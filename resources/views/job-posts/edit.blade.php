@extends('layouts.app') {{-- Optional: if you have a layout --}}

@section('content')
<div class="container">
    <h2>Edit Job Post</h2>
   
    <form method="POST" action="{{ route('employer.job-post.update', $jobPost->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" name="position" value="{{ $jobPost->position }}" required>
        </div>

        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="company_name" value="{{ $jobPost->company_name }}" required>
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" name="department" value="{{ $jobPost->department }}" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="{{ $jobPost->location }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Job Post</button>
        <a href="{{ route('employer.job-post') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
