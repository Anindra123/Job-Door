@extends('layout.jpDashboardLayout')

@section('title')
Manage Candidate Submission
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-auto m-3">
            <h1>Manage Candidate</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm m-3">
            @if(isset($candidate))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Status</th>
                        <th>Submission Status</th>
                        <th>Submission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidate as $c)

                    <tr>
                        <td>{{$c['name']}}</td>
                        <td>{{$c['status']}}</td>
                        <td>{{$c['state']}}</td>
                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-primary btn-sm portBtn {{$c['id']}}">View Submission</button><br></td>
                        @if($c['state'] === 'SUBMITTED')
                        <td>
                            <a href="/hireCandidate-{{$c['id']}}" class="btn btn-sm  btn-info">
                                Hire
                            </a>

                            <a href="/reject-{id}" class="btn btn-sm btn-danger">
                                Reject
                            </a>
                        </td>
                        @endif
                        @if($c['state'] === 'HIRED')
                        <td>
                            <p class="text-sucess">HIRED</p>
                        </td>
                        @endif
                        @if($c['state'] === 'REJECTED')
                        <td>
                            <p class="text-danger">REJECTED</p>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @else
            <h3 class="text-muted">No one submitted currently</h3>
            @endif
        </div>
    </div>


</div>
<div class="modal fade submission-modal" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body submission-modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection