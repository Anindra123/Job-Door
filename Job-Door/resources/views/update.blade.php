@extends('layout.dashboardlayout')

@section('title')
Update Profile
@endsection

@section('content')



<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        @if(isset($msg))
        <div class="alert alert-dismissible alert-success mt-3">
            <strong>{{$msg}}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <form action="/updateprofile" method="post" class="shadow-lg p-5 m-3 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Update your profile</legend>
                <div class="form-group">
                    <label for="fname" class="form-label">First name :</label>
                    <input type="text" class="form-control" name="fname" id="fname" value="{{isset($profile) ? $profile->fname : old('fname')}}">
                    @if($errors->has('fname'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('fname')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="lname" class="form-label">Last name :</label>
                    <input type="text" class="form-control" name="lname" id="lname" value="{{isset($profile) ? $profile->lname : old('lname')}}">
                    @if($errors->has('lname'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('lname')}}</strong>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>


@endsection