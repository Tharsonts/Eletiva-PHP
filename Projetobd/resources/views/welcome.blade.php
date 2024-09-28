<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #ebedee 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .card-body {
            padding: 2rem;
            background: #ffffff;
        }
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
            padding: 0.8rem;
            font-size: 1.1rem;
        }
        .card-title {
            margin-bottom: 2rem;
            font-weight: 600;
            font-size: 1.5rem;
            color: #333;
        }
        .text-center {
            color: #555;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title text-center">Sistema de Exposições de Arte</h5>
                @auth
                    <a href="/dashboard" class="btn btn-primary">
                        Acessar Painel de Controle
                    </a>
                @else
                    <a href="/login" class="btn btn-primary">
                        Acessar o Sistema
                    </a>
                    <a href="/register" class="btn btn-outline-primary">
                        Criar Conta
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
