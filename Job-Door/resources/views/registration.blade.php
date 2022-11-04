@extends('layout.app')

@section('title')
Registration
@endsection

@section('content')


<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <form action="/register" method="post" class="shadow-lg p-5 m-3 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Sign up as Job Seeker</legend>
                <div class="form-group">
                    <label for="fname" class="form-label">First name :</label>
                    <input type="text" class="form-control" name="fname" id="fname" value="{{old('fname')}}">
                    @if($errors->has('fname'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('fname')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="lname" class="form-label">Last name :</label>
                    <input type="text" class="form-control" name="lname" id="lname" value="{{old('lname')}}">
                    @if($errors->has('lname'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('lname')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="uname" class="form-label">User Name :</label>
                    <input type="text" class="form-control" name="uname" id="uname" value="{{old('uname')}}">
                    @if($errors->has('uname'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('uname')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="mail" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="mail" id="mail" value="{{old('mail')}}">
                    @if($errors->has('mail'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('mail')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}">
                    @if($errors->has('password'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('password')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password :</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">
                    @if($errors->has('password_confirmation'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('password_confirmation')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="curr_occup" class="form-label">Current Occupation :</label>
                    <select name="curr_occup" id="curr_occup" class="form-control">
                        <option value="" selected>Select an occupation</option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Part-time">Part time Job</option>
                        <option value="Full-time">Full time Job</option>
                        <option value="Student">Student</option>
                    </select>
                    @if($errors->has('curr_occup'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('curr_occup')}}</strong>
                    </span>
                    @endif
                </div>
            </fieldset>
            <br>
            <button type="submit" class="btn btn-primary">Sign-Up</button>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>


@endsection