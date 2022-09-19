CREATE TABLE activities(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username TEXT NOT NULL,
    ActivityTitle TEXT NOT NULL,
    ActivityCategory TEXT NOT NULL,
    ActivityStartTime DATE,
    ActivityDueTime DATE,
    ActivityImage TEXT NOT NULL,
    ActivityNote TEXT NOT NULL,
    isArchived VARCHAR(100) NOT NULL,
    isStarred VARCHAR(100) NOT NULL,
    inTrash VARCHAR(100) NOT NULL,
    isComplete VARCHAR(100) NOT NULL,
    isDue VARCHAR(100) NOT NULL
);

CREATE TABLE user_info(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname TEXT NOT NULL,
    username TEXT NOT NULL,
    email TEXT NOT NULL,
    user_password TEXT NOT NULL
);

CREATE TABLE subscribed_emails(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    timeSubscribed DATETIME DEFAULT CURRENT_TIMESTAMP,
    emailSubscribed TEXT NOT NULL
);