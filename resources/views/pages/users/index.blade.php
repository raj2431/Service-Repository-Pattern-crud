@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="offset-lg-12 col-lg-12 col-sm-12 col-12 border main-section">
            <h2>User List</h2>
            <a class="btn btn-primary btn-small" href="{{route('user.create')}}">Add New User</a>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key=>$user)
                    <tr>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile_number}}</td>
                        <td></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"> No any user added yet! </td>
                    </tr>
                    @endforelse
                   
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection