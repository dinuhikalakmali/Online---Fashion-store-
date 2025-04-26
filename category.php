<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Category</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

   <h1 class="heading">category</h1>

   <div class="box-container">

   <div class="swiper-wrapper">

   <!-- Example of a product (Lady's Shoe) -->
   <a href="products.php?products=Shirt" class="swiper-slide slide">
      <img src="images/ladyshoe.png" alt="Lady's Shoe">
      <h1>New Arrival Lady's Shoe</h1>
   </a>

   <?php
     // Retrieve the selected category from the URL parameter
     $category = isset($_GET['category']) ? $_GET['category'] : ''; 
     
     // Fetch products from the database matching the category
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ?");
     $select_products->execute(["%$category%"]);
     
     if($select_products->rowCount() > 0){
        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   
   <!-- Product form to add to cart/wishlist -->
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      
      <!-- Wishlist button -->
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      
      <!-- Quick view link -->
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      
      <!-- Product image -->
      <img src="images/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>">

      <!-- Product name -->
      <div class="name"><?= $fetch_product['name']; ?></div>
      
      <!-- Product price and quantity selector -->
      <div class="flex">
         <div class="price"><span>LKR.</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      
      <!-- Add to cart button -->
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   
   <?php
        } // End of while loop for fetching products
     } else {
        echo "<p>No products found in this category.</p>";
     } // End of if block for rowCount
   ?>

   </div> <!-- End of swiper-wrapper -->

   </div> <!-- End of box-container -->

</section>

<!-- START OF SPECIFIC PRODUCT DISPLAY BLOCK -->
<section class="specific-product">
   <h2>Featured Product: Elegant Leather Tote Bag for Women</h2>

   <?php
   // Fetch product details from the database for the specific bag
   $select_bag = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_bag->execute(['Elegant Leather Tote Bag for Women']);

   if ($select_bag->rowCount() > 0) {
      $bag = $select_bag->fetch(PDO::FETCH_ASSOC);

      // Display images and product details
      echo "<div class='product-display'>";
      echo "<img src='images/" . $bag['image_01'] . "' alt='Bag Front'>";
      echo "<img src='images/" . $bag['image_02'] . "' alt='Bag Back'>";
      echo "<img src='images/" . $bag['image_03'] . "' alt='Bag Side'>";
      echo "<div class='product-info'>";
      echo "<h3>" . $bag['name'] . "</h3>";
      echo "<p>Price: LKR " . $bag['price'] . "/-</p>";
      echo "<p>Description: " . $bag['description'] . "</p>";
      echo "</div>";
      echo "</div>";
   } else {
      echo "<p>Product not found.</p>";
   }
   ?>

</section>
<!-- END OF SPECIFIC PRODUCT DISPLAY BLOCK -->

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
