@extends('layout.adminDashboardLayout')

@section('title')
Interview proposals
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-auto m-3">
            <h1>Current Proposals</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm m-3">
            @if(isset($proposals))
            <div class="mb-3">
                <h4>Provided By</h4>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mail</th>
                        <th>Position</th>
                        <th>Job post title</th>
                        <th>Job post id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposals as $p)

                    <tr>
                        <td>{{$p['mail']}}</td>
                        <td>{{$p['position']}}</td>
                        <td>{{$p['post_title']}}</td>
                        <td>{{$p['post_id']}}</td>
                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-primary btn-sm propsalBtn {{$p['id']}}">View Proposal</button><br></td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @else
            <h3 class="text-muted">No propsal created currently</h3>
            @endif
        </div>
    </div>


</div>
<div class="modal fade proposal-modal" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Interview Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body proposal-modal-body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection