
CREATE TABLE IF NOT EXISTS User (
    UserID CHAR(8) PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS Profile(

    ProfileID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    Address VARCHAR(255),
    Gender CHAR(1),
    DOB DATE,
    Followers INT,
    Following INT,
    PhoneNum INT,
    ProfilePicture VARCHAR(255),
    Bio VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)

CREATE TABLE IF NOT EXISTS Catalogue(
    CatalogueID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
)

CREATE TABLE IF NOT EXISTS Talent(

    TalentID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    CatalogueID CHAR(8),
    TalentTitle VARCHAR(255),
    TalentDescription TEXT,
    Price DECIMAL(10,2),
    Content VARCHAR(255),
    TalentLikes INT,
    Category VARCHAR(50),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (CatalogueID) REFERENCES Catalogue(CatalogueID)
)
