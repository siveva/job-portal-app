@extends('landing-layouts.master')

@section('content')

<x-main-site.hero-component total-jobs="{{ $totalJobs }}" job-title="{{ isset($jobTitle) ? $jobTitle : '' }}" job-type="{{ isset($jobType) ? $jobType : '' }}" location="{{ isset($location) ? $location : '' }}" />

<div class="ftco-section bg-light" id="jobApplication">
  <div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <h2 class="mb-4">
            Job Application
          </h2>
        </div>
      </div>
   <div class="row">
          <div class="col-md-6 col-lg-6 mb-5">
            <div class="p-5 bg-white">
              <div class="mb-4 mb-md-5 mr-5">
                <div class="job-post-item-header d-flex align-items-center">
                  <h2 class="mr-3 text-black h4">{{ $job->title }}</h2>
                  <div class="badge-wrap">
                    @if ($job->job_type == 'part-time') <span class="bg-primary text-white badge py-2 px-3">Part-time</span> @elseif ($job->job_type == 'full-time') <span class="bg-warning text-white badge py-2 px-3">Full-time</span> @elseif ($job->job_type == 'freelance') <span class="bg-info text-white badge py-2 px-3">Freelance</span> @elseif ($job->job_type == 'internship') <span class="bg-secondary text-white badge py-2 px-3">Internship</span> @elseif ($job->job_type == 'temporary') <span class="bg-danger text-white badge py-2 px-3">Temporary</span> @endif 
                  </div>
                </div>
                <div class="job-post-item-body d-block ">
                  <div class="mr-3">
                    <i class="fas fa-layer-group text-success"></i>
                    <a href="#">{{ $job->employer->employer ? $job->employer->employer->company_name : NULL }}</a>
                  </div>
                  <div class="mr-3">
                    <i class="fa fa-map-marker-alt text-success mr-1"></i>
                    <span>{{ $job->location }}</span>
                  </div>
                  <div class="mr-3">
                    <i class="far fa-money-bill-alt text-success mr-1"></i><span> &#8369; {{ number_format($job->salary, 2) }}</span>
                  </div>
                  <div>
                        <i class="far fa-calendar-alt text-primary me-2 mr-1"></i>Date Line: {{ $job->deadline->format('d M, Y') }}
                  </div>
                </div>
              </div>
              <div class="mb-5">
                <h4 class="mb-3">Job description</h4>
                <p>{{ $job->description }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 mb-5">
            <div class="p-5 bg-white">
                <div class="job-post-item-header d-flex align-items-center">
                  <h2 class="mr-3 text-black h4">{{ Auth::user()->name }}</h2>
                </div>
                <hr>
                <form action="{{ route('job-apply.store', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="">Resume</label>
                      <input type="file" name="resume" id="resume" class="form-control" aria-describedby="helpId" required>
                    </div>
                    <div class="form-group">
                <label for="education">Educational Attainment</label>
                    <select id="education" class="form-control" name="education" required>
                        <option></option>
                        <option value="0">Elementary level or graduate</option>
                        <option value="1">Secondary level or graduate</option>
                        <option value="2">Vocational Course Graduate</option>
                        <option value="3">College level</option>
                        <option value="4">Graduate of any IT related course</option>
                        <option value="5">Graduate of any Arts or Sciences related course</option>
                        <option value="6">Graduate of any Engineering related course</option>
                        <option value="7">Graduate of any Business related course</option>
                        <option value="8">Graduate of any Medicine related course</option>
                        <option value="9">Graduate of any Education related course</option>
                    </select>
            </div>

            <div class="form-group">
                <label for="yrOfexp">{{ __('Range of relevant experience') }}</label>
                    <select id="yrOfexp" class="form-control" name="yrOfexp" required autocomplete="job_type">
                        <option></option>
                        <option value="0">None</option>
                        <option value="1">1-6 mos</option>
                        <option value="2">7-12 mos</option>
                        <option value="3">1-2 yrs</option>
                        <option value="4">2 yrs and above</option>
                    </select>
            </div>
                    <div class="form-group">
                        <label for="">Cover Letter</label>
                        <textarea class="form-control" name="letter" id="letter" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
  </div>
</div>
@endsection