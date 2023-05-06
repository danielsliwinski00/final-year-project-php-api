<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$con = mysqli_connect('localhost', 'root', '', 'restaurant'); //connecting
if (!$con) {
    echo ""; //used this whilst coding to find out if its not connected
} else {
    echo ""; //used this whilst coding to find out if it has connected
}

if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $encoded = json_encode($data, true);
    $decoded = json_decode($data, true);
    $orderID = 0;
    foreach ($decoded as $objects) {
        $orderID = $objects;
    }

    if ($orderID != '') {
        $sql = "DELETE FROM `orders` WHERE orderid=$orderID";
        if (mysqli_query($con, $sql)) {
            echo 'successfully deleted order';
        } else {
            echo "Error: " . $sql . " " . $con->error;
        }
    }
}
$con->close();
?>