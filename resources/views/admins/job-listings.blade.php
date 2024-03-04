@extends('admins.layouts.app')

@section('content')

<h1 class="mt-4">Job Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Job Posts</li>
</ol>
<div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Job Post List
        </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
        
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobModalPost
                <i class="fa fa-plus"></i> {{ __('Add Job Post') }}
            </button> --}}
            
        </div>

        <div class="table-responsive">
            <table class="table table-condensed table-striped data-table" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Education</th>
                        <th>Experience</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Employer</th>
                        <th>Deadline</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobPosts  as $jobPost)
                    @switch($jobPost->education)
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
                                    @case('10')
                                        @php $education = "Any Bachelors degree"; @endphp
                                        @break                        
                                @endswitch
                                @switch($jobPost->yrOfexp)
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
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                            <td style="font-size: 12px">{{ $jobPost->title }}</td>
                            <td style="font-size: 12px">{{ $education }}</td>
                            <td style="font-size: 12px">{{ $exp }}</td>
                            <td>{{ $jobPost->location }}</td>
                            <td style="color: green">{{ number_format($jobPost->salary, 2) }}</td>
                            <td>{{ $jobPost->employer->employer ? $jobPost->employer->employer->company_name : NULL }}</td>
                            <td>{{ date("m-d-Y", strtotime($jobPost->deadline)) }}</td>
                            <td>{{ date("m-d-Y", strtotime($jobPost->created_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>{{ __('No job posts found.') }}</td>
                            <td><td><td><td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</div>




        <!-- Modal to confirm job deletion -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">{{ __('Confirm Delete') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are you sure you want to delete job post: ') }}<strong><span id="deletejobTitle"></span></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('pages-script')
<script>
            $(document).ready(function () {
                $('.data-table').DataTable();
                
            });
</script>
@endpush

