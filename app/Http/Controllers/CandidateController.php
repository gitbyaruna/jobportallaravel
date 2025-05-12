<?php 

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\JobPost;
// use App\Models\Application;
// use Illuminate\Support\Facades\Auth;
use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function searchJobs(Request $request)
    {
        $search = $request->input('search');

        $jobPosts = JobPost::where('position', 'like', "%$search%")
            ->orWhere('company_name', 'like', "%$search%")
            ->orWhere('department', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%")
            ->get();

        return view('dashboard.candidate', compact('jobPosts'));
    }

    public function apply(JobPost $jobPost)
    {
        $user = Auth::user();

        // Store application
        Application::create([
            'user_id' => $user->id,
            'job_post_id' => $jobPost->id,
        ]);

        return redirect()->back()->with('success', 'You have successfully applied to this job.');
    }


    public function showApplyForm(JobPost $jobPost)
    {
        return view('candidate.apply-form', compact('jobPost'));
    }
    

   // CandidateController

   public function submitApplication(Request $request, JobPost $jobPost)
   {
       // Validate the application form data
       $validated = $request->validate([
           'name' => 'required|string',
           'email' => 'required|email',
           'phone' => 'required|string',
           'address' => 'required|string',
           'position' => 'required|string',
           'resume' => 'nullable|mimes:pdf|max:2048',
       ]);
   
       $resumePath = null;
if ($request->hasFile('resume')) {
    $resumePath = $request->file('resume')->store('resumes', 'public');
}
       // Create the application record
       $application = new Application();
       $application->job_post_id = $jobPost->id;
       $application->user_id = auth()->id();
       $application->name = $validated['name'];
       $application->email = $validated['email'];
       $application->phone = $validated['phone'];
       $application->address = $validated['address'];
       $application->position = $validated['position'];
       $application->resume = $resumePath;
       $application->department = $jobPost->department;
$application->location = $jobPost->location;
       $application->save();
   
       // Get the employer's email dynamically from the job post
    //    $employerEmail = $jobPost->employer->user->email;
    //    if ($employerEmail) {
    //     Mail::to($employerEmail)->send(new ApplicationSubmitted($application));
    // }
    $employerEmail = $jobPost->employer?->user?->email;

    if ($employerEmail) {
        // Mail::to('test@example.com')->send(new TestMail());
        Mail::to($employerEmail)->send(new ApplicationSubmitted($application));
    } else {
        \Log::warning('No employer email found for JobPost ID: ' . ($jobPost->id ?? 'N/A'));
    }
    
    
   
       // Redirect to the dashboard with a success message
       return redirect()->route('candidate.dashboard')->with('success', 'Application submitted successfully.');
   }


}

