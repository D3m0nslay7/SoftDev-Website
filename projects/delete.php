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

    //Retrieve the field values from our delete form
    $projectID = !empty($_POST['deleteprojectID']) ? trim($_POST['deleteprojectID']) : null;


    // Prepare our update statement.
    // We are updating a row in our projects table.
    $sql = "DELETE FROM projects WHERE pid = ?";

    $stmt = mysqli_prepare($conn, $sql);

    // Bind our variables.
    mysqli_stmt_bind_param($stmt, "s", $projectID); 

    // Execute the statement.
    $result = mysqli_stmt_execute($stmt);
    
    //If the update process is successful.
    if ($result) {

        header('Content-Type: application/json');
        $response = ['status' => 'success', 'message' => 'Deleted project ' . $projectID . ' succesfully'];
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Unable to delete project ' . $projectID];
        echo json_encode($response);
    }

    // Close the statement.
    mysqli_stmt_close($stmt);
} else {
    echo "How did you get here? sending you back";
}



?>