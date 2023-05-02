<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

    $con = mysqli_connect('localhost', 'root', '', 'restaurant'); //connecting
    if (!$con) {
        echo ""; //used this whilst coding to find out if its not connected
    } else {
        echo ""; //used this whilst coding to find out if it has connected
    }

    $items = "SELECT id, dish, description, price, special, available, quantity, type FROM menu";
    $result = $con->query($items);

    $menuItems = array();
    $i=0;

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
        echo "0 results";
    }
$con->close();
?>