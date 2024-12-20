<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $query = "SELECT * FROM `cart` WHERE name = :product_name AND user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':product_name' => $product_name, ':user_id' => $user_id]);

    if ($stmt->rowCount() > 0) {
        $message[] = 'already added to cart!';
    } else {
        $query = "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES (:user_id, :product_name, :product_price, :product_quantity, :product_image)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':user_id' => $user_id,
            ':product_name' => $product_name,
            ':product_price' => $product_price,
            ':product_quantity' => $product_quantity,
            ':product_image' => $product_image,
        ]);
        $message[] = 'product added to cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>our shop</h3>
   <p> <a href="home.php">home</a> / shop </p>
</div>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $query = "SELECT * FROM `products`";
         $stmt = $conn->query($query);
         if ($stmt->rowCount() > 0) {
            while ($fetch_products = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
