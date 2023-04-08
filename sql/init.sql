CREATE TABLE IF NOT EXISTS identities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  email VARCHAR(100),
  password VARCHAR(100),
  phone VARCHAR(15)
);
