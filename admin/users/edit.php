<?php

session_start();
require_once __DIR__. '/../../includes/db.php';

require_once __DIR__. '/../auth_check.php';

$error = "";
$user = null;

if(isset($_GET['id'])){
    $u_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$u_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

if(isset($_POST['update'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    if($name == "" || $email == ""){
        $error = "Name and Email are required!";
    } else {
        $update = $conn->prepare("UPDATE users SET Name = ?, Email = ?, Role = ? WHERE id = ?");
        $update->execute([$name, $email, $role, $u_id]);
        
        $_SESSION['success_msg'] = "User updated successfully!";
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!-- Remix icon Cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />
     
    <!-- Bootstrap Cdn Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/admin.css">

    <style>
        .users-ipi { background-color: #A07936; }
        .users-ipi i, .users-ip a { color: white !important; }
        .edit-container { padding: 30px; background: #fff; margin: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); max-width: 600px;}
    </style>
</head>
<body>

<div class="sidebar-content">
    <?php require_once __DIR__. '/../includes/sidebar.php'; ?>
    <div class="content">
        <?php require_once __DIR__. '/../includes/header.php'; ?>
        
        <div class="edit-container">
            <h4 class="mb-4">Edit User Details</h4>
            
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role">
                        <option value="user" <?php echo ($user['Role'] == 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo ($user['Role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                
                <?php if($error): ?><div class="alert alert-danger mt-2"><?php echo $error; ?></div><?php endif; ?>
                
                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-primary" style="background-color: #A07936; border-color: #A07936;">Update User</button>
                    <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/javascript/admin.js"></script>

</body>
</html>
