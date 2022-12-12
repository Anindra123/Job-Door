@extends('layout.jpDashboardLayout')

@section('title')
Job Vacency Candidates
@endsection

@section('content')

<!-- <div class="container">
    <div class="row">
        <div class="col-auto m-3">
            <h1>Applied Candidate List</h1>
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
                        <th>Applied Position</th>
                        <th>Portfolio</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidate as $c)

                    <tr>
                        <td>{{$c['name']}}</td>
                        <td>{{$c['status']}}</td>
                        <td>{{$c['position']}}</td>
                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-primary btn-sm portBtn {{$c['port']}}">View Portfolio</button><br></td>
                        @if($c['state'] === 'APPLIED')
                        <td>
                            <a href="/acceptCandidate-{{$c['id']}}" class="btn btn-sm  btn-info">
                                Accept
                            </a>

                            <a href="/rejectCandidate-{{$c['id']}}" class="btn btn-sm btn-danger">
                                Reject
                            </a>
                        </td>
                        @endif
                        @if($c['state'] === 'ACCEPTED')
                        <td>
                            <p class="text-sucess">ACCEPTED</p>
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
            <h3 class="text-muted">No one applied currently</h3>
            @endif
        </div>
    </div>


</div>
<div class="modal fade portfolio-modal" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Portfolio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body portfolio-modal-body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->



<div id="managejobVacency-root"></div>
<div class="modal fade portfolio-modal" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content" id="modal-root">

        </div>
    </div>
</div>


@endsection