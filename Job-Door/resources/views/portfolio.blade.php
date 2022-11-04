@extends('layout.dashboardlayout')


@section('title')
Portfolio
@endsection


@section('content')

<div class="container">
    @if(isset($port))
    <div class="row">
        <div class="col-sm-12">
            <h1 class="mb-3 mt-3">{{$port}}</h1>
            <div class="container p-3 mb-3 border border-primary">
                <h3 class="mb-3 mt-3">Skills</h3>

                @if(isset($sk_list))
                <div class="container border border-primary mb-3 p-3">
                    <div class="row align-items-center">
                        <div class="col-sm-8">
                            <h4 class="mb-3 mt-3">Current Skills</h4>
                        </div>
                        <div class="col-sm-2">
                            <a href="deleteSkills" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="updateSkills" class="btn btn-sm btn-info">Update</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            @foreach($sk_list as $sk)
                            <span class="badge m-2 ps-4 pe-4 pt-3 pb-3 bg-primary rounded-pill">{{$sk}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                <div class="row mt-4 mb-3">
                    <div class="col-sm-4">
                        <a href="skills" class="btn btn-sm btn-info">Add Skill</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="container p-3 mb-3 border border-primary">
                <div class="row mx-auto align-items-center">
                    <div class="col-sm-8">
                        <h3 class="mb-3 mt-3">Current Experience</h3>
                    </div>
                    <div class="col-sm-2">
                        <a href="addExperience" class="btn btn-sm btn-primary">Add New</a>
                    </div>

                </div>


                <div class="row align-items-top">
                    @if(isset($wk_list))
                    @foreach($wk_list as $wk)
                    <div class="col-auto m-3" style="width: 20rem; height:auto;">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">{{$wk->work_title}}</h4>
                                <h5 class="card-subtitle mb-3 text-muted">{{$wk->company_name}}</h5>
                                <h6 class="card-subtitle mb-1"><strong>Description</strong></h6>
                                <p class="card-text">{{$wk->work_description}}</p>
                                <h6 class="card-subtitle mb-1"><b>Start Date : </b></h6>
                                <p class="card-text"> {{ date('l jS \of F Y',strtotime($wk->start_date))}}</p>
                                <h6 class="card-subtitle mb-1"><b>End Date :</b></h6>
                                <p class="card-text"> {{date('l jS \of F Y',strtotime($wk->end_date))}}</p>
                                <a href="/updateExperience-{{$wk->id}}" class="btn btn-sm btn-info">Update</a>
                                <a href="/deleteExperience-{{$wk->id}}" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                </div>



            </div>
            <div class="container p-3 mb-3 border border-primary">
                <div class="row mx-auto align-items-center">
                    <div class="col-sm-8">
                        <h3 class="mb-3 mt-3">My Services</h3>
                    </div>
                    <div class="col-sm-2">
                        <a href="services" class="btn btn-sm btn-primary">Add New</a>
                    </div>

                </div>


                <div class="row align-items-top">
                    @if(isset($s_list))
                    @foreach($s_list as $s)
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
                    @endforeach
                    @endif


                </div>



            </div>

            <div class="container p-3 mb-3 border border-primary">
                <h4 class="mb-3 mt-3">My CV</h4>

                @if(isset($cv_path))
                <div class="container border border-primary mb-3 p-3">
                    <div class="row align-items-center">

                        <div class="col-sm-2">
                            <a href="cvDownload" class="btn btn-sm btn-danger">Download</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="cvDelete" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="cvUpdate" class="btn btn-sm btn-info">Update</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="row mt-4 mb-3">
                    <div class="col-sm-4">
                        <a href="cvUpload" class="btn btn-sm btn-info">Upload CV</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="container ">
                <div class="row row-cols-2">
                    <div class="col-sm-2"><button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">Delete Portfolio</button></div>
                    <div class="col-sm-3"><a href="updatePortfolio" class="btn btn-sm btn-info">Update Portfolio</a></div>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="row justify-content-center mt-4">
        <div class="col-sm-4">
            <a href="createPortfolio" class="btn btn-info">Create Portfolio</a>
        </div>
    </div>
    @endif
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Portfolio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this portfolio ?</p>
            </div>
            <div class="modal-footer">
                <a href="deletePortfolio" class="btn btn-danger">Confirm</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection