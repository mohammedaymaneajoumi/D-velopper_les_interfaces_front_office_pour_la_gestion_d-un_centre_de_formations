<?php
include "connectDB.php"; 

session_start();

if (isset($_SESSION['user_email'])) {

    $user_email = $_SESSION['user_email'];

    $query = "SELECT nom_apprenant FROM apprenant WHERE email_apprenant = '$user_email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user's name from the query result//
        $user = mysqli_fetch_assoc($result);
        $user_name = $user['nom_apprenant'];

    }
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
  <link href="assets/css/css2.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Navbar ======= -->
  <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
    <div class="container py-2 py-md-5" style="max-width: 1579px;">
      <div class="row align-items-start">
        <div class="col-md-2">
          <ul class="custom-menu">
          <ul class="custom-menu">
            <li><a href="index.php">Home</a></li>

            <li class="active"><a href="about.php">
              <?php if(!empty($user_email)){ echo "Profile"; }?></a>
            </li>

            <li><a href="works.php">
              <?php if(!empty($user_email)){ echo "My Lists"; }?></a>
            </li>

            <li><a href="contact.php">Contact</a></li>

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
    <div class="container" style="max-width: 1580px;">
      <a class="navbar-brand" href="index.php">LearnIt.</a>
      <a href="#" class="burger" data-bs-toggle="collapse" data-bs-target="#main-navbar">
        <span></span>
      </a>
    </div>
  </nav>

  <main id="main">
    <section class="section pb-3" style="padding: 4rem 0;">
      <div class="container" style="max-width: 1580px;">
      <p style="font-size: 22px ;color:black ;">Your Profile </p>
        <div class="container bootstrap snippets bootdey" style="max-width: 1657px;">
          <div class="row">
          <div class="col-md-7">
            <section class="panel">
            <div class="panel-body profile-wrapper">
              
                <div class="col-md-2">
                    <div class="profile-pic text-center">
                        <img src="assets/img/ava-4.png" alt="" class="img-circle">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="profile-info">
                        <h1><?php echo "$user_name"; ?></h1>
                        <span class="text-muted"><?php echo "$user_email"; ?></span>
                        <p>
                        Welcome to my educational profile:) I'm passionate about learning and sharing knowledge. Dedicated to expanding my knowledge and skills through online courses and practical experience. Excited to connect with like-minded individuals and contribute to the LearnIt community.                        </p>
                        <div class="connect" style="display: flex;">
                            <a href="works.php"><button type="button" class="btn btn-primary btn-trans" > My Lists </button></a>
                            <?php
                              
                              // Check if the user is logged in
                              if (isset($_SESSION['user_email'])) {
                                  // User is logged in, show the log out button
                                  echo '<form action="logout.php" method="POST">';
                                  echo '<button type="submit" name="logout" class="btn btn-danger btn-trans" style="margin-left:10px">Log Out</button>';
                                  echo '</form>';
                              }
                            ?>
                        </div>
                      </div>
                  </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer class="footer" role="contentinfo" style="padding: 9rem 0 0 0;">
    <div class="container" style="max-width: 1580px;">
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