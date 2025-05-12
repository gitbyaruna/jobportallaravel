@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Apply for {{ $jobPost->position }}</h3>

    <form method="POST" action="{{ route('candidate.job.apply', $jobPost->id) }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" name="position" class="form-control" value="{{ $jobPost->position }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>

    <a href="{{ route('candidate.dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>
@endsection
