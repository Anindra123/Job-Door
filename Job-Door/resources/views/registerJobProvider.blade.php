@extends('layout.app')

@section('title')
Job_Provider Registration
@endsection

@section('content')


<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <form action="" method="post" class="shadow-lg p-5 m-3 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Sign up as job provider</legend>
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
                    <label for="work_position" class="form-label">Work position:</label>
                    <select name="work_position" id="work_position" class="form-control">
                        <option value="" selected>Select an occupation</option>
                        <option value="hr">HR</option>
                        <option value="manager">Manager</option>
                        <option value="CTO">CTO</option>
                        <option value="recruit">Recruiter</option>
                    </select>
                    @if($errors->has('work_position'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('work_position')}}</strong>
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