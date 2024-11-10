<?php

// Insert a developer
function insertDeveloper($pdo, $name, $email, $expertise, $hourly_rate)
{
    $sql = "INSERT INTO Developers (name, email, expertise, hourly_rate) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$name, $email, $expertise, $hourly_rate]);
    } catch (PDOException $e) {
        error_log("Error inserting developer: " . $e->getMessage());
        return false;
    }
}

// Update a developer's information
function updateDeveloper($pdo, $name, $email, $expertise, $hourly_rate, $developer_id)
{
    $sql = "UPDATE Developers SET name = ?, email = ?, expertise = ?, hourly_rate = ? WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$name, $email, $expertise, $hourly_rate, $developer_id]);
    } catch (PDOException $e) {
        error_log("Error updating developer: " . $e->getMessage());
        return false;
    }
}

// Delete a developer
function deleteDeveloper($pdo, $developer_id)
{
    $pdo->beginTransaction(); 
    try {
        // Delete associated projects first
        $sql = "DELETE FROM Projects WHERE developer_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$developer_id]);

        // Then delete the developer
        $sql = "DELETE FROM Developers WHERE developer_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$developer_id]);

        $pdo->commit();
        return true; 
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Error deleting developer: " . $e->getMessage());
        return false;
    }
}

// Get all developers
function getAllDevelopers($pdo)
{
    $sql = "SELECT * FROM Developers";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching developers: " . $e->getMessage());
        return [];
    }
}

// Get a specific developer by ID
function getDeveloperById($pdo, $developer_id)
{
    $stmt = $pdo->prepare("SELECT * FROM Developers WHERE developer_id = ?");
    $stmt->execute([$developer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get projects associated with a developer
function getProjectsByDeveloper($pdo, $developer_id)
{
    $sql = "SELECT * FROM Projects WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$developer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Insert a new project
function insertProject($pdo, $project_name, $technologies_used, $start_date, $end_date, $budget, $developer_id, $status)
{
    if (is_array($technologies_used)) {
        $technologies_used = implode(", ", $technologies_used);
    }

    $sql = "INSERT INTO Projects (project_name, technologies_used, start_date, end_date, budget, developer_id, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_name, $technologies_used, $start_date, $end_date, $budget, $developer_id, $status]);
    } catch (PDOException $e) {
        error_log("Error inserting project: " . $e->getMessage());
        return false;
    }
}

function updateProject($pdo, $project_name, $technologies_used, $start_date, $end_date, $budget, $developer_id, $status, $project_id)
{
    if (is_array($technologies_used)) {
        $technologies_used = implode(", ", $technologies_used);
    }

    $sql = "UPDATE Projects SET project_name = ?, technologies_used = ?, start_date = ?, end_date = ?, budget = ?, developer_id = ?, status = ? WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_name, $technologies_used, $start_date, $end_date, $budget, $developer_id, $status, $project_id]);
    } catch (PDOException $e) {
        error_log("Error updating project: " . $e->getMessage());
        return false; 
    }
}

function deleteProject($pdo, $project_id)
{
    $sql = "DELETE FROM Projects WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_id]);
    } catch (PDOException $e) {
        error_log("Error deleting project: " . $e->getMessage());
        return false;
    }
}

function getProjectById($pdo, $project_id)
{
    $sql = "SELECT * FROM Projects WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
