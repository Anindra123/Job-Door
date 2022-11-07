@extends('layout.adminDashboardLayout')

@section('title')
Update Technical Interview Process
@endsection

@section('content')

<div class="container">
    @if(isset($sucess))
    <div class="alert alert-dismissible alert-success">
        <span>{{$sucess}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="row">
        <form action="" method="post" class="shadow-lg p-5 m-3 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Update Technical Interview process</legend>
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$val->title ?? old('title')}}">
                    @if($errors->has('title'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('title')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="desc" class="form-label">Description :</label>
                    <textarea name="desc" class="form-control" id="desc" cols="30" rows="50">{{$val->description ?? old('desc')}}</textarea>
                    @if($errors->has('desc'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('desc')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="stime" class="form-label">Start time:</label>

                    <input type="time" class="form-control" name="stime" id="stime" value="{{$val->stime ?? old('stime')}}">
                    @if($errors->has('stime'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('stime')}}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="etime" class="form-label">End time:</label>

                    <input type="time" class="form-control" name="etime" id="etime" value="{{$val->etime ?? old('etime')}}">
                    @if($errors->has('etime'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('etime')}}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="date" class="form-label">Date:</label>

                    <input type="date" class="form-control" name="date" id="date" value="{{$val->date ?? old('date')}}">
                    @if($errors->has('date'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('date')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="ques" class="form-label">Question :</label>
                    <textarea name="ques" class="form-control" id="ques" cols="30" rows="50">{{$val->question ?? old('ques')}}</textarea>
                    @if($errors->has('ques'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('ques')}}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="showTechnical" class="btn btn-primary">Go Back</a>
        </form>

    </div>
</div>


@endsection