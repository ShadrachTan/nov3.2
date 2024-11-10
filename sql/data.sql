CREATE TABLE Developers (
    developer_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    expertise VARCHAR(50),
    hourly_rate DECIMAL(10, 2)
);

CREATE TABLE Projects (
    project_id INT PRIMARY KEY AUTO_INCREMENT,
    project_name VARCHAR(100) NOT NULL,
    technologies_used VARCHAR(550),
    start_date DATE,
    end_date DATE,
    budget DECIMAL(10, 2),
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    developer_id INT,
    FOREIGN KEY (developer_id) REFERENCES Developers(developer_id) ON DELETE CASCADE
);
