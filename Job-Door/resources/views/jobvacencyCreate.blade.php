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
                <legend>Create Job Vacency Post</legend>
                <div class="form-group mb-3">
                    <label for="jtitle" class="form-label">Job Title:</label>
                    <input type="text" class="form-control" name="jtitle" id="jtitle" value="{{$val->jtitle ?? old('jtitle')}}">
                    @if($errors->has('jtitle'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('jtitle')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="jtitle" class="form-label">Company Name:</label>
                    <input type="text" class="form-control" name="cname" id="cname" value="{{$val->cname ?? old('cname')}}">
                    @if($errors->has('cname'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('cname')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="jtype" class="form-label">Job Type :</label>
                    <select name="jtype" id="jtype" class="form-control">
                        <option value="" selected>Select an type</option>
                        <option value="Part-time">Part time</option>
                        <option value="Full-time">Full time</option>
                    </select>
                    @if($errors->has('jtype'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('jtype')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="jdesc" class="form-label">Job Description :</label>
                    <textarea name="jdesc" class="form-control" id="jdesc" cols="30" rows="50">{{$val->jdesc ?? old('jdesc')}}</textarea>
                    @if($errors->has('jdesc'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('jdesc')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="text" class="form-control" name="salary" id="salary" value="{{$val->salary ?? old('salary')}}">
                    @if($errors->has('salary'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('salary')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="addr" class="form-label">Address :</label>
                    <textarea name="addr" class="form-control" id="addr" cols="30" rows="50">{{$val->addr ?? old('addr')}}</textarea>
                    @if($errors->has('addr'))
                    <span class=" text text-danger">
                        <strong>{{$errors->first('addr')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="jltype" class="form-label">Job Location Type :</label>
                    <select name="jltype" id="jltype" class="form-control">
                        <option value="" selected>Select an type</option>
                        <option value="remote">Remote</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="onspot">On Spot</option>
                    </select>
                    @if($errors->has('jltype'))
                    <span class="text text-danger">
                        <strong>{{$errors->first('jltype')}}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="vcount" class="form-label">Vacency Count:</label>
                    <input type="number" class="form-control" name="vcount" id="vcount" value="{{$val->vcount ?? old('vcount')}}">
                    @if($errors->has('vcount'))
                    <span class="text text-danger">
                        <strong> {{$errors->first('vcount')}}</strong>
                    </span>
                    @endif
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="profile" class="btn btn-primary">Go Back</a>
        </form>

    </div>
</div>


@endsection