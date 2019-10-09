<?php 
/*
Name: Lost in Translations
URI: 
Description: 
Version: 1.0
Author: Giuseppe Maccario
Author URI: giuseppemaccario.com
License: GPL2
*/

use Slim\Views\PhpRenderer;

use Controllers\HomeController;
use Controllers\BooksController;
use Controllers\AuthorsController;
use Controllers\AuthorsAddController;
use Controllers\BooksAddController;
use Controllers\BooksByAuthorAddController;
use Controllers\BooksListController;

// PSR-4: Autoloader - PHP-FIG
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Debug only
$config = ['settings' => ['displayErrorDetails' => true]];
 
// New Slim App
$app = new \Slim\App($config);

 // Set templates directory
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./src/templates");

// Get
$app->get('/', HomeController::class); // Get homepage
$app->get('/book/{id}', BooksController::class); // Get Books with Authors
$app->get('/author/{id}', AuthorsController::class); // Get Author with Books

// All Books
$app->get('/books', BooksListController::class); // Get Books filter by year

// Filter by
$app->get('/books/{year}', BooksListController::class); // Get Books filter by year

// Post
$app->post('/author', AuthorsAddController::class); // Add Author
$app->post('/book', BooksAddController::class); // Add Book
$app->post('/books-by-authors', BooksByAuthorAddController::class); // Add Book

// Run Slim Engine
$app->run();