<?php
include './app/config.php';
include './app/function.php';
include './shared/head.php';
auth();
/*******************registratin******************/
$erros = [];
if (isset($_POST['submit'])) {
  $name = stringValidation($_POST['name']);
  if (empty($name)) {
    $errors[] = "name is not valid";
  }
  $email = stringValidation($_POST['email']);
  if (empty($email)) {
    $errors[] = "email is not valid";
  }
  $password = $_POST['password'];
  $password_hash = sha1($password);
  if (empty($errors)) {
    $insert = "INSERT INTO `admin` VALUE (NULL,'$name','$email','$password_hash', DEFAULT)";
    $s = mysqli_query($conn, $insert);
    if ($s) {
      path("admin/pages-login.php");
    }
  }
}

?>
<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
              </a>
            </div><!-- End Logo -->
            <div class="card mb-3">
              <div class="card-body">
                <!------------------------errors------------------------------>
              <?php if(empty($errors)): ?>
              <div class="alert alert-danger">
                <ul>
                  <?php foreach($errors as $data): ?>
                  <li><?= $data ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endif; ?>
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form class="row g-3 needs-validation" method="post" novalidate>
                  <div class="col-12">
                    <label for="yourName" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" id="yourName" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                  </div>

                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Your Email</label>
                    <input type="email" name="email" class="form-control" id="yourEmail" required>
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit" name="submit">Create Account</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              <a href="" class="">Designed by Rania</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->

<?php

include './shared/script.php';
?>