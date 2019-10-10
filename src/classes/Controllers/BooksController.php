<?php
/**
 * BooksController
 *
 *
 * @package My Books Library
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use PropelModels\BooksQuery;
use PropelModels\BooksByAuthorsQuery;
use PropelModels\AuthorsQuery;

if(!class_exists('BooksController'))
{
    /**
     * @name BooksController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class BooksController
    {
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args) : \Slim\Http\Response
        {
            // Initial variable
            $authors = array();
            
            // Get GET parameters
            $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);
            
            // Get book by ID (and year if exists)
            $book = BooksQuery::create()
            ->filterById($id)
            ->findOne();

            if(!$book)
            {
                // Return 200 OK without book
                return $response->withJson(array(
                    'warning' => 'No Books saved yet',
                ), 200);
            }
            
            // Find all relationships (pivot table BooksByAuthors)
            $booksByAuthors = BooksByAuthorsQuery::create()
            ->filterByBooks($book)
            ->find();
            
            // Get authors by book
            foreach ($booksByAuthors as $bookByAuthor)
            {
                $author = AuthorsQuery::create()->filterById($bookByAuthor->getIdAuthor())->findOne();
                
                array_push($authors, array(
                    'author' => $author->getFullname(),
                    
                ));
            }
            
            // Prepare data
            $data = array(
                'book' => array(
                    'title' => $book->getTitle(),
                    'year' => $book->getYear(),
                ),
                'authors' => $authors
            );
            
            // Return 200 OK
            return $response->withJson($data, 200);
        }
    }
} 