<?php
include './shared/head.php';
include './shared/header.php';
include './shared/aside.php';
auth(2);
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
</main><!-- End #main -->
<?php  
include './shared/script.php';
?>