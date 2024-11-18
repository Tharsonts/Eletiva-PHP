<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Exposições de Arte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('fund/style.css')); ?>">
    <style>
        body {
            background-color: transparent;
            font-family: 'Orbitron', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #00ffea;
            font-size: 3rem;
            text-shadow: 0 0 10px #00ffea;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #00ffea;
            color: #000;
            border-radius: 30px;
            padding: 15px 40px;
            font-size: 1rem;
            font-weight: bold;
            width: auto;
            display: inline-block;
            margin: 0 auto;
            text-align: center;
            transition: background 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #00e5cc;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<canvas id="canvas"></canvas>

<div class="container">
    <div class="card">
        <h1>Sistema de Exposições de Arte</h1>
        <a href="/login" class="btn btn-primary">Acessar o Sistema</a>
    </div>
</div>

<script src="<?php echo e(asset('fund/script.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/welcome.blade.php ENDPATH**/ ?>