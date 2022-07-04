@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12  main-section">
            <h3 class="text-center text-inverse">Create New User</h3>
            <hr>
            <form class="" id="needs-validation" method="POST" action="{{route('user.store')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="text-inverse" for="validationCustom01">First Name</label>
                            <input name="first_name" type="text" class="form-control" id="validationCustom01" placeholder="First name" value="{{old('first_name')}}">

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
                            <input name="last_name" type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="{{old('last_name')}}" required>


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
                            <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{old('email')}}" required>

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
                            <input name="mobile_number" type="text" class="form-control" id="mobile_number" placeholder="Mobile Number" value="{{old('mobile_number')}}" required>

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
                            <textarea name="address" class="form-control" id="address" cols="2" rows="2">{{old('address')}}</textarea required>

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
                        <button class="btn btn-info" type="submit">Submit form</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection