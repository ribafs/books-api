# Books APIs

## Install
- Download the package
- Run composer update
- Create the database (See sql folder)
- Configure the database using config file ./propel.php
- Setup a Virtualhost if your are using Apache or run a php server.
- Browse the homepage (/) to check GET endpoints or use a tool to test POST endpoints.

## Description
Books and Authors APIs.

## Endpoints
GET: /book/:id
Expect a book with the author

GET: /author/:id
Expect an author with all his books

POST: /author/
Create an author
Parameters: firstname, lastname

POST: /book
Create a book and add an author to it.
Parameter: title, year, author-id

### Additional
GET: /books
Return all books

GET: /books/{year}
Fliter books by year

POST: /books-by-authors
Add a new relationship book by author
Parameters: author-id, book-id