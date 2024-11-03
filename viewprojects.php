<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Management</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Return to home</a>

	<?php
	if (!isset($_GET['web_dev_id']) || empty($_GET['web_dev_id'])) {
		echo "<p>Error: Web Developer ID is missing. Please provide a valid ID.</p>";
		exit; // Stop script execution
	}

	$web_dev_id = htmlspecialchars($_GET['web_dev_id']);
	$getAllInfoByWebDevID = getDeveloperByID($pdo, $web_dev_id);

	if (!$getAllInfoByWebDevID) {
		echo "<p>Error: Developer not found.</p>";
		exit; // Stop script execution if developer not found
	}
	?>

	<h1>Username: <?php echo $getAllInfoByWebDevID['name']; ?></h1>
	<h1>Add New Project</h1>
	<form action="core/handleForms.php?web_dev_id=<?php echo $web_dev_id; ?>" method="POST">
		<p>
			<input type="hidden" name="web_dev_id" value="<?php echo $web_dev_id; ?>">
		</p>
		<p>
			<label for="projectName">Project Name</label> 
			<input type="text" name="projectName" required>
		</p>
		<p>
			<label for="technologiesUsed">Technologies Used</label> 
			<input type="text" name="technologiesUsed" required>
			<input type="submit" name="insertNewProjectBtn" value="Add Project">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px;">
		<tr>
			<th>Project ID</th>
			<th>Project Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Budget</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php $getProjectsByDeveloper = getProjectsByDeveloper($pdo, $web_dev_id); ?>
		<?php foreach ($getProjectsByDeveloper as $row) { ?>
			<tr>
				<td><?php echo $row['project_id']; ?></td>
				<td><?php echo $row['project_name']; ?></td>
				<td><?php echo $row['start_date']; ?></td>
				<td><?php echo $row['end_date']; ?></td>
				<td><?php echo $row['budget']; ?></td>
				<td><?php echo $row['status']; ?></td>
				<td>
					<a href="editproject.php?project_id=<?php echo $row['project_id']; ?>&web_dev_id=<?php echo $web_dev_id; ?>">Edit</a>
					<a href="deleteproject.php?project_id=<?php echo $row['project_id']; ?>&web_dev_id=<?php echo $web_dev_id; ?>">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>

</body>
</html>
