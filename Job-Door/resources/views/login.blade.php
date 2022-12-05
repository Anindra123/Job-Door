@extends('layout.app')

@section('title')
Login
@endsection

@section('content')
<div class="row d-flex flex-row align-items-center justify-content-lg-between">
    <div class="col-lg-4 mr-2">
        <img src="{{asset('images/sign-up.svg')}}" alt="Sign up image" class="img-fluid mt-3
        ">
    </div>
    <div class="col-lg-6">

        @if(isset($msg))
        <div class="alert alert-dismissible alert-success mt-3">
            <strong>{{$msg}}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(isset($err))
        <div class="alert alert-dismissible alert-danger mt-3">
            <strong>{{$err}}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form action="/login" method="post" class="shadow-lg mt-5 p-5 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Sign In</legend>

                <div class="form-group">
                    <br>
                    <div class="form mb-3">
                        <label for="floatingInput">Username or Email address</label>
                        <input type="text" class="form-control" id="floatingInput" name="unmail" placeholder="User name or Email">
                    </div>
                    <div class="form mb-3">
                        <label for="floatingPassword">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Password">
                    </div>

                    <a href="{{route('password.request')}}" class="text-primary" style="text-decoration:none;">Forgot Password ?</a>
                    <br>
                    <br>
                    <button class="btn btn-primary">Sign In</button>
                </div>
            </fieldset>

        </form>


        <!-- <div id="login-root"></div> -->
    </div>
</div>
@endsection