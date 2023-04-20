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
    $getlastid = "SELECT orderid FROM orders ORDER BY orderid DESC LIMIT 1";
    $result = $con->query($getlastid);

    $orderid = 0;
    while ($row = $result->fetch_assoc()) {
        $orderid = $row['orderid'];
    }
    $orderid += 1;

    if (mysqli_query($con, $getlastid)) {
    } else {
        echo "error";
    }

    $data = file_get_contents("php://input");
    $decoded = json_decode($data, true);

    $text = "";
    $dish = '';
    $available = 1;
    //$time = date('Y-m-d H:i:sa');

    $time = new DateTime("now");
    $time->modify('-1 hour');
    $timeFinal = $time->format('Y-m-d H:i:sa');

    foreach ($decoded as $objects) {
        foreach ($objects as $dishes) {
            for ($i = 0; $i < sizeof($dishes); $i++) {
                $id = intval($dishes['itemid']);
                $d = $dishes['dish'];
                $q = $dishes['amount'];
                $table = $dishes['table'];
            }
            $dish = $dish . $d . " x" . $q . ", ";

            $getQuantity = "SELECT quantity FROM menu WHERE id = $id";
            $result2 = $con->query($getQuantity);
            $quantity = 0;
            while ($row = $result2->fetch_assoc()) {
                $quantity = $row['quantity'];
            }
            $quantity = $quantity - $q;
            if ($quantity <= 5) {
                $available = 0;
            }
            $sql2 = "UPDATE menu SET quantity = $quantity, available = $available WHERE id = $id";
            if (mysqli_query($con, $sql2)) {
            } else {
                echo "Error: " . $sql . " " . $con->error;
            }
        }
    }
    if ($dish != '') {
        $sql = "INSERT INTO `orders` (orderid, `dish`, `tablenumber`, `quantity`, `time`) VALUES ('$orderid', '$dish', '$table', 1, '$timeFinal')";
        if (mysqli_query($con, $sql)) {
            $return = array('orderid' => $orderid);
            echo json_encode($return);
        } else {
            echo "Error: " . $sql . " " . $con->error;
        }
    }
}
$con->close();
?>