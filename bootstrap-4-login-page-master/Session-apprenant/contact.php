<?php
include "connectDB.php"; //connect db

session_start();

if (isset($_SESSION['user_email'])) {

  // Get the user's email address from the session
  $user_email = $_SESSION['user_email'];

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=https://fonts.googleapis.com/css?family=Inconsolata:400,500,600,700|Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Navbar ======= -->
  <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
    <div class="container py-2 py-md-5" style="max-width: 1541px;">
      <div class="row align-items-start">
      <div class="col-md-2">
      <ul class="custom-menu">
            <li><a href="index.php">Home</a></li>

            <li><a href="about.php">
              <?php if(!empty($user_email)){ echo "Profile"; }?></a>
            </li>

            <li><a href="works.php">
              <?php if(!empty($user_email)){ echo "My Lists"; }?></a>
            </li>


            <li class="active"><a href="contact.php">Contact</a></li>

            <li><a href="../login.php">
              <?php if(empty($user_email)){ echo "log in"; }?></a>
            </li>

            <li><a href="../Register.php">
              <?php if(empty($user_email)){ echo "Register"; }?></a>
            </li>
          </ul>
          </div>
        <div class="col-md-6 d-none d-md-block  mr-auto">
          <div class="tweet d-flex">
            <span class="bi bi-twitter text-white mt-2 mr-3"></span>
            <div>
              <p><em>If you have any questions or feedback about our website or any services, please don't hesitate to contact us. 
                We are always happy to hear from our users and to help them achieve their educational goals. <br> <a href="#">t.co/v82jsk</a></em></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-none d-md-block">
          <h3>about us</h3>
          <p>Welcome to Learnit, an online platform dedicated to helping students of all ages and backgrounds to learn, grow and achieve their educational goals.
            <br> 
            <a href="#">LearnIt@gmail.com</a></p>
        </div>
      </div>

    </div>
  </div>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container" style="max-width: 1541px; padding:0;">
      <a class="navbar-brand" href="index.php">LearnIt.</a>
      <a href="#" class="burger" data-bs-toggle="collapse" data-bs-target="#main-navbar">
        <span></span>
      </a>
    </div>
  </nav>

  <main id="main">

    <section class="section pb-5" style="padding: 4rem 0;">
      <div class="container" style="max-width: 1541px; padding:0;">

        <div class="row mb-5 align-items-end">
          <div class="col-md-6" data-aos="fade-up">
            <h2>Contact</h2>
            <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam necessitatibus incidunt ut
              officiis explicabo inventore.
            </p>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-up">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">

              <div class="row gy-3">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject" required>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Message</label>
                  <textarea class="form-control" name="message" cols="30" rows="10" required></textarea>
                </div>

                <div class="col-md-12 my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>

                <div class="col-md-6 mt-0 form-group">
                  <input type="submit" class="readmore d-block w-100" value="Send Message">
                </div>
              </div>

            </form>

          </div>

        </div>

      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer class="footer" role="contentinfo" style=" padding: 9rem 0 2rem 0;">
    <div class="container" style="max-width: 1541px;">
      <div class="row">
        <div class="col-sm-6">
          <p class="mb-1">&copy; Copyright LearnIt. All Rights Reserved</p>
          <div class="credits">
          </div>
        </div>
        <div class="col-sm-6 social text-md-end">
          <a href="#"><span class="bi bi-twitter"></span></a>
          <a href="#"><span class="bi bi-facebook"></span></a>
          <a href="#"><span class="bi bi-instagram"></span></a>
          <a href="#"><span class="bi bi-linkedin"></span></a>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>