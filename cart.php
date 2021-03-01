<?php

require_once('autoload.php');

$msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);

if (isset($msg) && !empty($msg)) {
    echo '<div class="alert alert-info">';
    echo 'Product was deleted!';
    echo '</div>';
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) < 1 || !isset($_SESSION['cart'])) {
    echo "<div class='h5'>Sorry, but Your shopping cart is empty!</div>";
}


$total = 0;

$error = false;
$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
$sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, 'phone', FILTER_VALIDATE_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$postTotal = filter_input(INPUT_POST, 'total', FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'Confirm') {
    if (empty($fname) || empty($sname) || empty($phone) || empty($email)) {
        $error = true;
        echo "<span class='alert alert-danger d-flex justify-content-center'>You need to fill all the input fields!</span>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Shopping Cart</title>
</head>
<body class="p-5">
    <div class="m-5 d-flex flex-column justify-content-center">
    <?php if (!empty($products) && isset($_SESSION['cart'])) : foreach ($_SESSION['cart'] as $id => $amount) { ?>
        <table class="bg-light m-1 border-bottom" width="100%">
            <tr>
                <th width="20%"></th>      
                <th width="55%"></th>      
                <th width="20%"></th>      
                <th width="5%"></th>      
            </tr>
        <?php $product = $products[$id]; 
            $rowTotal= $product['price'] * $amount;
            $total += $rowTotal;
        ?>
        <tr>
            <td><?php echo "<span class='h6 m-5'>" . $product['name'] . "</span>"; ?></td>
            <td><?php echo "<span class='h6 m-2'>" . $rowTotal . "</span>"; ?></td>
            <td>
                <?php if ($amount < 1) {?>
                    <a class="btn btn-secondary">-</a>
                <?php } else if ($amount == 1) { ?>
                    <a class="btn btn-secondary" href="delete.php?id=<?php echo $product['id']; ?>">-</a>
                <?php } else { ?>
                    <a class="btn btn-secondary" href="decrease.php?id=<?php echo $product['id']; ?>">-</a>
                <?php } ?>
                <?php echo "<span class='h6 m-2'>" . $amount . "</span>"; ?>
                <a class="btn btn-secondary" href="increase.php?id=<?php echo $product['id']; ?>">+</a>
            </td>
            <td><img class="img-thumbnail" src="<?php echo $product['image']; ?>"></td>
            <td><a class="btn btn-danger m-5" href="delete.php?id=<?php echo $product['id']; ?>">Delete</a></td>
        </tr>
    </table>

    <?php } endif; ?>
</div>
<div class="m-5">
    <?php echo "<div class='d-flex align-items-end flex-column m-3'>
                    <div class='h4'>Total:  " . $total . " €</div>
                    <a class='btn btn-primary' href='/hajus4/shop'>Back to Shopping</a>
                </div>"; 
    ?>
    
</div>
<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { 
    if (isset($action) && $action === 'Confirm' && $error == false) {
        require_once 'pay.php';  
    } else {
?>
    
    <form method="post" class="d-flex flex-column m-5">
        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="fname" value="<?php if (isset($action)) { echo $_POST['fname']; } ?>">
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input class="form-control" type="text" name="sname" value="<?php if (isset($action)) { echo $_POST['sname']; } ?>">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="email" name="email" value="<?php if (isset($action)) { echo $_POST['email']; } ?>">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input class="form-control" type="text" name="phone" value="<?php if (isset($action)) { echo $_POST['phone']; } ?>">
        </div>
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <input class="btn btn-success" type="submit" name="submit" value="Confirm">
    </form>

<?php } ?>
<?php } ?>

</body>
</html>