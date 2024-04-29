<form action="login.php?action=recovery&token=<?php echo $token ?>" method="post">
    <!-- Password input -->
    <h1>Establece tu nueva contraseña</h1>
    <div class="form-outline mb-4">
        <input type="password" id="form2Example2" class="form-control" name="password" />
        <label class="form-label" for="form2Example2">Password</label>
    </div>
    
    <!-- Submit button -->
    <input type="submit" class="btn btn-primary btn-block mb-4" value="Login">

</form>