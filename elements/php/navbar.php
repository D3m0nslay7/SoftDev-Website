<?php
//we start a session for variables we need
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SoftDev.Co</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projects.php">Projects</a>
                </li>
                <?php if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="panel.php">User Panel</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <?php // if we arent logged in, we show this stuff, however if we are we show the else statement
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) { ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Register</a>
                    </li>
                </ul>

            <?php } else { ?>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#logoutModal" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <?php // we echo the username of the logged in person
                                echo "Hello " . $_SESSION['username'] ?>
                        </a>
                    </li>
                </ul>

            <?php } ?>
        </div>
    </div>
</nav>


<!--- We add a modal so that the user can double check if they want to logout or not. -->
<!-- Modal -->
<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="logout()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    //little script for the modal button
    function logout() {
        // Perform logout action
        window.location.href = "user/logout.php";
    }
</script>