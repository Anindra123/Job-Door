@extends('layout.adminDashboardLayout')

@section('title')
Interview Process
@endsection

@section('content')

@if(isset($jobs))
@foreach($jobs as $j)
<div class="container p-3 mb-3 border border-primary">
    <h3 class="mb-3 mt-3">{{$j->job_title}}</h3>


    @if(isset($j['interview']))

    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="card w-75">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{$j['interview']['title']}}</h4>
                    <h6 class="card-subtitle mb-1"><strong>Description</strong></h6>
                    <p class="card-text mb-4">{{$j['interview']['description']}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Question</strong></h6>
                    <p class="card-text mb-4">{{$j['interview']['question']}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Time</strong></h6>
                    <p class="card-text mb-4">{{$j['interview']['stime']}} to {{$j['interview']['etime']}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Date</strong></h6>
                    <p class="card-text mb-4">{{$j['interview']['date']}}</p>
                    @if($j['interview']['status'] === "PENDING")
                    <h6 class="card-subtitle mb-1 text-warning"><strong>Status</strong></h6>
                    <p class="card-text mb-4  text-warning">{{$j['interview']['status']}}</p>

                    @elseif($j['interview']['status'] === "APPROVED")
                    <h6 class="card-subtitle mb-1 text-success"><strong>Status</strong></h6>
                    <p class="card-text mb-4  text-success">{{$j['interview']['status']}}</p>

                    @else
                    <h6 class="card-subtitle mb-1 text-danger"><strong>Status</strong></h6>
                    <p class="card-text mb-4  text-danger">{{$j['interview']['status']}}</p>
                    @endif

                    @if($j['interview']['status'] === "OPEN")
                    <a href="/closeTechnicalForm-{{$j->id}}" class="btn btn-sm btn-warning">CLOSE</a>
                    @elseif($j['interview']['status'] === "APPROVED")
                    <a href="/updateTechnicalForm-{{$j->id}}" class="btn btn-sm btn-info">Update</a>
                    <a href="/deleteTechnical-{{$j->id}}" class="btn btn-sm btn-danger">Delete</a>
                    <a href="startInterView-{{$j['interview']['id']}}" class="btn btn-sm btn-info">Start Process</a>
                    @else
                    <a href="/updateTechnicalForm-{{$j->id}}" class="btn btn-sm btn-info">Update</a>
                    <a href="/deleteTechnical-{{$j->id}}" class="btn btn-sm btn-danger">Delete</a>
                    <a href="startInterView-{{$j['interview']['id']}}" class="btn btn-sm btn-info text-muted" style="pointer-events:none;">Start Process</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="container mb-3 p-3">
        <div class="row mb-3">
            <div class="col-sm-3">

                <a href="createTechnicalForm-{{$j->id}}" class="btn btn-sm btn-info">Create Technical Interview Process</a>
            </div>
        </div>
    </div>
    @endif




</div>
@endforeach
@endif


@endsection