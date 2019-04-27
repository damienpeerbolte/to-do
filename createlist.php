<?php
    include 'connection.php';
    $listname = $_POST['listName'];
    $sql = "INSERT INTO lists (listName) VALUES ('$listname')";
    if ($db->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
