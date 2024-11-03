<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

// Insert Developer
if (isset($_POST['insertDeveloperBtn'])) {
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
}

// Edit Developer
if (isset($_POST['editDeveloperBtn'])) {
    $query = updateDeveloper(
        $pdo, 
        $_POST['name'], 
        $_POST['email'], 
        $_POST['expertise'], 
        $_POST['hourly_rate'], 
        $_GET['developer_id']
    );

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Edit failed";
    }
}

// Delete Developer
if (isset($_POST['deleteDeveloperBtn'])) {
    $query = deleteDeveloper($pdo, $_GET['developer_id']);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Deletion failed";
    }
}

// Insert New Project
if (isset($_POST['insertNewProjectBtn'])) {
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
}

// Edit Project
if (isset($_POST['editProjectBtn'])) {
    $query = updateProject(
        $pdo, 
        $_POST['project_name'], 
        $_POST['start_date'], 
        $_POST['end_date'], 
        $_POST['budget'], 
        $_GET['project_id']
    );

    if ($query) {
        header("Location: ../viewprojects.php?developer_id=" . $_GET['developer_id']);
        exit;
    } else {
        echo "Update failed";
    }
}

// Delete Project
if (isset($_POST['deleteProjectBtn'])) {
    $query = deleteProject($pdo, $_GET['project_id']);

    if ($query) {
        header("Location: ../viewprojects.php?developer_id=" . $_GET['developer_id']);
        exit;
    } else {
        echo "Deletion failed";
    }
}

?>
