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

                <div class="col-sm-6">

                    <a href="updateprofile" class="btn btn-info">Update</a><br>

                </div>

                <div class="col-sm-6">

                    <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-danger">Delete</button><br>

                </div>
            </div>
            <div class="row m-3">
                <div class="col-sm-12">
                    <strong>First Name : </strong> {{$ud->fname}} <br>
                    <strong>Last Name : </strong> {{$ud->lname}} <br>
                    <strong>Email : </strong> {{$up->mail}} <br>
                    <strong>Current Occupation : </strong> @if($ud->current_occupation === 'Full-time') Full time job
                    @elseif($ud->current_occupation === 'Part-time') Part time job @else {{$ud->current_occupation}} @endif <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete profile ?. The changes are irreversible.</p>
            </div>
            <div class="modal-footer">
                <a href="deleteProfile" class="btn btn-danger">Confirm</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection