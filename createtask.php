<?php
    include 'connection.php';
    $itemname = $_POST['itemName'];
    $listId = $_GET['listId'];
    $listName = $_GET['listName'];
    $sql = "INSERT INTO items (name, listId) VALUES ('$itemname', '$listId')";
    if ($db->query($sql) === TRUE) {
        header("location: list.php?listID=$listId&listName=$listName");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
