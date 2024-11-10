<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project</title>
</head>
<body>
    <h1>Add a New Project</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="developer_id" value="<?php echo htmlspecialchars($_GET['developer_id']); ?>">

        <label for="project_name">Project Name:</label>
        <input type="text" name="project_name" required><br>

        <label for="technologies_used">Technologies used:</label>
        <input type="text" name="technologies_used" required><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required><br>

        <label for="budget">Budget:</label>
        <input type="number" name="budget" required><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br>

        <input type="submit" name="insertNewProjectBtn" value="Add Project">
    </form>
</body>
</html>
