@extends('employers.layouts.app')
@prepend('pages-css')
    <style>
        /* body {
            background-color: #353135;
        } */
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
@endprepend
@section('content')

<h1 class="mt-4">Application for {{ $application->jobListing->title }}</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('employer.jobList') }}">Jobs</a></li>
    <li class="breadcrumb-item active">Application for {{ $application->jobListing->title }}</li>
</ol>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                @if($application->status === "pending")
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#popupModalRejectApplication">Reject Application</button>
                    {{--<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#popupModalAcceptApplication">Accept Application</button>--}} 
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#popupModalScheduleInterviewApplication">Schedule for Interview</button> 
                @else
                    @if($application->status === "accepted")
                        <h5><span class="badge rounded-pill bg-success">Application Status: {{ Str::ucfirst($application->status) }} <i class="fa fa-check" aria-hidden="true"></i></span></h5>   
                    @elseif($application->status === "canceled")
                        <h5><span class="badge rounded-pill bg-danger">Application Status: {{ Str::ucfirst($application->status) }} <i class="fa fa-times" aria-hidden="true"></i></span></h5> 
                    @else
                        <h5><span class="badge rounded-pill bg-danger">Application Status: {{ Str::ucfirst($application->status) }} <i class="fa fa-times" aria-hidden="true"></i></span></h5> 
                    @endif
                @endif            
                <x-confirmation-modal modal-id="popupModalAcceptApplication" title="Confirm Application Action" message="Are you sure you want to accept {{ $application->jobSeeker->name }} application?" confirm-text="Yes, Accept">
                    <form action="{{ route('applications.update', [$application->id, 'type' =>  'accept']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                    </form>
                </x-confirmation-modal>
                <x-confirmation-modal modal-id="popupModalScheduleInterviewApplication" title="Confirm Schedule for Interview Action" message="Are you sure you want to schedule for interview {{ $application->jobSeeker->name }}?" confirm-text="Yes, Schedule for Interview">
                    <form action="{{ route('applications.update', [$application->id, 'type' =>  'schedule_for_interview']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label for="message" class="form-label mt-3 fw-bold">Message</label>
                          <textarea class="form-control" rows="10" name="message" id="message"></textarea>
                        </div>
                    </form>
                </x-confirmation-modal>
                <x-confirmation-modal modal-id="popupModalRejectApplication" title="Confirm Application Action" message="Are you sure you want to reject {{ $application->jobSeeker->name }} application?" confirm-text="Yes, Reject">
                    <form action="{{ route('applications.update', [$application->id, 'type' =>  'reject']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                    </form>
                </x-confirmation-modal>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{ $application->jobSeeker->name }}</span><span class="text-black-50">{{ $application->jobSeeker->email }}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Firstname</label><input type="text" class="form-control" placeholder="first name" value="{{ $application->jobSeeker->jobSeeker->first_name }}" readonly></div>
                    <div class="col-md-6"><label class="labels">Lastname</label><input type="text" class="form-control" value="{{ $application->jobSeeker->jobSeeker->last_name }}" readonly placeholder="surname"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="{{ $application->jobSeeker->jobSeeker->phone_number }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="enter phone number" value="{{ $application->jobSeeker->email }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address line 1" value="{{ $application->jobSeeker->jobSeeker->address }}" readonly></div>
                    {{-- <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
                    <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div> --}}
                </div>
                {{-- <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div> --}}
                {{-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Application</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <a href="{{ route('applications.download.resume', $application->id) }}" class="btn btn-primary btn-sm">Download Resume<i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                </div>
                @switch($application->education)
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
                                @switch($application->yrOfexp)
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
                                @switch($application->eligibility)
                                    @case('0')
                                        @php $el = "None"; @endphp
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
                <div class="row mt-2">
                    <label><b>Educational Attainment</b></label>
                    <p>* {{ $education }}</p>
                </div>
                <div class="row mt-2">
                    <label><b>Range of Relevant Experience</b></label>
                    <p>* {{ $exp }}</p>
                </div>
                <div class="row mt-2">
                    <label><b>Eligibility</b></label>
                    <p>* {{ $el }}</p>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <textarea class="form-control" rows="10" cols="10" readonly>{{ $application->cover_letter }}</textarea>
                    </div>
                </div>
            </div>
            {{-- <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div> --}}
        </div>
    </div>
</div>
</div>
</div>
@endsection
@push('pages-script')
<script>
$(document).ready(function () {
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