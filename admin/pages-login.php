<?php
include './app/config.php';
include './app/function.php';
include './shared/head.php';
/**********************login***********************/
$message = "";
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_hash = sha1($password);
  $select = "SELECT * FROM `admin` WHERE `name`='$username' and `password`='$password_hash'";
  $s = mysqli_query($conn,  $select);
  $row = mysqli_fetch_assoc($s);
  $numrow = mysqli_num_rows($s);
  if ($numrow > 0) {
    /****بجيب البيانات من الداته عشان مش اقررها*****/
    $_SESSION["Rania"] = [
      'id' => $row['id'],
      'name' => $row['name'],
      'image' => $row['image'],
      'rule' =>  $row['rule']
    ];
    path("admin/index.php");
  } else {
    $message = "user name or password is incorrect";
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
                <img src="/odc/admin/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Rania</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">
                <!-----------message---------------->
                <?php if (!empty($message)) : ?>
                  <div class="alert alert-danger">
                    <p><?= $message ?></p>
                  </div>
                <?php endif; ?>
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your username & password to login</p>
                </div>

                <form method="POST" class="row g-3 needs-validation" novalidate>

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <input type="text" name="username" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit" name="submit">Login</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              <a href="" class=""> Designed by Rania </a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->


<?php
include './shared/footer.php';
include './shared/script.php';
?>