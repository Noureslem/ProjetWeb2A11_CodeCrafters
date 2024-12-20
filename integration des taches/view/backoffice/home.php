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

    // Check if the product is already in the cart
    $query = "SELECT * FROM `cart` WHERE name = :product_name AND user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':product_name' => $product_name, ':user_id' => $user_id]);

    if ($stmt->rowCount() > 0) {
        $message[] = 'already added to cart!';
    } else {
        // Insert the product into the cart
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Get Your Course Now!</h3>
      <p>Learn Online,Grow,Succeed.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest Courses</h1>

   <div class="box-container">

      <?php  
         $query = "SELECT * FROM `products` LIMIT 6";
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
         echo '<p class="empty">no Courses added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>For further Informations , you can click the button bellow to discover Us more!</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>You can contact Us,And will respond to you Soon!</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
