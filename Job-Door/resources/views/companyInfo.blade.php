@extends('layout.jpDashboardLayout')

@section('title')
CompanyInfo
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-auto m-3">
            <a href="companyinfocreate" class="btn btn-primary btn-sm">Add Job Vacency Post</a>
        </div>
    </div>
    @if(isset($job))
    @foreach($job as $j)
    <div class="row">
        <div class="col-auto m-3">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title mb-4">{{$j->job_title}}</h4>
                    <h6 class="card-subtitle mb-1"><strong>Job Description</strong></h6> -->
                    <!-- <p class="card-text mb-4">{{$j->job_description}}</p> -->
                    <h6 class="card-subtitle mb-1"><strong>Company Name</strong></h6>
                    <p class="card-text mb-4">{{$j->company_name}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Company Email</strong></h6>
                    <p class="card-text mb-4">{{$j->company_email}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Company Website</strong></h6>
                    <p class="card-text mb-4">{{$j->website}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Company Facebookpage</strong></h6>
                    <p class="card-text mb-4">{{$j->fbpagelink}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Company Website</strong></h6>
                    <p class="card-text mb-4">{{$j->website}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Company Address</strong></h6>
                    <p class="card-text mb-4">{{$j->company_address}}</p>

                    <!-- <h6 class="card-subtitle mb-1"><strong>Location</strong></h6>
                    <p class="card-text mb-4">{{$j->job_location_type}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Vacency Count</strong></h6>
                    <p class="card-text mb-5">{{$j->vacency_count}}</p>
                    <h5 class="card-subtitle mb-3"><strong>Salary</strong></h5>
                    <h5 class="card-text mb-4 text-warning">{{$j->salary}}</h5> -->
                    <a href="/jobvacencyUpdate-{{$j->id}}" class="btn btn-sm btn-info">Update</a>
                    <a href="/jobvacency-{{$j->id}}" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif



</div>


@endsection