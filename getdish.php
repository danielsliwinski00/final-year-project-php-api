<?php
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'OPTIONS'){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
        header('HTTP/1.1 200 OK');
        die();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

$con = mysqli_connect('database-1.ctbs9a3wffrz.eu-north-1.rds.amazonaws.com:3306', 'admin', 'password', 'restaurant'); //connecting
if (!$con) {
    echo ""; //used this whilst coding to find out if its not connected
} else {
    echo ""; //used this whilst coding to find out if it has connected
}

if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $encoded = json_encode($data, true);
    $decoded = json_decode($data, true);
    foreach ($decoded as $objects) {
        $dishID = $objects;
    }

    $sql = "SELECT id, dish, description, price, special, available, quantity, type FROM menu WHERE id = $dishID";

    if (mysqli_query($con, $sql)) {
        $result = $con->query($sql);
        $menuItems = array();
        $i = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $itemid = $row["id"];
                $dish = $row["dish"];
                $price = $row["price"];
                $desc = $row['description'];
                $special = $row['special'];
                $available = $row['available'];
                $quantity = $row['quantity'];
                $type = $row['type'];

                $menuItems[$i]['id'] = $itemid;
                $menuItems[$i]['dish'] = $dish;
                $menuItems[$i]['price'] = $price;
                $menuItems[$i]['desc'] = $desc;
                $menuItems[$i]['special'] = $special;
                $menuItems[$i]['available'] = $available;
                $menuItems[$i]['quantity'] = $quantity;
                $menuItems[$i]['type'] = $type;

                $i++;
            }
            echo json_encode($menuItems);
        } else {
            echo "Error: " . $sql . " " . $con->error;
        }
    }
}
$con->close();
?>