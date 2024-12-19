<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit;
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_user_query = $conn->prepare("DELETE FROM `users` WHERE id = :id");
   $delete_user_query->execute([':id' => $delete_id]);
   header('location:admin_users.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title">User Accounts</h1>

   <div class="box-container">
      <?php
         $select_users = $conn->query("SELECT * FROM `users`");
         while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="box">
         <p> User ID: <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> Username: <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> Email: <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> User Type: <span style="color:<?php if ($fetch_users['user_type'] == 'admin') { echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete User</a>
      </div>
      <?php
         }
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
