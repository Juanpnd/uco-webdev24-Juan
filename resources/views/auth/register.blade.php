<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Create Account</h4>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <!-- Name Input -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        
                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        
                        <!-- Password Input -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        
                        <!-- Password Confirmation Input -->
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter your password" required>
                        </div>
                        
                        <!-- Register Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">Register</button>
                        </div>
                    </form>

                    <!-- Link to Login -->
                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="{{ route('login') }}" class="link-primary">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
