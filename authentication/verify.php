<?php

require_once __DIR__. '/../includes/db.php';

if(session_start() === PHP_SESSION_NONE){
    session_start();
}

$error = [];
$success = "";

if (isset($_SESSION['auth_success'])) {
    $success = $_SESSION['auth_success'];
    unset($_SESSION['auth_success']);
}

if (!isset($_GET['token']) || empty($_GET['token'])) {
    die("Invalid or Missing Token.");
}

$token = $_GET['token'];


$stmt = $conn->prepare("SELECT * FROM users WHERE forget_token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Invalid or Expired Token.");
}

if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['reset_password'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid Request");
    }

    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (empty($password)) {
        $error["password-error"] = "Password Required";
    } elseif (strlen($password) <= 5) {
        $error["password-error"] = "Password Must be at least 6 characters";
    }

    if (empty($confirm)) {
        $error['confirm-error'] = "Confirm Password Required";
    } elseif ($password !== $confirm) {
        $error['confirm-error'] = "Passwords Do Not Match";
    }

    if (empty($error)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET Password = ?, forget_token = NULL WHERE id = ?");
        if ($stmt->execute([$hash, $user['id']])) {
            $_SESSION['auth_success'] = "Password has been reset successfully. You can now login.";
            header("Location: login.php");
            exit;
        } else {
            $error['password-error'] = "Something went wrong. Please try again.";
        }
    }
}

$csrf_token = $_SESSION['csrf_token'];
?>

<?php require_once __DIR__. '/../includes/header.php'; ?>

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
            <p style="color:#A07936;">Reset Password<p>
      </div>
</div>
<!-- ProductDetails --- Section --- 1 --- End -->

<section>
         <div class="R-S2-container">
               <div class="R-S2-content">
                     <div class="R-S2-text">
                           <p>ENTER NEW PASSWORD</p>
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
                     <?php else: ?>
                         <form method="POST">
                         <div class="registration">
                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                <div class="input">
                                      <p>New Password <span style="color:#FE0400;">*</span></p>
                                      <input type="password" name="password">
                                      <p style="color:red;"><?php echo $error['password-error'] ?? ''?></p>
                                </div>
                                <div class="input">
                                      <p>Confirm Password <span style="color:#FE0400;">*</span></p>
                                      <input type="password" name="confirm_password">
                                      <p style="color:red;"><?php echo $error['confirm-error'] ?? ''?></p>
                                </div>
                                <button type="submit" name="reset_password" style="width: auto; padding: 0 20px;">RESET PASSWORD</button>
                         </div>
                         </form>
                     <?php endif; ?>
               </div> 
         </div>
</section>

<?php require_once __DIR__. '/../includes/footer.php'; ?>
