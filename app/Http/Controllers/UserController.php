<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * @version 0.9
 * Class for getting controlling users of the application
 */
class UserController extends Controller
{
    /**
     * Method for getting all users in an array()
     * @return array
     */
    public function index()
    {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray(),
            ], 200);
    }

    /**
     * Method for getting one user by id
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray(),
            ], 200
        );
    }

    /**
     * Deleting a user
     *
     * @param [type] $id
     * @return success message
     */
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();

        return response()->json(
            [
                'verwijderd' => $id,
            ], Response::HTTP_OK
        );
    }

    /**
     * @deprecated version 0.1
     *
     * @return void
     */
    public function deleteDeprecated()
    {
        if ($user = Auth::user()) {
            if ($user->delete()) {

                return response()->json(
                    [
                        'verwijderd' => 'success',
                    ], Response::HTTP_OK
                );
            }
        }

    }

}
