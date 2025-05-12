@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Search Results for "{{ $query }}"</h3>

    @if($jobPosts->isEmpty())
        <p>No job posts found.</p>
    @else
        <div class="list-group">
            @foreach($jobPosts as $jobPost)
                <div class="list-group-item mb-3">
                    <h5>{{ $jobPost->position }}</h5>
                    <p><strong>Company:</strong> {{ $jobPost->company_name }}</p>
                    <p><strong>Department:</strong> {{ $jobPost->department }}</p>
                    <p><strong>Location:</strong> {{ $jobPost->location }}</p>

                    <a href="{{ route('candidate.job.apply.form', $jobPost->id) }}" class="btn btn-success btn-sm">Apply</a>
                </div>
            @endforeach
        </div>
    @endif
    
    
    <!-- <form method="POST" action="/candidate/apply/{jobPost}', $jobPost->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Apply</button>
                </form> -->

    <a href="{{ route('candidate.dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>
@endsection
