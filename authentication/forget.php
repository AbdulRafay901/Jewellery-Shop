<?php

require_once __DIR__. '/../includes/db.php';

if(session_start() === PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];

$error = [];
$success = "";

if (isset($_SESSION['auth_success'])) {
    $success = $_SESSION['auth_success'];
    unset($_SESSION['auth_success']);
}

if (isset($_POST['Submit'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid Request");
    }

    $email = trim($_POST['email']);

    if (empty($email)) {
        $error['email-error'] = "Email Address Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email-error'] = "Invalid Email";
    }

    if (empty($error)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $forgetToken = bin2hex(random_bytes(32));

            $stmt = $conn->prepare("UPDATE users SET forget_token = ? WHERE Email = ?");
            if ($stmt->execute([$forgetToken, $email])) {
                require_once __DIR__ . '/forget_email.php';
                if (sendForgetPasswordEmail($email, $user['Name'], $forgetToken)) {
                    $_SESSION['auth_success'] = "Password reset link has been sent to your email.";
                    header("Location: forget.php");
                    exit;
                } else {
                    $error['email-error'] = "Failed to send email. Please try again.";
                }
            } else {
                $error['email-error'] = "Something went wrong. Please try again.";
            }
        } else {
            $error['email-error'] = "Email Address not found in our records.";
        }
    }
}

?>

<?php

require_once __DIR__. '/../includes/header.php';

?>

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

<style>
        .header-nav{
            position: static;
            background-color:#F7F7F7;
        }
        body{
            background-color: #F7F7F7;
        }
</style>

<!-- ProductDetails --- Section --- 1 --- Start -->
<div class="PD-S1-container">
      <div class="PD-S1-content">
            <p>Home</p>
            <p>/</p>
            <p style="color:#A07936;">Forget Password<p>
      </div>
</div>
<!-- ProductDetails --- Section --- 1 --- End -->


<!-- Registration --- Section --- 2 --- Start -->
<section>
         <div class="R-S2-container">
               <div class="R-S2-content">
                     <div class="R-S2-text">
                           <p>RESET PASSWORD</p>
                     </div>

                     <form method="POST">
                     <div class="registration forget">
                            <div class="input">
                                  <p>Email Address <span style="color:#FE0400;">*</span></p>
                                  <input type="email" name="email">
                                  <p style="color:red;"><?php echo $error['email-error'] ?? ''?></p>
                                  <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                            </div>
                           
                            <button type="submit" name="Submit">Submit</button>

                            <a href="login.php">Return To Login?</a>

                            <a href="../pages/cart.php" style="margin-top:-13px; text-decoration: underline;">Return to store</a>
                     </div>
                     </form>
               </div> 
         </div>
</section>

<?php require_once __DIR__. '/../includes/footer.php'; ?>
<!-- Registration --- Section --- 2 --- End -->