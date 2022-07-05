<?php

namespace App\Http\Controllers\API\V1\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\API\V1\Auth\AuthService;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\API\V1\Auth\SigninRequest;
use App\Http\Requests\API\V1\Auth\SignupRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends BaseController
{
    private $authService;

    public $pagination;
    public $response;

    public function __construct(AuthService $authService)
    {
        $this->pagination = config('constants.pagination.api');
        $this->authService = $authService;
        $this->response = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup(SignupRequest $request)
    {
        DB::beginTransaction();
        $validated = $request->validated();

        try {
            $user  = $this->authService->signup($validated);
            DB::commit();
            return $this->sendResponse((object) $this->response, "Congrats! Your profile has been created.", config('constants.api_status.created'));
        } catch (Exception $th) {
            DB::rollBack();
            throw new HttpResponseException($this->sendResponse((object)array(), "Intrnal Server", config('constants.api_status.fatel')));
        }
    }

    /**
     * Signin
     */
    public function signin(SigninRequest $request)
    {
        DB::beginTransaction();
        $validated = $request->validated();
        try {

            /**
             * Checking user is exist or not in data base
             */
            $isLoggedIn = $this->authService->signin($validated);
            /**
             * To validate password after getting user by email or username
             */
            if (!$isLoggedIn) {
                return $this->sendResponse((object) $this->response, trans('api.login.invalid_cred'), config('constants.api_status.validation'));
            }
            $user = Auth::user();
            
            /**
             * To check if email is verified or not.
             * If not verified then send email to verification
             */
            if (!empty($user->email_verified_at)) {
                // $user->sendEmailVerificationNotification();
                return $this->sendResponse((object) $this->response, "Please check your registered email for the verification link.", config('constants.api_status.failed'));
            }

            /**
             * To update user's devices
             */
            $this->response = $user;
            $this->response['token'] = $user->createToken("config('app.name')-$user->id")->accessToken;
            DB::commit();
            return $this->sendResponse((object) $this->response, "Login Success", config('constants.api_status.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpResponseException($this->sendResponse((object)array(), "Intrnal Server", config('constants.api_status.fatel')));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
