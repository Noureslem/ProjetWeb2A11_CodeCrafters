<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    $update_cart_query = $conn->prepare("UPDATE `cart` SET quantity = :quantity WHERE id = :id");
    $update_cart_query->execute([':quantity' => $cart_quantity, ':id' => $cart_id]);
    $message[] = 'Cart quantity updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = $conn->prepare("DELETE FROM `cart` WHERE id = :id");
    $delete_query->execute([':id' => $delete_id]);
    header('location:cart.php');
    exit;
}

if (isset($_GET['delete_all'])) {
    $delete_all_query = $conn->prepare("DELETE FROM `cart` WHERE user_id = :user_id");
    $delete_all_query->execute([':user_id' => $user_id]);
    header('location:cart.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<?php include 'header.php'; ?>

<div class="heading">
    <h3>Shopping Cart</h3>
    <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="shopping-cart">

    <h1 class="title">Courses added</h1>

    <div class="box-container">
        <?php
            $grand_total = 0;
            $select_cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
            $select_cart_query->execute([':user_id' => $user_id]);
            if ($select_cart_query->rowCount() > 0) {
                while ($fetch_cart = $select_cart_query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box">
            <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
            <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_cart['name']; ?></div>
            <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
            <form action="" method="post">
                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                <input type="submit" name="update_cart" value="update" class="option-btn">
            </form>
            <div class="sub-total"> Sub total : <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
        </div>
        <?php
        $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Your cart is empty</p>';
            }
        ?>
    </div>

    <div style="margin-top: 2rem; text-align:center;">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');">Delete all</a>
    </div>

    <div class="cart-total">
        <p>Grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
        <div class="flex">
            <a href="shop.php" class="option-btn">Continue shopping</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to checkout</a>
        </div>
    </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
