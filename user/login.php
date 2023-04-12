<?php
//checks if we are logged in, if we are then we return

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

    //Retrieve the field values from our registration form.
    $identiferlog = !empty($_POST['identiferlog']) ? trim($_POST['identiferlog']) : null;
    $passwordAttempt = !empty($_POST['passwordlog']) ? trim($_POST['passwordlog']) : null;
    
    //sanitizes all the inputs here just in case
    htmlentities($identiferlog);
    htmlentities($passwordAttempt);

    //Retrieve the user account information for the given username.
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    //Bind value.
    mysqli_stmt_bind_param($stmt, "ss", $identiferlog, $identiferlog);

    //Execute.
    mysqli_stmt_execute($stmt);

    //Fetch row.
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    //If $row is FALSE.
    if ($user === null) {
        //echo "here";
        //Could not find a user with that username!
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => "Username and password combination invalid"];
        echo json_encode($response);
    } else {


        //User account found.
        //Check to see if the given password matches the
        //password hash that we stored in our users table.
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        //If $validPassword is TRUE, the login has been successful.
        if ($validPassword) {

            //Provide the user with a login session. we check if no session exists first, in case we didnt start one above.
            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
            $_SESSION['user_id'] = $user['uid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_time'] = time();

            //tell the user its successfull and then we redirect them in the javascript return
             //Could not find a user with that username!
             header('Content-Type: application/json');
             $response = ['status' => 'success', 'message' => 'Successfully logged in'];
             echo json_encode($response);
             //echo "no here instead;";
        } else {
            //Could not find a user with that username!
            header('Content-Type: application/json');
            $response = ['status' => 'error', 'message' => 'Username and password combination invalid'];
            echo json_encode($response);
            //echo "i lied, here instead";
        }
    }

    //close the connection for saftey
    mysqli_close($conn);

} else {
    //Could not find a user with that username!
    header('Content-Type: application/json');
    $response = ['status' => 'error', 'message' => 'Idk how you are here, return user'];
    echo json_encode($response);
}



?>