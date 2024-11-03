<?php

// Function to insert a new developer into the Developers table
function insertDeveloper($pdo, $name, $email, $expertise, $hourly_rate)
{
    $sql = "INSERT INTO Developers (name, email, expertise, hourly_rate) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$name, $email, $expertise, $hourly_rate]);
    } catch (PDOException $e) {
        // Log error or handle it as needed
        echo "Error inserting developer: " . $e->getMessage();
        return false; // Indicate failure
    }
}

// Function to retrieve a specific developer's details by their ID
function getDeveloperID($pdo, $developer_id)
{
    $stmt = $pdo->prepare("SELECT * FROM developers WHERE developer_id = :developer_id");
    $stmt->execute(['developer_id' => $developer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



// Function to update an existing developer's details in the Developers table
function updateDeveloper($pdo, $name, $email, $expertise, $hourly_rate, $developer_id)
{
    $sql = "UPDATE Developers SET name = ?, email = ?, expertise = ?, hourly_rate = ? WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$name, $email, $expertise, $hourly_rate, $developer_id]);
    } catch (PDOException $e) {
        // Log error or handle it as needed
        echo "Error updating developer: " . $e->getMessage();
        return false; // Indicate failure
    }
}

// Function to delete a developer and their associated projects from the database
function deleteDeveloper($pdo, $developer_id)
{
    $sql = "DELETE FROM Developers WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$developer_id]);
    } catch (PDOException $e) {
        // Log error or handle it as needed
        echo "Error deleting developer: " . $e->getMessage();
        return false; // Indicate failure
    }
}

// Function to retrieve all developers from the Developers table
function getAllDevelopers($pdo)
{
    $sql = "SELECT * FROM Developers";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching developers: " . $e->getMessage(); // Display error message
        return [];
    }
}

// Function to retrieve a specific developer's details by their ID
function getDeveloperById($pdo, $developer_id)
{
    $stmt = $pdo->prepare("SELECT * FROM developers WHERE developer_id = ?");
    $stmt->execute([$developer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to retrieve all projects associated with a specific developer
function getProjectsByDeveloper($pdo, $developer_id)
{
    $sql = "SELECT * FROM Projects WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$developer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to insert a new project into the Projects table
function insertProject($pdo, $project_name, $start_date, $end_date, $budget, $developer_id, $status = 'Pending')
{
    $sql = "INSERT INTO Projects (project_name, start_date, end_date, budget, developer_id, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_name, $start_date, $end_date, $budget, $developer_id, $status]);
    } catch (PDOException $e) {
        // Log error or handle it as needed
        echo "Error inserting project: " . $e->getMessage();
        return false; // Indicate failure
    }
}

// Function to update an existing project's details in the Projects table
function updateProject($pdo, $project_name, $start_date, $end_date, $budget, $status, $project_id)
{
    $sql = "UPDATE Projects SET project_name = ?, start_date = ?, end_date = ?, budget = ?, status = ? WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_name, $start_date, $end_date, $budget, $status, $project_id]);
    } catch (PDOException $e) {
        // Log error or handle it as needed
        echo "Error updating project: " . $e->getMessage();
        return false; // Indicate failure
    }
}

// Function to delete a specific project from the Projects table
function deleteProject($pdo, $project_id)
{
    $sql = "DELETE FROM Projects WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_id]);
    } catch (PDOException $e) {
        // Log error or handle it as needed
        echo "Error deleting project: " . $e->getMessage();
        return false; // Indicate failure
    }
}

// Function to retrieve a specific project's details by its ID
function getProjectByID($pdo, $project_id)
{
    $sql = "SELECT * FROM Projects WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
