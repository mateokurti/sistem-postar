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
    identity_id INT,
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
    office_id INT,
    FOREIGN KEY (address_id) REFERENCES addresses(id),
    FOREIGN KEY (sender_id) REFERENCES identities(id),
    FOREIGN KEY (recipient_id) REFERENCES identities(id),
    FOREIGN KEY (holder_id) REFERENCES package_holders(id),
    FOREIGN KEY (office_id) REFERENCES offices(id)
);

CREATE TABLE IF NOT EXISTS tracking_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    delivery_id INT NOT NULL,
    holder_id int NOT NULL,
    description VARCHAR(255),
    status enum('created', 'accepted', 'picked_up', 'in_post_office', 'out_for_delivery', 'delivered'),
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    FOREIGN KEY (delivery_id) REFERENCES deliveries(id),
    FOREIGN KEY (holder_id) REFERENCES package_holders(id)
);


-- Add demo offices
INSERT INTO addresses (street, city, zip) VALUES ('Rruga Çamëria', 'Tirana', '1001');
INSERT INTO offices (name, address_id, phone) VALUES ('Zyrat Qëndrore', 1, '355662034560');
INSERT INTO package_holders (office_id, type) VALUES (1, 'office');

INSERT INTO addresses (street, city, zip) VALUES ('Rruga e Dibrës 229', 'Tirana', '1017');
INSERT INTO offices (name, address_id, phone) VALUES ('ZP Nr.3 - 1017', 2, '355662034561');
INSERT INTO package_holders (office_id, type) VALUES (2, 'office');

INSERT INTO addresses (street, city, zip) VALUES ('Rr. Skënderbeg', 'Tirana', '1002');
INSERT INTO offices (name, address_id, phone) VALUES ('ZP Nr. 26 - 1002', 3, '355662034562');
INSERT INTO package_holders (office_id, type) VALUES (3, 'office');


-- Add demo employees
INSERT INTO identities (
    first_name, last_name, email, password, phone, identity_type
) VALUES ('Arben', 'Gjoka', 'arben.gjoka@posta-fshn.al', '$2y$10$m.FfxaLGVQ5pG/KNIVWeFOSEUzbogcEHX/jqxu1V5jpUQ3DNcnIFy', '355662035001', 'employee');
INSERT INTO employees (identity_id, employee_type, office_id) VALUES (1, 'post_office', 1);

INSERT INTO identities (
    first_name, last_name, email, password, phone, identity_type
) VALUES ('Daniel', 'Gjuzi', 'daniel.gjuzi@posta-fshn.al', '$2y$10$m.FfxaLGVQ5pG/KNIVWeFOSEUzbogcEHX/jqxu1V5jpUQ3DNcnIFy', '355662035002', 'courier');
INSERT INTO package_holders (identity_id, type) VALUES (2, 'courier');
INSERT INTO employees (identity_id, employee_type, office_id) VALUES (2, 'courier', 1);


INSERT INTO identities (
    first_name, last_name, email, password, phone, identity_type
) VALUES ('Ana', 'Kola', 'ana.kola@posta-fshn.al', '$2y$10$m.FfxaLGVQ5pG/KNIVWeFOSEUzbogcEHX/jqxu1V5jpUQ3DNcnIFy', '355662035003', 'employee');

INSERT INTO employees (identity_id, employee_type, office_id) VALUES (3, 'post_office', 2);


INSERT INTO identities (
    first_name, last_name, email, password, phone, identity_type
) VALUES ('Besnik', 'Bregu', 'besnik.bregu@posta-fshn.al', '$2y$10$m.FfxaLGVQ5pG/KNIVWeFOSEUzbogcEHX/jqxu1V5jpUQ3DNcnIFy', '355662035004', 'courier');
INSERT INTO package_holders (identity_id, type) VALUES (4, 'courier');
INSERT INTO employees (identity_id, employee_type, office_id) VALUES (4, 'courier', 2);


INSERT INTO identities (
    first_name, last_name, email, password, phone, identity_type
) VALUES ('Suela', 'Abazi', 'suela.abazi@posta-fshn.al', '$2y$10$m.FfxaLGVQ5pG/KNIVWeFOSEUzbogcEHX/jqxu1V5jpUQ3DNcnIFy', '355662035005', 'employee');

INSERT INTO employees (identity_id, employee_type, office_id) VALUES (5, 'post_office', 3);


INSERT INTO identities (
    first_name, last_name, email, password, phone, identity_type
) VALUES ('Bujar', 'Laze', 'bujar.laze@posta-fshn.al', '$2y$10$m.FfxaLGVQ5pG/KNIVWeFOSEUzbogcEHX/jqxu1V5jpUQ3DNcnIFy', '355662035006', 'courier');
INSERT INTO package_holders (identity_id, type) VALUES (6, 'courier');
INSERT INTO employees (identity_id, employee_type, office_id) VALUES (6, 'courier', 3);
