<?php
require_once('projects_insert.php');
//here we insert cards for each project item. requires project insert.

//here we include the search bar to search through cards ?>

<div class="container">
    <div style="height: 50px; width:100%; display: flex; align-items: center; justify-content: space-between;">
        <h5>Search by End Date</h5>
        <h5>Search by Title</h5>
    </div>
    <div style="height: 50px; width:100%; display: flex; align-items: center; justify-content: space-between;">
        <input id="search-date" id="search-text" type="date" style="width: 40%; height: 100%;">
        <input id="search-text" type="text" style="width: 40%; height: 100%;" placeholder="Title">
    </div>
</div>
<?php
//we check if there are any projects 
if (count($projects) <= 0) { ?>
    <br>
    <div class="col">
        <center>
            <h3>
                We dont have any projects, register or login to gain access to the user panel, where you can insert,
                update
                and delete projects!
            </h3>
        </center>
    </div>
<?php } ?>
<div class="row row-cols-1 row-cols-md-2 g-4 pt-4">


    <?php foreach ($projects as $project) { ?>
        <div id="projectcon-<?php echo $project->getPID() ?>">

            <div class="col">
                <div class="card h-100">
                    <div class="card-header">Project
                        <?php echo $project->getPID() ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $project->getTitle(); ?>
                        </h5>
                        <p class="card-text">
                            <hr class="mt-0 mb-4">
                        <h5>Description</h5>
                        <?php echo $project->getDesc(); ?>
                        </p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Duration:</b>
                            <?php echo $project->getDuration() ?>
                        </li>
                        <li class="list-group-item"><b>Start Date: </b>
                            <?php echo $project->getStartDate() ?><b> | End Date:</b>
                            <div class="end-date">
                                <?php echo $project->getEndDate() ?>
                            </div>
                        </li>
                    </ul>

                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <div class="col d-flex">
                                <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal<?php echo $project->getPID() ?>">Details</button>
                                <?php if ($page === "panel") { ?>
                                    <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo $project->getPID() ?>">Edit</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?php echo $project->getPID() ?>">Delete</button>
                                <?php } ?>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary" disabled>
                                    <?php echo "Project ID: " . $project->getPID() ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>

</div>

<?php
//we do it again as we wrap the above cards in a column row container
foreach ($projects as $project) { ?>
    <div id="projectcon-<?php echo $project->getPID() ?>">
        <!-- Modal for the details button -->
        <div class="modal fade" id="detailsModal<?php echo $project->getPID() ?>" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="detailsBackdropLabel<?php echo $project->getPID() ?>" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailsModalLabel<?php echo $project->getPID() ?>">
                            <?php echo $project->getTitle() ?>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Description</h5>
                        <p>
                            <?php echo $project->getDesc() ?>
                        </p>
                        <hr>
                        <h5>Phase:
                            <?php echo $project->getPhase() ?>
                        </h5>
                        <hr>
                        <p>
                            <b>Duration:</b>
                            <?php echo $project->getDuration() ?>
                            <b>| Start Date: </b>
                            <?php echo $project->getStartDate() ?>
                            <b>| End Date:</b>
                            <?php echo $project->getEndDate() ?>
                        </p>
                        <hr>
                        <h5>Creator Information</h5>
                        <p>
                            <b>User ID: </b>
                            <?php echo $project->getUID() ?><br>
                            <b>Username: </b>
                            <?php echo $project->getUsername() ?><br>
                            <b>User Email: </b>
                            <?php echo $project->getUserEmail() ?>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled>
                            <?php echo "Project ID: " . $project->getPID() ?>
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for the edit button, we only make this if we are on the panel page -->
        <?php if ($page === "panel") { ?>
            <div class="modal fade" id="editModal<?php echo $project->getPID() ?>" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="editBackdropLabel<?php echo $project->getPID() ?>" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="editform" data-project-id="<?php echo $project->getPID() ?>">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel<?php echo $project->getPID() ?>">
                                    <?php echo $project->getTitle() ?>
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edittitle" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="edittitle" id="edittitle"
                                        aria-describedby="edittitlehelp" maxlength="60"
                                        value="<?php echo $project->getTitle() ?>" required>
                                    <div id="edittitleHelp" class="form-text">Title of project, max 60 characters
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="editdesc" class="form-label">Description</label>
                                    <textarea type="textarea" class="form-control" name="editdesc" id="editdesc"
                                        aria-describedby="editdeschelp" required><?php echo $project->getDesc() ?>"</textarea>
                                    <div id="editdescHelp" class="form-text">Description of the Project</div>
                                </div>
                                <div class="mb-3">
                                    <label for="editphase" class="form-label">Phase</label>
                                    <select class="form-select" aria-label="Default select example" id="editphase"
                                        name="editphase" aria-describedby="editphaseHelp" required>
                                        <option value="design" <?php if ($project->getPhase() === "design") {
                                            echo "selected";
                                        } ?>>
                                            Design</option>
                                        <option value="development" <?php if ($project->getPhase() === "development") {
                                            echo "selected";
                                        } ?>>Development</option>
                                        <option value="testing" <?php if ($project->getPhase() === "testing") {
                                            echo "selected";
                                        } ?>>
                                            Testing</option>
                                        <option value="deployment" <?php if ($project->getPhase() === "deployment") {
                                            echo "selected";
                                        } ?>>Deployment</option>
                                        <option value="complete" <?php if ($project->getPhase() === "complete") {
                                            echo "selected";
                                        } ?>>Complete</option>
                                    </select>
                                    <div id="editphaseHelp" class="form-text">
                                        The current phase the project is in
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="editstart" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="editstart" id="editstart"
                                        aria-describedby="editstarthelp" value="<?php echo $project->getStartDate() ?>"
                                        required>
                                    <div id="editstartHelp" class="form-text">Project start date. Must be 1+ days from
                                        today</div>
                                </div>
                                <div class="mb-3">
                                    <label for="editend" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="editend" id="editend"
                                        aria-describedby="editendhelp" value="<?php echo $project->getEndDate() ?>">
                                    <div id="editendHelp" class="form-text">Project end date. cannot come before start
                                        date</div>
                                </div>
                                <div class="mb-3">
                                    <label for="edituserID" class="form-label">User ID</label>
                                    <input type="text" value="<?php echo $project->getUID() ?>" class="form-control"
                                        name="edituserID" id="edituserID" aria-describedby="edituserIDhelp" disabled>
                                    <div id="edituserIDHelp" class="form-text">Can only edit the project if you're the creator
                                        of
                                        this project</div>
                                </div>
                                <div class="mb-3">
                                    <label for="editprojectID" class="form-label">Project ID</label>
                                    <input type="text" value="<?php echo $project->getPID() ?>" class="form-control"
                                        name="editprojectID" id="editprojectID" aria-describedby="editprojectIDhelp" disabled>
                                    <div id="editprojectIDHelp" class="form-text">The project's ID</div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- Can only edit this project if we created it -->
                                <?php if ($project->getUID() === $_SESSION['user_id']) { ?>
                                    <button type="submit" class="btn btn-danger">Save Changes</button>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php } ?>

        <!-- Modal for the delete button, we only make this if we are on the panel page -->
        <?php if ($page === "panel") { ?>
            <!-- Modal -->
            <div class="modal fade" id="deleteModal<?php echo $project->getPID() ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $project->getPID() ?>"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?php echo $project->getPID() ?>">Delete Project <?php echo $project->getPID() ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <?php if ($project->getUID() === $_SESSION['user_id']) { ?>
                                Are you sure you want to delete this project? be warned, there is no turning back!
                            <?php } else { ?>
                                You cannot delete this project as you're not the user that created it.
                            <?php } ?>
                        </div>
                        <form id="deleteform" data-project-id="<?php echo $project->getPID() ?>">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <?php if ($project->getUID() === $_SESSION['user_id']) { ?>
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<script src="elements/js/filterprojects.js"></script>