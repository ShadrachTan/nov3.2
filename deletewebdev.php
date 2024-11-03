<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Are you sure you want to delete this user?</h1>

    <?php
    // Fetch developer details by ID
    if (isset($_GET['developer_id'])) {
        $getDeveloperID = getDeveloperID($pdo, $_GET['developer_id']);
    } else {
        // Handle the case where developer_id is not set
        die("Developer ID not provided.");
    }
    ?>

    <div class="container" style="border-style: solid; height: 400px;">
        <h2>Developer ID: <?php echo htmlspecialchars($getDeveloperID['developer_id']); ?></h2>
        <h2>Name: <?php echo htmlspecialchars($getDeveloperID['name']); ?></h2>
        <h2>Email: <?php echo htmlspecialchars($getDeveloperID['email']); ?></h2>
        <h2>Expertise: <?php echo htmlspecialchars($getDeveloperID['expertise']); ?></h2>
        <h2>Hourly Rate: $<?php echo number_format($getDeveloperID['hourly_rate'], 2); ?></h2>

        <div class="deleteBtn" style="float: right; margin-right: 10px;">
            <form action="core/handleForms.php?developer_id=<?php echo htmlspecialchars($_GET['developer_id']); ?>" method="POST">
                <input type="submit" name="deleteWebDevBtn" value="Delete">
            </form>
        </div>
    </div>
</body>

</html>