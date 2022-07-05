@extends('layouts.app')

@section('css')
<style>
    .edit-btn {
        float: left;
        margin-right: 10px;
    }

    .delete-form,
    .delete-user {
        float: left;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="offset-lg-12 col-lg-12 col-sm-12 col-12 border main-section">
            <h2 class="text-inverse">
                User List
                <a class="btn btn-primary btn-small pull-right" style="float:right;margin-top:4px" href="{{route('user.create')}}">Add New User</a>
            </h2>

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
                        <td>
                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary edit-btn">Edit</a>

                            <form method="POST" class="delete-form" action="{{route('user.destroy',$user->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger delete-user" value="Delete">
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"> No any user added yet! </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="d-flex">
                <div class="mx-auto">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    $('.delete-user').click(function(e) {
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>

@endsection