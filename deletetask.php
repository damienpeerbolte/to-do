<?php
    include 'connection.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM items WHERE id='$id'";
    if ($db->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
