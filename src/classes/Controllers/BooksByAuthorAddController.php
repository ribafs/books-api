<?php
/**
 * BooksByAuthorAddController
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
use Propel\Runtime\Exception\PropelException;
use PropelModels\BooksByAuthors;
use PropelModels\BooksQuery;
use PropelModels\AuthorsQuery;

if(!class_exists('BooksByAuthorAddController'))
{
    /**
     * @name BooksByAuthorAddController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class BooksByAuthorAddController
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
            $authorId = filter_var($allPostPutVars['author-id'], FILTER_SANITIZE_NUMBER_INT);
            $bookId = filter_var($allPostPutVars['book-id'], FILTER_SANITIZE_NUMBER_INT);
            
            // Save new Book
            $bookByAuthors = new BooksByAuthors();
            $bookByAuthors->setIdAuthor($authorId);
            $bookByAuthors->setIdBook($bookId);
            
            // Try to save and setup a message error for duplicate Author
            try{
                
                // Save new relationship
                $bookByAuthors->save();
                
                // Get book by ID
                $book = BooksQuery::create()->filterById($bookId)->findOne();
                
                // Get author by ID
                $author = AuthorsQuery::create()->filterById($authorId)->findOne();
                
                // Prepare data
                $data = array(
                    'title' => $book->getTitle(),
                    'author' => $author->getFullname()
                );
            } catch (PropelException $e) {
                
                // Prepare data
                $data = array(
                    'error' => 'Relationship already exists'
                );
            }

            // 201 Created
            return $response->withJson($data, 201);
        }
    }
} 