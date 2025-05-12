@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Welcome, {{ Auth::user()->name }}!</h2>
        <h4>Create a New Job Post</h4>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Job Post Creation Form -->
        <form action="{{ route('employer.job-post.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" name="position" id="position" required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" name="company_name" id="company_name" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" class="form-control" name="department" id="department" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>
<br>
            <button type="submit" class="btn btn-primary">Create Job Post</button>
            
        </form>
        <br>
        <a href="/employer/job-post">
    <button class="btn btn-primary">Show All Job Posts</button>
</a>
    </div>
@endsection

