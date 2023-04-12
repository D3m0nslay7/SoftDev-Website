<?php


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
//we start a session
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}
//checks if we are already logged in, if we are we return the user to index
if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //since we get an open connection by including db, we close it at the end for security reasons
    require_once("../elements/php/db.php");

    //echo "here";
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['usernamereg']) ? trim($_POST['usernamereg']) : null;
    $pass = !empty($_POST['passwordreg']) ? trim($_POST['passwordreg']) : null;
    $email = !empty($_POST['emailreg']) ? trim($_POST['emailreg']) : null;

    //sanitizes all the inputs here just in case
    htmlentities($username);
    htmlentities($pass);
    htmlentities($email);

    //the prepared statement is built and executed.
    $sql = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the provided username to our prepared statement.
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);

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

    //If the provided username already exists - display error.
    if ($row['num'] > 0) {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'form cannot be submitted'];
        echo json_encode($response);
        //return;
    } else {
        //echo sizeof($row);
        // "here somehow??";
        //Hash the password as we do NOT want to store our passwords in plain text.
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        // Prepare our INSERT statement.
        // We are inserting a new row into our users table.
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind our variables.
        mysqli_stmt_bind_param($stmt, "sss", $username, $passwordHash, $email);

        // Execute the statement.
        $result = mysqli_stmt_execute($stmt);

        //If the signup process is successful.
        if ($result) {
            header('Content-Type: application/json');
            $response = ['status' => 'success', 'message' => 'Form submitted successfully'];
            echo json_encode($response);
        }

        // Close the statement.
        mysqli_stmt_close($stmt);
    }



    //close the connection for saftey
    mysqli_close($conn);
} else {
    echo "How did you get here? sending you back";
}



?>