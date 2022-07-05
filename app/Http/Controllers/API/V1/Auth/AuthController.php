<?php

namespace App\Http\Controllers\API\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\API\V1\Auth\AuthService;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\API\V1\Auth\SignupRequest;
use Exception;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
