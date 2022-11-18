@extends('layout.jpDashboardLayout')

@section('title')
Update Company Information
@endsection

@section('content')
@if(isset($sucess))
<div class="alert alert-dismissible alert-success">
    <span>{{$sucess}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
<div class="container">

    <div class="row">
        <form action="" method="post" class="shadow-lg p-5 m-3 bg-white" novalidate>
        {{@csrf_field()}}
            <fieldset>
                <legend>Update Company Information </legend>
                <div class="form-group mb-3">
                    <label for="ctittle" class="form-label">Company Name:</label>
                    <input type="text" class="form-control" name="cname" id="cname" value="{{$val->cname ?? old('cname')}}">
                    @if($errors->has('cname'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('cname')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="cemail" class="form-label">Company Email:</label>
                    <input type="text" class="form-control" name="cemail" id="cemail" value="{{$val->cemail ?? old('cemail')}}">
                    @if($errors->has('cemail'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('cemail')}}</strong>
                    </span>
                    @endif
                </div>


                <div class="form-group mb-3">
                    <label for="caddress" class="form-label">Company Address:</label>
                    <input type="text" class="form-control" name="caddress" id="caddress" value="{{$val->caddress ?? old('caddress')}}">
                    @if($errors->has('caddress'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('caddress')}}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="cwebsite" class="form-label">Company Website:</label>
                    <input type="text" class="form-control" name="cwebsite" id="cwebsite" value="{{$val->cwebsite ?? old('cwebsite')}}">
                    @if($errors->has('cwebsite'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('cwebsite')}}</strong>
                    </span>
                    @endif
                </div>


                <div class="form-group mb-3">
                    <label for="cfbpage" class="form-label">Company Facebookpage:</label>
                    <input type="text" class="form-control" name="cfbpage" id="cfbpage" value="{{$val->cfbpage ?? old('cfbpage')}}">
                    @if($errors->has('cfbpage'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('cfbpage')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="cservice" class="form-label">Company Service :</label>
                    <select name="cservice" id="cservice" class="form-control">
                        <option value="" selected>Select an type</option>
                        <option value="good">Good</option>
                        <option value="bad">Bad</option>
                        <option value="average">Average</option>
                    </select>
                    @if($errors->has('cservice'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('cservice')}}</strong>
                    </span>
                    @endif

                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="jobvacency" class="btn btn-primary">Go Back</a>
        </form>

    </div>
</div>


@endsection