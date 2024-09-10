<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Task List 2021</title>
	<script src="JS/behaviour.js"></script>
	<link rel="stylesheet" href="CSS/style.css" />
</head>

<body>

	<header>
		<h1>My to-do list 2023!</h1>
		<form id="new-task-form" action="create.php" method="POST">
			<input type="text" name="title" id="title" placeholder="What do you have planned?" />
			<label for="p">Priority</label>
			<select name="p" id="p">
				<option value="1">High</option>
				<option value="2">Medium</option>
				<option value="3">Low</option>
			</select>
			<label for="p">Status</label>
			<select name="s" id="s">
				<option value="1">Completed</option>
				<option value="2">In Progress</option>
				<option value="3">Not Started</option>
			</select>
			<label for="d">Due</label>
			<input type="date" name="d" id="d">
			<input type="text" name="desc" id="desc" placeholder="Give more details" />
			<input type="submit" id="new-task-submit" value="Add task" />

		</form>
	</header>
	<main>
		<section class="task-list">
		<form id="searchandsortform" action="searchandsort.php" method="POST"> 
		<input type="text" name="search" id="search" placeholder="Search..." /> 
			<select name="sort" id="sort">
				<option value="1">Sort by date low to high</option>
				<option value="2">Sort by priority low to high</option>
				<option value="3">Sort by date high to low</option>
				<option value="4">Sort by priority high to low</option>
			</select>
			</form><br>
		<h2>Tasks</h2>
			<div id="tasks">
				<form id="modification" method="POST" action='modification.php'>
				<?php
				if (session_status() !== PHP_SESSION_ACTIVE) session_start();
				$cnn = mysqli_connect("localhost", "Me", "1234", "ITEC327ToDoList"); 
				
				
				$query = "SELECT * FROM tasks";

				if (isset($_SESSION["search"]))
				{
					$query.= $_SESSION["search"];
				}

				if (isset($_SESSION["sort"]))
				{
					if ($_SESSION["sort"] == 1) {
						$query .= " ORDER BY due_date asc";
					} else if ($_SESSION["sort"] == 2) {
						$query .= " ORDER BY priority asc";
					} else if ($_SESSION["sort"] == 3) {
						$query .= " ORDER BY due_date desc";
					} else if ($_SESSION["sort"] == 4) {
						$query .= " ORDER BY priority desc";
					}
				}

			
				
				$result = mysqli_query($cnn, $query);
				
				if ($result) 
				{
					while ($row = mysqli_fetch_assoc($result)) {
						$id = $row["id"];
						$task = $row["title"];
						$priority = $row["priority"];
						$priorityAdd = ["low", "medium", "high"];
						if (($key = array_search($priority, $priorityAdd)) !== false) 
						{
							unset($priorityAdd[$key]);
						}
						$priorityAdd = array_values($priorityAdd);
						$status = $row["status"];
						$statusAdd = ["complete", "in_progress", "incomplete"];
						if (($key = array_search($status, $statusAdd)) !== false) 
						{
							unset($statusAdd[$key]);
						}
						$statusAdd = array_values($statusAdd);
						$duedate = $row["due_date"];
						$description = $row["description"];
				
					
						echo '<div class="task">';
						echo "<h3 class='title'>$task</h3>";
						echo '<div class="content">';
						
				
						echo '<div class="details" >';
						echo '<input name="title'.$id.'" class="text" type="text" value="' . htmlspecialchars($task) . '" disabled="true"/>';
						echo '<input name="description'.$id.'" class="text" type="text" value="' . htmlspecialchars($description) . '" disabled="true"/>';
						echo '<input name="priorityText" class="text" type="text" value="' . htmlspecialchars($priority) . '" disabled="true"/>';
						echo '<select name="priority'.$id.'" class="text" disabled="true" style="display:none;"/>';
						echo '<option value="' . htmlspecialchars($priority) . '">'.htmlspecialchars($priority);
						echo '<option value="' . $priorityAdd[0] . '">'.$priorityAdd[0];
						echo '<option value="' . $priorityAdd[1] . '">'.$priorityAdd[1];
						echo '</select>'; 
						echo '<input name="statusText" class="text" type="text" value="' . htmlspecialchars($status) . '" disabled="true"/>';
						echo '<select name="status'.$id.'" class="text" disabled="true"/ style="display:none;">';
						echo '<option value="' . htmlspecialchars($status) . '">'.htmlspecialchars($status);
						echo '<option value="' . $statusAdd[0] . '">'.$statusAdd[0];
						echo '<option value="' . $statusAdd[1] . '">'.$statusAdd[1];
						echo '</select>'; 
						echo '<input name="dueDate'.$id.'" class="text" type="date" value="' . htmlspecialchars($duedate) . '" disabled="true"/>';
						echo '</div>';
				
						echo '<div class="actions">';
						echo '<button type="button" class="show">Show</button>';
						echo "<button class='edit' value='$id' name='saveEdit' style='display:none'>Save</button>";
						echo "<button type='button' class='edit' value='$id' name='edit'>Edit</button>";
						echo "<button class='delete' value='$id' name='delete'>Delete</button>";
						echo '</div>';
				
						echo '</div>';
						echo '</div>';
					} 
				} 
				else 
				{
					echo "Error executing query: " . mysqli_error($cnn);
				}
				
				mysqli_close($cnn);
//Author: Morteza Farrokhnejad
				?>
				</form>

			</div>

		</section>
	</main>
	
</body>
</html>
