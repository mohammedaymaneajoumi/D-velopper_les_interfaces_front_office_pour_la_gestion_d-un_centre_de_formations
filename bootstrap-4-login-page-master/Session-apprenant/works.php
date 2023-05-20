<?php
include "connectDB.php"; //connect db

session_start();

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {

    // Get the user's email address from the session
    $user_email = $_SESSION['user_email'];
    $id_apprenant = $_SESSION['id_apprenant'];
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
  <link href="assets/css/css5.css" rel="stylesheet">
  <link href="assets/css/css6.css" rel="stylesheet">


  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

  


</head>

<body>

  <!-- ======= Navbar ======= -->
  <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
    <div class="container py-2 py-md-5" style="max-width: 1545px;">
      <div class="row align-items-start">
        <div class="col-md-2">
        <ul class="custom-menu">
            <li ><a href="index.php">Home</a></li>

            <li><a href="about.php">
              <?php if(!empty($user_email)){ echo "Profile"; }?></a>
            </li>

            <li class="active"><a href="works.php">
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
  <div class="container" style="max-width: 1546px; " >
      <a class="navbar-brand" href="index.php">LearnIt.</a>
      <a href="#" class="burger" data-bs-toggle="collapse" data-bs-target="#main-navbar">
        <span></span>
      </a>
    </div>
  </nav>
  <main id="main">
  <div class="tabs-to-dropdown">
  <div class="nav-wrapper d-flex align-items-center justify-content-between" style="margin-top: 50px;">
    <ul class="nav nav-pills d-none d-md-flex" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-company-tab" data-toggle="pill" href="#pills-company" role="tab" aria-controls="pills-company" aria-selected="true" >in progress</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-product-tab" data-toggle="pill" href="#pills-product" role="tab" aria-controls="pills-product" aria-selected="false" >old courses</a>
      </li>
    </ul>
  </div>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">
    <div class="container-fluid d-flex">

    <?php 
      $sql ="SELECT * FROM formation f INNER JOIN session s ON s.id_formation = f.id_formation 
      INNER JOIN inscrire i ON i.id_session = s.id_session WHERE i.id_apprenant = $id_apprenant";
      $resultat = mysqli_query($conn,$sql);
      
      while($row_resultat = mysqli_fetch_assoc($resultat)){
        // $id_formation = $row_resultat['id_formation'];
    ?>
      <?php
        if(mysqli_num_rows($resultat) > 0){
          ?>
            <a href="#" class="card ms-4">
              <?php
                if (!empty($row_resultat['image'])) {
                  echo '<img class="card__img d-block"  src="data:image/jpeg;base64,'.base64_encode($row_resultat['image']).'"/>';
                } 
              ?>
            
              <span class="card__footer">
                <p style="margin-top: 1rem;"><?php echo $row_resultat['titre']; ?>(ends in <?php echo $row_resultat['date_fin']; ?>)</p>
                
              </span>

            </a>
          <?php 
        }else{
          ?>
          <h1>No formation exicte</h1>
          <?php
        }
      }
      ?>

    </div>

    </div>
    <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
    <div class="container-fluid d-flex">

<?php 
  $sql_old ="SELECT * FROM formation f INNER JOIN session s ON s.id_formation = f.id_formation 
  INNER JOIN inscrire i ON i.id_session = s.id_session WHERE i.id_apprenant = $id_apprenant";
  $resultat_old = mysqli_query($conn,$sql_old);

  
  while($row_resultat_old = mysqli_fetch_assoc($resultat_old)){
    $formation_id = $row_resultat_old['id_formation'];
?>
  <?php
  $sql_old_fin = "SELECT * FROM session WHERE id_formation = $formation_id AND id_session IN (SELECT id_session FROM iscrire WHERE id_appreant = $id_apprenant AND DATEDIFF(CURRENT_DATE,Date_inscription)>date_fin )";
    if(mysqli_num_rows($resultat_old) > 0){
      ?>
        <a href="#" class="card ms-4">
          <?php
            if (!empty($row_resultat_old['image'])) {
              echo '<img class="card__img d-block"  src="data:image/jpeg;base64,'.base64_encode($row_resultat_old['image']).'"/>';
            } 
          ?>
        
          <span class="card__footer">
            <p style="margin-top: 1rem;"><?php echo $row_resultat_old['titre']; ?></p>
            
          </span>

        </a>
      <?php 
    }else{
      echo "<h1>No formation exicte</h1>";

    }
  }

  ?>

</div>
    </div>
  </div>
</div>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer class="footer" role="contentinfo" style=" padding: 9rem 0 2rem 0;">
    <div class="container" style="max-width: 1541px;">
      <div class="row">
        <div class="col-sm-6">
          <p class="mb-1">&copy; Copyright LearnIt. All Rights Reserved</p>
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
  <script src="assets/js/js2.js"></script>


</body>

</html>