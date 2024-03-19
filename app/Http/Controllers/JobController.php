<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function d(){
    //     return view('jobs.post-a-job');
    // }

    public function index()
    {

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('jobs.post-a-job');
        
    // }

    public function create()
    {
        // return view('job_listings.post-a-job');
        
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
            // Validate the form data
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'location' => 'required|max:255',
                'salary' => 'required|numeric',
                'job_type' => 'required',
                'requirements' => 'required',
                'deadline' => 'required|date',
                'education' => 'required',
                'yrOfexp' => 'required',
                'eligibility' => 'required',
                'categories' => 'required|array|min:1', // added categories validation rules
                'categories.*' => 'exists:categories,id' // added categories validation rules
            ]);
        
            // Create a new Job instance and fill it with the form data
            $job = new JobListing();
            $job->title = $validatedData['title'];
            $job->description = $validatedData['description'];
            $job->location = $validatedData['location'];
            $job->salary = $validatedData['salary'];
            $job->job_type = $validatedData['job_type'];
            $job->requirements = $validatedData['requirements'];
            $job->deadline = $validatedData['deadline'];
            $job->education = $validatedData['education'];
            $job->yrOfexp = $validatedData['yrOfexp'];
            $job->eligibility = $validatedData['eligibility'];
        
            // Get the authenticated employer and associate the job with them
            // $employer = Auth::user()->employer;
            // $employer->jobListings()->save($job);

            $user = Auth::user();
            $user->jobListings()->save($job);
        
            // Attach the selected categories to the job
            $job->categories()->attach($validatedData['categories']);
        
            // Redirect to the employer's dashboard with a success message
            return redirect()->route('employer.jobList')->with('success', 'Job posted successfully.');
        }
        

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
        $job = JobListing::findOrFail($id);
        return view('jobs.job-single-2', compact('job'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function edit(JobListing $job)
    {
        $categories = Category::all();
         return view('jobs.edit', compact('job','categories'));
        
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobListing $job)
    {
        // Validate the form data
        // return $job;
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'salary' => 'required|numeric',
            'job_type' => 'required',
            'requirements' => 'required',
            'deadline' => 'required|date',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id'
        ]);

        // return $jobListing;
    
        // Update the job listing with the new data
        $job->title = $validatedData['title'];
        $job->description = $validatedData['description'];
        $job->location = $validatedData['location'];
        $job->salary = $validatedData['salary'];
        $job->job_type = $validatedData['job_type'];
        $job->requirements = $validatedData['requirements'];
        $job->deadline = $validatedData['deadline'];
    
        // Get the authenticated user's employer and associate it with the job listing
        // $employer = Auth::user();
        // $jobListing->employer()->associate($employer);
    
        // Save the updated job listing
        $job->save();
    
        // Sync the categories with the provided list
        $job->categories()->sync($validatedData['categories']);
    
        // Redirect to the employer's dashboard with a success message
        return redirect()->route('employer.jobList')->with('success', 'Job updated successfully.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobListing $jobListing)
    {
        $jobListing->delete();
        return redirect()->route('employer.jobList')->with('success', 'Job deleted successfully.');

    }

    public function showJobApplicationForm($id)
    {
        $job = JobListing::findOrFail($id);
        return view('jobs.job-apply', compact('job'));
    }

    public function applyJob(Request $request, $id)
    {
        // $this->validate($request,[
        //     'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        //     'letter'    =>  'required|min:5'
        // ]);

        $job = JobListing::find($id);

        if ($request->file('resume')->isValid()) {
            $path = $request->file('resume')->store('resumes');
        }

        if($job->eligibility == "0") {
            $shortlisted = $this->shortlist($job, $request);
        }
        else if($job->eligibility == "2" && ($request->eligibility == "2" || $request->eligibility == "3")){
            $shortlisted = $this->shortlist($job, $request);
        }
        else if($job->eligibility == $request->eligibility) {
            $shortlisted = $this->shortlist($job, $request);
        }
        else {
            $shortlisted = "no";
        }

        $job->applications()->create([
            'job_seeker_id'    =>  Auth::id(),
            'cover_letter'  =>  $request->letter,
            'resume'  =>  $path,
            'status'    => 'pending',
            'education' => $request->education,
            'yrOfexp' => $request->yrOfexp,
            'shortlisted' => $shortlisted,
            'eligibility' => $request->eligibility
        ]);

        return redirect()->route('jobseeker.appliedJobs')->with('success', 'Application was successfully submitted');
    }

private function shortlist($job, $request)
{
    if($job->education == "10") {
        if($request->education > 10  && $job->yrOfexp == "0"){
            $shortlisted = "yes";
        }
        else if($request->education > 10  && $request->yrOfexp >= $job->yrOfexp){
            $shortlisted = "yes";
        }
        else if($request->education >= "4" && $job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->education >= "4" && $request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        } 
        else {
            $shortlisted = "no";
        }
    } 
    else if($job->education == $request->education) {
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education <= "3" && $request->education >= "3") {
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education <= "3" && $request->education >= $job->education) {
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "4" && ($request->education == "11" || $request->education == "17" || $request->education == "4")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "5" && ($request->education == "12" || $request->education == "18" || $request->education == "5")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "6" && ($request->education == "13" || $request->education == "19" || $request->education == "6")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "7" && ($request->education == "14" || $request->education == "20" || $request->education == "7")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "8" && ($request->education == "15" || $request->education == "21" || $request->education == "8")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "9" && ($request->education == "16" || $request->education == "22" || $request->education == "9")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "11" && ($request->education == "17" || $request->education == "11")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "12" && ($request->education == "18" || $request->education == "12")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "13" && ($request->education == "19" || $request->education == "13")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "14" && ($request->education == "20" || $request->education == "14")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "15" && ($request->education == "21" || $request->education == "15")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else if($job->education == "16" && ($request->education == "22" || $request->education == "16")){
        if($job->yrOfexp == "0") {
            $shortlisted = "yes";
        }
        else if($request->yrOfexp >= $job->yrOfexp) {
            $shortlisted = "yes";
        }
        else {
            $shortlisted = "no";
        }
    }
    else {
        $shortlisted = "no";
    }

    return $shortlisted;
}

}
