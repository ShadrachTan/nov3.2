<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Developer Portfolio Homepage</title>
</head>

<body>
    <div class="wrapper">
        <h1>Welcome to My Developer Portfolio <br> Explore My Projects and Skills!</h1>
        <div class="container">
            <form action="core/handleForms.php" method="POST">
                <p>
                    <input type="hidden" name="developer_id" id="developer_id">
                </p>
                <p>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </p>
                <p>
                    <label for="expertise">Expertise</label>
                    <input type="text" name="expertise" id="expertise" required>
                </p>
                <p>
                    <label for="hourly_rate">Hourly Rate</label>
                    <input type="number" name="hourly_rate" id="hourly_rate" step="0.01" required>
                </p>
                <button class="btn" type="submit" name="insertDeveloperBtn">Add Developer</button>
            </form>

            <?php $getAllDevelopers = getAllDevelopers($pdo); ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Expertise</th>
                        <th>Hourly Rate</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getAllDevelopers as $row) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['expertise']); ?></td>
                            <td>$<?php echo number_format($row['hourly_rate'], 2); ?></td>
                            <td>
                                <li><a class="links" href="viewprojects.php?developer_id=<?php echo $row['developer_id']; ?>">View Projects</a></li>
                                <li><a class="links" href="editwebdev.php?developer_id=<?php echo $row['developer_id']; ?>">Edit</a></li>
                                <li><a class="links" href="deletewebdev.php?developer_id=<?php echo $row['developer_id']; ?>">Delete</a></li>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>