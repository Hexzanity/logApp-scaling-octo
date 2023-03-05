<?php
	require('config/config.php');
  require('config/db.php');


  if(isset($_POST['submit'])){
    $name = htmlentities($_POST['username']);
    $pass = htmlentities($_POST['password']);
    $sql = "SELECT * from account where user='$name' AND password='$pass'";

    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
    if($rows ==1){
      header('Location: guestbook-list.php');
      $row = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $row['user'];

    } else {
      echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color:#ff9999;">
      <strong style="color:Black">Couldn\'t find account</strong>
      <p class="mb-0" style="color:#b30000">Please make sure Username or Password is Correct!<p>
      <button style="color:Black" type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      ';
      
      }
    }
?>
<?php include('inc/header.php'); ?>
  <br/>
  <div style="width:30%; margin: auto; text-align: center;">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form-signin">
      <img class="mb-4" src="img/bootstrap.svg" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
      <br/><label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

    </form>
  </div>
<?php include('inc/footer.php'); ?>