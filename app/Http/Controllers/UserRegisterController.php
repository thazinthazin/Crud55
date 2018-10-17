<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\User;

class UserRegisterController extends Controller
{
    public function register(Request $request)
    {
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	// return "success";
    	return new UserResource($user);
    }

    public function update(Request $request)
    {
    	$user = User::where('email', $request->email)->first();
    	$user->name = $request->name;
    	$user->password = bcrypt($request->password);
    	$user->update();

    	return "success";
    }

    public function getUser()
    {
    	return UserResource::collection(User::all());
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $response = [];
        $response["status"] = 200;
        $response["description"] = "User Successfully Deleted!";

        return response()->json($response);
        // return "success";

        // return response()->json([
		//     'name' => 'Abigail',
		//     'state' => 'CA'
		// ]);
    }
}
