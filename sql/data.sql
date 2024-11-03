CREATE TABLE Developers (
    developer_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    expertise VARCHAR(50),
    hourly_rate DECIMAL(10, 2)
);

CREATE TABLE Projects (
    project_id INT PRIMARY KEY AUTO_INCREMENT,
    developer_id INT NOT NULL,
    project_name VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(10, 2),
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (developer_id) REFERENCES Developers(developer_id) ON DELETE CASCADE
);
