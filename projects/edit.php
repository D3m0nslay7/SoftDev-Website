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
    //Retrieve the field values from our edit form
    $title = !empty($_POST['edittitle']) ? trim($_POST['edittitle']) : null;
    $desc = !empty($_POST['editdesc']) ? trim($_POST['editdesc']) : null;
    $phase = !empty($_POST['editphase']) ? trim($_POST['editphase']) : null;
    $startDate = !empty($_POST['editstart']) ? trim($_POST['editstart']) : null;
    $endDate = !empty($_POST['editend']) ? trim($_POST['editend']) : null;
    $projectID = !empty($_POST['editprojectID']) ? trim($_POST['editprojectID']) : null;


    //sanitizes all the inputs here just in case
    htmlentities($title);
    htmlentities($desc);
    htmlentities($phase);
    htmlentities($startDate);
    htmlentities($endDate);
    htmlentities($userID);
    htmlentities($projectID);

    // Prepare our update statement.
    // We are updating a row in our projects table.
    $sql = "UPDATE projects SET title = ?, start_date = ?, end_date = ?, phase = ?, description = ? WHERE pid = ?";

    $stmt = mysqli_prepare($conn, $sql);

    // Bind our variables.
    mysqli_stmt_bind_param($stmt, "ssssss", $title, $startDate, $endDate, $phase, $desc, $projectID);

    // Execute the statement.
    $result = mysqli_stmt_execute($stmt);
    
    //If the update process is successful.
    if ($result) {

        header('Content-Type: application/json');
        $response = ['status' => 'success', 'message' => 'Edited project ' . $projectID . ' succesfully'];
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Unable to edit project ' . $projectID];
        echo json_encode($response);
    }

    // Close the statement.
    mysqli_stmt_close($stmt);
} else {
    echo "How did you get here? sending you back";
}



?>