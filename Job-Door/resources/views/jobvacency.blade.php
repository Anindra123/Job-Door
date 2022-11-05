@extends('layout.jpDashboardLayout')

@section('title')
Job Vacency
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href="" class="btn btn-primary btn-sm">Add Job Vacency Post</a>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-auto m-3" style="width: 20rem; height:auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{$s->service_title}}</h4>
                    <h6 class="card-subtitle mb-1"><strong>Service Description</strong></h6>
                    <p class="card-text">{{$s->service_description}}</p>
                    <a href="/updateServices-{{$s->id}}" class="btn btn-sm btn-info">Update</a>
                    <a href="/deleteServices-{{$s->id}}" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div> -->
</div>


@endsection