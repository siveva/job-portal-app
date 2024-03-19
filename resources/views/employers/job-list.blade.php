@extends('employers.layouts.app')

@section('content')

<h1 class="mt-4">My Job Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Jobs</li>
</ol>
<div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Job Posts
        </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('job.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> {{ __('Post a Job') }}
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-condensed table-striped data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Job Title') }}</th>
                        <th>{{ __('Applications') }}</th>
                        {{-- <th>{{ __('Status') }}</th> --}}
                        <th>Location</th>
                        <th>Salary</th>
                        <th>{{ __('Date Posted') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $job->title }}</td>
                            <td>
                                
                                <a href="{{ route('applications.index', ['id' => $job->id]) }}">
                                    <h5><span class="badge bg-success"><i class="fas fa-eye"></i> Show <span class="badge bg-black">{{ $job->applications_count }}</span></span></h5>
                                </a>
                            </td>
                            <td>{{ $job->location }}</td>
                            <td style="color: green">{{ number_format($job->salary, 2) }}</td>
                            {{-- <td>{{ $job->status }}</td> --}}
                            <td>{{ $job->created_at->format('Y-m-d') }}</td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <a href="{{ route('job.edit', $job->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                    <button type="button" class="btn btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $job->id }}" data-name="{{ $job->title }}"><i class="fas fa-trash"></i> {{ __('Delete') }}</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>{{ __('No jobs found.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
                        <p>{{ __('Are you sure you want to delete the job: ') }}<strong><span id="jobTitle"></span></strong>?</p>
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
<script>
    // Handle delete button click
    $('.deleteBtn').on('click', function() {
        // console.log('dal');
        var jobId = $(this).data('id');
        var jobTitle = $(this).data('name');
        $('#deleteForm').attr('action', '/jobs/' + jobId);
        $('#jobTitle').text(jobTitle);
    });
</script>
@endpush

