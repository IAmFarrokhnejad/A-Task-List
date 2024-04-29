<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (isset($_POST['search']))
{
    $search = $_POST["search"];

    $_SESSION["search"] = " WHERE title LIKE '%$search%' or priority LIKE '%$search%' or status LIKE '%$search%' or due_date LIKE '%$search%' or description LIKE '%$search%'";
    $_SESSION["sort"] = $_POST["sort"];

    header("location:main.php");
}

?>
