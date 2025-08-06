<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fritter's Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffb6c1;
            margin: 0;
            padding-top: 60px; /* for navbar */
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            transition: box-shadow 0.3s;
        }

        .profile-img:hover {
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .navbar {
            background-color: #ff69b4 !important;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('home') }}">Fritter's Blog</a>

            <div class="d-flex align-items-center ms-auto">
                @auth
                    <!-- Profile Icon with Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Profile" class="profile-img">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="profileDropdown">
                            <li class="px-3 py-2">
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <small>{{ Auth::user()->email }}</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('posts.create') }}">Create Post</a></li>
                            <li><a class="dropdown-item" href="{{ route('posts.index') }}">My Posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-light ms-2">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
