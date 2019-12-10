<?php
    include 'connection.php';

    $sql = "SELECT * FROM lists";
    $result = $db->query($sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>To-Do</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </head>
    <body>
        <main>
            <h1 class="title">To-Do Lists</h1>
            <a class="waves-effect waves-light btn blue addBtn modal-trigger" data-target="modal1">+</a>
            <div id="modal1" class="modal">
                <form action="createlist.php" method="post">
                <div class="modal-content">
                    <h4>Add List</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="listName" type="text" class="validate" name="listName">
                                <label for="listName">List Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="addTaskSubmit" class="modal-close waves-effect waves-green btn-flat" value="Add">
                    </div>
                </form>
            </div>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
            ?>
                        <div id="editModal<?= $row['listID'] ?>" class="modal">
                            <form action="editlist.php?listID=<?= $row['listID'] ?>" method="post">
                                <div class="modal-content">
                                    <h4>Edit List</h4>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="itemName" type="text" class="validate" name="newlistname">
                                            <label for="itemName">New List Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="addTaskSubmit" class="modal-close waves-effect waves-green btn-flat" value="Edit">
                                </div>
                            </form>
                        </div>
                        <div style="padding-bottom:5px;" id="toDoItem">
                            <h6><a href="list.php?listID=<?= $row['listID'] ?>&listName=<?= $row['listName'] ?>" id="toDoTitle"><?= $row['listName'] ?></a><a href="deletelist.php?listID=<?= $row['listID'] ?>"> <i class="fas fa-trash"> </i></a><a class="modal-trigger" href="index.php?listID=<?= $row['listID'] ?>" data-target="editModal<?= $row['listID'] ?>"> <i class="fas fa-edit"></i></a></h6>
                        </div>
                <?php
                    }
                } else {
                    echo '
                    <div id="toDoItem">
                        <p style="text-align:center;color:gray;">Add List</p>
                    </div>
                    ';
                }
            ?>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.modal').modal();
            });
        </script>
    </body>
</html>
