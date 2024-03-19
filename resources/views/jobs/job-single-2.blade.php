@extends('landing-layouts.master')

@section('content')

<x-main-site.hero-component total-jobs="{{ $totalJobs }}" job-title="{{ isset($jobTitle) ? $jobTitle : '' }}" job-type="{{ isset($jobType) ? $jobType : '' }}" location="{{ isset($location) ? $location : '' }}" />

<div class="ftco-section bg-light" id="jobDetails">
  <div class="container">
   <div class="row">
          <div class="col-md-8 col-lg-8 mb-5">
            <div class="p-5 bg-white">
              <div class="mb-4 mb-md-5 mr-5">
                <div class="job-post-item-header d-flex align-items-center">

                  <h2 class="mr-3 text-black h4">{{ $job->title }}</h2>
                  <div class="badge-wrap">
                    @if ($job->job_type == 'part-time') <span class="bg-primary text-white badge py-2 px-3">Part-time</span> @elseif ($job->job_type == 'full-time') <span class="bg-warning text-white badge py-2 px-3">Full-time</span> @elseif ($job->job_type == 'freelance') <span class="bg-info text-white badge py-2 px-3">Freelance</span> @elseif ($job->job_type == 'internship') <span class="bg-secondary text-white badge py-2 px-3">Internship</span> @elseif ($job->job_type == 'temporary') <span class="bg-danger text-white badge py-2 px-3">Temporary</span> @endif 
                  </div>
                </div>
                <div class="job-post-item-body d-block d-md-flex">
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
                  <div class="{{ $job->deadline->isToday() || $job->deadline->isPast() ? 'text-danger' : '' }}">
                        <i class="far fa-calendar-alt text-primary me-2 mr-1"></i>Date Line: {{ $job->deadline->format('d M, Y') }}
                  </div>
                </div>
              </div>
              <div class="mb-1">
                <h4>Job description</h4>
                <p>{{ $job->description }}</p>
              </div>
              <div class="mb-1">
                <h4>Job Type</h4>
                <p>{{ $job->job_type }}</p>
              </div>
              <div class="mb-1">
              @switch($job->education)
                                    @case('0')
                                        @php $education = "Elementary level or graduate"; @endphp
                                        @break
                                    @case('1')
                                        @php $education = "Secondary level or graduate"; @endphp
                                        @break
                                    @case('2')
                                        @php $education = "Vocational Course Graduate"; @endphp
                                        @break
                                    @case('3')
                                        @php $education = "College level"; @endphp
                                        @break
                                    @case('4')
                                        @php $education = "Graduate of any IT related course"; @endphp
                                        @break
                                    @case('5')
                                        @php $education = "Graduate of any Arts or Sciences related course"; @endphp
                                        @break
                                    @case('6')
                                        @php $education = "Graduate of any Engineering related course"; @endphp
                                        @break
                                    @case('7')
                                        @php $education = "Graduate of any Business related course"; @endphp
                                        @break
                                    @case('8')
                                        @php $education = "Graduate of any Medicine related course"; @endphp
                                        @break
                                    @case('9')
                                        @php $education = "Graduate of any Education related course"; @endphp
                                        @break
                                    @case('11')
                                        @php $education = "Masters of any Technology and Computer Science Degrees"; @endphp
                                        @break
                                    @case('12')
                                        @php $education = "Masters of any Creative Arts Degrees"; @endphp
                                        @break
                                    @case('13')
                                        @php $education = "Masters of any Engineering and Technology Management Degrees"; @endphp
                                        @break
                                    @case('14')
                                        @php $education = "Masters of any Business Management Degrees"; @endphp
                                        @break
                                    @case('15')
                                        @php $education = "Masters of any Healthcare Degrees"; @endphp
                                        @break
                                    @case('16')
                                        @php $education = "Masters of any Education Degrees"; @endphp
                                        @break
                                    @case('17')
                                        @php $education = "Doctorates in any Computer or IT related Degrees"; @endphp
                                        @break
                                    @case('18')
                                        @php $education = "Doctorates in any Arts or Sciences related Degrees"; @endphp
                                        @break
                                    @case('19')
                                        @php $education = "Doctorates in any Engineering related Degrees"; @endphp
                                        @break
                                    @case('20')
                                        @php $education = "Doctorates in any Business related Degrees"; @endphp
                                        @break
                                    @case('21')
                                        @php $education = "Doctorates in any Medicine related Degrees"; @endphp
                                        @break
                                    @case('22')
                                        @php $education = "Doctorates in any Education related Degrees"; @endphp
                                        @break                            
                                @endswitch
                <h4>Education</h4>
                <p>{{ $education }}</p>
              </div>

              <div class="mb-1">
              @switch($job->yrOfexp)
                                    @case('0')
                                        @php $exp = "None"; @endphp
                                        @break
                                    @case('1')
                                        @php $exp = "1-6 mos"; @endphp
                                        @break
                                    @case('2')
                                        @php $exp = "7-12 mos"; @endphp
                                        @break
                                    @case('3')
                                        @php $exp = "1-2 yrs"; @endphp
                                        @break
                                    @case('4')
                                        @php $exp = "2 yrs and above"; @endphp
                                        @break    
                                @endswitch
                <h4>Years of Relevant Experience  </h4>
                <p>{{ $exp }}</p>
              </div>

              <div class="mb-1">
              @switch($job->eligibility)
                                    @case('0')
                                        @php $el = "None Required"; @endphp
                                        @break
                                    @case('1')
                                        @php $el = "CS Sub-professional"; @endphp
                                        @break
                                    @case('2')
                                        @php $el = "CS Professional"; @endphp
                                        @break
                                    @case('3')
                                        @php $el = "Licensed Professional"; @endphp
                                        @break  
                                @endswitch
                <h4>Eligibility  </h4>
                <p>{{ $el }}</p>
              </div>

              <div class="mb-1">
                <h4>Requirements</h4>
                <p>{{ $job->requirements }}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="p-4 mb-3 bg-white">
              <p>
                <a href="{{ route('job-apply', [$job->id, '#jobApplication']) }}" class="btn btn-primary btn-block py-2 px-4" style="width:100%;">Apply</a>
              </p>
            </div>
          </div>
        </div>
  </div>
</div>
@endsection