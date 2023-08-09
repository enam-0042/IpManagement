<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use JsonException;
use Validator;
use Carbon\Carbon;
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('Its new user registration')->plainTextToken;
            $success['name'] = $user->name;
            $newLog= new Log();
            $newLog->description='Registration Successfull';
            $newLog->user_id=$user->id;
            $newLog->save();

            return $this->sendResponse($success, 'User register successfully.');
        } catch (\Exception $e) {
            return $this->sendError('User registration failed', 500);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Its user login')->plainTextToken;
            $success['name'] = $user->name;
            $newLog = new Log();
            $newLog->description='Login at '.Carbon::now()->toDayDateTimeString();
            $newLog->user_id=$user->id;
            $newLog->save();

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}