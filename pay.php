<?php

// THIS IS AUTO GENERATED SCRIPT
// (c) 2011-2021 Kreata OÜ www.pangalink.net

// File encoding: UTF-8
// Check that your editor is set to use UTF-8 before using any non-ascii characters

// STEP 1. Setup private key
// =========================

$private_key = openssl_pkey_get_private(
"-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAmRWOgbwQ8s6h9V9qHWd0mT2/6ZK02HArgtvbJSrmb6XT8+0U
a9lgdpjFWN2CLFMGUKOBii4C8EFgUqXfaY0FA9pKgMrrMC0z/HlP3CLJEbXy0Huy
RwfK1amiuz0hWYyXENZk4erDqEaUoGypDJAu5Qa2LRPXNFDkHq3tAeNt467+I/20
ZztMlZImvtuMJSKcASlZ9YjJ6I5US0T8b5V+QRYFayUGyk8cIHOrLs2Yug9x71aZ
AUpiI0WmQTVnUjUoJ100Q6zvL4MuhPBa9LaD6NZdiXLbC2K0mSVs81htDcYVyYUS
3GwBykd3EHthOdCJQY/C5XrJXuAPeHwYdTe5rQIDAQABAoIBAF2+kq8lwOc/3HRL
gssQ4Jk69DwP6Akm365Z/mBLXiP+08XrZ/cHfggCU8+wjhegnBxjlF9O/+Oq1Van
VyHnBqwuUDOAj/fHpq80htASyTi8SD6dkTXoMrEXGZ05uSOCcbwQ3mRuhHSXDEsV
X4xe+yirLIJ8ROw3oQqcjaf7Yv7q5ybmDeLDA6aIGMrRJ2D43MSzo4Fyqbegp9xj
ZFrPzz5xSfculyk3trCSKfbHPdEMAFZjuvOPBH0m71jEpzlknDEH7JQm/N9ObnkC
kzt8eC5GIZJXG9LOgHv5sRNzvghslAKbPMLwgwsHgj+Bokga6j6DBDjIoBQzWFpS
59ypQsECgYEAxq1h9plsdvzX1G/B69sw/9C6sVZpxZ79HhPKIIyyodgUKVFxUmEa
Qwx5SMFKPOp2n/EY4bDwTHtCkEmD9JUHXYahDNErci93WxKiOV5ONQTrVFL9lN9r
TokszjXnPe9oArVfDI54EvFqGXpxskHp6RZwbHk+c60whNUm5MVEbV0CgYEAxUCZ
C2jTcY+YUgxJ+4R6/ENPlhWRXkcJ8khGDpPE3HWozYjckkrC4pSjospHT7B7fPe9
m9AlEFQ0bc/QHhKwB6mU5Sbrf0tvaBuXdC+kAmdjrdVjQMNYhTG4YQLz9Xw1Vjh+
SR1lUOyIi4aqaubmcD3rRo27T9OjJoGBI0ioaJECgYAEXMQ85OuDxVN736RTaHGv
/EZNJIeYBkCqi2axxkUZ1qPCsH4bf/RSqpBzL4NQyRkns+SG+Bqeo0o33tVd5nPN
8unQXTtl+3LUdhlHxzFSarQ8GsJkpW82vz5TnM1iB8Kx5Iecv/gU+mYI/y5F6rqX
Gp4HU7YyVggtsnxzI324JQKBgQCI2t7UebBqU/ScyIX0CeDCcXkgampnfOY7wUVK
C+BEDSZHJDPVFCXOys4Vvj5n3cxv0fstxeZRQ/r0TYDZvKGBT3lM3An8UbxEARC9
vegO+ui/zROF9YLPNsX0GPZmVf0zixKja8/Fq7a5B3/pl7Y+HdfFJcTWB8Jkjumo
L1sY4QKBgCGgQDYtbt0iMEBVytOPQODAUB5DfVYoe8XJINIZcqbGsJHyefQzw0ny
YJRSIKNG+DUlsNRinPY6GjjiPLvZiDkIKjimS3v/+t05TEzEZ+L0B9zycsTbOa6w
9BaEuwjATY/WOneTj5nd99uPfrqaiOTfWo/p1c84Mc3xDL3TJmMR
-----END RSA PRIVATE KEY-----");

// STEP 2. Define payment information
// ==================================

$fields = array(
        "VK_SERVICE"     => "1011",
        "VK_VERSION"     => "008",
        "VK_SND_ID"      => "uid100010",
        "VK_STAMP"       => "12345",
        "VK_AMOUNT"      => $_POST['total'],
        "VK_CURR"        => "EUR",
        "VK_ACC"         => "EE171010123456789017",
        "VK_NAME"        => $_POST['fname'] . " " . $_POST['sname'],
        "VK_REF"         => "1234561",
        "VK_LANG"        => "EST",
        "VK_MSG"         => $_POST['email'] . "_" . $_POST['phone'],//message
        "VK_RETURN"      => "http://localhost/hajus4/shop/?msg=success",//success
        "VK_CANCEL"      => "http://localhost/hajus4/shop/?msg=cancel",//Cancel
        "VK_DATETIME"    => date('Y-m-d\TH:i:sO'),
        "VK_ENCODING"    => "utf-8",
);

// STEP 3. Generate data to be signed
// ==================================

// Data to be signed is in the form of XXXYYYYY where XXX is 3 char
// zero padded length of the value and YYY the value itself
// NB! SEB expects symbol count, not byte count with UTF-8,
// so use `mb_strlen` instead of `strlen` to detect the length of a string

$data = str_pad (mb_strlen($fields["VK_SERVICE"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_SERVICE"] .    /* 1011 */
        str_pad (mb_strlen($fields["VK_VERSION"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_VERSION"] .    /* 008 */
        str_pad (mb_strlen($fields["VK_SND_ID"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_SND_ID"] .     /* uid100010 */
        str_pad (mb_strlen($fields["VK_STAMP"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_STAMP"] .      /* 12345 */
        str_pad (mb_strlen($fields["VK_AMOUNT"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_AMOUNT"] .     /* 150 */
        str_pad (mb_strlen($fields["VK_CURR"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_CURR"] .       /* EUR */
        str_pad (mb_strlen($fields["VK_ACC"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_ACC"] .        /* EE171010123456789017 */
        str_pad (mb_strlen($fields["VK_NAME"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_NAME"] .       /* ÕIE MÄGER */
        str_pad (mb_strlen($fields["VK_REF"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_REF"] .        /* 1234561 */
        str_pad (mb_strlen($fields["VK_MSG"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_MSG"] .        /* Torso Tiger */
        str_pad (mb_strlen($fields["VK_RETURN"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_RETURN"] .     /* http://localhost:8080/project/ukDX4OZ3yAq7Kl5K?payment_action=success */
        str_pad (mb_strlen($fields["VK_CANCEL"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_CANCEL"] .     /* http://localhost:8080/project/ukDX4OZ3yAq7Kl5K?payment_action=cancel */
        str_pad (mb_strlen($fields["VK_DATETIME"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_DATETIME"];    /* 2021-02-25T14:58:39+0200 */

/* $data = "0041011003008009uid10001000512345003150003EUR020EE171010123456789017009ÕIE MÄGER0071234561011Torso Tiger069http://localhost:8080/project/ukDX4OZ3yAq7Kl5K?payment_action=success068http://localhost:8080/project/ukDX4OZ3yAq7Kl5K?payment_action=cancel0242021-02-25T14:58:39+0200"; */

// STEP 4. Sign the data with RSA-SHA1 to generate MAC code
// ========================================================

openssl_sign ($data, $signature, $private_key, OPENSSL_ALGO_SHA1);

/* ldVaV6IKwh18TNVK0F9ED5qUi87Kn9mnDBv4mswNt/x9v0N+cF/fnEwHc4TGXg1/Z2E17TsGO/gbdKNGUPUz7TWChdS3u1Zoxm0fETojBYFQvEhtA+AxCThmArTvVpYqfHAUAQhbeFBBcw8uUDV4XhR4MGQaiuTK8MRAxrTkbbmDZoYvMOqWEDlf85lejps1bi3cKg8TKdiBAzgGgAsp2LtH0bRs24LlMYM4r92aD4mdR7qGVkxkd9e+zEkBvBqQ//OLjjepSUJe+tFD9dYa6I80ab3CSofBcaUjSSu1itstPbUJPE8eNSM5Mgbo5+LzYIYwGt0Qt/3XwUP/E+msuA== */
$fields["VK_MAC"] = base64_encode($signature);

// STEP 5. Generate POST form with payment data that will be sent to the bank
// ==========================================================================
?>

        <form method="post" action="http://localhost:8080/banklink/seb-common">
            <!-- include all values as hidden form fields -->
<?php foreach($fields as $key => $val):?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($val); ?>" />
<?php endforeach; ?>

            <!-- draw table output for demo -->
            <table>
                <!-- when the user clicks "Edasi panga lehele" form data is sent to the bank -->
                <tr><td colspan="2"><input class="btn btn-success m-5" type="submit" id="banksubmit" value="To the Bank" /></td></tr>
            </table>
        </form>

    </body>
</html>
