
CREATE TABLE IF NOT EXISTS users (
    UserID CHAR(8) PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role VARCHAR(10) NOT NULL
);

-- You can also insert sample data if needed
-- INSERT INTO users (name, email) VALUES ('Alice', 'alice@example.com');
