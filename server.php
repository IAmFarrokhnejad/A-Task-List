<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$priority = filter_input(INPUT_POST, "p", );
$status = filter_input(INPUT_POST, "s");
$description = filter_input(INPUT_POST, "desc");
$due_date = filter_input(INPUT_POST, "d");

$cnn = mysqli_connect("localhost", "Me", "1234", "ITEC327ToDoList");

$query = "insert into tasks(title, description, due_date, priority, status)
          values(?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($cnn, $query);
mysqli_stmt_bind_param($stmt, "sssss", $title, $description, $due_date, $priority, $status);

mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($cnn) >0) 
{
    echo "Task added succesfully.";
}
else 
{
    echo "Task addition failed.";
}

header("Refresh:4 URL=main.php");

?>