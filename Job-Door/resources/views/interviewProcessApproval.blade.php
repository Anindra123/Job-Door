@extends('layout.jpDashboardLayout')

@section('title')
Current Interview Process
@endsection

@section('content')
@if(isset($err))
<div class="alert alert-dismissible alert-danger">
    <span>{{$err}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(isset($job))

<div class="container p-3 mb-3 border border-primary">




    <div class="row mb-3">
        @foreach($job as $j)
        <div class="col-sm-12">
            <div class="card w-75">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{$j['title']}}</h4>
                    <h6 class="card-subtitle mb-1"><strong>Description</strong></h6>
                    <p class="card-text mb-4">{{$j['description']}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Question</strong></h6>
                    <p class="card-text mb-4">{{$j['question']}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Time</strong></h6>
                    <p class="card-text mb-4">{{$j['stime']}} to {{$j['etime']}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Date</strong></h6>
                    <p class="card-text mb-4">{{$j['date']}}</p>
                    @if($j['status'] === "PENDING")
                    <h6 class="card-subtitle mb-1 text-warning"><strong>Status</strong></h6>
                    <p class="card-text mb-4  text-warning">{{$j['status']}}</p>

                    @elseif($j['status'] === "APPROVED")
                    <h6 class="card-subtitle mb-1 text-success"><strong>Status</strong></h6>
                    <p class="card-text mb-4  text-success">{{$j['status']}}</p>

                    @else
                    <h6 class="card-subtitle mb-1 text-danger"><strong>Status</strong></h6>
                    <p class="card-text mb-4  text-danger">{{$j['status']}}</p>
                    @endif

                    @if($j['status'] === 'PENDING')
                    <a href="/approveTechnicalForm-{{$j->id}}" class="btn btn-sm btn-info">Approve</a>
                    <a href="/declineTechnical-{{$j->id}}" class="btn btn-sm btn-danger">Decline</a>
                    @endif


                </div>
            </div>
        </div>
        @endforeach
    </div>







</div>
@endif


@endsection