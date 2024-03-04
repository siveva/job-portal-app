@extends('employers.layouts.app')

@section('content')

<h1 class="mt-4">{{ $job->title }} <span style="font-style: italic;color: blue;">Shortlisted</span> Applicants</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('employer.jobList') }}">Jobs</a></li>
    <li class="breadcrumb-item active">{{ $job->title }} Applicants</li>
</ol>
<x-messages.success-message/>
<x-messages.error-message/>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        List of Applicants
        <span style="float: right"><a href="{{ route('applications.unQualified', ['id' => $_GET['id']]) }}">View Unshortlisted Applicants</a></span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-condensed table-striped data-table">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Fullname</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobApplications as $jobApplication)
                    @switch($jobApplication->education)
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
                                @endswitch
                                @switch($jobApplication->yrOfexp)
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
                            <td>{{ $jobApplication->id }}</td>
                            <td>{{ $jobApplication->seeker->last_name. ", ".$jobApplication->seeker->first_name }}</td>
                            <td>{{ $jobApplication->seeker->phone_number }}</td>
                            <td>{{ $jobApplication->jobSeeker->email }}</td>
                            <td style="font-size: 11px">{{ $jobApplication->seeker->address }}</td>
                            <td>{{ date("m-d-Y", strtotime($jobApplication->created_at)) }}</td>
                            <td>
                                @switch($jobApplication->status)
                                    @case('accepted')
                                        <span class="badge bg-success" style="padding: 9px">{{ ucfirst($jobApplication->status) }}</span>
                                        @break
                                    @case('scheduled_for_interview')
                                        <span class="badge bg-success" style="padding: 9px">Scheduled for Interview</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger" style="padding: 9px">{{ ucfirst($jobApplication->status) }}</span>
                                        @break
                                    @case('canceled')
                                        <span class="badge bg-danger" style="padding: 9px">{{ ucfirst($jobApplication->status) }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary" style="padding: 9px">{{ ucfirst($jobApplication->status) }}</span>
                                @endswitch
                            </td>
                            <td>
                                    <a href="{{ route('applications.show', $jobApplication->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a>                                     
                                    {{--@if($jobApplication->status == "pending")
                                        <button type="button" class="btn btn-success btn-sm modal-trigger-button" data-bs-toggle="modal" data-bs-target="#popupModalAcceptApplication{{ $jobApplication->id }}"><i class="fas fa-check"></i> Accept</button>
                                        <button type="button" class="btn btn-primary btn-sm modal-trigger-button" data-bs-toggle="modal" data-bs-target="#popupModalScheduleForInterviewApplication{{ $jobApplication->id }}"><i class="fas fa-clock"></i> Schedule for Interview</button>
                                        <button type="button" class="btn btn-danger btn-sm modal-trigger-button" data-bs-toggle="modal" data-bs-target="#popupModalRejectApplication{{ $jobApplication->id }}"><i class="fas fa-times"></i> Reject</button>
                                        <x-confirmation-modal modal-id="popupModalAcceptApplication{{ $jobApplication->id }}" title="Confirm Application Action" message="Are you sure you want to accept {{ $jobApplication->jobSeeker->name }} application?" confirm-text="Yes, Accept">
                                            <form action="{{ route('applications.update', [$jobApplication->id, 'type' =>  'accept']) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        </x-confirmation-modal>
                                        <x-confirmation-modal modal-id="popupModalScheduleForInterviewApplication{{ $jobApplication->id }}" title="Confirm Application Action" message="Are you sure you want to schedule for interview {{ $jobApplication->jobSeeker->name }}?" confirm-text="Yes, Schedule for Interview">
                                            <form action="{{ route('applications.update', [$jobApplication->id, 'type' =>  'schedule_for_interview']) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="message" class="form-label mt-3 fw-bold">Message</label>
                                                    <textarea class="form-control" rows="10" name="message" id="message"></textarea>
                                                  </div>
                                            </form>
                                        </x-confirmation-modal>
                                        <x-confirmation-modal modal-id="popupModalRejectApplication{{ $jobApplication->id }}" title="Confirm Application Action" message="Are you sure you want to reject {{ $jobApplication->jobSeeker->name }} application?" confirm-text="Yes, Reject">
                                            <form action="{{ route('applications.update', [$jobApplication->id, 'type' =>  'reject']) }}" method="POST" class="d-inline mt-5">
                                                @csrf
                                                @method('PUT')
                                                {{-- <div class="mb-3 mt-3">
                                                  <label for="message" class="form-label">Message</label>
                                                  <textarea class="form-control" rows="8" name="message"></textarea>
                                                </div> --}}
                                            {{--</form>
                                        </x-confirmation-modal>
                                    @endif--}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                         <td>No applicants found.</td>
                         <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@push('pages-script')
<script>
$(document).ready(function () {
    $('.data-table').DataTable();
    
    $(document).on('show.bs.modal', '.confirmation-modal', function () {
        $(this).find('.modal-confirmation-button').on('click', function () {
            const form = $(this).closest('.confirmation-modal').find('form');
            console.log(form);
            form.submit();
        });
    });
});
</script>
@endpush
