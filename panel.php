<?php
//TODO:
//we need this for the projects
$page = "panel";
//checks if we are logged in, if we arent we return the user to index
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once("elements/php/addons.php") ?>
    <link rel="stylesheet" type="text/css" href="elements/css/index.css">


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" v content="width=device-width, initial-scale=1">

    <title>Panel Page</title>
</head>

<body>
    <header>
        <?php include_once("elements/php/navbar.php") ?>
    </header>
    <main>

        <div class="container align-items-center" style="padding: 20px;">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Create Project
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <form id="createform">
                                <div class="mb-3">
                                    <label for="createtitle" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="createtitle" id="createtitle"
                                        aria-describedby="createtitlehelp" maxlength="100" required>
                                    <div id="createtitleHelp" class="form-text">Title of project, max 60 characters
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="createdesc" class="form-label">Description</label>
                                    <textarea type="textarea" class="form-control" name="createdesc" id="createdesc"
                                        aria-describedby="createdeschelp" maxlength="500" required></textarea>
                                    <div id="createdescHelp" class="form-text">Description of the Project, max 500 characters</div>
                                </div>
                                <div class="mb-3">
                                    <label for="createphase" class="form-label">Phase</label>
                                    <select class="form-select" aria-label="Default select example" id="createphase"
                                        name="createphase" aria-describedby="createphaseHelp" required>

                                        <option value="Design">Design</option>
                                        <option value="Development">Development</option>
                                        <option value="Testing">Testing</option>
                                        <option value="Deployment">Deployment</option>
                                        <option value="Complete">Complete</option>
                                    </select>
                                    <div id="createphaseHelp" class="form-text">
                                        The current phase the project is in
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="createstart" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="createstart" id="createstart"
                                        aria-describedby="createstarthelp" required>
                                    <div id="createstartHelp" class="form-text">Project start date. Must be 1+ days from
                                        today</div>
                                </div>
                                <div class="mb-3">
                                    <label for="createend" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="createend" id="createend"
                                        aria-describedby="createendhelp">
                                    <div id="createendHelp" class="form-text">Project end date. cannot come before start
                                        date</div>
                                </div>
                                <div class="mb-3">
                                    <label for="createuserID" class="form-label">User ID</label>
                                    <input type="text" value="<?php echo $_SESSION['user_id'] ?>" class="form-control"
                                        name="createuserID" id="createuserID" aria-describedby="createuserIDhelp"
                                        disabled>
                                    <div id="createuserIDHelp" class="form-text">User ID of person who is creating the
                                        project</div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Edit/Delete Project
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <!-- Here we spawn all the projects and then have it so we can edit each one -->

                            <div class="container">

                                <?php
                                //we get all the projects and store them in an array here, we import a class php that deals with creating and returning to us a class for each row of the project we send it.
                                //this php does it all for us
                                require_once("elements/php/project_implementation/projects_cards.php");
                                ?>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- external js -->
    <script src="projects/createform.js"></script>
    <script src="projects/editform.js"></script>
    <script src="projects/deleteform.js"></script>

    <?php include_once("elements/php/footer.php") ?>
</body>

</html>