@extends('layout.dashboardlayout')

@section('title')
Upload CV
@endsection

@section('content')

<div class="container">

    <h1>Upload CV</h1>
    <br>
    @if(isset($sucess))
    <div class="alert alert-dismissible alert-success">
        <span>{{$sucess}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <form method="post" action="/cvUpload" enctype="multipart/form-data">
        {{csrf_field()}}


        <div class="form-group">
            <label for="cv" class="form-label mt-4">Upload CV :</label>
            <input class="form-control" type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" value="{{old('cv')}}">
            @if($errors->has('cv'))
            <span class="text-danger">{{$errors->first('cv')}}</span>
            @endif
        </div>


        <button type="submit" class="btn btn-sm btn-info mt-3 me-3">Submit</button><a href="portfolio" class="btn btn-sm mt-3 btn-primary">Go Back</a>
    </form>
</div>

@endsection