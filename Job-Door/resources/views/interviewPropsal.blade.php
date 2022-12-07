@extends('layout.jpDashboardLayout')

@section('title')
Interview Proposal
@endsection

@section('content')


<div class="container p-3 mb-3 border border-primary">




    <div class="row">
        <div class="col-sm-4">



            <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-primary">Create Interview Proposal</button>


        </div>
    </div>

</div>



<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div id="ip-root"></div>

        </div>
    </div>
</div>
@endsection