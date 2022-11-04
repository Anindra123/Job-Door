@extends('layout.dashboardlayout')

@section('title')
Create Portfolio
@endsection

@section('content')

<div class="container">

    <h1>Create Portfolio</h1>
    <br>
    @if(isset($sucess))
    <div class="alert alert-dismissible alert-success">
        <span>{{$sucess}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <form method="post" action="">
        {{csrf_field()}}
        <div class="row align-items-center">


            <div class="col-auto">
                <div class="mb-3">
                    <label for="prtitle" class="mb-2">Enter portfolio title :</label>

                    <input type="text" id="prtitle" name="prtitle" placeholder="" value="{{$val ?? old('prtitle')}}" class="form-control">
                </div>


            </div>

            <div class="col-auto">
                @if($errors->has("prtitle"))
                <span class="text-danger">{{$errors->first("prtitle")}}</span>
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