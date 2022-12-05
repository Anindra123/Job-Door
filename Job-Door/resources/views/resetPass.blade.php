@extends('layout.app')

@section('title')
Reset Password
@endsection

@section('content')
<div class="row d-flex flex-row align-items-center mt-5 justify-content-lg-between">
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

        <form action="{{route('password.email')}}" method="post" class="shadow-lg mt-5  p-5 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Reset Password</legend>

                <div class="form-group">
                    <br>
                    <div class="form mb-3">
                        <label for="floatingInput">Verify your mail for password reset :</label>
                        <input type="text" class="form-control" id="floatingInput" name="email" placeholder="Enter your email" value="{{old('email')}}">
                        @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                        <br>
                        @endif
                    </div>

                    <button class="btn btn-primary">Send</button>
                    <a href="/login" class="btn btn-secondary">Go Back</a>
                </div>
            </fieldset>

        </form>


        <!-- <div id="login-root"></div> -->
    </div>
</div>
@endsection