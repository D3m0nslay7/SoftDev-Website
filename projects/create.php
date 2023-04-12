<?php


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
//we start a session
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
//checks if we are already logged in, if we arent we return the user to index
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //since we get an open connection by including db, we close it at the end for security reasons
    require_once("../elements/php/db.php");

    //echo "here";
    //Retrieve the field values from our add form
    $title = !empty($_POST['createtitle']) ? trim($_POST['createtitle']) : null;
    $desc = !empty($_POST['createdesc']) ? trim($_POST['createdesc']) : null;
    $phase = !empty($_POST['createphase']) ? trim($_POST['createphase']) : null;
    $startDate = !empty($_POST['createstart']) ? trim($_POST['createstart']) : null;
    $endDate = !empty($_POST['createend']) ? trim($_POST['createend']) : null;
    $userID = $_SESSION['user_id'];

    //sanitizes all the inputs here just in case
    htmlentities($title);
    htmlentities($desc);
    htmlentities($phase);
    htmlentities($startDate);
    htmlentities($endDate);
    htmlentities($userID);

    //the prepared statement is built and executed. this is to check if we already have a project with the exact title
    $sql = "SELECT COUNT(title) AS num FROM projects WHERE title = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the provided project details to our prepared statement.
    mysqli_stmt_bind_param($stmt, "s", $title);

    // Execute.
    mysqli_stmt_execute($stmt);

    // Bind the result to a variable.
    mysqli_stmt_bind_result($stmt, $num);

    // Fetch the row.
    mysqli_stmt_fetch($stmt);

    // Store the result in an associative array.
    $row = array("num" => $num);
    // Close the statement.
    mysqli_stmt_close($stmt);

    //If the provided title already exists - display error.
    if ($row['num'] > 0) {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Already has project with title'];
        echo json_encode($response);
        //return;
    } else {
        //echo sizeof($row);
        // "here somehow??";

        // Prepare our INSERT statement.
        // We are inserting a new row into our projects table.
        $sql = "INSERT INTO projects (title, start_date, end_date, phase, description, uid) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind our variables.
        mysqli_stmt_bind_param($stmt, "ssssss", $title, $startDate, $endDate, $phase, $desc, $userID);

        // Execute the statement.
        $result = mysqli_stmt_execute($stmt);

        if ($result) {

            //gets the inserted row
            $inserted_row = mysqli_query($conn, "SELECT * FROM projects WHERE pid = " . mysqli_insert_id($conn));
            $row = mysqli_fetch_assoc($inserted_row);


            //If the creation process is successful.
            if ($row) {
                header('Content-Type: application/json');
                $response = ['status' => 'success', 'message' => 'Created project succesfully', 'projectID' => $row["pid"]];
                echo json_encode($response);
            }
        } else {
            header('Content-Type: application/json');
            $response = ['status' => 'error', 'message' => 'Unable to create project'];
            echo json_encode($response);
        }

        // Close the statement.
        mysqli_stmt_close($stmt);


    }
} else {
    echo "How did you get here? sending you back";
}



?>