@extends('layout.dashboardlayout')

@section('title')
Update Skills
@endsection

@section('content')

<h1>Update Skills</h1>
<br>
@if(isset($sucess))
<div class="alert alert-dismissible alert-success">
    <span>{{$sucess}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
<div class="container">
    <form action="" method="post" novalidate>
        {{csrf_field()}}
        <div class="row mb-3">
            <div class="col-sm-12">

                <label for="skillsList" class="mb-2">Enter your skills (seperate by comma):</label>

                <input type="text" class="form-control" value="{{$sk_list ?? old('skillsList')}}" id="skillsList" placeholder="ie. skill1,skill2,skill3..." name="skillsList">

            </div>
            <div class="col-auto">
                @if($errors->has("skillsList"))
                <span class="text-danger">{{$errors->first("skillsList")}}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1">
                <button type="submit" class="btn btn-sm btn-info">Update</button>
            </div>
            <div class="col-sm-2">
                <a href="portfolio" class="btn btn-sm btn-primary">Go Back</a>
            </div>
        </div>

    </form>
</div>


@endsection