@extends('layout.dashboardlayout')

@section('title')
Profile
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>

    <div class="col-lg-6">
        <div class="container p-2 m-3 shadow-lg bg-white d-flex flex-column align-items-center justify-">
            <div class="row m-3">
                <div class="col-sm-12">
                    <img src="{{asset('images/pfp.webp')}}" alt="Default profile" class="img-fluid img-thumbnail rounded-circle" width="100" height="100" srcset="">
                </div>

            </div>
            <div class="row m-3">

                <div class="col-sm-12">

                    <a href="updateprofile" class="btn btn-info">Update</a><br>

                </div>

            </div>
            <div class="row m-3">
                <div class="col-sm-12">
                    <strong>First Name : </strong> {{$up->fname}} <br>
                    <strong>Last Name : </strong> {{$up->lname}} <br>
                    <strong>Email : </strong> {{$up->mail}} <br>
                    <strong>Current Occupation : </strong> @if($up->current_occupation === 'Full-time') Full time job
                    @elseif($up->current_occupation === 'Part-time') Part time job @else {{$up->current_occupation}} @endif <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection