<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

    $con = mysqli_connect('database-1.ctbs9a3wffrz.eu-north-1.rds.amazonaws.com:3306', 'admin', 'password', 'restaurant'); //connecting
    if (!$con) {
        echo ""; //used this whilst coding to find out if its not connected
    } else {
        echo ""; //used this whilst coding to find out if it has connected
    }

    $items = "SELECT orderid, dish, tablenumber, time FROM orders";
    $result = $con->query($items);

    $orders = array();
    $i=0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orderid = $row["orderid"];
            $dish = $row["dish"];
            $tablenumber = $row["tablenumber"];
            $time = $row["time"];

            $orders[$i]['orderid'] = $orderid;
            $orders[$i]['dish'] = $dish;
            $orders[$i]['tablenumber'] = $tablenumber;
            $orders[$i]['time'] = $time;
            
            $i++;
        }
        echo json_encode($orders);
    } else {
        echo "0 results";
    }
    $con->close();
    ?>