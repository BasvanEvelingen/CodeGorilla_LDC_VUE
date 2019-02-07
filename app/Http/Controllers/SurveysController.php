<?php

namespace App\Http\Controllers;

use App\Survey;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * @version 1.0.1
 * Class for handling all surveys in the application
 */
class SurveysController extends Controller
{

    /**
     * API GET SURVEY
     * Gives one survey back to user or admin, to get results or to complete a pending survey
     * @param $id the id of the survey to be given
     * @return $response gives back survey data
     * in survey to be updated.
     */
    public function getSurvey($id)
    {
        $survey = Survey::findOrFail($id);
        return response($survey->survey->json(), Response::HTTP_OK);
    }

    /**
     * API INDEX ALL SURVEYS
     * Gives all surveys back admin, to get results or to complete a pending survey
     * @return $response gives back all survey data
     * in survey to be updated.
     */
    public function indexSurveys()
    {
        $surveys = Survey::all();
        return response($surveys, Response::HTTP_OK);
    }

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
        $survey->survey = json_encode($request->getContent());
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
        $survey->survey = json_encode($request->getContent());
        $survey->save();
        return response(['status' => 'updated'], Response::HTTP_OK);
    }

    /**
     * API DELETE SURVEY
     * Destroys a given survey, only admins are allowed to destroy surveys
     * Should only be used before Survey_Details are destroyed
     * @param $id , id of the survey to be deleted from database
     */
    public function deleteSurvey($id)
    {
        $survey = Survey::find($id);
        $survey->delete();
        return response('status', 'survey deleted', Response::HTTP_OK);
    }
}
