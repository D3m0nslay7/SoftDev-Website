<?php
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}
if (isset($_SESSION['user_id'])) {

session_destroy();
//Redirect to our protected page, which we called home.php
header('Location: ../index.php');
} else {
echo "How can you see this, you're not logged in";
}
?>