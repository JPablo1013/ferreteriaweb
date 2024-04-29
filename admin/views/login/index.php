<form action="login.php?action=login" method="post">
    
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="form2Example1" class="form-control" name="correo">
        <label class="form-label" for="form2Example1">Correo</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="form2Example2" class="form-control" name="password" />
        <label class="form-label" for="form2Example2">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="login.php?action=forgot">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <input type="submit" class="btn btn-primary btn-block mb-4" value="Login">

    <!-- Register buttons -->
    <div class="text-center">
        <p>Not a member? <a href="../register.php">Register</a></p>
        <p>or sign up with:</p>
        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-google"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-twitter"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-github"></i>
        </button>
    </div>
</form>