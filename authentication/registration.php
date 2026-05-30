<?php


require_once __DIR__. '/../includes/db.php';

if(session_start() === PHP_SESSION_NONE){
      session_start();
}


if(empty($_SESSION['csrf_token'])){
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
}
$token = $_SESSION['csrf_token']; 



$error = [];

if(isset($_POST['create'])){
    if($_POST['csrf_token'] != $_SESSION['csrf_token']){
       die("invalid Request");
    }
    $name = $_POST['user-name'];
    $email = $_POST['user-email'];
    $password = $_POST['user-password'];
    $confirm = $_POST['user-confirm'];

    if(empty($name)){
        $error["name-error"] = "Name Required";
    }
    if(empty($email)){
        $error["email-error"] = "Email Required";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $error["email-error"] = "invalid Email";
    }
    if(empty($password)){
        $error["password-error"] = "Password Required";
    }
    elseif(strlen($password) <= 5){
      $error["password-error"] = "Password Must be 6 letter";
    }
    if(empty($confirm)){
        $error['confirm-password'] = "Confirm Password Required";
    }elseif($password != $confirm){
        $error['confirm-password'] = "Password Not Match";
    }
    if(empty($error)){
       $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
       $stmt->execute([$email]);
       $rows = $stmt->rowCount();

       if($rows > 0){
          $error['email-error'] = "This Email Already Exits";
       }
       else{

          $hash = password_hash($password, PASSWORD_DEFAULT);

          $emailtoken = bin2hex(random_bytes(32));

          $stmt = $conn->prepare("INSERT INTO users (Name, Email, Password,Token) VALUES (?, ?, ?, ?)");
          $stmt->execute([$name, $email, $hash, $emailtoken]);

          require_once __DIR__.'/emailVerification.php';

          sendEmailVerification($email, $name, $emailtoken);

          header("Location: registration.php");
          exit;

       }
    }

}

?>

<?php require_once __DIR__. '/../includes/header.php';  ?>

<style>
        .header-nav{
            position: static;
            background-color:#F7F7F7;
        }
        body{
            background-color: #F7F7F7;
        }
        .search-767px input {       
           background-color: #F7F7F7;
        }
</style>

<!-- ProductDetails --- Section --- 1 --- Start -->
<div class="PD-S1-container">
      <div class="PD-S1-content">
            <p>Home</p>
            <p>/</p>
            <p style="color:#A07936;">Create Account<p>
      </div>
</div>
<!-- ProductDetails --- Section --- 1 --- End -->


<!-- Registration --- Section --- 2 --- Start -->
<section>
         <div class="R-S2-container">
               <div class="R-S2-content">
                     <div class="R-S2-text">
                           <p>REGISTER</p>
                     </div>
                     <form method="POST">
                     <div class="registration">
                            <input type="hidden" name="csrf_token" value="<?php echo $token ?>">
                            <div class="input">
                                  <p>Your Name <span style="color:#FE0400;">*</span></p>
                                  <input type="text" name="user-name">
                                  <p style="color:red;"><?php echo $error['name-error'] ?? ''?></p>
                            </div>
                            <div class="input">
                                  <p>Your Email <span style="color:#FE0400;">*</span></p>
                                  <input type="text" name="user-email">
                                  <p style="color:red;"><?php echo $error['email-error'] ?? ''?></p>
                            </div>
                            <div class="input">
                                  <p>Enter Password <span style="color:#FE0400;">*</span></p>
                                  <input type="password" name="user-password">
                                  <p style="color:red;"><?php echo $error['password-error'] ?? ''?></p>
                            </div>
                            <div class="input">
                                  <p>Confirm Password <span style="color:#FE0400;">*</span></p>
                                  <input type="password" name="user-confirm">
                                  <p style="color:red;"><?php echo $error['confirm-error'] ?? ''?></p>
                                  <p style="color:red;"><?php echo $error['confirm-password'] ?? ''?></p>
                            </div>
                            <button type="submit" name="create">CREATE AN ACCOUNT</button>
                     </div>
                     </form>
               </div> 
         </div>
</section>
<!-- Registration --- Section --- 2 --- End -->

<?php require_once __DIR__. '/../includes/newsletter.php';  ?>


<?php require_once __DIR__. '/../includes/footer.php';  ?>