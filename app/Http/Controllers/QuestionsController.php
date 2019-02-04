<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Survey;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
   /**
    * Testing method for making API call currently not in the routes
    *   
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
     * API
     * Intermediate function for getting data from RESTFUL API 
     * Sending it over with another API request from front-end vue.js
     * Both async/promise based. Guzzle on this back-end and Axios on Vue.js front-end
     * Sends POST request and receives GET request from front-end
     * @return $response in json format 
     * @var $offline for testing when disconnected from api.
     */
    public function getQuestions()
    {
        $offline = true;
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
     * API
     * Intermediate function for getting data front end and storing it on the back-end
     * Sending it over from front-end vue.js and storing it in database, after each call
     * Both async/promise based. Guzzle on this back-end and Axios on Vue.js front-end
     * Stores data and receives POST request from front-end
     * @return $response in json format what has been stored 
     */
    public function storeQuestions(Request $request) {

        $user = Auth::user();
        $username = $user->name;
        $date = new DateTime();
        $survey = new Survey();
        $survey->name = $username . $date->getTimestamp();
        $survey->user_id = $user->id;
        $survey->survey =  json_encode($request->json());
        $survey->save();

        dd(json_decode($request->getContent(), true));
    }

    


    private function createSurvey($rawresponse)
    {
        $response = json_decode($rawresponse);
        $survey = [];

        foreach ($response->responses[0]->objects as $question) {
            $storeQuestion = new \stdClass();
            $storeQuestion->id = $question->id;
            $storeQuestion->name = $question->name;
            $storeQuestion->outcome = -1;
            array_push($survey, $storeQuestion);
        }
        $this->storeSurvey($survey);
    }

    public function sampleTest()
    {
        $response = $this->getQuestions();
        $this->createSurvey($response);

    }

    public function storeSurvey(Request $request)
    {
        
    }

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

        return view('levels')->with('data', json_decode($response, true));

    }

    public function postAnswers()
    {

        // tijdelijk voorbeeld voor testen
        $json = Storage::disk('local')->get('ldc_sampleanswers.json');

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
        // Even wachten op antwoord
        $response = $promise->wait();
        //echo $response;
        // Nu even sturen naar blade, volgende stap vue.js
        return view('outcome')->with('data', json_decode($response, true));
    }
}
