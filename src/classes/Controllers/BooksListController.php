<?php
/**
 * BooksListController
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
use PropelModels\AuthorsQuery;
use Propel\Runtime\Collection\ObjectCollection;

if(!class_exists('BooksListController'))
{
    /**
     * @name BooksListController
     * @description
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class BooksListController
    {
        /**
         * @name getBooks
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        private function getBooks(int $year = null) : ObjectCollection
        {
            if(!$year)
            {
                // Get all books...
                return BooksQuery::create()
                ->find();
            }

            // ...or get books by year
            return BooksQuery::create()
            ->filterByYear($year)
            ->find();
        }
        
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args) : \Slim\Http\Response
        {
            // Initial variable
            $data = array();
            
            // Get GET parameters
            $year = (int)filter_var($args['year'], FILTER_SANITIZE_NUMBER_INT);
            
            $books = $this->getBooks($year);
            
            if(!$books)
            {
                // Return 200 OK without book
                return $response->withJson(array(
                    'warning' => 'No Books saved yet',
                ), 200);
            }
            
            // Get authors by book
            foreach($books as $book)
            {
                // Prepare an array of author for each book
                $authors = array();
                
                $booksByAuthorssJoinAuthors = $book->getBooksByAuthorssJoinAuthors();
                
                // Loop over relationship
                foreach($booksByAuthorssJoinAuthors as $relationship)
                {
                    $author = AuthorsQuery::create()
                    ->filterById($relationship->getIdAuthor())
                    ->findOne();
                    
                    array_push($authors, array(
                        'author' => $author->getFullname(),
                        
                    ));
                }
                
                // Prepare data
                array_push($data, array(
                    'book' => array(
                        'title' => $book->getTitle(),
                        'year' => $book->getYear(),
                    ),
                    'authors' => $authors
                ));
            }
            
            // Return 200 OK
            return $response->withJson($data, 200);
        }
    }
} 