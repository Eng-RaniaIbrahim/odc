<?php
include './app/config.php';
include './app/function.php';
include './shared/head.php';
include './shared/header.php';
include './shared/aside.php';
auth();
$userId = $_SESSION['Rania']['id'];
//**************************** about ***************************************** */
$about_errors = [];
$title = "";
$Birthday = "";
$Website = "";
$Phone = "";
$City = "";
$Age = "";
$Degree = "";
$Email = "";
$Freelance = "";
if (isset($_POST['submit'])) {
  $title = stringValidation($_POST['title']);
  $Birthday = stringValidation($_POST['Birthday']);
  $Website = stringValidation($_POST['Website']);
  $Phone = stringValidation($_POST['Phone']);
  $City = stringValidation($_POST['City']);
  $Age = stringValidation($_POST['Age']);
  $Degree = stringValidation($_POST['Degree']);
  $Email = stringValidation($_POST['Email']);
  $Freelance = stringValidation($_POST['Freelance']);
  // **************** Validation *************************/
  if (empty($title)) {
    $about_errors[] = "Please enter a valid title";
  }
  if (empty($Birthday)) {
    $about_errors[] = "Please enter a valid  Birthday";
  }
  if (empty($Website)) {
    $about_errors[] = "Please enter a valid  Website";
  }
  if (empty($Phone)) {
    $about_errors[] = "Please enter a valid  Phone";
  }
  if (empty($City)) {
    $about_errors[] = "Please enter a valid  City";
  }
  if (empty($Age)) {
    $about_errors[] = "Please enter a valid  Age";
  }
  if (empty($Degree)) {
    $about_errors[] = "Please enter a valid  Degree";
  }
  if (empty($Email)) {
    $about_errors[] = "Please enter a valid  Email";
  }
  if (empty($Freelance)) {
    $about_errors[] = "Please enter a valid  Freelance";
  }
  //***************************create بحط في الداته بيز******************************* */
  if (empty($about_errors)) {
    $insert = " INSERT INTO `about` VALUES (null ,'$title','$Birthday','$Website','$Phone','$City','$Age','$Degree','$Email','$Freelance',$userId)";
    $s = mysqli_query($conn, $insert);
    path("admin/users-profile.php");
  }
}
//******************************* read بيقراء من الداته بيز ************************************* */
$select = "SELECT * FROM `about` WHERE userId = $userId";
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
/*************************skills************************ */
$HTML = "";
$CSS = "";
$JAVASCRIPT = "";
$PHP = "";
$WORDPRESS = "";
$PHOTOSHOP = "";
if (isset($_POST['submitskills'])) {
  $HTML = $_POST['HTML'];
  $CSS = $_POST['CSS'];
  $JAVASCRIPT = $_POST['JAVASCRIPT'];
  $PHP = $_POST['PHP'];
  $WORDPRESS = $_POST['WORDPRESS'];
  $PHOTOSHOP = $_POST['PHOTOSHOP'];
  //***************************create skills بحط في الداته بيز******************************* */
  $insert = "INSERT INTO `skills` VALUES (null,'$HTML','$CSS','$JAVASCRIPT','$PHP','$WORDPRESS','$PHOTOSHOP',$userId)";
  $i = mysqli_query($conn, $insert);
  path("admin/users-profile.php");
}
//******************************* read skills بيقراء من الداته بيز ************************************* */
$selectskills = "SELECT * FROM `skills` WHERE userId = $userId";
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
//***********************************upload image********************* */ 
$errors = [];
if (isset($_POST['upload'])) {
  // if (!empty($_FILES['image']['name'])) {}
  $image_size = $_FILES['image']['size'];
  $image_name = time() . $_FILES['image']['name'];
  /****imagevalidation****/
  $imagvalid = imagevalidation($image_size, $image_name, 5);
  if ($imagevaild) {
    $errors[] = "image or size is not valid";
  }
  if (empty($error)) {
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./assets/img/" . $image_name;
    move_uploaded_file($tmp_name, $location);
    $oldImage = $_SESSION['Rania']['image'];
    if ($oldImage != 'fake.png') {
      unlink("./assets/img/$oldImage");
    }
    $_SESSION["Rania"]["image"] = $image_name;
    $update = "UPDATE `admin` set `image`='$image_name' where id=$userId";
    $u = mysqli_query($conn, $update);
    path("admin/users-profile.php");
  }
}
/*************************sumary************************ */
$summary_errors = [];
$description = "";
$addresssumary = "";
$Phonesumary = "";
$emailsumary = "";
if (isset($_POST['submitsumary'])) {
  $description = stringValidation($_POST['description']);
  $addresssumary = stringValidation($_POST['addresssumary']);
  $Phonesumary = stringValidation($_POST['Phonesumary']);
  $emailsumary = stringValidation($_POST['emailsumary']);
  if (empty($description)) {
    $summary_errors[] = "description is not valid";
  }
  if (empty($addresssumary)) {
    $summary_errors[] = "addresssumary is not valid";
  }
  if (empty($Phonesumary)) {
    $summary_errors[] = "Phonesumary is not valid";
  }
  if (empty($emailsumary)) {
    $summary_errors[] = "emailsumary is not valid";
  }
  //***************************create sumary بحط في الداته بيز******************************* */
  if (empty($summary_errors)) {
    $insert = "INSERT INTO `sumary` VALUES (null,'$description','$addresssumary','$Phonesumary','$emailsumary',$userId)";
    $i = mysqli_query($conn, $insert);
    path("admin/users-profile.php");
  }
}
//******************************* read sumary بيقراء من الداته بيز ************************************* */
$selectsumary = "SELECT * FROM `sumary` WHERE userId = $userId";
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
$education_errors = [];
$titleeducation = "";
$from = "";
$to = "";
$descriptionedu = "";
if (isset($_POST['submiteducation'])) {
  $titleeducation = stringValidation($_POST['titleeducation']);
  if (empty($titleeducation)) {
    $education_errors[] = "titleeducation is not valid";
  }
  $from = stringValidation($_POST['from']);
  if (empty($from)) {
    $education_errors[] = "fromis not valid";
  }
  $to = stringValidation($_POST['to']);
  if (empty($to)) {
    $education_errors[] = "to is not valid";
  }
  $descriptionedu = stringValidation($_POST['descriptionedu']);
  if (empty($descriptionedu)) {
    $education_errors[] = "descriptionedu is not valid";
  }
  //***************************create education بحط في الداته بيز******************************* */
  if (empty($education_errors)) {
    $insert = "INSERT INTO `education` VALUES (null,'$titleeducation','$from','$to','$descriptionedu',$userId)";
    $i = mysqli_query($conn, $insert);
    path("admin/users-profile.php");
  }
}
//******************************* read education بيقراء من الداته بيز ************************************* */
$selecteducation = "SELECT * FROM `education` WHERE userId = $userId";
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
$experience_errors = [];
$titleexperience = "";
$fromex = "";
$toex = "";
$descriptionecs = "";
if (isset($_POST['submitexperience'])) {
  $titleexperience = stringValidation($_POST['titleexperience']);
  if (empty($titleexperience)) {
    $experience_errors[] = "titleexperience is not valid";
  }
  $fromex = stringValidation($_POST['from']);
  if (empty($fromex)) {
    $experience_errors[] = "Enter valid 'From' date";
  }
  $toex = stringValidation($_POST['to']);
  if (empty($toex)) {
    $experience_errors[] = "Enter valid 'to' date";
  }
  $descriptionecs = stringValidation($_POST['descriptionecs']);
  if (empty($descriptionecs)) {
    $experience_errors[] = "descriptionecs is not valid";
  }
  //***************************create experience بحط في الداته بيز*******************************************/
  if (empty($experience_errors)) {
    $insert = "INSERT INTO `experience` VALUES (null,'$titleexperience','$fromex','$toex','$descriptionecs',$userId)";
    $i = mysqli_query($conn, $insert);
    path("admin/users-profile.php");
  }
}
//******************************* read experience بيقراء من الداته بيز ***************************************/
$selectexperience = "SELECT * FROM `experience` WHERE userId = $userId";
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
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-12">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="/odc/admin/assets/img/logo.png" alt="Profile" class="rounded-circle">
            <h2><?= $_SESSION["Rania"]['name'] ?></h2>
            <h3>Web Designer</h3>
            <div class="social-links mt-2">
              <a href="$" class="github"><i class="bi bi-facebook"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-12">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"> Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#skills-edit"> Skills</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sumary-edit"> Sumary</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#education-edit"> Education</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#experience-edit"> Experience</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Birthday</div>
                  <div class="col-lg-9 col-md-8"><?= $Birthday ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Website</div>
                  <div class="col-lg-9 col-md-8"><a href="<?= $Website ?>" class=""><?= $_SESSION["Rania"]['name'] ?></a></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8"><?= $Phone ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">City</div>
                  <div class="col-lg-9 col-md-8"><?= $City ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Age</div>
                  <div class="col-lg-9 col-md-8"><?= $Age ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Degree</div>
                  <div class="col-lg-9 col-md-8"><?= $Degree ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?= $Email ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Freelance</div>
                  <div class="col-lg-9 col-md-8"><?= $Freelance ?></div>
                </div>
              </div>
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- ======================================================================== -->
                <!-- =============================== Profile Edit Form ================================== -->
                <!-- ======================================================================== -->
                <form method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="/odc/admin/assets/img/<?= $_SESSION["Rania"]['image'] ?>" alt="Profile">
                      <input type="file" name="image">
                      <div class="pt-2">
                        <button name="upload" class="btn btn-primary btn-sm">Upload photo</button>
                      </div>
                    </div>
                  </div>
                </form>
                <form method="POST">
                  <!------------------------errors------------------------------>
                  <?php if (!empty($about_errors)) : ?>
                    <div class="alert alert-danger">
                      <ul>
                        <?php foreach ($about_errors as $data) : ?>
                          <li><?= $data ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <label for="title" class="col-md-4 col-lg-3 col-form-label">title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="title" type="text" class="form-control" id="title" value="<?= $title ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Birthday" class="col-md-4 col-lg-3 col-form-label">Birthday</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Birthday" type="text" class="form-control" id="Birthday" value="<?= $Birthday ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Website" class="col-md-4 col-lg-3 col-form-label">Website</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Website" type="text" class="form-control" id="Website" value="<?= $Website ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Phone" type="text" class="form-control" id="Phone" value="<?= $Phone ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="City" class="col-md-4 col-lg-3 col-form-label">City</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="City" type="text" class="form-control" id="City" value="<?= $City ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Age" class="col-md-4 col-lg-3 col-form-label">Age</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Age" type="text" class="form-control" id="Age" value="<?= $Age ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Degree" class="col-md-4 col-lg-3 col-form-label">Degree</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Degree" type="text" class="form-control" id="Degree" value="<?= $Degree ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Email" type="email" class="form-control" id="Email" value="<?= $Email ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Freelance" class="col-md-4 col-lg-3 col-form-label">Freelance</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Freelance" type="text" class="form-control" id="Freelance" value="<?= $Freelance ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>

              <!-- ======================================================================== -->
              <!-- =============================== test--skills-edit ================================== -->
              <!-- ======================================================================== -->
              <div class="tab-pane fade skills-edit pt-3" id="skills-edit">
                <form method="POST">
                  <div class="row mb-3">
                    <label for="HTML" class="col-md-4 col-lg-3 col-form-label">HTML</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="HTML" type="range" class="form-control" id="HTML" value="<?= $HTML ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="CSS" class="col-md-4 col-lg-3 col-form-label">CSS</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="CSS" type="range" class="form-control" id="CSS" value="<?= $CSS ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="JAVASCRIPT" class="col-md-4 col-lg-3 col-form-label">JAVASCRIPT</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="JAVASCRIPT" type="range" class="form-control" id="JAVASCRIPT" value="<?= $JAVASCRIPT ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="PHP" class="col-md-4 col-lg-3 col-form-label">PHP</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="PHP" type="range" class="form-control" id="PHP" value="<?= $PHP ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="WORDPRESS" class="col-md-4 col-lg-3 col-form-label">WORDPRESS</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="WORDPRESS" type="range" class="form-control" id="WORDPRESS" value="<?= $WORDPRESS ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="PHOTOSHOP" class="col-md-4 col-lg-3 col-form-label">PHOTOSHOP</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="PHOTOSHOP" type="range" class="form-control" id="PHOTOSHOP" value="<?= $PHOTOSHOP ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="submitskills" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>

              <!-- ======================================================================== -->
              <!-- =============================== test two--sumary-edit ================================== -->
              <!-- ======================================================================== -->
              <div class="tab-pane fade sumary-edit pt-3" id="sumary-edit">
                <form method="POST">
                  <!------------------------errors------------------------------>
                  <?php if (!empty($summary_errors)) : ?>
                    <div class="alert alert-danger">
                      <ul>
                        <?php foreach ($summary_errors as $data) : ?>
                          <li><?= $data ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <label for="description" class="col-md-4 col-lg-3 col-form-label">description</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="description" type="text" class="form-control" id="description" value="<?= $description ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="addresssumary" type="text" class="form-control" id="address" value="<?= $addresssumary ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="Phonesumary" type="text" class="form-control" id="Phone" value="<?= $Phonesumary ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="emailsumary" type="text" class="form-control" id="email" value="<?= $emailsumary ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="submitsumary" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>

              <!-- ======================================================================== -->
              <!-- =============================== test three--education-edit ================================== -->
              <!-- ======================================================================== -->
              <div class="tab-pane fade education-edit pt-3" id="education-edit">
                <form method="POST">
                  <!------------------------errors------------------------------>
                  <?php if (!empty($education_errors)) : ?>
                    <div class="alert alert-danger">
                      <ul>
                        <?php foreach ($education_errors as $data) : ?>
                          <li><?= $data ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <label for="title" class="col-md-4 col-lg-3 col-form-label">title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="titleeducation" type="text" class="form-control" id="title" value="<?= $titleeducation ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="from" class="col-md-4 col-lg-3 col-form-label">from</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="from" type="text" class="form-control" id="from" value="<?= $from ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="to" class="col-md-4 col-lg-3 col-form-label">to</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="to" type="text" class="form-control" id="to" value="<?= $to ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description" class="col-md-4 col-lg-3 col-form-label">description</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="descriptionedu" type="text" class="form-control" id="description" value="<?= $descriptionedu ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="submiteducation" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>

              <!-- ======================================================================== -->
              <!-- =============================== test four--experience-edit ================================== -->
              <!-- ======================================================================== -->
              <div class="tab-pane fade experience-edit pt-3" id="experience-edit">
                <form method="POST">
                  <!------------------------errors------------------------------>
                  <?php if (!empty($experience_errors)) : ?>
                    <div class="alert alert-danger">
                      <ul>
                        <?php foreach ($experience_errors as $data) : ?>
                          <li><?= $data ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <label for="title" class="col-md-4 col-lg-3 col-form-label">title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="titleexperience" type="text" class="form-control" id="title" value="<?= $titleexperience ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="from" class="col-md-4 col-lg-3 col-form-label">from</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="from" type="text" class="form-control" id="from" value="<?= $fromex ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="to" class="col-md-4 col-lg-3 col-form-label">to</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="to" type="text" class="form-control" id="to" value="<?= $toex ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description" class="col-md-4 col-lg-3 col-form-label">description</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="descriptionecs" type="text" class="form-control" id="description" value="<?= $descriptionecs ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="submitexperience" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>
              <div class="tab-pane fade pt-3" id="profile-settings">
                <!-------------- Settings Form ------------------>
                <form>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->
              </div>
              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->
              </div>
            </div><!-- End Bordered Tabs -->
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->



<?php
include './shared/footer.php';
include './shared/script.php';
?>