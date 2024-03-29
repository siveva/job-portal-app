<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use App\Models\JobSeeker;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    
    

    public function index()
    {


        $jobs = JobListing::with('employer')->latest()->paginate(5);
        return view('jobseekers.want-a-job', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = auth()->user();
        // if ($user->job_seeker) {
        //     return redirect()->route('jobseeker.dashboard');
        // }
        // return view('jobseeker.fill-up');

        $user = Auth::user();
        // Retrieve the unread notifications count
        $unreadNotificationsCount = $user->unreadNotifications()->count();

        // $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(5)->get();
        $notifications = Notification::where('receiver_id', $user->id)->get()->toArray();


        return view('jobseekers.fill-up',compact('unreadNotificationsCount','notifications'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);
    
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeName = $resume->getClientOriginalName();
            $resumeExtension = $resume->getClientOriginalExtension();
            $newResumeName = 'resume_' . time() . '.' . $resumeExtension;
    
            $resume->move(public_path('uploads/resumes'), $newResumeName);
            $resumePath = 'uploads/resumes/' . $newResumeName;
        } else {
            $resumePath = null;
        }
    
        $jobSeeker = new JobSeeker([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'resume' => $resumePath,
        ]);
    
        $user->jobSeeker()->save($jobSeeker);
    
        return redirect()->route('jobseeker.dashboard');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Http\Response
     */
    public function show(JobSeeker $jobSeeker)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

            // Retrieve the unread notifications count
            $unreadNotificationsCount = $user->unreadNotifications()->count();

            // $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(5)->get();
            $notifications = Notification::where('receiver_id', $user->id)->get()->toArray();

        $jobseeker = JobSeeker::where('user_id', $user->id)->first();
        return view('jobseekers.jobseeker-overview', compact('jobseeker','unreadNotificationsCount','notifications'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();
    
        if (!$jobSeeker) {
            abort(404); // or handle the case when the jobseeker is not found
        }
    
        // Validate the input
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
    
        // Update the job seeker information
        $jobSeeker->first_name = $request->input('first_name');
        $jobSeeker->last_name = $request->input('last_name');
        $jobSeeker->phone_number = $request->input('phone_number');
        $jobSeeker->address = $request->input('address');
    
        if ($request->hasFile('resume')) {
            // Handle uploaded resume
            $resume = $request->file('resume');
            $resumePath = $resume->store('uploads/resumes', 'public');
            $jobSeeker->resume = $resumePath;
        }
    
        $jobSeeker->save();
    
        return redirect()->back()->with('success', 'Jobseeker information updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobSeeker $jobSeeker)
    {
        //
    }


    public function appliedJobs()
    {
        $appliedJobs = Application::with(['jobListing'])->where('job_seeker_id', Auth::id())->get();
     
              $user = Auth::user();
              // Retrieve the unread notifications count
              $unreadNotificationsCount = $user->unreadNotifications()->count();

              // $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(5)->get();
              $notifications = Notification::where('receiver_id', $user->id)->get()->toArray();
      
          
        return view('jobseekers.applied_jobs', compact('appliedJobs','unreadNotificationsCount','notifications'));
    }

    public function cancelJobApplication(Request $request, $id)
    {
        $application = Application::find($id);
        $application->status = 'canceled';
        $application->save();

        return redirect()->back()->with('sucess', 'Application was canceled.');
    }

    public function dashboard(){
        $user = Auth::user();
        $appliedJobCount = $user->applications()->count();

        $acceptedJobCount = Application::where('job_seeker_id', $user->id)
        ->where('status', 'accepted')
        ->count();

          // Retrieve the unread notifications count
        $unreadNotificationsCount = $user->unreadNotifications()->count();

        // $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(5)->get();
        $notifications = Notification::where('receiver_id', $user->id)->get()->toArray();

        return view('jobseekers.dashboard', compact('appliedJobCount', 'acceptedJobCount', 'unreadNotificationsCount', 'notifications'));
        
    }

    


}
