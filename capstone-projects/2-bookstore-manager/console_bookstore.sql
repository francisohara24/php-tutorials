CREATE DATABASE bookstore;
USE bookstore;
CREATE TABLE book(
    book_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    book_title TEXT,
    book_isbn VARCHAR(13),
    book_author TEXT,
    book_date_published DATE
                 );