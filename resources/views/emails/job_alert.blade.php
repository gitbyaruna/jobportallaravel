<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Job Alert</title>
</head>
<body>
    <h1>New Job Opportunity</h1>

    <p><strong>Position:</strong> {{ $job->position }}</p>
    <p><strong>Company:</strong> {{ $job->company_name }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Department:</strong> {{ $job->department }}</p>

    <p><a href="{{ url('/candidate/jobs') }}">View All Jobs</a></p>

    <p>Thanks for reaching out</p>
    <!-- <p>Thanks for reaching out,<br>{{ config('app.name') }}</p> -->
</body>
</html>

