@extends('layout.DashboardLayout')

@section('title')
Job Finder
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-auto m-3">
            <h2>Apply for Job</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group mb-3">
                <label for="job_search" class="form-label">Search for job:</label>
                <input type="search" class="form-control" name="job_search" placeholder="Enter company name, job type....." id="job_search">

            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-auto m-3 job-posts">
            <!-- @if(isset($job))
            @foreach($job as $j) -->
            <!-- <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{$j->job_title}}</h4>
                    <h6 class="card-subtitle mb-1"><strong>Job Description</strong></h6>
                    <p class="card-text mb-4">{{$j->job_description}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Company Name</strong></h6>
                    <p class="card-text mb-4">{{$j->company_name}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Type</strong></h6>
                    <p class="card-text mb-4">{{$j->job_type}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Address</strong></h6>
                    <p class="card-text mb-4">{{$j->address}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Location</strong></h6>
                    <p class="card-text mb-4">{{$j->job_location_type}}</p>
                    <h6 class="card-subtitle mb-1"><strong>Vacency Count</strong></h6>
                    <p class="card-text mb-5">{{$j->vacency_count}}</p>
                    <h5 class="card-subtitle mb-3"><strong>Salary</strong></h5>
                    <h5 class="card-text mb-4 text-warning">{{$j->salary}}</h5>
                    <a href="#" class="btn btn-sm btn-info">View Company Info</a>
                    <a href="#" class="btn btn-sm btn-danger">Apply</a>
                    <a href="#" class="btn btn-sm btn-info">Report</a>
                </div>
            </div> -->
            <!-- @endforeach
            @endif -->
        </div>
    </div>



</div>



@endsection