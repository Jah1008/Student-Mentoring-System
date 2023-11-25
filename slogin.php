<!-- slogin.php -->



<?php include('header.php') ?>
  <section class="bg-light vh-100 d-flex">
    <div class="col-3 m-auto">
      <div class="card">
        <div class="card-body">
          <div class="border rounded-circle mx-auto d-flex " style="width:100px;height:100px" ><i class="fa fa-user text-light fa-3x m-auto"></i></div>
          <form action="student/process_login.php" method="POST">
        
    <div class="md-form">
        <input type="text" id="ssn" name="ssn" class="form-control">
        <label for="ssn">Your SRN</label>
    </div>
    
    <!-- Password field (if you need it) -->
    <div class="md-form">
        <input type="password" id="pass" name="pass" class="form-control">
        <label for="pass">Your Password</label>
    </div>
    <div class="text-center">
        <button class="btn btn-secondary" name="login">Login</button>
    </div>
</form>
        </div>
      </div>
    </div>
  </section>
<?php include('footer.php') ?>

