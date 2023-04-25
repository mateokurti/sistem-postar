CREATE TABLE IF NOT EXISTS account_types (
    id INT PRIMARY KEY,
    name VARCHAR(255)
);

INSERT INTO account_types (id, name) VALUES (1, 'User');
INSERT INTO account_types (id, name) VALUES (2, 'Courier');
INSERT INTO account_types (id, name) VALUES (3, 'Post Office');

CREATE TABLE IF NOT EXISTS identities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    phone VARCHAR(255),
    account_type INT,
    FOREIGN KEY (account_type) REFERENCES account_types(id)
);

CREATE TABLE IF NOT EXISTS reset_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    code VARCHAR(6),
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    expires_at TIMESTAMP
);

CREATE TABLE IF NOT EXISTS delieveries ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_name VARCHAR(255),
    city VARCHAR(255),
    address VARCHAR(255),
    zip VARCHAR(255),
    phone VARCHAR(255),
    notes VARCHAR(255),
    status VARCHAR(255),
    responsible_identity INT,
    FOREIGN KEY (responsible_identity) REFERENCES identities(id)
);
