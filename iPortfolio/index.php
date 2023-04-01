<?php
include '../admin/app/config.php';
include '../admin/app/function.php';

session_start();
auth();
$userId = $_SESSION['Rania']['id'];
/**********read img************ */
$image = $_SESSION['Rania']['image'];
$title = "";
$Birthday = "";
$Website = "";
$Phone = "";
$City = "";
$Age = "";
$Degree = "";
$Email = "";
$Freelance = "";
//******************************* read بيقراء من الداته بيز ************************************* */
$select = "SELECT * FROM about WHERE userId = $userId";
$s = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($s);
$numrow = mysqli_num_rows($s);
if ($numrow > 0) {
  $title = $row['title'];
  $Birthday = $row['Birthday'];
  $Website = $row['Website'];
  $Phone = $row['Phone'];
  $City = $row['City'];
  $Age = $row['Age'];
  $Degree = $row['Degree'];
  $Email = $row['Email'];
  $Freelance = $row['Freelance'];
}
//******************************* read skills بيقراء من الداته بيز ************************************* */
/*************************skills************************ */
$HTML = "";
$CSS = "";
$JAVASCRIPT = "";
$PHP = "";
$WORDPRESS = "";
$PHOTOSHOP = "";
$selectskills = "SELECT * FROM skills WHERE userId = $userId";
$sskils = mysqli_query($conn, $selectskills);
$row = mysqli_fetch_assoc($sskils);
$numrow = mysqli_num_rows($sskils);
if ($numrow > 0) {
  $HTML = $row['HTML'];
  $CSS = $row['CSS'];
  $JAVASCRIPT = $row['JAVASCRIPT'];
  $PHP = $row['PHP'];
  $WORDPRESS = $row['WORDPRESS'];
  $PHOTOSHOP = $row['PHOTOSHOP'];
}
/*************************sumary************************ */
$description = "";
$addresssumary = "";
$Phonesumary = "";
$emailsumary = "";
//******************************* read sumary بيقراء من الداته بيز ************************************* */
$selectsumary = "SELECT * FROM sumary WHERE userId = $userId";
$ssumary = mysqli_query($conn, $selectsumary);
$row = mysqli_fetch_assoc($ssumary);
$numrow = mysqli_num_rows($ssumary);
if ($numrow > 0) {
  $description = $row['description'];
  $addresssumary = $row['address'];
  $Phonesumary = $row['phone'];
  $emailsumary = $row['email'];
}
/*************************education************************ */
$titleeducation = "";
$from = "";
$to = "";
//******************************* read education بيقراء من الداته بيز ************************************* */
$selecteducation = "SELECT * FROM education WHERE userId = $userId";
$seducation = mysqli_query($conn, $selecteducation);
$row = mysqli_fetch_assoc($seducation);
$numrow = mysqli_num_rows($seducation);
if ($numrow > 0) {
  $titleeducation = $row['title'];
  $from = $row['from'];
  $to  = $row['to'];
  $descriptionedu = $row['description'];
}
/*************************experience************************ */
$titleexperience = "";
$fromex = "";
$toex = "";
$descriptionecs = "";
//******************************* read experience بيقراء من الداته بيز ***************************************/
$selectexperience = "SELECT * FROM experience WHERE userId = $userId";
$sexperience = mysqli_query($conn, $selectexperience);
$row = mysqli_fetch_assoc($sexperience);
$numrow = mysqli_num_rows($sexperience);
if ($numrow > 0) {
  $titleexperience = $row['title'];
  $fromex = $row['from'];
  $toex  = $row['to'];
  $descriptionecs = $row['description'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>iPortfolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="/odc/iPortfolio/assets/img/favicon.png" rel="icon">
  <link href="/odc/iPortfolio/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="/odc/iPortfolio/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/odc/iPortfolio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/odc/iPortfolio/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/odc/iPortfolio/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/odc/iPortfolio/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/odc/iPortfolio/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Main CSS File -->
  <link href="/odc/iPortfolio/assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">
      <div class="profile">
        <img src="/odc/admin/assets/img/<?= $image ?>" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">Rania</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="https://github.com/Eng-RaniaIbrahim"><i class='bx bxl-github'></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="https://www.linkedin.com/in/rania-ibrahim-234910255/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section style="background:url('/odc/admin/assets/img/<?= $image ?>') top center; background-size:cover;background-attachment: fixed; " id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1>Rania</h1>
      <p>I'm <span class="typed" data-typed-items="Designer, Developer, Freelancer, Photographer"></span></p>
    </div>
  </section><!-- End Hero -->
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="section-title">
          <h2>About</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
            consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit
            in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <!-----------------read img------------------>
            <img src="/odc/admin/assets/img/<?= $image ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3><?= $title ?></h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore
              magna aliqua.
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span><?= $Birthday ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span><a href="<?= $Website ?>" class=""><?= $_SESSION['Rania']['name'] ?></a></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span><?= $Phone ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span><?= $City ?></span></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span><?= $Age ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span><?= $Degree ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><?= $Email ?></span>
                  </li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span><?= $Freelance ?></span></li>
                </ul>
              </div>
            </div>
            <p>
              Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et
              ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis.
              Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque.
              Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni laudantium dolores.
            </p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
      <div class="container">
        <div class="section-title">
          <h2>Skills</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
            consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit
            in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row skills-content">
          <div class="col-lg-6" data-aos="fade-up">
            <div class="progress">
              <span class="skill">HTML <i class="val"><?= $HTML ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $HTML ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
            <div class="progress">
              <span class="skill">CSS <i class="val"><?= $CSS ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $CSS ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
            <div class="progress">
              <span class="skill">JavaScript <i class="val"><?= $JAVASCRIPT ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $JAVASCRIPT ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="progress">
              <span class="skill">PHP <i class="val"><?= $PHP ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $PHP ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val"><?= $WORDPRESS ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $WORDPRESS ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
            <div class="progress">
              <span class="skill">Photoshop <i class="val"><?= $PHOTOSHOP ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $PHOTOSHOP ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">
        <div class="section-title">
          <h2>Resume</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
            consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit
            in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Sumary</h3>
            <div class="resume-item pb-0">
              <h4>Rania Ibrahim Abdel Hameed</h4>
              <p><em><?= $description ?></em></p>
              <ul>
                <li><?= $addresssumary ?></li>
                <li><?= $Phonesumary ?></li>
                <li><?= $emailsumary ?></li>
              </ul>
            </div>
            <h3 class="resume-title">Education</h3>
            <div class="resume-item">
              <h4><?= $titleeducation ?></h4>
              <h5><?= $from . " - " . $to ?></h5>
              <p><?= $descriptionedu ?></p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Professional Experience</h3>
            <div class="resume-item">
              <h4><?= $titleexperience ?></h4>
              <h5><?= $fromex . " - " . $toex ?></h5>
              <p><?= $descriptionecs ?></p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Resume Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Rania</span></strong>
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Rania</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/odc/iPortfolio/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/aos/aos.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/typed.js/typed.min.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/odc/iPortfolio/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/odc/iPortfolio/assets/js/main.js"></script>

</body>

</html>