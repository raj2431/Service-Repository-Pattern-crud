<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUser;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userService;
    private $perPage = 10;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers($this->perPage);
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $data = $request->validated();
        $user = $this->userService->createOrUpdateUser($data);
        Session::flash('success', 'User has been created successfully.');
        return redirect()->route('user.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  = $this->userService->getUserById($id);
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, $id)
    {
        $data = $request->validated();
        $user = $this->userService->createOrUpdateUser($data, $id);
        Session::flash('success', 'User has been updated successfully.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->userService->deleteSingleOrMultipleUser($id)){
            Session::flash('success', 'User has been updated successfully.');
        }else{
            Session::flash('error', 'Sorry, Server side something went wrong, Please try again!!!');
        }

        return redirect()->route('user.index');
    }
}
