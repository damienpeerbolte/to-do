<?php
    include 'connection.php';
    $id = $_GET['id'];
    $listId = $_GET['listID'];
    $listName = $_GET['listName'];
    $newItemName = $_POST['newitemname'];
    $sql = "UPDATE items SET name='$newItemName' WHERE id='$id'";
    if ($db->query($sql) === TRUE) {
        header("location: list.php?listID=$listId&listName=$listName");

    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
