<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\AuthRequest;
use App\Repositories\Interfaces\LogHistoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\LogHistory;
use App\Repositories\LogHistoryRepository;
use Illuminate\Support\Facades\Auth;
use JsonException;
use Validator;
use Carbon\Carbon;
class AuthController extends BaseController
{
    private $logHistoryRepository;

    public function __construct(LogHistoryRepositoryInterface $logHistoryRepository)
    {
        $this->logHistoryRepository = $logHistoryRepository;
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

     public function register(AuthRequest $request)
    {
        
        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('Its new user registration')->plainTextToken;
            $success['name'] = $user->name;
            $this->logHistoryRepository->storeAuthLog('Registration Succesfull', $user);

            return $this->sendResponse($success, 'User register successfully.');
        } catch (\Exception $e) {
            return $this->sendError('User registration failed'.$e, 500);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AuthRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Its user login')->plainTextToken;
            $success['name'] = $user->name;
            $message='Login at '.Carbon::now()->toDayDateTimeString();
       
            $this->logHistoryRepository->storeAuthLog($message, $user);
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}