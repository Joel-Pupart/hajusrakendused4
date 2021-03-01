<?php
require_once 'autoload.php';

echo "<pre>";
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!isset($products[$id])) {
    //redirect to...
    exit('product missing');
}

//session req: id, amount
if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 0;
}

unset($_SESSION['cart'][$id]);

?><meta http-equiv="refresh" content="0;url=cart.php?msg=deleted" />
<?php
exit;