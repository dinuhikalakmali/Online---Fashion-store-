<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
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
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/Untitled design (1).png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off - HNB Credit Cards - </span>
            <h3>NEW ARRIVALS WOMAN SHORTS</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/menpant.png" alt="">
         </div>
         <div class="content">
            <span>upto 40% off -BOC Credit cards-</span>
            <h3>GENTS TROUSER </h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/Untitled design3.png" alt="">
         </div>
         <div class="content">
            <span>upto 30% off -sampath credit Cards-</span>
            <h3>NEW ARRIVALS PARTY DRESS</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">shop by category</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=Shirt" class="swiper-slide slide">
      <img src="images/shirt.png" alt="">
      <h3>Gent Shirt</h3>
   </a>

   <a href="category.php?category=Ladies" class="swiper-slide slide">
      <img src="images/dress.png" alt="">
      <h3>Ladies</h3>
   </a>

   <a href="category.php?category=Kids" class="swiper-slide slide">
      <img src="images/onesie.png" alt="">
      <h3>Kids</h3>
   </a>

   <a href="category.php?category=Accessories" class="swiper-slide slide">
      <img src="images/eyeglasses.png" alt="">
      <h3>Gents Accessories</h3>
   </a>

   <a href="category.php?category=Shoes" class="swiper-slide slide">
      <img src="images/high-heel.png" alt="">
      <h3>Shoes</h3>
   </a>

   <a href="category.php?category=Perfume" class="swiper-slide slide">
      <img src="images/perfume.png" alt="">
      <h3>Perfume</h3>
   </a>

   <a href="category.php?category=Jewelry" class="swiper-slide slide">
      <img src="images/ring.png" alt="">
      <h3>Jewelry</h3>
   </a>

   <a href="category.php?category=watch" class="swiper-slide slide">
      <img src="images/icon-8.png" alt="">
      <h3>Watch</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading latest-products-title">latest products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <a href="home-products.php?home-products=Shirt" class="swiper-slide slide">
      <img src="images/menshue.png" alt="" class="product-image">
      <h1 class="product-title">New Arrival Men's Shoe</h1>
   </a>

   <a href="home-products.php?home-products=Shirt" class="swiper-slide slide">
      <img src="images/ladyshoue.png" alt="">
      <h1>New Arrival Lady's Shoe</h1>
   </a>

   <a href="home-products.php?home-products=Shirt" class="swiper-slide slide">
      <img src="images/sidebag.png" alt="">
      <h1>New Arrival Men's Side bag</h1>
   </a>

   <a href="home-products.php?home-products=Shirt" class="swiper-slide slide">
      <img src="images/watch (1).png" alt="">
      <h1>New Trendy Watch</h1>
   </a>

   <a href="home-products.php?home-products=Shirt" class="swiper-slide slide">
      <img src="images/ladybag.png" alt="">
      <h1>New Arrival Lady's Bag</h1>
   </a>

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" class="product-image">
      <h1 class="product-title"><?= $fetch_product['name']; ?></h1>
      <div class="flex">
         <div class="price"><span>LKR.</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
        } // Closing the while loop
     } // Closing the if block
   ?>
   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
