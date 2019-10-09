<?php
/**
 * AuthorsController
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

use PropelModels\AuthorsQuery;
use PropelModels\BooksByAuthorsQuery;
use PropelModels\BooksQuery;

if(!class_exists('AuthorsController'))
{
    /**
     * @name AuthorsController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class AuthorsController
    {
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args)
        {
            // Initial variable
            $books = array();
            
            // Get GET parameters
            $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

            // Get author by ID
            $author = AuthorsQuery::create()
            ->filterById($id)
            ->findOne();
            
            if(!$author)
            {
                // Return 200 OK without book
                return $response->withJson(array(
                    'warning' => 'No Authors saved yet',
                ), 200);
            }
            
            // Find all relationships (pivot table BooksByAuthors)
            $booksByAuthors = BooksByAuthorsQuery::create()
            ->filterByAuthors($author)
            ->find();

            // Get books by author
            foreach ($booksByAuthors as $bookByAuthor) 
            {                
                $book = BooksQuery::create()->filterById($bookByAuthor->getIdBook())->findOne();
                
                array_push($books, array(
                    'title' => $book->getTitle(),
                    'year' => $book->getYear(),
                    
                ));
            }

            // Prepare data
            $data = array(
                'author' => array(
                    'firstname' => $author->getFirstname(),
                    'lastname' => $author->getLastname()
                ),
                'books' => $books
            ); 
            
            // Return 200 OK
            return $response->withJson($data, 200);
        }
    }
} 