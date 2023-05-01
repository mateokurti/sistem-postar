CREATE TABLE IF NOT EXISTS identities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    phone VARCHAR(255),
    identity_type enum('admin', 'user', 'courier', 'employee')
);

CREATE TABLE IF NOT EXISTS reset_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    code VARCHAR(6),
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    expires_at TIMESTAMP
);

CREATE TABLE IF NOT EXISTS addresses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identity_id INT NOT NULL,
    street VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    FOREIGN KEY (identity_id) REFERENCES identities(id)
);

CREATE TABLE IF NOT EXISTS identities_addresses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identity_id INT NOT NULL,
    address_id INT NOT NULL,
    FOREIGN KEY (identity_id) REFERENCES identities(id),
    FOREIGN KEY (address_id) REFERENCES addresses(id)
);

CREATE TABLE IF NOT EXISTS offices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    address_id INT NOT NULL,
    phone VARCHAR(15),
    FOREIGN KEY (address_id) REFERENCES addresses(id)
);

CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identity_id INT NOT NULL,
    employee_type enum('courier', 'post_office'),
    office_id INT,
    FOREIGN KEY (identity_id) REFERENCES identities(id),
    FOREIGN KEY (office_id) REFERENCES offices(id)
);

CREATE TABLE IF NOT EXISTS package_holders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identity_id INT,
    office_id INT,
    type enum('user', 'courier', 'office'),
    FOREIGN KEY (identity_id) REFERENCES identities(id),
    FOREIGN KEY (office_id) REFERENCES offices(id),
    CHECK (identity_id IS NOT NULL OR office_id IS NOT NULL),
    CHECK (identity_id IS NULL OR office_id IS NULL)
);

CREATE TABLE IF NOT EXISTS deliveries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    recipient_id INT NOT NULL,
    holder_id INT NOT NULL,
    tracking_number VARCHAR(10),
    notes VARCHAR(255),
    address_id INT NOT NULL,
    FOREIGN KEY (address_id) REFERENCES addresses(id),
    FOREIGN KEY (sender_id) REFERENCES identities(id),
    FOREIGN KEY (recipient_id) REFERENCES identities(id),
    FOREIGN KEY (holder_id) REFERENCES package_holders(id)
);

CREATE TABLE IF NOT EXISTS tracking_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    delivery_id INT NOT NULL,
    holder_id int NOT NULL,
    description VARCHAR(255),
    status enum('created', 'picked_up', 'in_transit', 'in_post_office', 'delivered', 'returned', 'cancelled', 'lost'),
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    FOREIGN KEY (delivery_id) REFERENCES deliveries(id),
    FOREIGN KEY (holder_id) REFERENCES package_holders(id)
);