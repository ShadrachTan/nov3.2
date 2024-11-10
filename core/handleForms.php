<?php
require_once 'dbConfig.php';
require_once 'models.php';

// Handle Developer Insertion
if (isset($_POST['insertDeveloperBtn'])) {
    if (isset($_POST['name'], $_POST['email'], $_POST['expertise'], $_POST['hourly_rate'])) {
        $query = insertDeveloper(
            $pdo,
            $_POST['name'],
            $_POST['email'],
            $_POST['expertise'],
            $_POST['hourly_rate']
        );

        if ($query) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Developer Insertion Failed";
        }
    } else {
        echo "All developer fields are required.";
    }
}

// Handle Developer Update
if (isset($_POST['editWebDevBtn'])) {
    if (isset($_POST['name'], $_POST['email'], $_POST['expertise'], $_POST['hourly_rate'], $_POST['developer_id'])) {
        $query = updateDeveloper(
            $pdo,
            $_POST['name'],
            $_POST['email'],
            $_POST['expertise'],
            $_POST['hourly_rate'],
            $_POST['developer_id']
        );

        if ($query) {
            echo "Update successful.<br><br> <a href='../index.php'>Return Home</a>";
            exit;
        } else {
            echo "Update failed.";
        }
    } else {
        echo "Missing data.";
    }
}

// Handle Developer Deletion
if (isset($_POST['deleteWebDevBtn'])) {
    if (isset($_POST['developer_id'])) {
        $query = deleteDeveloper($pdo, $_POST['developer_id']);

        if ($query) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Developer Deletion Failed.";
        }
    } else {
        echo "Developer ID is required for deletion.";
    }
}

// Handle Project Insertion
if (isset($_POST['insertNewProjectBtn'])) {
    if (isset($_POST['developer_id'], $_POST['project_name'], $_POST['technologies_used'], $_POST['start_date'], $_POST['budget'], $_POST['status'])) {
        // Ensure end_date is passed, or set it to NULL if not present
        $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : NULL;

        $query = insertProject(
            $pdo,
            $_POST['developer_id'],
            $_POST['project_name'],
            $_POST['technologies_used'],
            $_POST['start_date'],
            $end_date,
            $_POST['budget'],
            $_POST['status']
        );

        if ($query) {
            header("Location: ./viewprojects.php?developer_id=" . $_POST['developer_id']);
            exit;
        } else {
            echo "Project Insertion Failed.";
        }
    } else {
        echo "All project fields are required.";
    }
}

// Handle Project Update
if (isset($_POST['editProjectBtn'])) {
    if (isset($_POST['project_name'], $_POST['technologies_used'], $_POST['start_date'], $_POST['budget'], $_POST['status'], $_POST['project_id'], $_POST['developer_id'])) {
        // Ensure end_date is passed, or set it to NULL if not present
        $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : NULL;

        $query = updateProject(
            $pdo,
            $_POST['project_name'],
            $_POST['technologies_used'],
            $_POST['start_date'],
            $end_date,
            $_POST['budget'],
            $_POST['status'],
            $_POST['project_id']
        );

        if ($query) {
            header("Location: ../viewprojects.php?developer_id=" . $_POST['developer_id']);
            exit;
        } else {
            echo "Project Update Failed.";
        }
    } else {
        echo "Missing data for project update.";
    }
}

// Handle Project Deletion
if (isset($_POST['deleteProjectBtn'])) {
    if (isset($_POST['project_id'], $_POST['developer_id'])) {
        $query = deleteProject($pdo, $_POST['project_id']);

        if ($query) {
            header("Location: ../viewprojects.php?developer_id=" . $_POST['developer_id']);
            exit;
        } else {
            echo "Project Deletion Failed.";
        }
    } else {
        echo "Project ID is required for deletion.";
    }
}
?>
