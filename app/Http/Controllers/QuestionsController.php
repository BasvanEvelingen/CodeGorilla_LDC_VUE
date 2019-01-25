<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends Controller
{
    // Resource functions

    /**
     * API for Vue.js
     * path /questions
     *
     */
    public function index()
    {

        //testing off/on
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
                break;
        }
        dd($response);
        return response($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function destroy($id)
    {

    }

    // Helper functions
    private function getQuestions()
    {
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
        // give questions to view for testing
        //return view('questions')->with('data', json_decode($response, true));
        // give questions to vue.js component
        return $response;
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

    private function storeSurvey($survey)
    {
        dd($survey);
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
