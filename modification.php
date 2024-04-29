<?php

if(isset($_POST['delete']))
{
    $id= filter_input(INPUT_POST, "delete", FILTER_SANITIZE_STRING);

$cnn = mysqli_connect("localhost", "Me", "1234", "ITEC327ToDoList");


$query = "delete from tasks 
where id=?";


$stmt = mysqli_prepare($cnn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

header("location:main.php");

}
else if(isset($_POST['saveEdit']))
{
    $id= filter_input(INPUT_POST, "saveEdit", FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, "title$id", FILTER_SANITIZE_STRING);
    $priority = filter_input(INPUT_POST, "priority$id", );
    $status = filter_input(INPUT_POST, "status$id");
    $description = filter_input(INPUT_POST, "description$id");
    $due_date = filter_input(INPUT_POST, "dueDate$id");
$cnn = mysqli_connect("localhost", "Me", "1234", "ITEC327ToDoList");


$query = "update tasks 
set title=?, description=?, due_date=?, priority=?, status=?
where id=?";



$stmt = mysqli_prepare($cnn, $query);
mysqli_stmt_bind_param($stmt, "sssssi", $title, $description, $due_date, $priority, $status,$id);

mysqli_stmt_execute($stmt);


header("location:main.php");

}

?>