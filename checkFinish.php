<?php
    include 'connection.php';

    $id = $_GET['id'];
    $finishedTask = $_GET['finishedTask'];

    if($finishedTask == 0) {
        $sql = "UPDATE items SET finishedTask='1' WHERE id='$id'";
    } else {
        $sql = "UPDATE items SET finishedTask='0' WHERE id='$id'";
    }

    if ($db->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
