<?php
    include 'connection.php';
    $itemname = $_POST['itemName'];
    $sql = "INSERT INTO items (name) VALUES ('$itemname')";
    if ($db->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
