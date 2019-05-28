<?php
    include 'connection.php';
    $listID = $_GET['listID'];
    $listName = $_GET['listName'];
    $sql = "SELECT * FROM items WHERE listID='$listID'";
    $result = $db->query($sql);

    if(isset($_POST['checkFinish'])) {
        header("Location: connection.php");
    }
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
            <a style="position:absolute;" href="index.php"><i class="fas fa-chevron-left fa-2x"></i></a>
            <h1 class="title"><?php echo $listName ?></h1>
            <a class="waves-effect waves-light btn blue addBtn modal-trigger" data-target="modal1">+</a>
            <div id="modal1" class="modal">
                <form action="createtask.php?listId=<?php echo $listID . '&listName=' . $listName ?>" method="post">
                <div class="modal-content">
                    <h4>Add Task</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="itemName" type="text" class="validate" name="itemName">
                                <label for="itemName">Item Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="addTaskSubmit" class="modal-close waves-effect waves-green btn-flat" value="Toevoegen">
                    </div>
                </form>
            </div>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div id="editModal' . $row['id'] . '" class="modal">
                            <form action="edititem.php?id=' . $row['id'] . '&listID=' . $listID . '&listName=' . $listName . '" method="post">
                            <div class="modal-content">
                                <h4>Edit Task</h4>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="itemName" type="text" class="validate" name="newitemname">
                                            <label for="itemName">Item Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="addTaskSubmit" class="modal-close waves-effect waves-green btn-flat" value="Edit">
                                </div>
                            </form>
                        </div>
                        ';
                        if($row['finishedTask'] == 0) {
                            echo '
                            <div id="toDoItem">
                                <p>
                                    <label>
                                        <input type="checkbox" onchange=window.location.href=`checkFinish.php?id=' . $row['id'] . "&finishedTask=" . $row['finishedTask'] . '` name="finishCheck" />
                                        <span id="toDoTitle">' . $row['name'] . '<a href="deletetask.php?id='.$row['id'].'"> <i class="fas fa-trash"> </i></a><a class="modal-trigger" href="index.php?id=' . $row['id'] . '" data-target="editModal' . $row['id'] . '"> <i class="fas fa-edit"></i></a></span>
                                    </label>
                                </p>
                            </div>';
                        } elseif ($row['finishedTask'] == 1) {
                            echo '
                            <div id="toDoItem">
                                <p>
                                    <label>
                                        <input type="checkbox" onchange=window.location.href=`checkFinish.php?id=' . $row['id'] . "&finishedTask=" . $row['finishedTask'] . '` name="finishCheck" checked />
                                        <span style="text-decoration:line-through;" id="toDoTitle">' . $row['name'] . '<a href="deletetask.php?id='.$row['id'].'"> <i class="fas fa-trash"> </i></a><a class="modal-trigger" href="index.php?id=' . $row['id'] . '" data-target="editModal"> <i class="fas fa-edit"></i></a></span>
                                    <label>
                                </p>
                            </div>';
                        } else {
                            echo 'An unknown error has occured!';
                        }

                        // echo '
                        // <script>
                        // function checkItem() {
                        //     window.location = "checkFinish.php?id=' . $row['id'] . '&finishedTask=' . $row['finishedTask'] . '";
                        // }
                        // </script>
                        // ';
                    }
                } else {
                    echo '
                    <div id="toDoItem">
                        <p style="text-align:center;color:gray;">Add Tasks</p>
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
