
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
$success = "";

if (isset($_SESSION['auth_success'])) {
    $success = $_SESSION['auth_success'];
    unset($_SESSION['auth_success']);
}

if(isset($_POST['login'])){
      if($_SESSION['csrf_token'] != $_POST['csrf_token']){
            echo "invalid Token";
      }

      $email = $_POST['email'];
      $password = $_POST['password'];

      if(empty($email)){
        $error["email-error"] = "Enter Your Email";
      }
      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $error["email-error"] = "invalid Email";
      }
      if(empty($password)){
       $error["email-password"] = "Enter Your Password";
      }
      if(empty($error)){
            $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
            $stmt->execute([$email]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row){
                  if(password_verify($password, $row['Password'])){

                        session_regenerate_id(true);
                  
                        if($row['Role'] == "admin"){
                              $_SESSION['username'] = $row['Name'];
                              $_SESSION['Role'] = $row['Role'];

                              if(isset($_POST['remember-me'])){

                              $cookie_token = bin2hex(random_bytes(32));

                              setcookie("token", $cookie_token, time() + (86400 * 30), "/", "", true, true);

                              $stmt = $conn->prepare("UPDATE users SET cookie_token = ? WHERE id = ");
                              $stmt->execute([$cookie_token,$row['id']]);

                              }

                              header("Location: ../admin/dashboard.php");
                              exit;

                        }
                        else{
                              $_SESSION['username'] = $row['Name'];
                              $_SESSION['Role'] = $row['Role'];

                              if(isset($_POST['remember-me'])){

                              $cookie_token = bin2hex(random_bytes(32));

                              setcookie("token", $cookie_token, time() + (86400 * 30), "/");

                              $stmt = $conn->prepare("UPDATE users SET cookie_token = ? WHERE id = ?");
                              $stmt->execute([$cookie_token,$row['id']]);

                              }

                              header("Location: ../index.php");
                              exit;
                        }
                  }else{
                        $error['email-password'] = "incorrect Password";
                  }
            }else{
            $error['email-error'] = "invalid Email";
      }
      }
}


?>





<?php

require_once __DIR__. '/../includes/header.php';

?>

<style>
        .header-nav{
            position: static;
            background-color:#F7F7F7;
        }
        body{
            background-color: #F7F7F7;
        }
        .registration button{
            width: 130px;
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
                           <p>LOGIN</p>
                     </div>

                     <?php if (!empty($success)): ?>
                     <div class="Auth-Success-msg">
                           <div class="icon">
                                 <i class="ri-check-line"></i>
                           </div>
                           <div class="text">
                                 <p><?php echo $success; ?></p>
                           </div>
                     </div>
                     <?php endif; ?>

                     <form method="POST">
                     <div class="registration">
                            <div class="input">
                                  <p>Email Address <span style="color:#FE0400;">*</span></p>
                                  <input type="email" name="email">
                                  <p style="color:red;"><?php echo $error['email-error'] ?? ''?></p>
                                  <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                            </div>
                            <div class="input">
                                  <p>Password <span style="color:#FE0400;">*</span></p>
                                  <input type="password" name="password">
                                  <p style="color:red;"><?php echo $error['email-password'] ?? ''?></p>
                            </div>
                            <div class="input remember-me">
                              <input type="checkbox" name="remember-me">
                                  <p>Remember Me <span style="color:#FE0400;">*</span></p>
                            </div>
                            <button type="submit" name="login">LOGIN</button>

                            <a href="forget.php">Forget your password?</a>

                            <a href="<?php echo BASE_URL;  ?>/pages/cart.php" style="margin-top:-13px; text-decoration: underline;">Return to store</a>
                     </div>
                     </form>
               </div> 
         </div>
</section>

<?php require_once __DIR__. '/../includes/footer.php'; ?>
<!-- Registration --- Section --- 2 --- End -->