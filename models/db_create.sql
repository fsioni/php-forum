CREATE DATABASE IF NOT EXISTS the_forum;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS the_forum.Users;
DROP TABLE IF EXISTS the_forum.Posts;
DROP TABLE IF EXISTS the_forum.Comments;
DROP TABLE IF EXISTS the_forum.CommentsVotes;
DROP TABLE IF EXISTS the_forum.PostsVotes;
DROP TABLE IF EXISTS the_forum.Tags;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE the_forum.Users
(
    id             INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pseudo         VARCHAR(100),
    email          VARCHAR(255),
    password       TEXT,
    lastSeen       VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS the_forum.Posts
(
    id        INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    author_id INT,
    title     TEXT,
    content   TEXT,
    status    VARCHAR(255),
    FOREIGN KEY (author_id) REFERENCES Users (id)
);

CREATE TABLE IF NOT EXISTS the_forum.PostsVotes
(
    user_id INT,
    post_id INT,
    vote    VARCHAR(15),
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (post_id) REFERENCES Posts (id)
);

CREATE TABLE IF NOT EXISTS the_forum.Comments
(
    id        INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    author_id INT,
    post_id   INT,
    content   TEXT,
    FOREIGN KEY (author_id) REFERENCES Users (id),
    FOREIGN KEY (post_id) REFERENCES Posts (id)
);

CREATE TABLE IF NOT EXISTS the_forum.CommentsVotes
(
    user_id    INT,
    comment_id INT,
    vote       VARCHAR(15),
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (comment_id) REFERENCES Comments (id)

);

CREATE TABLE IF NOT EXISTS the_forum.Tags
(
    post_id INT,
    tag     VARCHAR(35),
    FOREIGN KEY (post_id) REFERENCES Posts (id)
);