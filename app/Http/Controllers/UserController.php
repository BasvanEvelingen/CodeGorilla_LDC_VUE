<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray(),
            ], 200);
    }

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

    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();

        return response()->json(
            [
                'verwijderd' => $id,
            ], Response::HTTP_OK
        );
        /*

    if ($user = Auth::user()) {
    if ($user->delete()) {

    return response()->json(
    [
    'verwijderd' => 'success',
    ], Response::HTTP_OK
    );
    }
    }
     */
    }

}
