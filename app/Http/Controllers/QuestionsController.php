<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Survey;
use Illuminate\Support\Facades\Auth;

/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * @version 2.0
 * Class for All API methods concerning LDC REST Api
 */
class QuestionsController extends Controller
{
   /**
    * API GET INDEX OF QUESTIONS
    * Testing method for making API call currently not in the routes
  
    * @return $reponse in json format 
    */
    public function index()
    {
        $offline = true;
        switch ($offline) {
            case false:
                $json = Storage::disk('local')->get('ldc_getquestions.json');
                $client = new Client();
                $URI = 'https://staging.ldc.nl';
                $headers = ['Content-Type' => 'application/json'];
                $promise = $client->requestAsync('POST', $URI, ['headers' => $headers, 'body' => $json])->then(
                    function ($response) {
                        return $response->getBody();
                    }, function ($exception) {
                        return $exception->getMessage();
                    }
                );
                $response = $promise->wait();
                break;
            case true:
                $response = Storage::disk('local')->get('ldc_samplequestions');
                dd('$response: '.$response);
                break;
        }
        return response($response, Response::HTTP_OK);
    }

    /**
     * API GET QUESTIONS
     * Intermediate function for getting data from RESTFUL API 
     * Sending it over with another API request from front-end vue.js
     * Both async/promise based. Guzzle on this back-end and Axios on Vue.js front-end
     * Sends POST request and receives GET request from front-end
     * @return $response in json format 
     * @var $offline for testing when disconnected from api.
     */
    public function getQuestions()
    {
        $offline = false;
        switch ($offline) {
            case false:
                // get api-call bodydata from json file
                $json = Storage::disk('local')->get('ldc_getquestions.json');
                // new guzzle instance
                $client = new Client();
                $URI = 'https://staging.ldc.nl';
                $headers = ['Content-Type' => 'application/json'];
                // try to get questions
                $promise = $client->requestAsync('POST', $URI, ['headers' => $headers, 'body' => $json])->then(
                    function ($response) {
                        return $response->getBody();
                    }, function ($exception) {
                        return $exception->getMessage();
                    }
                );
                $response = $promise->wait();
            break;
            case true:
                // no api-call avaiable so we're gonna send some sampledata
                $response = Storage::disk('local')->get('ldc_samplequestions.json');
            break;
        }
        return response($response, Response::HTTP_OK);
        
    }


      /**
     * API GET PROFESSION LEVELS
     * function for obtaining possible professionlevels for generating result of test
     * @response in json
     */
    public function getProfessionLevels()
    {
        // get api-call bodydata from json file
        $json = Storage::disk('local')->get('ldc_getlevels.json');

        // new guzzle instance
        $client = new Client();
        $URI = 'https://staging.ldc.nl';
        $headers = ['Content-Type' => 'application/json'];
        // try to get levels
        $promise = $client->requestAsync('POST', $URI, ['headers' => $headers, 'body' => $json])->then(
            function ($response) {
                return $response->getBody();
            }, function ($exception) {
                return $exception->getMessage();
            }
        );
        // Even wachten op antwoord van server
        $response = $promise->wait();

        return response($response, Response::HTTP_OK);

    }

      /**
     * API POST ANSWERS
     * Function for requesting results for given answers, request data is first pulled from table surveys
     * in database,and then merged with requested professionlevels and then sent over to api
     * @request in json format what has been stored 
     * @response also in json format
     */
    public function postAnswers(Request $request)
    {
        // tijdelijk voorbeeld voor testen
        
        $request = Storage::disk('local')->get('ldc_sampleanswers.json');
        
        

        // new guzzle instance
        $client = new Client();
        $URI = 'https://staging.ldc.nl';
        $headers = ['Content-Type' => 'application/json'];
        // try to get levels
        $promise = $client->requestAsync('POST', $URI, ['headers' => $headers, 'body' => $request])->then(
            function ($response) {
                return $response->getBody();
            }, function ($exception) {
                return $exception->getMessage();
            }
        );
        // Even wachten op antwoord
        $response = $promise->wait();
       
        return response($response, Response::HTTP_OK);
    }
}
