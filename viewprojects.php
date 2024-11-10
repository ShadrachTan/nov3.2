<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

$developer_id = isset($_GET['developer_id']) ? $_GET['developer_id'] : null;

$developer = getDeveloperById($pdo, $developer_id);
?>

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

    <?php if ($developer): ?>
        <h1>Welcome, <?php echo htmlspecialchars($developer['name']); ?></h1>
    <?php else: ?>
        <h1>Developer not found</h1>
    <?php endif; ?>

    <h2>Add New Project</h2>
    <form action="core/handleForms.php?developer_id=<?php echo $developer_id; ?>" method="POST">
        <input type="hidden" name="developer_id" value="<?php echo $developer_id; ?>">

        <p>
            <label for="project_name">Project Name</label>
            <input type="text" name="project_name" id="project_name" required>
        </p>
        <p>
            <label for="technologies_used">Technologies Used</label>
            <input type="text" name="technologies_used" id="technologies_used" required>
        </p>
        <p>
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" required>
        </p>
        <p>
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" required>>
        </p>
        <p>
            <label for="budget">Budget</label>
            <input type="number" name="budget" id="budget" step="0.01" required>
        </p>
        <p>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </p>
        <p>
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
        <?php $getProjectsByDeveloper = getProjectsByDeveloper($pdo, $developer_id); ?>
        <?php foreach ($getProjectsByDeveloper as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['project_id']); ?></td>
                <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                <td>$<?php echo number_format($row['budget'], 2); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <a href="editproject.php?project_id=<?php echo $row['project_id']; ?>&developer_id=<?php echo $developer_id; ?>">Edit</a>
                    <a href="deleteproject.php?project_id=<?php echo $row['project_id']; ?>&developer_id=<?php echo $developer_id; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
