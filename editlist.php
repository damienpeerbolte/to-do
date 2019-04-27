<?php
    include 'connection.php';
    $listID = $_GET['listID'];
    $newListName = $_POST['newlistname'];
    $sql = "UPDATE lists SET listName='$newListName' WHERE listID='$listID'";
    if ($db->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>
