<?php

function insertDeveloper($pdo, $name, $email, $expertise, $hourly_rate)
{
    $sql = "INSERT INTO Developers (name, email, expertise, hourly_rate) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$name, $email, $expertise, $hourly_rate]);
    } catch (PDOException $e) {

        echo "Error inserting developer: " . $e->getMessage();
        return false;
    }
}

function getDeveloperID($pdo, $developer_id)
{
    $stmt = $pdo->prepare("SELECT * FROM developers WHERE developer_id = :developer_id");
    $stmt->execute(['developer_id' => $developer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



function updateDeveloper($pdo, $name, $email, $expertise, $hourly_rate, $developer_id)
{
    $sql = "UPDATE Developers SET name = ?, email = ?, expertise = ?, hourly_rate = ? WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$name, $email, $expertise, $hourly_rate, $developer_id]);
    } catch (PDOException $e) {
        echo "Error updating developer: " . $e->getMessage();
        return false; 
    }
}

function deleteDeveloper($pdo, $developer_id)
{
    $pdo->beginTransaction(); 
    try {

        $sql = "DELETE FROM Projects WHERE developer_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$developer_id]);


        $sql = "DELETE FROM Developers WHERE developer_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$developer_id]);

        $pdo->commit();
        return true; 
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error deleting developer: " . $e->getMessage();
        return false; 
    }
}

function getAllDevelopers($pdo)
{
    $sql = "SELECT * FROM Developers";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching developers: " . $e->getMessage();
        return [];
    }
}

function getDeveloperById($pdo, $developer_id)
{
    $stmt = $pdo->prepare("SELECT * FROM developers WHERE developer_id = ?");
    $stmt->execute([$developer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProjectsByDeveloper($pdo, $developer_id)
{
    $sql = "SELECT * FROM Projects WHERE developer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$developer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertProject($pdo, $project_name, $start_date, $end_date, $budget, $developer_id, $status = 'Pending')
{
    $sql = "INSERT INTO Projects (project_name, start_date, end_date, budget, developer_id, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_name, $start_date, $end_date, $budget, $developer_id, $status]);
    } catch (PDOException $e) {
        echo "Error inserting project: " . $e->getMessage();
        return false;
    }
}

function updateProject($pdo, $project_name, $start_date, $end_date, $budget, $status, $project_id)
{
    $sql = "UPDATE Projects SET project_name = ?, start_date = ?, end_date = ?, budget = ?, status = ? WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        return $stmt->execute([$project_name, $start_date, $end_date, $budget, $status, $project_id]);
    } catch (PDOException $e) {
        echo "Error updating project: " . $e->getMessage();
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
        echo "Error deleting project: " . $e->getMessage();
        return false;
    }
}

function getProjectByID($pdo, $project_id)
{
    $sql = "SELECT * FROM Projects WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
