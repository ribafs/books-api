<?php
/**
 * AuthorsAddController
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

use PropelModels\Authors;
use Propel\Runtime\Exception\PropelException;

if(!class_exists('AuthorsAddController'))
{
    /**
     * @name AuthorsAddController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class AuthorsAddController
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
            $firstname = filter_var($allPostPutVars['firstname'], FILTER_SANITIZE_STRING);
            $lastname = filter_var($allPostPutVars['lastname'], FILTER_SANITIZE_STRING);
            
            // Save new Author
            $author = new Authors();
            $author->setFirstname($firstname);
            $author->setLastname($lastname);
            
            // Try to save and add a message error for duplicate Author
            try{
                
                // Save object
                $author->save();
                
                // Prepare data
                $data = array(
                    'id' => $author->getId(),
                    'firstname' => $author->getFirstname(),
                    'lastname' => $author->getLastname(),
                );
            } catch (PropelException $e) {

                // Prepare data
                $data = array(
                    'error' => 'Author already exists'
                );
            }

            // 201 Created
            return $response->withJson($data, 201);
        }
    }
} 