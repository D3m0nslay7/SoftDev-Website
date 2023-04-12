<?php
//TODO:

?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once("elements/php/addons.php") ?>
    <link rel="stylesheet" type="text/css" href="elements/css/index.css">


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"v  content="width=device-width, initial-scale=1">

    <title>Landing Page</title>
</head>

<body>
    <header>
        <?php include_once("elements/php/navbar.php") ?>
    </header>
    <main>
        <section id="Information" style="background-color: #f4f5f7;">
            <div class="container pt-4 pb-4 text-center">
                <h1><b>Welcome to SoftDevs Website!</b></h1>
                <br>
                <p>
                    SoftDev is a software development company that provides custom solutions for businesses. Our team of
                    experienced developers, designers, and project managers work together to deliver high-quality
                    products for our clients. We offer a range of services including website development, software
                    development, and mobile app development.
                    <br>
                    <br>
                    We work collaboratively with our clients to ensure that we understand their unique needs and
                    requirements. This allows us to develop effective and user-friendly solutions that are tailored to
                    each client's goals and challenges. Our team has experience working with a variety of programming
                    languages, platforms, and frameworks.
                    <br>
                    <br>
                    At SoftDev, we are committed to delivering cost-effective solutions that help our clients succeed in
                    today's competitive market. Whether you are a small startup or a large enterprise, we have the
                    expertise and experience to help you achieve your goals. Thank you for visiting our website, and we
                    look forward to working with you!
                </p>
            </div>
        </section>
        <section id="Clients" style="background-color: #f4f5f7;">
            <div id="logo" class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="logoContainer rounded">
                        <h1 class="text-center">Previous Clients</h1>
                        <div class="d-flex justify-content-between">

                            <i class="fab fa-brands fa-facebook fa-4x"></i>
                            <i class="fab fa-brands fa-twitter fa-4x"></i>
                            <i class="fab fa-brands fa-paypal fa-4x"></i>
                            <i class="fab fa-brands fa-teamspeak fa-4x"></i>
                            <i class="fab fa-brands fa-skype fa-4x"></i>

                        </div>
                    </div>
                </div>

            </div>
        </section>


        <section id="Profile">
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <h1 class="text-center" style="background-color: #f4f5f7;">Profiles</h1>
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col mb-4">
                                    <div class="card mb-3" style="border-radius: .5rem;">
                                        <div class="row g-0">
                                            <div class="col-md-4 gradient-custom text-center text-black"
                                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                <img src="images/placeholderProfile.png" alt="Avatar"
                                                    class="img-fluid my-5" style="width: 80px;" />
                                                <h5>Umer Mohammed</h5>
                                                <p>Web Programmer</p>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body p-4">
                                                    <h6>Information</h6>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Email</h6>
                                                            <p class="text-muted">220181356@aston.ac.uk</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>ID</h6>
                                                            <p class="text-muted">220181356</p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <h6>
                                                <center>Skills</center>
                                            </h6>
                                            <section id="education">
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1 text-center">
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">Java</h6>
                                                        <p class="text-muted">Proficent</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">HTML5</h6>
                                                        <p class="text-muted">Proficent</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">Javascript</h6>
                                                        <p class="text-muted">Proficent</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">C#</h6>
                                                        <p class="text-muted">Proficent</p>
                                                    </div>
                                                </div>
                                            </section>
                                            <hr class="mt-0 mb-4">
                                            <div class="d-flex justify-content-center">
                                                <a href="https://github.com"><i
                                                        class="fab fa-github fa-lg mb-3 me-3"></i></a>
                                                <a href="https://twitter.com/?lang=en"><i
                                                        class="fab fa-twitter fa-lg mb-3 me-3"></i></a>
                                                <a href="https://www.linkedin.com/feed/"><i
                                                        class="fab fa-linkedin fa-lg mb-3"></i></a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card mb-3" style="border-radius: .5rem;">
                                        <div class="row g-0">
                                            <div class="col-md-4 gradient-custom text-center text-black"
                                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                <img src="images/placeholderProfile.png" alt="Avatar"
                                                    class="img-fluid my-5" style="width: 80px;" />
                                                <h5>Joe Goldberg</h5>
                                                <p>Investigator</p>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body p-4">
                                                    <h6>Information</h6>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Email</h6>
                                                            <p class="text-muted">Joe@aston.ac.uk</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>ID</h6>
                                                            <p class="text-muted">JoeG</p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <h6>
                                                <center>Skills</center>
                                            </h6>
                                            <section id="education">
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1 text-center">
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">Java</h6>
                                                        <p class="text-muted">Proficent</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">HTML5</h6>
                                                        <p class="text-muted">Not Proficent</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">Javascript</h6>
                                                        <p class="text-muted">Proficent</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6 id="skill">C#</h6>
                                                        <p class="text-muted">Not Proficent</p>
                                                    </div>
                                                </div>
                                            </section>
                                            <hr class="mt-0 mb-4">
                                            <div class="d-flex justify-content-center">
                                                <a href="https://github.com"><i
                                                        class="fab fa-github fa-lg mb-3 me-3"></i></a>
                                                <a href="https://twitter.com/?lang=en"><i
                                                        class="fab fa-twitter fa-lg mb-3 me-3"></i></a>
                                                <a href="https://www.linkedin.com/feed/"><i
                                                        class="fab fa-linkedin fa-lg mb-3"></i></a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <br>
            <br>
            <br>
        </section>
        <section class="home-testimonial">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">

                    <div class="col-md-12 d-flex justify-content-center">
                        <h2>Explore our Clients Experiences</h2>
                    </div>
                </div>
                <div id="testimonals" class="row">
                    <div class="col">
                        <div class="card text-center h-100">
                            <center>
                                <img src="images/Testimonial (2).jpg" class="img-fluid" style="width: 80px; " />
                            </center>
                            <div class="card-body">
                                <h5 class="card-title">Nick Powell</h5>
                                <p class="card-text">
                                <blockquote cite="#">&ldquo;
                                    SoftDev listened and
                                    delivered a professional website that captured my vision.
                                    Highly recommended for web development services.&ldquo;
                                </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center h-100">
                            <center>
                                <img src="images/Testimonial (2).jpg" class="img-fluid" style="width: 80px; " />
                            </center>
                            <div class="card-body">
                                <h5 class="card-title">Nick Powell</h5>
                                <p class="card-text">
                                <blockquote cite="#">&ldquo;
                                    SoftDev provided expert
                                    software development services, delivering a high-quality
                                    solution that exceeded our expectations. Highly recommended for their
                                    technical
                                    expertise and professionalism.&ldquo;
                                </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center h-100">
                            <center>
                                <img src="images/Testimonial (2).jpg" class="img-fluid" style="width: 80px; " />
                            </center>
                            <div class="card-body">
                                <h5 class="card-title">Nick Powell</h5>
                                <p class="card-text">
                                <blockquote cite="#">&ldquo;SoftDev's
                                    exceptional web
                                    design expertise and responsive customer service helped us launch our
                                    new
                                    website quickly and easily. Highly recommend their services.&ldquo;
                                </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


    </main>

    <?php include_once("elements/php/footer.php") ?>



</body>

</html>