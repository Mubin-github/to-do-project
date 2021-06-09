<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}

	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];
	
		mysqli_query($db, "DELETE FROM tasks WHERE Id=".$id);
		header('location: index.php');
	 }
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body class = "container">

	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Application PHP and MySQL database</h2>
	</div>
	<form method="post" action="index.php">
	
	
	<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
	<?php } ?>
		
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>

	</form>

	<table>
	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete">
				<a href="index.php?del_task=<?php echo $row['Id'] ?>"><button type="button"class="btn btn-danger" data-toggle="modal">DELETE</button></a>
				</td>
				<td class="edit">
				<!-- <a href="index.php?edit_task="> -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Edit</button>
				<!-- </a> -->
				<!-- href="index.php?edit_task=<?php echo $row['Id'] ?>" -->
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit to do list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>