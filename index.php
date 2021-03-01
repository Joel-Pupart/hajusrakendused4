<?php

require_once 'autoload.php' ;

$msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);

if (isset($msg) && !empty($msg)) {
    echo '<div class="alert alert-info d-flex justify-content-center">';
    switch ($msg) {
        case 'success':
            session_unset();
            echo "Payment successful!";
            break;
        case 'cancel':
            echo "Payment cancelled!";
            break;
        case 'added_to_cart':
            echo "Product was added to the cart!";
        }
        echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

<div class="d-flex flex-row-reverse m-3">
    <a href="cart.php" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>    Shopping Cart  
        <?php
            $totalAmount = 0;
            $totalPrice = 0;
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $id => $amount) {
                    $totalAmount += $amount;
                    $product = $products[$id]; 
                    $rowTotal= $product['price'] * $amount;
                    $totalPrice += $rowTotal;
                }
                echo "(" . $totalAmount . ")";
            }
            echo "</a>";
            echo "</div>";

            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                echo "<div class='h4 d-flex flex-row-reverse m-3'>" . $totalPrice . "€</div>";
            }
        ?>
<div class="d-flex flex-wrap justify-content-center m-5">
    <?php if (!empty($products)) : foreach ($products as $product) { ?>
        <div class="card m-4" style="width: 18rem;">
            <img class="card-img-top" src="<?php echo $product['image']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text"><?php echo $product['price']; ?></p>
                <a class="btn btn-primary" href="add.php?id=<?php echo $product['id']; ?>">Add to cart</a>
            </div>
        </div>
    <?php } endif; ?>
</div>

</body>
</html>