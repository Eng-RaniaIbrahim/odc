<?php
include './app/config.php';
include './app/function.php';
include './shared/head.php';
include './shared/header.php';
include './shared/aside.php';
auth(2);
//*********************** Profile **********************************/
$errors = [];
if (isset($_POST['submit'])) {
  $address = stringValidation($_POST['address']);
  if(empty($address)){
    $errors[] = "address is not valid";
  }
  $price = stringValidation($_POST['price']);
  if(empty($price)){
    $errors[] = "price is not valid";
  }
  //***********************************upload image**********************/ 
  // if (!empty($_FILES['image']['name'])) {}
  $image_name = time() . $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $imagevaild = imagevalidation($image_size, $image_name, 5);
  if($imagevaild){
    $errors[] = "image or size is not valid";
  }
  if (empty($errors)){
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./assets/img/" . $image_name;
    move_uploaded_file($tmp_name, $location);
    //***************************create estateAgency بحط في الداته بيز******************************* */
    $insert = "INSERT INTO `estateagency` VALUES (null,'$address','$image_name','$price')";
    $i = mysqli_query($conn, $insert);
    path("admin/estate-agency.php");
  }
}
//***************************Read estateAgency بيقرأ من الداته بيز******************************* */
$select = "SELECT * FROM `estateagency`";
$s = mysqli_query($conn, $select);
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $select = "SELECT image FROM `estateagency`  WHERE id = $id";
  $s = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($s);
  $image = $row["image"];
  unlink("./assets/img/$image");
  $delete = "DELETE FROM `estateagency` WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  path("admin/estate-agency.php");
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
          <div class="card-body pt-3">
            <?php if(!empty($errors)): ?>
              <div class="alert alert-danger">
                <ul>
                  <?php foreach($errors as $data): ?>
                  <li><?= $data ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endif; ?>
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#property-add">Add Property</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#list-property"> List Property</button>
              </li>
            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-edit pt-3" id="property-add">
                <form method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="image" class="col-md-4 col-lg-3 col-form-label">Property Image</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="file" name="image">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="price" class="col-md-4 col-lg-3 col-form-label">Price</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="price" type="text" class="form-control" id="price">
                    </div>
                  </div>
                  <div class="row mb-3 justify-content-center">
                    <div class="col-5 text-center">
                      <button class="btn btn-info" name="submit" style="color:#fff">Save</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-------------------------------List Property------------------------->
              <div class="tab-pane fade profile-edit pt-3" id="list-property">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">image</th>
                      <th scope="col">address</th>
                      <th scope="col">price</th>
                      <th scope="col">action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($s as $data) : ?>
                      <tr>
                        <th><?= $data['id'] ?></th>
                        <td><img width="60" src="../admin/assets/img/<?= $data['image'] ?>" alt=""></td>
                        <td><?= $data['address'] ?></td>
                        <td><?= $data['price'] ?>$</td>
                        <td><a href="/odc/admin/estate-agency.php?delete=<?= $data['id'] ?>" class="btn btn-danger">Delete</a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>



<?php
include './shared/footer.php';
include './shared/script.php';
?>