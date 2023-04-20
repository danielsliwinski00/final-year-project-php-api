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
    $decoded = json_decode($data, true);

    $id = 0;
    $dish = '';
    $price = 0;
    $description = '';
    $quantity = 0;
    $special = 0;
    $available = 0;
    //$time = date('Y-m-d H:i:sa');

    foreach($decoded as $objs){
        $id = $objs['id'];
        $dish = $objs['dish'];
        $price = $objs['price'];
        $description = $objs['desc'];
        $quantity = $objs['quantity'];
        $special = $objs['special'];
        $available = $objs['available'];
    }

    /*
    $id = intval($id);
    echo $id." ".$dish." ".$price." ".$description." ".$quantity." ".$special." ".$available;          
    foreach ($decoded as $objects) {
    for ($i = 0; $i < $objects; $i++) {
    $id = $dishes['id'];
    $dish = $dishes['dish'];
    $price = $dishes['price'];
    $description = $dishes['description'];
    $quantity = $dishes['quantity'];
    $special = $dishes['special'];
    $available = $dishes['available'];
    }
    
    }*/
    if ($dish != '') {
        $sql = "UPDATE menu SET dish = '$dish', price = $price, description = '$description', quantity = $quantity, special = $special, available = $available WHERE id = $id";
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