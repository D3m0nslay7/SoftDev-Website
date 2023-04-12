<?php
//TODO:

?>


<!doctype html>
<html lang="en">

<head>
    <!-- External imported stuff -->
    <?php include_once("elements/php/addons.php") ?>

    <!-- I have this style in a document level because I dont want the same behaviour for every container in all pages-->
    <style>
        #formAlert {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 10000;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact Page</title>
</head>

<body>
    <div id="formAlert" class="alert" role="alert">
        <!-- Alert message goes here -->


    </div>
    <header>
        <?php include_once("elements/php/navbar.php") ?>
    </header>
    <main>
        <section id="contact-us">
            <div class="container-md" style="padding: 20px;">
                <div class="card border-dark mb-3">
                    <div class="card-header">Proposal</div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Contact Us</h5>

                        <hr class="mt-0 mb-4">
                        <p class="card-text">


                        <form id="contactForm">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" required>

                            </div>
                            <div class="form-group">
                                <label for="confirmEmail">Confirm Email address</label>
                                <input type="email" class="form-control" id="confirmemail" aria-describedby="emailHelp"
                                    required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone
                                    else.</small>
                            </div>
                            <br>
                            <hr class="mt-0 mb-4">
                            <div class="form-group">
                                <label for="description">Project Description</label>
                                <textarea id="description" class="form-control" type="textarea"></textarea>
                            </div>
                            <br>
                            <hr class="mt-0 mb-4">
                            <div class="form-group">
                                <label for="startDate">Proposed Start</label>
                                <input id="startDate" class="form-control" type="date" required />
                            </div>
                            <div class="form-group">
                                <label for="endDate">Expected End</label>
                                <input id="endDate" class="form-control" type="date" required />
                            </div>

                            <br>
                            <hr class="mt-0 mb-4">
                            <div class="form-group">
                                <label for="phone">Enter a phone number:</label><br>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="123-45-678"
                                    pattern="[0-9]{2}-[0-9]{3}-[0-9]{3}-[0-9]{3}" required>
                            </div>
                            <small>Format: (00)-123-456-789</small>
                            <br>
                            <hr class="mt-0 mb-4">

                            <h6>How would you like to be contacted?</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="sms" id="smsCheck">
                                <label class="form-check-label" for="smsCheck">
                                    SMS
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="email" id="emailCheck">
                                <label class="form-check-label" for="emailCheck">
                                    Email
                                </label>
                            </div>
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="privacyCheck">
                                <label class="form-check-label" for="privacyCheck">
                                    Do you agree to our privacy and statements? View <a href="#">Here</a>
                                </label>
                            </div>

                            <!-- BECAUSE WE DO NOT REQUIRE AN ADRESS, THIS HAS BEEN COMMENTED OUT.
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="mail" id="mailCheck">
                                <label class="form-check-label" for="mailCheck">
                                    Mail
                                </label>
                            </div>

                            -->

                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </p>
                    </div>
                </div>
            </div>




        </section>


    </main>

    <div aria-live="polite" aria-atomic="true" style="position: relative;">

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1">

            <div class="toast" id="form-toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto">Form Output</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <!-- Toast message will appear here -->
                </div>
            </div>
        </div>
    </div>

    <!-- external js -->
    <script src="elements/js/contactform.js"></script>
    <script src="elements/js/livealert.js"></script>

    <!-- Footer-->
    <?php include_once("elements/php/footer.php") ?>

</body>

</html>