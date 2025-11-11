<?php
// No queremos el layout completo aquí, es una página simple.
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body { height: 100%; }
        body { display: flex; align-items: center; justify-content: center; background-color: #f5f5f5; }
        .form-signin { max-width: 400px; padding: 15px; }
    </style>
</head>
<body class="text-center">
    
    <main class="form-signin w-100 m-auto">
        <form action="<?php echo BASE_URL; ?>admin/authenticate" method="POST">
            <h1 class="h3 mb-3 fw-normal">Acceso Admin</h1>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="admin@colegio.cl" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                <label for="password">Contraseña</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Ingresar</button>
            <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?></p>
        </form>
    </main>

</body>
</html>