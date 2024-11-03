<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Developer</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<?php
	// Fetch developer details by ID
	if (isset($_GET['developer_id'])) {
		$getDeveloperID = getDeveloperID($pdo, $_GET['developer_id']);
	} else {
		// Handle the case where developer_id is not set
		die("Developer ID not provided.");
	}
	?>

	<h1>Edit Developer</h1>
	<form action="core/handleForms.php" method="POST"> <!-- Action points to handleForms.php -->
		<input type="hidden" name="developer_id" value="<?php echo $getDeveloperID['developer_id']; ?>">

		<p>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($getDeveloperID['name']); ?>" required>
		</p>
		<p>
			<label for="email">Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($getDeveloperID['email']); ?>" required>
		</p>
		<p>
			<label for="expertise">Expertise</label>
			<input type="text" name="expertise" value="<?php echo htmlspecialchars($getDeveloperID['expertise']); ?>" required>
		</p>
		<p>
			<label for="hourly_rate">Hourly Rate</label>
			<input type="number" name="hourly_rate" value="<?php echo htmlspecialchars($getDeveloperID['hourly_rate']); ?>" step="0.01" required>
		</p>
		<p>
			<input type="submit" name="editWebDevBtn" value="Update Developer">
		</p>
	</form>
</body>

</html>