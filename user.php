<!doctype html>
<html lang="en">

<head>
    <?php include_once("elements/php/addons.php");


    //checks if we are logged in, if we are we goback to the homepage
    
    //checks if we are already logged in, if we are we return the user to index
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit;
    }
    ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" v content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .flip-container {
            position: relative;
            perspective: 1000;
        }


        .flipper {
            position: relative;
            background: #f5f5f5;
            transition: 0.6s;
            transform-style: preserve-3d;
        }

        .front,
        .back {
            /*background-color: rgba(0,0,0,.3);*/
            position: absolute;
            padding: 10px 10px;
            top: 0;
            left: 0;
            right: 0;

            backface-visibility: hidden;
        }

        .front {
            z-index: 2;
            /* for firefox 31 */
            transform: rotateY(0deg);
        }

        .back {
            transform: rotateY(180deg);
        }

        .flip {
            transform: rotateY(180deg);
        }
    </style>

    <title>Register/Login Page</title>
</head>

<body>
    <header>
        <?php include_once("elements/php/navbar.php") ?>
    </header>


    <main>
        <section id="register/login">

            <div class="container">
                <div class="flip-container">
                    <div class="flipper" id="flipper">
                        <div class="front">
                            <div class="row justify-content-center">
                                <div class="col-md-7 col-lg-10">
                                    <div class="login-wrap p-4 p-md-5">
                                        <div class="card border-dark mb-3">
                                            <div class="card-header" style="justify-content: space-between;">User</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Login</h5>
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <i class="fa-regular fa-user"></i>
                                                </div>
                                                <form id="loginform">

                                                    <div class="mb-3">
                                                        <label for="identiferlog"
                                                            class="form-label">Username/Email</label>
                                                        <input type="text" class="form-control" id="identiferlog"
                                                            name="identiferlog" aria-describedby="loginHelp"
                                                            maxlength="255" required>
                                                        <small id="loginHelp" class="form-text text-muted">Please enter
                                                            your
                                                            username OR email to login
                                                        </small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label id="password-strength-text" for="passwordlog"
                                                            class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="passwordlog"
                                                            name="passwordlog" maxlength="20" required>
                                                        <span class="input-group-text"
                                                            onclick="password_show_hide_log();">
                                                            <i class="fas fa-eye" id="show_eye_log"></i>
                                                            <i class="fas fa-eye-slash d-none" id="hide_eye_log"></i>
                                                        </span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Login</button>
                                                        <button type="button" id="registerButton"
                                                            class="btn btn-secondary">Click to Register</button>
                                                    </div>
                                                    <br>
                                                    <div id="formAlertLog" class="alert justify-content-end"
                                                        role="alert">
                                                        <!-- Alert message goes here -->


                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back">

                            <div class="row justify-content-center">
                                <div class="col-md-7 col-lg-10">
                                    <div class="register-wrap p-4 p-md-5">

                                        <div class="card border-dark mb-3">
                                            <div class="card-header">User</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Register</h5>
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <i class="fa-regular fa-user"></i>
                                                </div>
                                                <form id="registerForm">

                                                    <div class="mb-3">
                                                        <label for="usernamereg" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="usernamereg"
                                                            name="usernamereg" maxlength="25"
                                                            aria-describedby="usernameHelp" required>
                                                        <small id="usernameHelp" class="form-text text-muted">Username
                                                            must not contain any of these characters: !, -, _, @, #, %,
                                                            &, *, {, }, :, and ;<br>Can only be 25 characters in
                                                            length</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="emailreg">Email address</label>
                                                        <input type="email" class="form-control" id="emailreg"
                                                            name="emailreg" maxlength="255" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="confirmEmailreg">Confirm Email address</label>
                                                        <input type="email" class="form-control" id="confirmemailreg"
                                                            name="confirmemailreg" aria-describedby="emailHelp"
                                                            maxlength="255" required>
                                                        <small id="emailHelp" class="form-text text-muted">We'll never
                                                            share
                                                            your
                                                            email with
                                                            anyone
                                                            else.</small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label id="password-strength-text" for="passwordreg"
                                                            class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="passwordreg"
                                                            name="passwordreg" maxlength="20"
                                                            aria-describedby="passwordHelp" required>
                                                        <span class="input-group-text"
                                                            onclick="password_show_hide_reg();">
                                                            <i class="fas fa-eye" id="show_eye_reg"></i>
                                                            <i class="fas fa-eye-slash d-none" id="hide_eye_reg"></i>
                                                        </span>
                                                        <small id="passwordHelp" class="form-text text-muted">Password
                                                            must not contain any of these characters: !, -, _, @, #, %,
                                                            &, *, {, }, :, and ;<br>Can only be 20 characters in
                                                            length</small>
                                                    </div>
                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="privacyCheck" name="privacyCheck">
                                                        <label class="form-check-label" for="privacyCheck"><a
                                                                href="#">Privacy
                                                                Agreement</a></label>
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Sign
                                                            Up</button>
                                                        <button type="button" id="loginButton"
                                                            class="btn btn-secondary">Click to Login</button>
                                                    </div>
                                                    <br>
                                                    <div id="formAlertReg" class="alert justify-content-end"
                                                        role="alert">
                                                        <!-- Alert message goes here -->


                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- external js -->
    <script src="elements/js/popup.js"></script>
    <script src="user/registerform.js"></script>
    <script src="user/loginform.js"></script>
    <!-- Here we add a few password functions -->
    <script src="elements/js/password.js"></script>
    <script>
        var loginButton = document.getElementById("loginButton");
        var registerButton = document.getElementById("registerButton");

        loginButton.onclick = function () {
            document.querySelector("#flipper").classList.toggle("flip");
        }

        registerButton.onclick = function () {
            document.querySelector("#flipper").classList.toggle("flip");
        }
    </script>


    <?php include_once("elements/php/footer.php") ?>
</body>

</html>