@extends('layouts.app')

@section('heading','Create New User')
@section('action',route('user.store'))
@section('method','POST')


@section('content')
<div class="container">
    <div class="row">
        <div class="offset-lg-12 col-lg-12 col-sm-12 col-12 border main-section">
            <h2 class="text-inverse">@yield('heading')

                <a class="btn btn-primary btn-small pull-right" style="float:right;margin-top:4px" href="{{route('user.index')}}">Back</a>
            </h2>
            <hr>
            <form class="" id="needs-validation" method="POST" action="@yield('action')">
                @csrf
                @if(isset($user->id))
                @method('PUT')
                @endif

                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="text-inverse" for="validationCustom01">First Name</label>
                            <input name="first_name" type="text" class="form-control" id="validationCustom01" placeholder="First name" value="{{old('first_name',@$user->first_name)}}">

                            @error('first_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="text-inverse" for="validationCustom02">Last Name</label>
                            <input name="last_name" type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="{{old('last_name',@$user->last_name)}}" required>


                            @error('last_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="text-inverse" for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{old('email',@$user->email)}}" required>

                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="text-inverse" for="inputEmail4">Mobile Number</label>
                            <input name="mobile_number" type="text" class="form-control" id="mobile_number" placeholder="Mobile Number" value="{{old('mobile_number',@$user->mobile_number)}}" required>

                            @error('mobile_number')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="text-inverse" for="validationCustom03">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="2" rows="2">{{old('address',@$user->address)}}</textarea required>

                            @error('address')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-center">
                        <a href="{{route('user.index')}}" class="btn btn-danger">Cancel</a>
                        <button class="btn btn-primary" type="submit">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection