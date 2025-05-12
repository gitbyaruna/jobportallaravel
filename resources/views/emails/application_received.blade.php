<!-- resources/views/emails/application_received.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Job Application</title>
</head>
<body>
    <h1>New Application for Job Post: {{ $application->position }}</h1>
    <p><strong>Name:</strong> {{ $application->name }}</p>
    <p><strong>Email:</strong> {{ $application->email }}</p>
    <p><strong>Phone:</strong> {{ $application->phone }}</p>
    <p><strong>Address:</strong> {{ $application->address }}</p>
    <p><strong>Position Applied for:</strong> {{ $application->position }}</p>
</body>
</html>

