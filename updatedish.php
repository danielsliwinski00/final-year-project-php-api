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
    $decoded = json_decode($data, true);

    $id = 0;
    $dish = '';
    $price = 0;
    $description = '';
    $quantity = 0;
    $special = 0;
    $available = 0;
    $type = 0;

    foreach($decoded as $objs){
        $id = $objs['id'];
        $dish = $objs['dish'];
        $price = $objs['price'];
        $description = $objs['desc'];
        $quantity = $objs['quantity'];
        $special = $objs['special'];
        $available = $objs['available'];
        $type = $objs['type'];
    }

    if ($dish != '') {
        $sql = "UPDATE menu SET dish = '$dish', price = $price, description = '$description', quantity = $quantity, special = $special, available = $available, type = $type WHERE id = $id";
        if (mysqli_query($con, $sql)) {
            echo 'success';
        } else {
            file_put_contents('result.txt', "Error: " . $sql . " " . $con->error );
            echo "Error: " . $sql . " " . $con->error;
        }
    }
}
$con->close();
?>