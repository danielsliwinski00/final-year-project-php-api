<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$con = mysqli_connect('database-1.ctbs9a3wffrz.eu-north-1.rds.amazonaws.com:3306', 'admin', 'password', 'restaurant'); //connecting
if (!$con) {
    echo ""; //used this whilst coding to find out if its not connected
} else {
    echo ""; //used this whilst coding to find out if it has connected
}

if (isset($_POST)) {
    $getlastid = "SELECT id FROM menu ORDER BY id DESC LIMIT 1";
    $result = $con->query($getlastid);

    $dishid = 0;
    while ($row = $result->fetch_assoc()) {
        $dishid = $row['id'];
    }
    $dishid += 1;

    if (mysqli_query($con, $getlastid)) {
    } else {
        echo "error";
    }

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

    foreach ($decoded as $objs) {
        $dish = $objs['dish'];
        $price = $objs['price'];
        $description = $objs['desc'];
        $quantity = $objs['quantity'];
        $special = $objs['special'];
        $available = $objs['available'];
        $type = $objs['type'];
    }

    if ($dish != '') {
        $sql = "INSERT INTO `menu` (id, `dish`, `price`, `description`, `quantity`, `available`, `special`, `type` ) VALUES ('$dishid', '$dish', '$price', '$description', '$quantity', '$available','$special', '$type')";
        if (mysqli_query($con, $sql)) {
            echo 'success';
        } else {
            echo "Error: " . $sql . " " . $con->error;
        }
    }
}
$con->close();
?>