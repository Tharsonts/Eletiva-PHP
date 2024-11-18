<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle - Sistema de Exposições de Arte</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('funddash/style.css')); ?>">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        #background-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
        }

        nav.navbar {
            display: flex;
            justify-content: space-between;
            background-color: rgba(10, 25, 47, 0.2);
            padding: 10px 20px;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        nav a {
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 1.1rem;
        }
        nav a:hover {
            background-color: transparent;
            border-radius: 8px;
        }

        .container {
            margin-top: 80px; 
            padding: 20px;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>
    <canvas id="background-canvas"></canvas>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard"><i class="fas fa-home"></i> Sistema da Empresa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('artists.index')); ?>"><i class="fas fa-palette"></i> Cadastrar Artistas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('artworks.index')); ?>"><i class="fas fa-paint-brush"></i> Cadastrar Obras de Arte</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('expositions.index')); ?>"><i class="fas fa-image"></i> Cadastrar Exposições</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <?php echo e(Auth::user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/profile">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content">
        <h3>Painel de Controle - Sistema de Exposições de Arte</h3>
        <div id="chart"></div>
    </div>

    <script src="<?php echo e(asset('funddash/script.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'bar',
                    height: 500,
                    toolbar: { show: false },
                    background: 'transparent'
                },
                series: [{
                    name: 'Quantidade',
                    data: [<?php echo e($totalArtists); ?>, <?php echo e($totalArtworks); ?>, <?php echo e($totalExpositions); ?>]
                }],
                xaxis: {
                    categories: ['Artistas', 'Obras de Arte', 'Exposições'],
                    labels: { style: { colors: '#00FFFF', fontSize: '16px' } }
                },
                yaxis: {
                    labels: { style: { colors: '#00FFFF' } },
                    title: { text: 'Quantidade', style: { color: '#00FFFF' } },
                    min: 0,
                    forceNiceScale: true
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: "vertical",
                        gradientToColors: ["#00FF99", "#0099FF"],
                        opacityFrom: 0.8,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#FFFFFF']
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        horizontal: false
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/dashboard.blade.php ENDPATH**/ ?>