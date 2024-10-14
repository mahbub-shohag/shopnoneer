<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Shopno Neer</title>
    <link type="text/css" href="{{ asset('assets/css/custom-styles.css') }}" rel="stylesheet"> <!-- Include custom CSS -->
    <link type="text/css" href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* CSS from your provided code */

        * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: url('/assets/img/sky.jpg') no-repeat center center fixed; /* Add background image */

            background-size: cover; /* Ensure the image covers the entire viewport */
        }

        .container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .circle-container {
            position: absolute;
            top: 0; /* Make sure it starts from the top */
            left: 0; /* Align it to the left */
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: hidden; /* Hide overflow */
        }

        .circle {
            position: absolute; /* Absolute positioning */
            border-radius: 50%;
            mix-blend-mode: screen;
            background-image: radial-gradient(
                    hsl(180, 100%, 80%),
                    hsl(180, 100%, 80%) 10%,
                    hsla(180, 100%, 80%, 0) 56%
            );

            animation: fadein-frames 200ms infinite, scale-frames 2s infinite;
        }

        @keyframes fadein-frames {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @keyframes scale-frames {
            0% { transform: scale3d(0.4, 0.4, 1); }
            50% { transform: scale3d(2.2, 2.2, 1); }
            100% { transform: scale3d(0.4, 0.4, 1); }
        }

        /* New styles for login card */
        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
            width: 100%; /* Make it full width */
            max-width: 700px; /* Set max width for larger screens */
            margin: 0 auto; /* Center align */
            border-radius: 20px; /* Optional: Add border radius for rounded corners */
        }

        .card-header {
            background-color: teal; /* Keep header color */
        }

        .btn-primary {
            background-color: teal; /* Change button color to teal */
            border: none; /* Remove border */
        }

        .btn-primary:hover {
            background-color: #005f5f; /* Darker teal on hover */
        }

        .small a {
            color: teal; /* Change link color to teal */
        }

        .small a:hover {
            text-decoration: underline; /* Optional: underline on hover */
        }

        /* Transparent input fields */
        .form-control {
            font-size: 18px; /* Increase font size */
            background-color: rgba(255, 255, 255, 0.3); /* Set background to be semi-transparent */
            border: 1px solid rgba(255, 255, 255, 0.7); /* Border color */
            color: black; /* Text color */
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Placeholder color */
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.5); /* Change background on focus */
            border-color: teal; /* Border color on focus */
            box-shadow: 0 0 5px teal; /* Optional: add a shadow */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="circle-container">
        @for ($i = 1; $i <= 100; $i++)
            @php
                // Randomize the size and position for each circle
                $circleSize = rand(5, 25); // Random size between 5px and 25px
                $startPositionX = rand(0, 100); // Random start position on the X-axis
                $startPositionY = rand(100, 150); // Start below the viewable area
                $duration = rand(20000, 40000); // Random duration for movement
            @endphp
            <div class="circle" style="
                    width: {{ $circleSize }}px;
                    height: {{ $circleSize }}px;
                    left: {{ $startPositionX }}vw;
                    animation: move-frames-{{ $i }} {{ $duration }}ms infinite;">
            </div>

            <style>
                @keyframes move-frames-{{ $i }} {
                    0% {
                        transform: translate3d(0, {{ $startPositionY }}vh, 0);
                    }
                    100% {
                        transform: translate3d(0, -10vh, 0);
                    }
                }
            </style>
        @endfor
    </div>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header text-center bg-teal text-white">
                                <h3 class="font-weight-light my-4">Shopno Neer</h3>
                            </div>
                            <div class="card-body">
                                <h3 class="text-center">Sign In</h3>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" required />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small text-teal" href="password.html">Forgot Password?</a> <!-- Changed to teal color -->
                                        <button class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="signup">Need an account? Sign up!</a></div> <!-- Kept link background transparent -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between ">
                        <div class="text-muted">Copyright &copy;2024 Mahbub Alam, CSE, Jagannath University</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
</body>
</html>
