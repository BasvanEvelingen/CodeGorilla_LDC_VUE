<?php

namespace App\Http\Controllers;

use App\Survey;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SurveysController extends Controller
{
    /**
     * API STORE SURVEY
     * Initializes new survey and stores it in the database
     * Intermediate function for getting data front end and storing it on the back-end
     * Sending it over from front-end vue.js and storing it in database, after each call
     * Both async/promise based. Guzzle on this back-end and Axios on Vue.js front-end
     * Stores data and receives POST request from front-end
     * @return $response gives back new survey_id which makes it possible for further changes
     * in survey to be updated.
     */
    public function storeSurvey(Request $request)
    {

        $user = Auth::user();
        $username = $user->name;
        $date = new DateTime();
        $survey = new Survey();
        $survey->name = $username . $date->getTimestamp();
        $survey->user_id = $user->id;
        $survey->survey = json_encode($request->json());
        $survey->save();
        return response(['survey_id' => $survey->id], Response::HTTP_OK);

    }
    /**
     * API UPDATE Survey
     * Intermediate function for getting data front end and updating it on the back-end
     * Sending it over from front-end vue.js and storing it in database, after each call
     * Both async/promise based. Guzzle on this back-end and Axios on Vue.js front-end
     * Stores data and receives PUT request from front-end
     * @return $response just OK if everything went well.
     */
    public function updateSurvey(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);
        $survey->survey = json_encode($request->json());
        $suvey->save();
        return response(null, Response::HTTP_OK);
    }
}
