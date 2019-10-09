# Books APIs

## Description
Books and Authors APIs.

## Endpoints
GET: /book/:id
Expect a book with the author

GET: /author/:id
Expect an author with all his books

POST: /author/
Create an author

POST: /book
Create a book and add an author to it.

### Additional
GET: /books
Return all books

GET: /books/{year}
Fliter books by year

POST: /books-by-authors
Add a new relationship book by author