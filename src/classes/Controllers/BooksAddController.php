<?php
/**
 * BooksAddController
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

use PropelModels\Books;
use PropelModels\BooksByAuthors;

if(!class_exists('BooksAddController'))
{
    /**
     * @name BooksAddController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class BooksAddController
    {
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args) : \Slim\Http\Response
        {
            // Get all POST parameters
            $allPostPutVars = $request->getParsedBody();
            
            // Sanitize strings
            $title = filter_var($allPostPutVars['title'], FILTER_SANITIZE_STRING);
            $year = filter_var($allPostPutVars['year'], FILTER_SANITIZE_NUMBER_INT);
            $authorId = filter_var($allPostPutVars['author-id'], FILTER_SANITIZE_NUMBER_INT);
            
            // Save new Book
            $book = new Books();
            $book->setTitle($title);
            $book->setYear($year);
            
            // Save new book
            $book->save();
            
            // Add relationship with Author (if autor id exists)
            if($authorId)
            {
                // @todo Check is Author exists
                
                $booksByAuthors = new BooksByAuthors();
                $booksByAuthors->setIdAuthor($authorId);
                $booksByAuthors->setIdBook($book->getId());
                
                // Save relationship
                $booksByAuthors->save();
            }
            
            // Prepare data
            $data = array(
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'year' => $book->getYear()
            );

            // 201 Created
            return $response->withJson($data, 201);
        }
    }
} 