<?php
include "connectDB.php"; 

session_start();

if (isset($_SESSION['user_email'])) {

    //sess
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
  <script src="https://kit.fontawesome.com/1171a84c58.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-1gW/ujGUKIQ9XzKy0OVqy3qCwV8f2tjuRZIK+a04Z5yi5iynDcqXbXj+jyehdeceEpz4o4+M4mzDfrKjJ+m3Ew==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/css.css" rel="stylesheet">
  <link href="assets/css/css3.css" rel="stylesheet">


  <!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  

</head>

<body>

  <!-- ========================================== -->
  <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
    <div class="container py-2 py-md-5" style="max-width: 1579px;">
      <div class="row align-items-start">
        <div class="col-md-2">
          <ul class="custom-menu">
            <li class="active"><a href="index.php">Home</a></li>

            <li><a href="about.php">
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
    <div class="container" style="max-width: 1546px; " >
      <a class="navbar-brand" href="index.php">LearnIt.</a>
      <a href="#" class="burger" data-bs-toggle="collapse" data-bs-target="#main-navbar">
        <span></span>
      </a>
    </div>
  </nav>

  <main id="main">

  <!-- ========================================== -->
  <section class="section site-portfolio" style="padding: 4rem 0 0 0!important;">
      <div class="container" style="max-width: 1546px; ">
        <div class="row mb-5 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0 pb-3" data-aos="fade-up">
            <form action="work-single.php" method="post">
              <input type="search" name="filters" value="" placeholder="tap somthing here...." style="width: 478px;padding: 3px;">
              <input type="submit" name="send" class="btn btn-outline-dark" value="search" style="padding: 3px;">

            </form>
            <?php 
              if(isset($_POST["send"])){
              $titre = $_POST['filters'] ;
          
              $sql = "SELECT id_formation FROM formation WHERE titre = '$titre'";
              $resultat = mysqli_query($conn,$sql);
          
              $row_resultat = mysqli_fetch_assoc($resultat);
              $filter = $row_resultat["id_formation"];
              echo $filter;
              }
            ?>

          </div>
          <div class="col-md-12 col-lg-6 text-start text-lg-end" data-aos="fade-up" data-aos-delay="100">

          <style>
            .nav-menu li:hover {
              color: #789beb;
            }
          </style>
            <div class="container">
              <div class="tutorial">
                <ul>
                  <li class="active" href=""><a href="index.php">All</a></li>
                    <li><a href="#section1">Game Design</a><i class=""></i>
                  </li>

                  <li><a href="#section2">Web Development</a><i class=""></i>
                  </li>

                  <li><a href="#section3">Graphic Design</a><i class=""></i>
                  </li>

                  <li><a href="#section4">Digital Marketing</a><i class=""></i>
                  </i>
                
              </div>
            </div><link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
            </div>
          </div>
        </div>

                <!-- ................................................................. -->
      <style>
        #slid {
          height: 800px; /* set your preferred height */
          width: 2000px;
          overflow: hidden;
        }
      </style>

      <div class="container" id="slid" style="max-width: 1537px; padding-left:0;margin-top:4%;height: 734px;">
      <span id="section1"></span>
        <div class="wrapper">
          <div class="news-slider">
          <h3 style="margin:51px 0 41px 0;">Let's start learning<?php if(isset($_SESSION["user_email"])){echo ", ";} ?><a href="about.php" style="color: rgb(120 155 235);" ><?php if(isset($_SESSION["user_email"])){echo $user_name;}  ?></a></h3>
          
          <h4 style="margin:108px 0 41px 25px;">All Game Design formations <span style='color: rgb(120 155 235);'></h4>
            <div class="news-slider__wrp swiper-wrapper" style="">
              <?php
              $query_fst = "SELECT * FROM formation WHERE categorie = 'Game Design'";
              // Execute the query and get the results
              $result_fst = $conn->query($query_fst);

              // Loop through the results and display them in the card
              while ($row_fst = $result_fst->fetch_assoc()) {
                $id_formation=$row_fst["id_formation"];
                ?>
                <div class="news-slider__item swiper-slide">
                  <a href="work-single.php?id=<?php echo $row_fst["id_formation"]; ?>" class="news__item">
                    <div class="news-date">
                      <span class="news-date__txt"><?php echo $row_fst["titre"]; ?></span>
                    </div>
                    <div class="news__desc">
                      <?php echo $row_fst["description"]; ?>
                    </div>
                    <div class="news__img">
                    <?php
                      $img="SELECT image FROM session WHERE id_formation='$id_formation'";
                      $res_img=mysqli_query($conn,$img);
                      $row=mysqli_fetch_assoc($res_img);
                      $row_img=$row["image"];

                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img).'" />';
                      
                    ?>
                    </div>
                    
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
      </div>
      </div>


      

      <div class="container" id="slid" style="max-width: 1537px; padding-left:0;margin-top:0!important;height: 693px;">
      <span id="section2"></span>
        <div class="wrapper">
          <div class="news-slid">
          <h4 style="margin:94px 0 41px 25px;">All Web Development formations <span style='color: rgb(120 155 235);'></h4>
            <div class="news-slid__wrp swiper-wrapper" style="">
              <?php
              $query_end = "SELECT * FROM formation WHERE categorie = 'Web Development'";
              // Execute the query and get the results
              $result_end = $conn->query($query_end);
                  
              // Loop through the results and display them in the card
              while ($row_end = $result_end->fetch_assoc()) {
                $id_formation=$row_end["id_formation"];
                ?>
                <div class="news-slider__item swiper-slide">
                  <a href="work-single.php?id=<?php echo $row_end["id_formation"]; ?>" class="news__item">
                    <div class="news-date">
                      <span class="news-date__txt"><?php echo $row_end["titre"]; ?></span>
                    </div>
                    <div class="news__desc">
                      <?php echo $row_end["description"]; ?>
                    </div>
                    <div class="news__img">
                    <?php
                      $img="SELECT image FROM session WHERE id_formation='$id_formation'";
                      $res_img=mysqli_query($conn,$img);
                      $row=mysqli_fetch_assoc($res_img);
                      $row_img=$row["image"];

                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img).'" />';
                      
                    ?>
                    </div>
                    
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
      </div>
      </div>
      


      <div class="container" id="slid" style="max-width: 1537px; padding-left:0;margin-top:0!important;height: 693px;">
      <span id="section3"></span>
        <div class="wrapper">
          <div class="news-slid">
          <h4 style="margin:79px 0 41px 25px;">All Graphic Design formations <span style='color: rgb(120 155 235);'></h4>
            <div class="news-slid__wrp swiper-wrapper" style="">
              <?php
              $query_end = "SELECT * FROM formation WHERE categorie = 'Graphic Design'";
              // Execute the query and get the results
              $result_end = $conn->query($query_end);
                  
              // Loop through the results and display them in the card
              while ($row_end = $result_end->fetch_assoc()) {
                $id_formation=$row_end["id_formation"];
                ?>
                <div class="news-slider__item swiper-slide">
                  <a href="work-single.php?id=<?php echo $row_end["id_formation"]; ?>" class="news__item">
                    <div class="news-date">
                      <span class="news-date__txt"><?php echo $row_end["titre"]; ?></span>
                    </div>
                    <div class="news__desc">
                      <?php echo $row_end["description"]; ?>
                    </div>
                    <div class="news__img">
                    <?php
                      $img="SELECT image FROM session WHERE id_formation='$id_formation'";
                      $res_img=mysqli_query($conn,$img);
                      $row=mysqli_fetch_assoc($res_img);
                      $row_img=$row["image"];

                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img).'" />';
                      
                    ?>
                    </div>
                    
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
      </div>
      </div>


      <div class="container" id="slid" style="max-width: 1537px; padding-left:0;margin-top:0!important;height: 693px;">
      <span id="section4"></span>
        <div class="wrapper">
          <div class="news-slid">
          <h4 style="margin:79px 0 41px 25px;">All Digital Marketing formations <span style='color: rgb(120 155 235);'></h4>
            <div class="news-slid__wrp swiper-wrapper" style="">
              <?php
              $query_end = "SELECT * FROM formation WHERE categorie = 'Digital Marketing'";
              // Execute the query and get the results
              $result_end = $conn->query($query_end);
                  
              // Loop through the results and display them in the card
              while ($row_end = $result_end->fetch_assoc()) {
                $id_formation=$row_end["id_formation"];
                ?>
                <div class="news-slider__item swiper-slide">
                  <a href="work-single.php?id=<?php echo $row_end["id_formation"]; ?>" class="news__item">
                    <div class="news-date">
                      <span class="news-date__txt"><?php echo $row_end["titre"]; ?></span>
                    </div>
                    <div class="news__desc">
                      <?php echo $row_end["description"]; ?>
                    </div>
                    <div class="news__img">
                    <?php
                      $img="SELECT image FROM session WHERE id_formation='$id_formation'";
                      $res_img=mysqli_query($conn,$img);
                      $row=mysqli_fetch_assoc($res_img);
                      $row_img=$row["image"];

                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img).'" />';
                      
                    ?>
                    </div>
                    
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
      </div>
      </div>
      

      </section><!-- End  Works Section -->

  <!-- ========================================== -->
  <section class="section" style= "padding: 10rem 0 0 4rem!important;">
      <div class="container" style="max-width: 1587px; ">
        <div class="row justify-content-center text-center mb-4">
          <div class="">
            <h3 class="h3 heading">Partners</h3>
            <p>Unlock Your Career Potential with LearnIt. The Top Choice for Building In-Demand Skills.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%; margin-left: 8px;">
            <a href="#" class="client-logo"><img src="assets/img/udemy.png" alt="Image" class="img-fluid" style="max-width: 60%;"></a>
          </div>
          <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
            <a href="#" class="client-logo"><img src="assets/img/OnTrac New.png" alt="Image" class="img-fluid" style="max-width: 60%;"></a>
          </div>
          <div class="col-4 col-sm-4 col-md-2 pt-2" style="width: 14.2%;">
            <a href="#" class="client-logo"><img src="assets/img/Amazon Prime Video.png" alt="Image" class="img-fluid" style="max-width: 60%;"></a>
          </div>
          <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
            <a href="#" class="client-logo"><img src="assets/img/Evisu Red.png" alt="Image" class="img-fluid" style="max-width: 60%;padding-top: 26px;""></a>
          </div>
          <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
            <a href="#" class="client-logo"><img src="assets/img/Section School New.png" alt="Image" class="img-fluid" style="max-width: 60%;"></a>
          </div>
          <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
            <a href="#" class="client-logo"><img src="assets/img/Facebook Meta New.png" alt="Image" class="img-fluid" style="max-width: 60%;"></a>
          </div>
          <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
            <a href="#" class="client-logo"><img src="assets/img/Google China.png" alt="Image" class="img-fluid" style="max-width: 60%;"></a>
          </div>

        </div>
      </div>
    </section><!-- End Clients Section -->

  <!-- ========================================== -->
  <section class="section services">
      <div class="container" style="max-width: 1541px;">
        <div class="row justify-content-center text-center mb-5">
          <div class="">
            <h3 class="h3 heading" style="margin: 0 0 7px 65px;">Our Services</h3>
            <p class="mb-5">Our courses are designed to provide you with the knowledge and skills you need to succeed in today's rapidly changing world..</p>
          </div>
        </div>
        <div class="row">

          <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <i class="fas fa-user-tie"></i>
            <h4 class="h4 mb-2">Expert Instructors</h4>
            <p>Our instructors are experienced professionals in their respective fields, 
              bringing real-world experience and expertise to their teachings. 
              They provide personalized support and guidance to ensure that you get the most out of your learning experience..</p>
            <ul class="list-unstyled list-line">
              <!-- <li>Lorem ipsum dolor sit amet consectetur adipisicing</li>
              <li>Non pariatur nisi</li> -->
            </ul>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <i class="fas fa-puzzle-piece"></i>
            <h4 class="h4 mb-2">Interactive Learning</h4>
            <p>Our courses are designed to be interactive and engaging, incorporating a variety of multimedia elements such as videos,
              quizzes, and interactive activities. This ensures that you stay engaged and motivated throughout your learning journey.
            </p>
            
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <i class="fas fa-award"></i>
            <h4 class="h4 mb-2">Industry-Recognized Certificates</h4>
            <p>Our courses are designed to equip you with the skills and knowledge that are in high demand in the job market.
              Upon completion of our courses, you will receive industry-recognized certificates that will help you stand out to potential employers..</p>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <i class="fas fa-laptop"></i>
            <h4 class="h4 mb-2">Flexible Learning</h4>
            <p>Our courses are available online, allowing you to learn at your own pace and convenience. You can access our courses anytime, anywhere, 
              on any device, making it easy to fit learning into your busy schedule..</p>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main -->

  <!-- ========================================== -->
  <footer class="footer" role="contentinfo">
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
  <script src="assets/js/js.js"></script>
  <script src="assets/js/js3.js"></script>


</body>

</html>