<?php

require_once('elements/php/db.php');
require_once('project_class.php');
//initalize array
$projects = [];
$users = [];

//we get all the users from the database here, 
$sqlusers = "SELECT * FROM users";
$result = mysqli_query($conn, $sqlusers);

if (mysqli_num_rows($result) > 0) {
    // we put each project into a project class, easier for us to use
    while ($user = mysqli_fetch_assoc($result)) {
        //echo $user["uid"];
        $users += array($user["uid"] => $user);
    }
} else {
    //echo "0 users";
}


//we get all the projects from database here
$sqlprojects = "SELECT * FROM projects";
$result = mysqli_query($conn, $sqlprojects);

//we get all the projects, check if we are above 0
if (mysqli_num_rows($result) > 0) {
    // we put each project into a project class, easier for us to use
    while ($row = mysqli_fetch_assoc($result)) {
        $project = New Project($row['pid'], $row['title'], $row['start_date'], $row['end_date'], $row['phase'], $row['description'], $row['uid'], $users[$row['uid']]["username"], $users[$row['uid']]["email"]);
        array_push($projects, $project);
    }
} else {
    //echo "0 projects";
}

//at the end we set users to nothing, we dont want to store user details other then in the projects
$users = null;

//close the connection since we the the database php above
mysqli_close($conn);

//now we have an array full of all project classes we can use