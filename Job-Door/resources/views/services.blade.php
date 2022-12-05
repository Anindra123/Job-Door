@extends('layout.dashboardlayout')

@section('title')
Add Work Experience
@endsection

@section('content')

<div class="container">

    <h1>Add Work Experience</h1>
    <br>
    @if(isset($sucess))
    <div class="alert alert-dismissible alert-success">
        <span>{{$sucess}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <form method="post" action="">
        {{csrf_field()}}
        <div class="row align-items-center mb-3">


            <div class="col-sm">
                <div class="mb-3">
                    <label for="stitle" class="mb-2">Enter Service title :</label>

                    <input type="text" id="stitle" name="stitle" placeholder="" value="{{$val ?? old('stitle')}}" class="form-control">
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("stitle"))
                <span class="text-danger">{{$errors->first("stitle")}}</span>
                @endif
            </div>
        </div>
        <div class="row align-items-center mb-3">


            <div class="col-sm">
                <p class="mb-2 text-dark">Enter service description :</p>
                <div class="mb-3">

                    <textarea name="servicedesc" id="servicedesc" cols="50" rows="10">{{$val ?? old('servicedesc')}}</textarea>
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("servicedesc"))
                <span class="text-danger">{{$errors->first("servicedesc")}}</span>
                @endif
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-1">
                <div class="mb-3">
                    <button type="submit" class="btn btn-sm btn-info">Submit</button>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="mb-3">
                    <a href="portfolio" class="btn btn-sm btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection