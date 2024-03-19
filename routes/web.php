<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployerController as AdminEmployerController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\JobSeekerController as AdminJobSeekerController;
use App\Http\Controllers\Employer\JobApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSeeker\NotificationController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use App\Models\JobListing;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WebsiteController::class, 'landingPage'])->name('site.landing.page');
Route::get('/search-jobs', [WebsiteController::class, 'searchJobs'])->name('site.search.jobs');

Auth::routes();


Route::get('/want-a-job', [JobSeekerController::class, 'index'])->name('want-a-job');

// Route::get('/post-a-job', [JobController::class, 'd'])->name('post-a-job');

Route::get('job-single/{id}', [JobController::class, 'show'])->name('job-single');
Route::get('job/apply/{id}', [JobController::class, 'showJobApplicationForm'])->name('job-apply')->middleware(['auth', 'job.deadline']);
Route::post('job/apply/{id}', [JobController::class, 'applyJob'])->name('job-apply.store')->middleware(['auth']);



Route::middleware(['auth'])->group(function () {

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



});


// middleware for employer
Route::middleware(['auth', 'employer'])->group(function () {
    // Routes for employer
    Route::get('/employer/fill-up', [EmployerController::class, 'create'])->name('employer.fill-up');
    Route::post('/employer/store', [EmployerController::class, 'store'])->name('employer.store');
    Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
    Route::get('/employer/job/list', [EmployerController::class, 'jobList'])->name('employer.jobList');
    Route::get('/employer/overview/edit', [EmployerController::class, 'edit'])->name('employer.overview.edit');
    Route::put('/employer/overview/update', [EmployerController::class, 'update'])->name('employer.overview.update');



    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/job/store', [JobController::class, 'store'])->name('job.store');
    Route::delete('/jobs/{jobListing}', [JobController::class,'destroy'])->name('job.destroy');
    Route::get('/job/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::put('/job/update/{job}', [JobController::class, 'update'])->name('job.update');

    Route::put('/user/employer/update/{id}', [UserController::class, 'updateProfile'])->name('user.employer.update');
    Route::put('/user/employer/pass/update/{id}', [UserController::class, 'changePassword'])->name('user.employer.changePassword');

    // Route::get('/jobs/{id}/applicants', [App\Http\Controllers\JobController::class, 'showApplicants'])->name('job.applicants');

    Route::prefix('employer')->group(function(){
        Route::prefix('jobs')->group(function(){
            Route::resource('applications', JobApplicationController::class);
            Route::get('unQualified', [JobApplicationController::class, 'unQualified'])->name('applications.unQualified');
            Route::get('applications/download/resume/{id}', [JobApplicationController::class, 'downloadResume'])->name('applications.download.resume');
        });
    });

});

// middleware for jobseeker
Route::middleware(['auth', 'jobseeker'])->group(function () {
    // Routes for jobseeker
    Route::get('/jobseeker/fill-up', [JobSeekerController::class, 'create'])->name('jobseeker.fill-up');
    Route::post('/jobseeker/store', [JobSeekerController::class, 'store'])->name('jobseeker.store');
    Route::get('/jobseeker/dashboard', [JobSeekerController::class, 'dashboard'])->name('jobseeker.dashboard');

    Route::get('/jobseeker/overview/edit', [JobSeekerController::class, 'edit'])->name('jobseeker.overview.edit');
    Route::put('/jobseeker/overview/update', [JobSeekerController::class, 'update'])->name('jobseeker.overview.update');

    Route::put('/user/jobseeker/update/{id}', [UserController::class, 'updateProfile'])->name('user.jobseeker.update');
    Route::put('/user/jobseeker/pass/update/{id}', [UserController::class, 'changePassword'])->name('user.jobseeker.changePassword');
    Route::get('/applied-jobs', [JobSeekerController::class, 'appliedJobs'])->name('jobseeker.appliedJobs');
    Route::put('cancel/applied-jobs/{id}', [JobSeekerController::class, 'cancelJobApplication'])->name('jobseeker.cancel.application');

    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);
});


Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/job-listings', [JobListingController::class])->name('admin.job-listings.index');
    Route::get('/employers', [JobListingController::class])->name('admin.employers.index');
    Route::get('/job-seekers', [JobListingController::class])->name('admin.job-seekers.index');
    Route::get('/categories', [JobListingController::class])->name('admin.categories.index');
    Route::put('/user/update/{id}', [AdminController::class, 'updateProfile'])->name('user.admin.update');
    Route::put('/user/pass/update/{id}', [AdminController::class, 'changePassword'])->name('user.admin.changePassword');
   // Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
   // Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

    // routing for categories
    Route::resource('categories', CategoryController::class)->names([

        'index'=>'admin.categories.index',
        // 'show'=>'admin.categories.show',
        // 'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit',
        'update'=>'admin.categories.update',
        'destroy'=>'admin.categories.destroy',
    ]);

        // routing for job seeker
        Route::resource('job-seekers', AdminJobSeekerController::class)->names([

            'index'=>'admin.job-seekers.index',
            // 'show'=>'admin.job-seekers.show',
            // 'create'=>'admin.job-seekers.create',
            'store'=>'admin.job-seekers.store',
            'edit'=>'admin.job-seekers.edit',
            'update'=>'admin.job-seekers.update',
            'destroy'=>'admin.job-seekers.destroy',
        ]);

        // routing for employer
        Route::resource('employers', AdminEmployerController::class)->names([

            'index'=>'admin.employers.index',
            // 'show'=>'admin.employers.show',
            // 'create'=>'admin.employers.create',
            'store'=>'admin.employers.store',
            'edit'=>'admin.employers.edit',
            'update'=>'admin.employers.update',
            'destroy'=>'admin.employers.destroy',
        ]);

        // routing for job listing
        Route::resource('job-listings', JobListingController::class)->names([

            'index'=>'admin.job-listings.index',
            // 'show'=>'admin.job-listings.show',
            // 'create'=>'admin.job-listings.create',
            'store'=>'admin.job-listings.store',
            'edit'=>'admin.job-listings.edit',
            'update'=>'admin.job-listings.update',
            'destroy'=>'admin.job-listings.destroy',
        ]);

});
