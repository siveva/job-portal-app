@extends('admins.layouts.app')

@section('content')

<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Job Posts
                <h4 class="text-center">{{ number_format($jobCount) }}</h4>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="{{ route('admin.job-listings.index') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Employers
                <h4 class="text-center">{{ number_format($employerCount) }}</h4>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="{{ route('admin.employers.index') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Job Seekers
                <h4 class="text-center">{{ number_format($seekerCount) }}</h4>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="{{ route('admin.job-seekers.index') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Categories
                <h4 class="text-center">{{ number_format($categoryCount) }}</h4>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="{{ route('admin.categories.index') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>


@endsection
