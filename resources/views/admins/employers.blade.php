@extends('admins.layouts.app')

@section('content')

<h1 class="mt-4">Employers</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Employers</li>
</ol>
<div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Employer List
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
        
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobSeekerModal">
                <i class="fa fa-plus"></i> {{ __('Add Job Seeker') }}
            </button> --}}
            
        </div>

        <div class="table-responsive">
            <table class="table table-condensed table-striped data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employer Name</th>
                        <th>Email</th>
                        <th>Company Name</th>
                        <th>Company Description</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employers  as $employer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employer->name }}</td>
                            <td>{{ $employer->email }}</td>
                            <td>{{ $employer->employer->company_name }}</td>
                            <td>{{ $employer->employer->company_description }}</td>
                            <td>{{ date("m-d-Y", strtotime($employer->created_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ __('No job seekers found.') }}</td>
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
                        <p>{{ __('Are you sure you want to delete employer: ') }}<strong><span id="deletEmployerName"></span></strong>?</p>
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


