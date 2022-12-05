@extends('layout.jpDashboardLayout')

@section('title')
Create Job Vacency Post
@endsection

@section('content')
<div class="container">

    <div class="row">
        <form action="" method="post" class="shadow-lg p-5 m-3 bg-white" novalidate>
            {{@csrf_field()}}
            <fieldset>
                <legend>Create Interview Proposal</legend>
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
                    <label for="type" class="form-label">Type of interview :</label>
                    <select name="type" id="type" class="form-control">

                        <option value="technical" selected>Technical Interview</option>
                        <option value="behavioural">Behavioural Interview</option>
                    </select>
                    @if($errors->has('type'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('type')}}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="venue" class="form-label">Venue:</label>
                    <input type="text" class="form-control" name="venue" id="venue" value="{{$val->venue ?? old('venue')}}">
                    @if($errors->has('venue'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('venue')}}</strong>
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
                    <label for="link" class="form-label">Platform Link:</label>
                    <input type="url" class="form-control" name="link" id="link" value="{{$val->link ?? old('link')}}">
                    @if($errors->has('link'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('link')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address :</label>
                    <textarea name="address" class="form-control" id="address" cols="30" rows="50">{{$val->address ?? old('address')}}</textarea>
                    @if($errors->has('address'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('address')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="jltype" class="form-label">Platform :</label>
                    <select name="jltype" id="jltype" class="form-control">
                        <option value="" selected>Select an type</option>
                        <option value="zoom">Zoom</option>
                        <option value="meet">Google Meet</option>
                        <option value="teams">Teams</option>
                    </select>
                    @if($errors->has('jltype'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('jltype')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="duration" class="form-label">Time duration:</label>
                    <input type="number" class="form-control" name="duration" id="duration" value="{{$val->duration ?? old('duration')}}">
                    @if($errors->has('duration'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('duration')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="notes" class="form-label">Additional Notes :</label>
                    <textarea name="notes" class="form-control" id="notes" cols="30" rows="50">{{$val->notes ?? old('notes')}}</textarea>
                    @if($errors->has('notes'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('notes')}}</strong>
                    </span>
                    @endif
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="showInterviewProposal" class="btn btn-primary">Go Back</a>
        </form>

    </div>
</div>


@endsection