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
                    <label for="wtitle" class="mb-2">Enter Work title :</label>

                    <input type="text" id="wtitle" name="wtitle" placeholder="" value="{{$val->work_title ?? old('wtitle')}}" class="form-control">
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("wtitle"))
                <span class="text-danger">{{$errors->first("wtitle")}}</span>
                @endif
            </div>
        </div>
        <div class="row align-items-center mb-3">


            <div class="col-sm">
                <div class="mb-3">
                    <label for="cname" class="mb-2">Enter company name :</label>

                    <input type="text" id="cname" name="cname" placeholder="" value="{{$val->company_name ?? old('cname')}}" class="form-control">
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("cname"))
                <span class="text-danger">{{$errors->first("cname")}}</span>
                @endif
            </div>
        </div>
        <div class="row align-items-center mb-3">


            <div class="col-sm">
                <p class="mb-2 text-dark">Enter work description :</p>
                <div class="mb-3">

                    <textarea name="workdesc" id="workdesc" cols="50" rows="10">{{$val->work_description ?? old('workdesc')}}</textarea>
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("workdesc"))
                <span class="text-danger">{{$errors->first("workdesc")}}</span>
                @endif
            </div>
        </div>
        <div class="row align-items-center mb-3">


            <div class="col-sm">
                <div class="mb-3">
                    <label for="stime" class="mb-2">Enter start time :</label>

                    <input type="text" id="stime" name="stime" placeholder="Give date in format (dd-mm-yy)" value="{{$val->start_date ?? old('stime')}}" class="form-control">
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("stime"))
                <span class="text-danger">{{$errors->first("stime")}}</span>
                @endif
            </div>
        </div>
        <div class="row align-items-center mb-3">


            <div class="col-sm">
                <div class="mb-3">
                    <label for="etime" class="mb-2">Enter complete time :</label>

                    <input type="text" id="etime" name="etime" placeholder="Give date in format (dd-mm-yy)" value="{{$val->end_date ?? old('etime')}}" class="form-control">
                </div>


            </div>

            <div class="col-sm">
                @if($errors->has("etime"))
                <span class="text-danger">{{$errors->first("etime")}}</span>
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
                    <a href="/portfolio" class="btn btn-sm btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection