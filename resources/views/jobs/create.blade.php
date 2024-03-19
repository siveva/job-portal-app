@extends('employers.layouts.app')

@prepend('pages-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endprepend

@section('content')

<h1 class="mt-4">Post Job</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Create</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Input Job Information
    </div>
    <div class="card-body">
    
     
        <form method="POST" action="{{ route('job.store') }}">
            @csrf

            <div class="form-group row mb-3">
                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
            
                <div class="col-md-6">
                    <select id="category" class="form-control @error('categories') is-invalid @enderror" name="categories[]" multiple required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="job_type" class="col-md-4 col-form-label text-md-right">{{ __('Job Type') }}</label>

                <div class="col-md-6">
                    <select id="job_type" class="form-control @error('job_type') is-invalid @enderror" name="job_type" required autocomplete="job_type">
                        <option value="part-time">Part-time</option>
                        <option value="full-time">Full-time</option>
                        <option value="freelance">Freelance</option>
                        <option value="internship">Internship</option>
                        <option value="temporary">Temporary</option>
                        <option value="job order">Job Order</option>
                        <option value="contract of service">Contract of Service</option>
                    </select>
                    @error('job_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-6">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location">

                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

                <div class="col-md-6">
                    <input id="salary" type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" required autocomplete="salary">

                    @error('salary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}</label>
            
                <div class="col-md-6">
                    <select id="education" class="form-control @error('education') is-invalid @enderror" name="education" required>
                        <option></option>
                        <option value="0">Elementary level or graduate</option>
                        <option value="1">Secondary level or graduate</option>
                        <option value="2">Vocational Course Graduate</option>
                        <option value="3">College level</option>
                        <option value="10">Any Bachelors degree holder</option>
                        <option value="4">Graduate of any Computer or IT related course</option>
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
                    @error('education')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="yrOfexp" class="col-md-4 col-form-label text-md-right">{{ __('Yrs of relevant experience') }}</label>

                <div class="col-md-6">
                    <select id="yrOfexp" class="form-control @error('yrOfexp') is-invalid @enderror" name="yrOfexp" required autocomplete="job_type">
                        <option></option>
                        <option value="0">None required</option>
                        <option value="1">1-6 mos</option>
                        <option value="2">7-12 mos</option>
                        <option value="3">1-2 yrs</option>
                        <option value="4">2 yrs and above</option>
                    </select>
                    @error('yrOfexp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="yrOfexp" class="col-md-4 col-form-label text-md-right">{{ __('Eligibility') }}</label>

                <div class="col-md-6">
                    <select id="eligibility" class="form-control @error('eligibility') is-invalid @enderror" name="eligibility" required autocomplete="job_type">
                        <option></option>
                        <option value="0">None required</option>
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
            

            <div class="form-group row mb-3">
                <label for="requirements" class="col-md-4 col-form-label text-md-right">{{ __('Requirements') }}</label>

                <div class="col-md-6">
                    <textarea id="requirements" class="form-control @error('requirements') is-invalid @enderror" name="requirements" required autocomplete="requirements">{{ old('requirements') }}</textarea>
                    @error('requirements')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="deadline" class="col-md-4 col-form-label text-md-right">{{ __('Deadline') }}</label>

                <div class="col-md-6">
                    <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" required autocomplete="deadline">

                    @error('deadline')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>
            </div>  

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
        </form> 

      
    </div>
</div>



@endsection

@push('pages-script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#category').select2();
        });
    </script>

@endpush


