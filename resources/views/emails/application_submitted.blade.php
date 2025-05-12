<!-- resources/views/emails/application_submitted.blade.php -->
<p>A new job application has been submitted:</p>
<ul>
    <li><strong>Name:</strong> {{ $name }}</li>
    <li><strong>Email:</strong> {{ $email }}</li>
    <li><strong>Phone:</strong> {{ $phone }}</li>
    <li><strong>Address:</strong> {{ $address }}</li>
    <li><strong>Position:</strong> {{ $position }}</li>
</ul>
