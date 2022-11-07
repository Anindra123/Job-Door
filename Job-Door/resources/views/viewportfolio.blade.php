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
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            @foreach($sk_list as $sk)
                            <span class="badge m-2 ps-4 pe-4 pt-3 pb-3 bg-primary rounded-pill">{{$sk}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="container p-3 mb-3 border border-primary">
                <div class="row mx-auto align-items-center">
                    <div class="col-sm-8">
                        <h3 class="mb-3 mt-3">Current Experience</h3>
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
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
    @endif
</div>