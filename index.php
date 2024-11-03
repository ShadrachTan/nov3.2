<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developers Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to my page. I'm a freelance web developer!</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="name">Name</label> 
            <input type="text" name="name" required>
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="expertise">Expertise</label> 
            <input type="text" name="expertise" required>
        </p>
        <p>
            <label for="hourly_rate">Hourly Rate</label> 
            <input type="number" name="hourly_rate" step="0.01" required>
        </p>
        <p>
            <input type="submit" name="insertDeveloperBtn" value="Add Developer">
        </p>
    </form>

    <?php $getAllDevelopers = getAllDevelopers($pdo); ?>
    <?php foreach ($getAllDevelopers as $row) { ?>
    <div class="container" style="border-style: solid; width: 50%; height: auto; margin-top: 20px; padding: 10px;">
        <h3>Name: <?php echo htmlspecialchars($row['name']); ?></h3>
        <h3>Email: <?php echo htmlspecialchars($row['email']); ?></h3>
        <h3>Expertise: <?php echo htmlspecialchars($row['expertise']); ?></h3>
        <h3>Hourly Rate: $<?php echo number_format($row['hourly_rate'], 2); ?></h3>

        <div class="editAndDelete" style="float: right; margin-right: 20px;">
            <a href="viewprojects.php?developer_id=<?php echo $row['developer_id']; ?>">View Projects</a>
            <a href="editdeveloper.php?developer_id=<?php echo $row['developer_id']; ?>">Edit</a>
            <a href="deletedeveloper.php?developer_id=<?php echo $row['developer_id']; ?>">Delete</a>
        </div>
    </div> 
    <?php } ?>
</body>
</html>
