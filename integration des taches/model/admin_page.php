<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $query = "SELECT total_price FROM `orders` WHERE payment_status = 'pending'";
            $stmt = $conn->query($query);
            while ($fetch_pendings = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $total_price = $fetch_pendings['total_price'];
                $total_pendings += $total_price;
            }
         ?>
         <h3>$<?php echo $total_pendings; ?>/-</h3>
         <p>total pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $query = "SELECT total_price FROM `orders` WHERE payment_status = 'completed'";
            $stmt = $conn->query($query);
            while ($fetch_completed = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $total_price = $fetch_completed['total_price'];
                $total_completed += $total_price;
            }
         ?>
         <h3>$<?php echo $total_completed; ?>/-</h3>
         <p>completed payments</p>
      </div>

      <div class="box">
         <?php 
            $query = "SELECT * FROM `orders`";
            $stmt = $conn->query($query);
            $number_of_orders = $stmt->rowCount();
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order placed</p>
      </div>

      <div class="box">
         <?php 
            $query = "SELECT * FROM `products`";
            $stmt = $conn->query($query);
            $number_of_products = $stmt->rowCount();
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Courses added</p>
      </div>

      <div class="box">
         <?php 
            $query = "SELECT * FROM `users` WHERE user_type = 'user'";
            $stmt = $conn->query($query);
            $number_of_users = $stmt->rowCount();
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php 
            $query = "SELECT * FROM `users` WHERE user_type = 'admin'";
            $stmt = $conn->query($query);
            $number_of_admins = $stmt->rowCount();
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php 
            $query = "SELECT * FROM `users`";
            $stmt = $conn->query($query);
            $number_of_account = $stmt->rowCount();
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         <?php 
            $query = "SELECT * FROM `message`";
            $stmt = $conn->query($query);
            $number_of_messages = $stmt->rowCount();
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>new messages</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
