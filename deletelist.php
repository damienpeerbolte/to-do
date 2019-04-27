<?php
    include 'connection.php';
    $id = $_GET['listID'];
    $sql = "DELETE FROM lists WHERE listID='$id'";
    if ($db->query($sql) === TRUE) {
        $sql = "DELETE FROM items WHERE listId='$id'";
        if ($db->query($sql) === TRUE) {
            header("location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
