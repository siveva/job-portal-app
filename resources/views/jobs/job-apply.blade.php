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
                        <option value="11">Masters of any Technology and Computer Science Degrees</option>
                        <option value="12">Masters of any Creative Arts Degrees</option>
                        <option value="13">Masters of any Engineering and Technology Management Degrees</option>
                        <option value="14">Masters of any Business Management Degrees</option>
                        <option value="15">Masters of any Healthcare Degrees</option>
                        <option value="16">Masters of any Education Degrees</option>
                        <option value="17">Doctorates in any Computer or IT related Degrees</option>
                        <option value="18">Doctorates in any Arts or Sciences related Degrees</option>
                        <option value="19">Doctorates in any Engineering related Degrees</option>
                        <option value="20">Doctorates in any Business related Degrees</option>
                        <option value="21">Doctorates in any Medicine related Degrees</option>
                        <option value="22">Doctorates in any Education related Degrees</option>
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
            <div class="form-group row mb-3">
                <label for="yrOfexp" class="col-md-4 col-form-label text-md-right">{{ __('Eligibility') }}</label>

                <div class="col-md-6">
                    <select id="eligibility" class="form-control @error('eligibility') is-invalid @enderror" name="eligibility" required autocomplete="job_type">
                        <option></option>
                        <option value="0">None</option>
                        <option value="1">CS Sub-professional</option>
                        <option value="2">CS Professional</option>
                        <option value="3">Licensed Professional</option>
                    </select>
                    @error('eligibility')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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