<?php
//TODO:
//we need this for the projects
$page = "projects";
?>


<!doctype html>
<html lang="en">

<head>
    <!-- External imported stuff -->
    <?php include_once("elements/php/addons.php") ?>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projects Page</title>
</head>

<body>
    <header>
        <?php include_once("elements/php/navbar.php") ?>
    </header>
    <main>
        <section id="projects">
            <div class="container pt-4"
                style="padding:20px; background-color: #f2f2f2; border-radius: 10px; margin:auto;">


                <?php
                //we get all the projects and store them in an array here, we import a class php that deals with creating and returning to us a class for each row of the project we send it.
                //this php does it all for us
                require_once("elements/php/project_implementation/projects_cards.php");
                ?>

            </div>

        </section>

    </main>


    <?php include_once("elements/php/footer.php") ?>
</body>

</html>