@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Search Job Posts</h3>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form action="/candidate/job-search" method="GET" class="row g-3">
        <div class="col-md-8">
            <input type="text" name="query" class="form-control" placeholder="Search by position, location, or company name" required>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>
</div>

