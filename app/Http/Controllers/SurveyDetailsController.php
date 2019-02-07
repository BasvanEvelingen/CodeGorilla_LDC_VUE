<?php

namespace App\Http\Controllers;

use App\SurveyDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * @version 1.0.0
 * Class for handling all the survey API methods
 */
class SurveyDetailsController extends Controller
{

    /**
     * API INDEX SURVEY DETAILS
     * gives back all surveydetails
     * @return records of all survey details
     */
    public function indexSurveyDetails()
    {
        $surveys = Survey::all()->get();
        return response(['surveys' => $surveys], Response::HTTP_OK);
    }

    /**
     * API GET SURVEY DETAIL
     * Gives back details of one survey.
     * @param $id , id of the survey detail to be retreived from the database
     * @return record of the survey detail with the given id.
     */
    public function getSurveyDetail($id)
    {
        $survey_detail = SurveyDetail::findOrFail($id)->first();
        return response(['survey' => $survey_detail], Response::HTTP_OK);
    }

    /**
     * API STORE SURVEY DETAIL
     * Initialisation of Survey Detail by Admin
     * deleted also
     * @param request with data for initialising Survey Detail in the database;
     */
    public function storeSurveyDetail(Request $request)
    {
        $survey_detail = new SurveyDetail();
        $survey_detail->user_id = $request->user_id;
        $survey_detail->user_name = $request->user_name;
        $survey_detail->status = $request->status;
        $survey_detail->survey_type = $request->survey_type;
        $survey_detail->save();
        return response('record stored', Response::HTTP_CREATED);

    }

    /**
     * API UPDATE SURVEY
     * Updates the given
     * @param $id , id of the survey_detail to be deleted from database
     */
    public function updateSurveyDetail(Request $request, $id)
    {
        $survey_detail = SurveyDetail::findOrFail($id)->first();
        if ($request->survey_id != nullOrEmptyString()) {
            $survey_detail->survey_id = $request->survey_id;
        }
        if ($request->survey_name != nullOrEmptyString()) {
            $survey_detail->survey_name = $request->survey_name;
        }
        if ($request->survey_outcome != nullOrEmptyString()) {
            $survey_detail->survey_outcome = $request->survey_outcome;
        }
        $survey_detail->save();
        return response('record updated', Response::HTTP_OK);
    }

    /**
     * API DELETE SURVEY
     * Destroys a given survey, only admins are allowed to destroy surveys
     * Before survey_details are destroyed, the corresponding survey from surveys will be
     * deleted also
     * @param $id , id of the survey_detail to be deleted from database
     */
    public function deleteSurveyDetail($id)
    {
        SurveyDetail::destroy($id);
        return response('record deleted', Response::HTTP_OK);
    }

}
