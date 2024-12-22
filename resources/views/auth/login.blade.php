<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEaCiQhrRtx1W12iw3PQGhvA9BU6B0" 
        crossorigin="anonymous"
    >
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Login</h4>
                        
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            
                            <!-- Email Input -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            
                            <!-- Password Input -->
                            <div class="form-group mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            
                            <!-- Login Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>

                        <!-- Link to Registration or Forgot Password -->
                        <div class="mt-3 text-center">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="link-primary">Register</a></p>
                            <p><a href="{{ route('password.request') }}" class="link-primary">Forgot your password?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-qQ4P0xjkKt4pykPTjAlYZXovKZQ8xVWB1ndRfuKDaAoFfAP1Hs1k3xkcpJx4lSDF" 
        crossorigin="anonymous"
    ></script>
</body>
</html>
