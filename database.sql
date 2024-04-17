CREATE TABLE lenders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_date DATE,
    last_name VARCHAR(50),
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    loanable DECIMAL(16,2)
);