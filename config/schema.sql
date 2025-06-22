
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
);

CREATE TABLE IF NOT EXISTS Catalogue(
    CatalogueID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE IF NOT EXISTS Talent(

    TalentID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    CatalogueID CHAR(8),
    TalentTitle VARCHAR(255),
    TalentDescription TEXT,
    Price DECIMAL(10,2),
    Content VARCHAR(255),
    TalentLikes INT DEFAULT 0,
    Category VARCHAR(50),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (CatalogueID) REFERENCES Catalogue(CatalogueID)
);

CREATE TABLE IF NOT EXISTS Forum(
    ForumID CHAR(8) PRIMARY KEY,
    ForumName VARCHAR(50),
    ForumDescription VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS ForumMember(
    FMemberID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    ForumID CHAR(8),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (ForumID) REFERENCES Forum(ForumID)
);

CREATE TABLE IF NOT EXISTS ForumPost(
    FPostID CHAR(8) PRIMARY KEY,
    ForumID CHAR(8),
    FMemberID CHAR(8),
    FPostTitle VARCHAR(255),
    FPost TEXT,
    FPostDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    FPostLikes INT DEFAULT 0,
    FOREIGN KEY (ForumID) REFERENCES Forum(ForumID),
    FOREIGN KEY (FMemberID) REFERENCES ForumMember(FMemberID)
);

CREATE TABLE IF NOT EXISTS ForumPostComment(
    FCommentID CHAR(8) PRIMARY KEY,
    FPostID CHAR(8),
    FMemberID CHAR(8),
    FComment TEXT,
    FCommentTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (FPostID) REFERENCES ForumPost(FPostID),
    FOREIGN KEY (FMemberID) REFERENCES ForumMember(FMemberID)
);

CREATE TABLE IF NOT EXISTS Comment(
    CommentID CHAR(8) PRIMARY KEY,
    TalentID CHAR(8),
    UserID CHAR(8),
    Comment TEXT,
    CommentTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (TalentID) REFERENCES Talent(TalentID),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE IF NOT EXISTS Connection(
    ConnectionID CHAR(8) PRIMARY KEY,
    FollowerID CHAR(8) NOT NULL,
    FollowingID CHAR(8) NOT NULL,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (FollowerID) REFERENCES User(UserID),
    FOREIGN KEY (FollowingID) REFERENCES User(UserID)
);

CREATE TABLE IF NOT EXISTS Announcement(
    AnnouncementID CHAR(8) PRIMARY KEY,
    AnnouncementTitle VARCHAR(255),
    Announcement TEXT,
    AnnouncementTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Feedback(
    FeedbackID CHAR(8) PRIMARY KEY,
    UserID CHAR(8),
    Feedback TEXT,
    FeedbackStatus VARCHAR(10) DEFAULT 'Pending',
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);


CREATE TABLE IF NOT EXISTS FAQ(
    FAQID CHAR(8) PRIMARY KEY,
    Question TEXT,
    Answer TEXT
);

CREATE TABLE IF NOT EXISTS Offer (
    OfferID CHAR(8) PRIMARY KEY,
    UserID CHAR(8) NOT NULL,
    TalentID CHAR(8) NOT NULL,
    OfferDetails TEXT,
    DateCreated DATETIME DEFAULT CURRENT_TIMESTAMP,
    Status VARCHAR(10) DEFAULT 'Pending',
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (TalentID) REFERENCES Talent(TalentID)
);

CREATE TABLE IF NOT EXISTS Cart(
    CartID CHAR(8) PRIMARY KEY,
    UserID CHAR(8) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE IF NOT EXISTS CartItem (
    ItemID CHAR(8) PRIMARY KEY,
    CartID CHAR(8) NOT NULL,
    TalentID CHAR(8) NOT NULL,
    Price DECIMAL(10,2),
    Quantity INT,
    Total DECIMAL(10,2),
    FOREIGN KEY (CartID) REFERENCES Cart(CartID),
    FOREIGN KEY (TalentID) REFERENCES Talent(TalentID)
);

CREATE TABLE IF NOT EXISTS Leaderboard (
    LeaderboardID CHAR(8) PRIMARY KEY,
    TalentID CHAR(8) NOT NULL,
    Category VARCHAR(50) NOT NULL,
    FOREIGN KEY (TalentID) REFERENCES Talent(TalentID)
);
