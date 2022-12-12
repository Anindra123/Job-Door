@extends('layout.app')

@section('title')
Send Mail
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

        <form action="/sendmail" method="post" class="shadow-lg mt-5 p-5 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <legend>Send Us A Message</legend>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>

                <div class="form-group">
                    <br>
                    <div class="form mb-3">
                        <label for="floatingInput">TELL US YOUR NAME</label>
                        <input type="text" class="form-control" id="floatingInput" name="fname" placeholder="First Name">
                        <input type="text" class="form-control" id="floatingInput" name="lname" placeholder="Last Name">
                    </div>
                    <div class="form mb-3">
                        <label for="floatingPassword">ENTER YOUR EMAIL</label>
                        <input type="email" class="form-control" id="floatingPassword" name="mail" placeholder="Eg. example@gmail.com">
                    </div>
                    <div class="form mb-3">
                        <label for="floatingPassword">ENTER YOUR PHONE NUMBER</label>
                        <input type="tel" class="form-control" id="floatingPassword" name="tel" placeholder="Eg. _1800 000000">
                    </div>
                    <div class="form mb-3">
                        <label for="floatingPassword">MESSAGE</label>
                        <br>
                        <textarea placeholder="Write us a message" rows="10" cols="50" name="message"></textarea>
                    </div>

                    <br>
                    <br>
                    <button class="btn btn-success">SEND MESSAGE</button>
                </div>
            </fieldset>

        </form>


        <!-- <div id="login-root"></div> -->
    </div>
</div>
@endsection