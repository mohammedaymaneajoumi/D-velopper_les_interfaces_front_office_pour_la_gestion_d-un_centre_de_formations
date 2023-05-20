<?php
include("connectDB.php");

session_start();
if(isset($_SESSION["user_email"])){
    $apprenant = $_SESSION['id_apprenant'];
    $filter="";


}



if (isset($_SESSION['user_email'])) {

  // Get the user's email address from the session
$user_email = $_SESSION['user_email'];

}
if(isset($_GET["id"])){
    $id = $_GET["id"];
}

?>
<?php
if (isset($_POST['inscrer'])) {
    $formation = $_POST['id_formation'];
    $date = $_POST['date_session'];
    if(!isset($_SESSION["user_email"])){
        header("location:../register.php");
    }
            //input hidden from card below coantain value
            $sql_inscrire = "SELECT * FROM inscrire WHERE id_apprenant = '$apprenant' AND DATEDIFF(CURRENT_TIMESTAMP, date_inscription) = 365";
            // execute a SQL query//
        $result = mysqli_query($conn, $sql_inscrire);
        //retrieve the number of rows returned by a SELECT statement//
        if (mysqli_num_rows($result) === 0) {
            //to specifie more cuz we have more than 1 session
            $idSession = mysqli_query($conn, "SELECT id_session FROM session WHERE id_formation = '$formation' AND date_debut ='$date'");
            //fetch a single row from the result set returned by a SELECT statement//
            $rowSession = mysqli_fetch_assoc($idSession);
            $session = $rowSession["id_session"];///////

            // Check if user is already registered for this session
            $result = mysqli_query($conn, "SELECT * FROM inscrire WHERE id_session = '$session' AND id_apprenant = '$apprenant'");
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='alert alert-danger'>Vous êtes déjà inscrit pour cette session!</div>";
            } else {
                $result = mysqli_query($conn, "SELECT * FROM inscrire WHERE id_apprenant = '$apprenant'");
                if (mysqli_num_rows($result) > 1) {
                    echo "<div class='alert alert-danger'>Vous ne pouvez pas vous inscrire à plus de deux sessions!</div>";
                }
                else {
                    $disponible="";
                    $query_date = "SELECT * FROM session s INNER JOIN inscrire i ON i.id_session = s.id_session WHERE i.id_apprenant = $apprenant";
                    $res_date = mysqli_query($conn,$query_date);
                    if(mysqli_num_rows($res_date )>0){
                            $row_date = mysqli_fetch_assoc($res_date);
                            if($date >= $row_date['date_debut'] && $date < $row_date['date_fin']){
                                echo "<div class='alert alert-danger'>Vous ne pouvez pas vous inscrire pendant un inscreption dans un autre sessions!</div>";
                                $disponible="non";
                            }
                    }if($disponible !=="non"){
                        // Insert new registration into the database
                        $results = mysqli_query($conn, "INSERT INTO inscrire (id_apprenant, id_session, resultat, date_evaluation) VALUES ('$apprenant', '$session', NULL, NULL)");
                        if($results){
                            $sql_place=mysqli_query($conn,"SELECT nombre_de_place_max FROM session WHERE id_session ='$session'");
                            $result_place = mysqli_fetch_assoc($sql_place);
                            $rowPlace = $result_place["nombre_de_place_max"];
                            if($rowPlace > 0){
                                $update = "UPDATE session SET nombre_de_place_max = nombre_de_place_max - 1 , participant = participant + 1 WHERE id_session = '$session'";
                                if(mysqli_query($conn,$update)){
                                    echo "<div class='alert alert-success'>Inscription réussie!</div>";
                                }

                            }
                            
                        }else{
                            echo "error";
                        }
                    }
                    
                }
            }
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
    <link
        href="https://fonts.googleapis.com/css?family=https://fonts.googleapis.com/css?family=Inconsolata:400,500,600,700|Raleway:400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/1171a84c58.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-1gW/ujGUKIQ9XzKy0OVqy3qCwV8f2tjuRZIK+a04Z5yi5iynDcqXbXj+jyehdeceEpz4o4+M4mzDfrKjJ+m3Ew=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/css4.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Navbar ======= -->
    <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
        <div class="container py-2 py-md-5" style="max-width: 1542px;">
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
                            <p><em>If you have any questions or feedback about our website or any services, please don't
                                    hesitate to contact us.
                                    We are always happy to hear from our users and to help them achieve their
                                    educational goals. <br> <a href="#">t.co/v82jsk</a></em></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <h3>about us</h3>
                    <p>Welcome to Learnit, an online platform dedicated to helping students of all ages and backgrounds
                        to learn, grow and achieve their educational goals.
                        <br>
                        <a href="#">LearnIt@gmail.com</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <nav class="navbar navbar-light custom-navbar">
        <div class="container" style="max-width: 1587px;">
            <a class="navbar-brand" href="index.php">LearnIt.</a>
            <a href="#" class="burger" data-bs-toggle="collapse" data-bs-target="#main-navbar">
                <span></span>
            </a>
        </div>
    </nav>

    <main id="main">



        <!-- ======= Works Section ======= -->
        <section class="section site-portfolio" style="padding: 9rem 0 0 0!important;">
            <div class="container" style="max-width: 1546px; ">
                <div class="row mb-5 align-items-center">
                    <div class="col-md-12 col-lg-6 mb-4 mb-lg-0 pb-3" data-aos="fade-up">
                        <form action="work-single.php" method="post">
                            <input type="search" name="filters" value="" placeholder="tap somthing here...."
                                style="width: 478px;padding: 3px;">
                            <input type="submit" name="send" class="btn btn-outline-dark" value="search"
                                style="padding: 3px;">
                        </form>
                    </div>
                    <!-- ////////////////////////////////////////////// -->
                    <section class="section" style="padding-top: 3rem!important;">


                        <div class="site-section pb-0">
                            <div class="container" style="max-width: 1587px;">
                                <div class="row align-items-stretch">
                                    <div class="col-md-8" data-aos="fade-up" style="padding-left: 0;">

                                        <div class="container py-3">
                                            <!-- Card Start -->

                        <?php 
                        $id_formation="";
                            if(isset($_POST["send"])){
                            $titre = $_POST['filters'] ;

                            if(!empty($titre)){
                                $sql = "SELECT id_formation FROM formation WHERE titre = '$titre'";
                                $resultat = mysqli_query($conn,$sql);
                        
                                $row_resultat = mysqli_fetch_assoc($resultat);
                                $filter = $row_resultat["id_formation"];
                            }elseif(empty($titre)){

                            }
                            else{
                                if(!empty($id_formation)){
                                    $id_formation=$_GET["id"];

                                }
                            }
                            }

                        ?>
                        <div class="container" style="max-width: 1587px;">
                            <div class="row mb-4 align-items-center">
                            <div class="col-md-6" data-aos="fade-up" style="width: 100%;">
                    <?php 
                        $sql_filter="";
                        $res_filter="";
                            if(!empty($filter)){
                                $sql_filter = "SELECT * FROM formation WHERE id_formation = '$filter'";
                                $res_filter = mysqli_query($conn,$sql_filter);
                            }else{
                                $sql_filter = "SELECT * FROM formation WHERE id_formation = '$id_formation'";
                                $res_filter = mysqli_query($conn,$sql_filter);
                            }
                        
                          // $row = mysqli_fetch_assoc($res_filter);

                        while($row_name = mysqli_fetch_assoc($res_filter)){
                            //
                            ?>
                                <h2>All <a href="#"
                                        style="color: rgb(120 155 235);"><?php echo $row_name['titre'] ; ?></a>
                                    sessions</h2>
                                <p>
                                    <?php echo $row_name ['description'] ; ?>
                                </p>
                                <?php
                        }
                    ?>

                        </div>
                    </div>
                </div>
                <?php

                if(!empty($filter)){
                  $query = "SELECT * FROM  `session` WHERE  id_formation = '$filter' ORDER BY date_debut ASC";
                    $res_query = mysqli_query($conn,$query);
                
                    while($row_query = mysqli_fetch_assoc($res_query)){
                        
                    ?>
                    <div class="card" style="width: 1301px;">
                        <div class="row ">
                            <div class="col-md-7 px-3">
                                <div class="card-block px-6">
                                    <h4 class="card-title"><?php echo $row_query['titre'] ;?>
                                    </h4>
                                    <h6>session starts in <span href=""
                                            style="color: rgb(120 155 235);">
                    <?php
                            echo $row_query['date_debut'] ;
                    ?>
                    </span>
                    to <span href="" style="color: rgb(120 155 235);">
                    <?php
                        echo $row_query['date_fin'] ;
                    ?>
                        </span>
                    </h6>
                    <br>
                    <h5 class="card-text">
                        <?php
                        echo $row_query['description'] ;
                    ?>
                        </h5>
                        <!-- <p class="card-text">Made for usage, commonly searched for. Fork, like and use it. Just move the carousel div above the col containing the text for left alignment of images</p> -->
                        <h6>Created by
                    <?php
                        $sql_formateur = "SELECT nom_formateur FROM `formateur` WHERE id_formateur IN (SELECT id_formateur FROM session WHERE id_formation = '$filter')";
                        //resl sql
                        $res_formateur = mysqli_query($conn,$sql_formateur);
                        //array
                        $rows_formateur = mysqli_fetch_assoc($res_formateur);
                        $name_formateur = $rows_formateur['nom_formateur'] ;

                        echo $name_formateur;
                        ?>
                            </h6>
                            <h4 style="width:100% ;color:#7d9eeb;">
                                <?php 
                                    $querys = "SELECT * FROM  `session` WHERE  id_formation = '$filter' AND etat_session = 'in progress'";
                                    $requette = mysqli_query($conn,$querys);
                                    $row_req=mysqli_fetch_assoc($requette);
                                    $place = $row_req["nombre_de_place_max"];
                                    
                                    if($place <= 0){
                                        echo "0";
                                    }else{
                                        echo $place;
                                    }

                                    if(!empty($row_req['participant'])){
                                        $participant = $row_req["participant"];
                                    }else{
                                        $participant = "0";
                                    }
                                    



                                ?> places
                                max. session <?php echo $row_query['etat_session'];
                                
                                $mass = "SELECT mass_horaire FROM formation WHERE id_formation = '$filter'" ;
                                $res = mysqli_query($conn, $mass);
                                $mass_row = mysqli_fetch_assoc($res);
                                $time = $mass_row['mass_horaire'];
                                    echo $time . " " ;
                                ?>
                                Hours</h4><br>
                            <div class="flex-buttons">
                    
                            
                        <!-- <span href="#" class="mt-auto " style=" border: 1px solid; border-radius:5px;">Read More</span> -->
                        <form action="" method="post"
                            style="padding-left: 5px !important;">
                            <input type="hidden" name="id_formation"
                                value="<?php echo $row_query["id_formation"];?>">
                            <button href="" type="submit" class="mt-auto btn "
                                style="color:white,  !important;background-color:#7d9eeb;">
                                Inscription</button>
                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Carousel start -->
                            <div class="col-md-5">
                                <div id="CarouselTest" class="carousel slide"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <?php
                            if (!empty($row_query['image'])) {
                                echo '<img class="d-block" src="data:image/jpeg;base64,'.base64_encode($row_query['image']).'" style="max-width: 100%;height: 100%;width: 100%;" />';
                            }
                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of carousel -->
                        </div>
                    </div>
                    <!-- End of card -->

            <?php
                    }
                }
                
                else{
                    $query = "SELECT * FROM  `session` WHERE id_formation = '$id' ORDER BY date_debut ASC";
                    $res_query = mysqli_query($conn,$query);
                
                    while($row_query = mysqli_fetch_assoc($res_query)){
                    ?>
                    <div class="card" style="width: 1301px;">
                        <div class="row ">
                            <div class="col-md-7 px-3">
                                <div class="card-block px-6">
                                    <h4 class="card-title"><?php echo $row_query['titre'] ;?>
                                    </h4>
                                    <h6>session starts in <span href=""
                                            style="color: rgb(120 155 235);">
                    <?php
                            echo $row_query['date_debut'] ;
                    ?>
                    </span>
                    to <span href="" style="color: rgb(120 155 235);">
                    <?php
                        echo $row_query['date_fin'] ;
                    ?>
                        </span>
                    </h6>
                    <br>
                    <h5 class="card-text">
                        <?php
                        echo $row_query['description'] ;
                    ?>
                        </h5>
                        <!-- <p class="card-text">Made for usage, commonly searched for. Fork, like and use it. Just move the carousel div above the col containing the text for left alignment of images</p> -->
                        <h6>Created by
                    <?php
                        $sql_formateur = "SELECT nom_formateur FROM `formateur` WHERE id_formateur IN (SELECT id_formateur FROM session WHERE id_formation = '$id')";
                        //resl sql
                        $res_formateur = mysqli_query($conn,$sql_formateur);
                        //array
                        $rows_formateur = mysqli_fetch_assoc($res_formateur);
                        $name_formateur = $rows_formateur['nom_formateur'] ;

                        echo $name_formateur;
                        ?>
                            </h6>
                            <h6 style="width:100%">
                                <?php echo $row_query['nombre_de_place_max'] ;?> places
                                dispo. session <?php echo $row_query['etat_session'] ." " ;?>
                                .<?php echo $row_query['participant'] ;?> participants .<?php
                                
                                $mass = "SELECT mass_horaire FROM formation WHERE id_formation = '$id'" ;
                                $res = mysqli_query($conn, $mass);
                                $mass_row = mysqli_fetch_assoc($res);
                                $time = $mass_row['mass_horaire'];
                                    echo $time . " " ;
                                ?>
                                Hours</h6><br>
                            <div class="flex-buttons">
                    
                            
                        <!-- <span href="#" class="mt-auto " style=" border: 1px solid; border-radius:5px;">Read More</span> -->
                        <form action="" method="post"style="padding-left: 5px !important;">
                            <input type="hidden" name="id_formation" value="<?php echo $row_query["id_formation"];?>">
                            <input type="hidden" name="date_session" value="<?php echo $row_query['date_debut'] ?>">

                            <?php 
                            $id_formation = $row_query["id_formation"];
                            $date = $row_query['date_debut'];
                            $queryss = "SELECT * FROM  `session` WHERE id_formation = '$id_formation' AND date_debut='$date'";
                            $requettes = mysqli_query($conn,$queryss);
                            
                            $row_reqs=mysqli_fetch_assoc($requettes);
                            $places = $row_reqs["nombre_de_place_max"];
                                if($places === "0"){
                                    ?>
                                        <button type="submit" name="inscrer" class="mt-auto btn "style="color: white !important; background-color: #7d9eeb;" disabled>Inscription</button>
    
                                    <?php
                                }else{
                                    ?>
                                    <button type="submit" name="inscrer" class="mt-auto btn "style="color: white !important; background-color: #7d9eeb;">Inscription</button>
    
                                <?php
                                }
                            

                            
                            ?>
                        </form>
                        

                                    </div>
                                </div>
                            </div>
                            <!-- Carousel start -->
                            <div class="col-md-5">
                                <div id="CarouselTest" class="carousel slide"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <?php
                            if (!empty($row_query['image'])) {
                                echo '<img class="d-block" src="data:image/jpeg;base64,'.base64_encode($row_query['image']).'" style="max-width: 100%;height: 100%;width: 100%;" />';
                            }
                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of carousel -->
                        </div>
                    </div>
                    <!-- End of card -->

            <?php
                    }

                }
            
            ?>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Clients Section ======= -->
    <section class="section" style="padding: 0 0 7rem 4rem!important;">
        <div class="container" style="max-width: 1587px; ">
            <div class="row justify-content-center text-center mb-4">
                <div class="">
                    <h3 class="h3 heading">Partners</h3>
                    <p>Unlock Your Career Potential with LearnIt. The Top Choice for Building In-Demand Skills.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%; margin-left: 8px;">
                    <a href="#" class="client-logo"><img src="assets/img/udemy.png" alt="Image" class="img-fluid"
                            style="max-width: 60%;"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
                    <a href="#" class="client-logo"><img src="assets/img/OnTrac New.png" alt="Image" class="img-fluid"
                            style="max-width: 60%;"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2 pt-2" style="width: 14.2%;">
                    <a href="#" class="client-logo"><img src="assets/img/Amazon Prime Video.png" alt="Image"
                            class="img-fluid" style="max-width: 60%;"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
                    <a href="#" class="client-logo"><img src="assets/img/Evisu Red.png" alt="Image" class="img-fluid"
                            style="max-width: 60%;padding-top: 26px;"></a>
                </div>
                <div class=" col-4 col-sm-4 col-md-2" style="width: 14.2%;">
                        <a href="#" class="client-logo"><img src="assets/img/Section School New.png" alt="Image"
                                class="img-fluid" style="max-width: 60%;"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
                    <a href="#" class="client-logo"><img src="assets/img/Facebook Meta New.png" alt="Image"
                            class="img-fluid" style="max-width: 60%;"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2" style="width: 14.2%;">
                    <a href="#" class="client-logo"><img src="assets/img/Google China.png" alt="Image" class="img-fluid"
                            style="max-width: 60%;"></a>
                </div>

            </div>
        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Footer ======= -->
    <footer class="footer" role="contentinfo">
        <div class="container" style="max-width: 1587px;">
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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