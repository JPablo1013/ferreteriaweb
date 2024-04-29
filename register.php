<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Registrarse</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<h1>REGISTRAR</h1>
<form action="proces.php" method="post">
    <!-- nombre input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">nombre</label>
        <input type="name" id="form2Example1" class="form-control" name="nombre">
        
    </div>
    <!-- primer apellido input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Primer apellido</label>
        <input type="text" id="form2Example2" class="form-control" name="primer_apellido" />
    </div>
    <!-- segundo apellido input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example3">segundo apellido</label>
        <input type="text" id="form2Example3" class="form-control" name="segundo_apellido" />
    </div>
    <!-- rfc input -->
    <div class="form-outline mb-4">
         <label class="form-label" for="form2Example4">RFC</label>
        <input type="text" id="form2Example4" class="form-control" name="rfc" />
    </div>

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


    <!-- Submit button -->
    <input type="submit" class="btn btn-primary btn-block mb-4" value="Register">

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