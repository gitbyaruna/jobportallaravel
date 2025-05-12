@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">All Job Posts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($jobPosts->isEmpty())
        <div class="alert alert-info">No job posts available.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($jobPosts as $jobPost)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $jobPost->position }}</h5>
                            <p class="card-text">
                                <strong>Company:</strong> {{ $jobPost->company_name }}<br>
                                <strong>Department:</strong> {{ $jobPost->department }}<br>
                                <strong>Location:</strong> {{ $jobPost->location }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('employer.job-post.edit', $jobPost->id) }}" class="btn btn-sm btn-warning">Edit</a>


                            <form action="{{ route('job-post.destroy', $jobPost->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
