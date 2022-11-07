@extends('layout.jpDashboardLayout')

@section('title')
Interview Proposal
@endsection

@section('content')

@if(isset($jobs))
@foreach($jobs as $j)
<div class="container p-3 mb-3 border border-primary">
    <h3 class="mb-3 mt-3">{{$j->job_title}}</h3>

    @if(isset($j['clist']))
    @if(isset($j['prop']))
    <div class="container border border-primary mb-3 p-3">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <h4 class="mb-3 mt-3">Current proposal</h4>
            </div>
            <div class="col-sm-2">
                <a href="deleteProposal" class="btn btn-sm btn-danger">Delete</a>
            </div>
            <div class="col-sm-1">
                <a href="updateInterviewProposal" class="btn btn-sm btn-info">Update</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card w-75">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{$j['prop']['title']}}</h4>
                        <h6 class="card-subtitle mb-1"><strong>Interview Type</strong></h6>
                        <p class="card-text mb-4">{{$j['prop']['type']}}</p>
                        <h6 class="card-subtitle mb-1"><strong>Venue</strong></h6>
                        <p class="card-text mb-4">{{$j['prop']['venue']}}</p>
                        <h6 class="card-subtitle mb-1"><strong>Time</strong></h6>
                        <p class="card-text mb-4">{{$j['prop']['stime']}} to {{$j['prop']['etime']}}</p>
                        <h6 class="card-subtitle mb-1"><strong>Date</strong></h6>
                        <p class="card-text mb-4">{{$j['prop']['date']}}</p>
                        <h6 class="card-subtitle mb-1"><strong>Address</strong></h6>
                        <p class="card-text mb-4">{{$j['prop']['address']}}</p>
                        <h5 class="card-subtitle mb-3"><strong>Platform</strong></h5>
                        <p class="card-text mb-4 text-warning">{{$j['prop']['platform']}}</p>
                        <h5 class="card-subtitle mb-3"><strong>Platform Link</strong></h5>
                        <p class="card-text mb-4 text-warning">{{$j['prop']['link']}}</p>
                        <h5 class="card-subtitle mb-3"><strong>Time duration</strong></h5>
                        <p class="card-text mb-4 text-warning">{{$j['prop']['duration']}}</p>
                        <h5 class="card-subtitle mb-3"><strong>Additional notes</strong></h5>
                        <p class="card-text mb-4 text-warning">{{$j['prop']['notes']}}</p>
                        <a href="viewCandidateList" class="btn btn-sm btn-info">View Candidate List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-4">
            <a href="createInterviewProposal-{{$j['id']}}" class="btn btn-sm btn-danger">Create Interview Propsal</a>
        </div>
    </div>
    @endif
    @else
    <div class="row mt-4 mb-3">
        <div class="col-sm-4">
            <h3>No candidates accpeted for this job</h3>
        </div>
    </div>
    @endif
</div>
@endforeach
@endif

@endsection