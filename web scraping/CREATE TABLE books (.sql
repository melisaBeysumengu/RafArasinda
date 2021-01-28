CREATE TABLE books (
    book_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    genre varchar(250) not null,
    title varchar(250) not null,
    authorName varchar(250) not null,
    isbn int(30) not null,
    img varchar(250) not null,
    publishedDate varchar(250) not null,
    publisherName varchar(250) not null,
    ratingVal  varchar(10) not null,
    ratingcount varchar(250) not null,
    descrp  text 
);
CREATE TABLE genre (
    genre_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    genre_name varchar(250) not null,
    
);
CREATE TABLE publisher (
    publisher_ID int(11) AUTO_INCREMENT PRIMARY KEY not null,
    publisher_name varchar(250) not null,
    
);

CREATE TABLE Author (
    Author_ID int(11) AUTO_INCREMENT PRIMARY KEY not null,
    first_name varchar(250) not null,
    second_name varchar(250) not null,
    BirthDate varchar(250) not null,

    
);
CREATE TABLE Review (
    review_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    rate varchar(250) not null,
    FOREIGN KEY (user_ID)
      REFERENCES users (user_id)
      ON UPDATE CASCADE ON DELETE ,

    FOREIGN KEY (book_ID)
      REFERENCES books (book_id)
      ON UPDATE CASCADE ON DELETE 
);


