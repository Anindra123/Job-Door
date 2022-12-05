@extends('layout.dashboardlayout')

@section('title')
Dashboard
@endsection

@section('content')
@if(isset($val) && isset($tcs))
<div class="row">
    <div class="col-auto m-3">
        <div class="card" style="width:100rem;">
            <div class="card-body">
                <h4 class="card-title mb-4">{{$val->title}}</h4>
                <h6 class="card-subtitle mb-1"><strong>Deadline</strong></h6>
                <p class="card-text mb-4">{{$val->date}}</p>
                <p class="card-text mb-4">From {{$val->stime}} to {{$val->etime}} </p>

                @if($tcs['status'] === 'SUBMITTED')
                <p class="text-success mb-4">SUBMITTED</p>
                <p class="text-warning mb-4">PENDING ACCEPTANCE</p>
                <button type="button" data-bs-toggle="modal" data-bs-target="#submissionModal" class="btn btn-primary btn-sm portBtn {{$val['id']}}">View Submission</button>
                @else
                @if(strtotime($val->date) === strtotime(date('Y-m-d',time())) )
                @if(time() >= strtotime($val->stime) )
                <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-primary btn-sm portBtn {{$val['id']}}">View Assesment</button>
                @else
                <p class="card-text"> Assesment will start in {{date('i:s',strtotime($val->stime)-time())}}</p>
                @endif

                @else
                <p class="card-text"> Assesment will start in {{$val->date}}</p>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade interview-modal" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title interview-title">Interview question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body interview-modal-body">
                <form method="post" action="/submitAnswer-{{$tcs['id']}}">

                    <div class="mb-1">

                        <h4>Description</h4>
                    </div>
                    <div class="mb-3">

                        <h5>{{$val->description}}</h5>
                    </div>
                    <div class="mb-1">

                        <h4>Question</h4>
                    </div>

                    <div class="mb-3">

                        <h5>{{$val->question}}</h5>
                    </div>
                    <div class="mb-3">
                        <pre>
                        {{$tcs['submission']}}
                        </pre>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade interview-modal" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title interview-title">Interview question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body interview-modal-body">
                <form method="post" action="/submitAnswer-{{$tcs['id']}}">

                    <div class="mb-1">

                        <h4>Description</h4>
                    </div>
                    <div class="mb-3">

                        <h5>{{$val->description}}</h5>
                    </div>
                    <div class="mb-1">

                        <h4>Question</h4>
                    </div>

                    <div class="mb-3">

                        <h5>{{$val->question}}</h5>
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="col-form-label">Answer:</label>
                        <textarea class="form-control" name="answer" class="answerBox" id="answer"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary interviewAnswerSubmit {{$tcs['submitter_id']}}">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-sm-12">
        <h1>No interview process created currently</h1>
    </div>
</div>
@endif


@endsection