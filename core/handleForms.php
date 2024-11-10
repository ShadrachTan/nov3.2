<?php

require_once 'dbConfig.php';
require_once 'models.php';

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
            echo "Insertion failed";
        }
    } else {
        echo "All developer fields are required.";
    }
}

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
            echo "Update successfuly.<br><br> <a href='../index.php'>Return Home</a>";
            exit;
        } else {
            echo "Update failed";
        }
    } else {
        echo "Missing data.";
    }
}

if (isset($_POST['deleteWebDevBtn'])) {
    if (isset($_GET['developer_id'])) {
        $query = deleteDeveloper($pdo, $_GET['developer_id']);

        if ($query) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Deletion failed";
        }
    } else {
        echo "Developer ID is required for deletion.";
    }
}

if (isset($_POST['insertNewProjectBtn'])) {
    if (isset($_POST['project_name'], $_POST['start_date'], $_POST['end_date'], $_POST['budget'], $_GET['developer_id'])) {
        $query = insertProject(
            $pdo,
            $_POST['project_name'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['budget'],
            $_GET['developer_id']
        );

        if ($query) {
            header("Location: ../viewprojects.php?developer_id=" . $_GET['developer_id']);
            exit;
        } else {
            echo "Insertion failed";
        }
    } else {
        echo "All project fields and Developer ID are required.";
    }
}

if (isset($_POST['editProjectBtn'])) {
    if (isset($_POST['project_name'], $_POST['start_date'], $_POST['end_date'], $_POST['budget'], $_GET['project_id'])) {
        $query = updateProject(
            $pdo,
            $_POST['project_name'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['budget'],
            $_GET['project_id'],
            $project_id
        );

        if ($query) {
            header("Location: ../viewprojects.php?developer_id=" . $_GET['developer_id']);
            exit;
        } else {
            echo "Update failed";
        }
    } else {
        echo "All project fields and Project ID are required.";
    }
}

if (isset($_POST['deleteProjectBtn'])) {
    if (isset($_GET['project_id'], $_GET['developer_id'])) {
        $query = deleteProject($pdo, $_GET['project_id']);

        if ($query) {
            header("Location: ../viewprojects.php?developer_id=" . $_GET['developer_id']);
            exit;
        } else {
            echo "Deletion failed";
        }
    } else {
        echo "Project ID and Developer ID are required for deletion.";
    }
}
