<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
    <div class="container mt-3">
    <header>
        @auth
            <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light border rounded">
                <div>
                    <h4>
                        @if(Auth::user()->role === 'employer')
                            Employer
                        @elseif(Auth::user()->role === 'candidate')
                            Candidate
                        @endif
                    </h4>
                </div>
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
        <header>

        <div class="container mt-3">
            @yield('content')
        </div>
    </div>
</body>

</html>
