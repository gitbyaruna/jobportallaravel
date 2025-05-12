<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    // Store the job post in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'position' => 'required|string',
            'company_name' => 'required|string',
            'department' => 'required|string',
            'location' => 'required|string',
        ]);

        // Check if the logged-in user has an employer associated
        $employer = Auth::user()->employer;

        if (!$employer) {
            return redirect()->route('employer.dashboard')->with('error', 'Employer not found for this user.');
        }

        // Create the job post with the employer's ID
        JobPost::create([
            'position' => $request->position,
            'company_name' => $request->company_name,
            'department' => $request->department,
            'location' => $request->location,
            'employer_id' => $employer->id, // Safe access to employer id
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('employer.dashboard')->with('success', 'Job post created successfully!');
    }
   
    // Show all job posts for the employer
    public function showAll()
    {
        // Get the employer's job posts
        $employer = Auth::user()->employer;

        // Debugging step: Check if employer is found
        if (!$employer) {
            return redirect()->route('employer.dashboard')->with('error', 'Employer not found for this user.');
        }

        // Get all job posts created by the employer
        $jobPosts = JobPost::where('employer_id', $employer->id)->get();

        // Debugging step: Check if job posts are found
        if ($jobPosts->isEmpty()) {
            return redirect()->route('employer.dashboard')->with('error', 'No job posts found for this employer.');
        }

        // Return a view with all job posts
        return view('dashboard.all-job-posts', compact('jobPosts'));
    }


    public function edit(JobPost $jobPost)
    {
        // Check if the logged-in user is the employer of this job post
        $employer = Auth::user()->employer;

        if ($jobPost->employer_id != $employer->id) {
            return redirect()->route('employer.dashboard')->with('error', 'Unauthorized access!');
        }

        return view('job-posts.edit', compact('jobPost'));
    }

    // Update the job post in the database
    public function update(Request $request, JobPost $jobPost)
    {
        // Validate the form data
        $request->validate([
            'position' => 'required|string',
            'company_name' => 'required|string',
            'department' => 'required|string',
            'location' => 'required|string',
        ]);

        // Check if the logged-in user is the employer of this job post
        $employer = Auth::user()->employer;

        if ($jobPost->employer_id != $employer->id) {
            return redirect()->route('employer.dashboard')->with('error', 'Unauthorized access!');
        }

        // Update the job post
        $jobPost->update([
            'position' => $request->position,
            'company_name' => $request->company_name,
            'department' => $request->department,
            'location' => $request->location,
        ]);

        // Redirect to the job post list with a success message
        return redirect()->route('employer.job-post')->with('success', 'Job post updated successfully!');
    }

    public function destroy(JobPost $jobPost)
{
    // Check if the logged-in user is the employer of this job post
    $employer = Auth::user()->employer;

    if ($jobPost->employer_id != $employer->id) {
        return redirect()->route('employer.dashboard')->with('error', 'Unauthorized access!');
    }

    // Delete the job post
    $jobPost->delete();

    // Redirect to the job post list with a success message
    return redirect()->route('employer.job-post')->with('success', 'Job post deleted successfully!');
}


public function search(Request $request)
{
    $query = $request->input('query');

    $jobPosts = JobPost::where('position', 'like', "%{$query}%")
        ->orWhere('location', 'like', "%{$query}%")
        ->orWhere('company_name', 'like', "%{$query}%")
        ->get();

    return view('job-posts.search-results', compact('jobPosts', 'query'));
}

}