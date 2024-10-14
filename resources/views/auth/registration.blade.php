<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Registration - Shopno Neer</title>
  <link type="text/css" href="{{ asset('assets/css/custom-styles.css') }}" rel="stylesheet"> <!-- Include custom CSS -->
  <link type="text/css" href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    /* Styles for the animated background and other elements */

    * {
      margin: 0;
      padding: 0;
    }

    html,
    body {
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    body {
      background-color: #021027; /* Fallback for dark background */
      background: url('/assets/img/sky.jpg') no-repeat center center fixed; /* Add background image */
      background-size: cover; /* Cover the entire background */
      background-position: center; /* Center the background image */
      background-repeat: no-repeat; /* Prevent tiling */
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

    /* Custom styles for the form */
    .card {
      background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
      padding: 40px; /* Increase padding around the card */
      width: 100%; /* Make it full width */
      max-width: 700px; /* Set max width for larger screens */
      margin: 0 auto; /* Center align */
      border-radius: 20px; /* Optional: Add border radius for rounded corners */
    }

    .small a {
      color: teal; /* Change link color to teal */
    }

    .form-control {
      height: 60px; /* Increase height of input fields */
      font-size: 18px; /* Increase font size */
      padding: 10px; /* Increase padding inside inputs */
      background-color: rgba(255, 255, 255, 0.3); /* Set background to be semi-transparent */
      border: 1px solid rgba(255, 255, 255, 0.7); /* Border color */
    }

    .btn {
      width: 100%; /* Make button full width */
      padding: 15px; /* Increase button height */
      font-size: 18px; /* Increase button font size */
      border-radius: 5px; /* Round button corners */
    }

    .card-header h3 {
      font-size: 24px; /* Increase size of header */
    }

    .small a {
      font-size: 16px; /* Increase font size of the link */
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
              <div class="card-header bg-teal text-white">
                <h3 class="font-weight-light my-4">Shopno Neer</h3>
              </div>
              <div class="card-body">
                <h3 class="text-center">Sign Up</h3>
                <form method="POST" action="{{ route('signup') }}">
                  @csrf
                  <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter Name" required />
                    <label for="inputName">Name</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="name@example.com" required />
                    <label for="inputEmail">Email address</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required />
                    <label for="inputPassword">Password</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password" required />
                    <label for="inputConfirmPassword">Confirm Password</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <div class="card-footer text-center py-3 text-teal ">
                <div class="small"><a href="login">Have an account? Sign In!</a></div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>
