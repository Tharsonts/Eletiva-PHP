<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle - Sistema de Exposições de Arte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #001022;
            overflow: hidden;
        }

        nav {
            display: flex;
            justify-content: space-between;
            background-color: #343a40;
            padding: 10px 20px;
        }

        nav a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.1rem;
        }

        nav a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-container {
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">Sistema da Empresa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('artists.index')); ?>">Cadastrar Artistas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('artworks.index')); ?>">Cadastrar Obras de Arte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('expositions.index')); ?>">Cadastrar Exposições</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?>

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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center" style="color: #fff; font-weight: bold;">Painel de Controle - Sistema de Exposições de Arte</h3>
            <p class="text-center text-muted">Visualize e gerencie os dados das exposições, obras e artistas</p>
        </div>
    </div>
</div>

<div class="container chart-container mt-5">
    <div id="chart"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                width: '100%',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                },
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Quantidade',
                data: [<?php echo e($totalArtists); ?>, <?php echo e($totalArtworks); ?>, <?php echo e($totalExpositions); ?>]
            }],
            xaxis: {
                categories: ['Artistas', 'Obras de Arte', 'Exposições'],
            },
            yaxis: {
                title: {
                    text: 'Quantidade'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#00FFFF']
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " itens";
                    }
                }
            },
            theme: {
                mode: 'dark'
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var scene = new THREE.Scene();
            var camera = new THREE.PerspectiveCamera(75, window.innerWidth / 600, 0.1, 1000);
            var renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(window.innerWidth, 600);
            document.getElementById('threejsChart').appendChild(renderer.domElement);

            var controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableZoom = true;
            controls.enableDamping = true;
            controls.dampingFactor = 0.25;

            var barData = [12, 19, 3, 5, 2, 3];
            var barWidth = 0.5, barSpacing = 1;
            var barMaterials = new THREE.ShaderMaterial({
                uniforms: {
                    color1: { value: new THREE.Color('#ff7f00') },
                    color2: { value: new THREE.Color('#00E396') },
                },
                vertexShader: `
                    varying vec3 vPosition;
                    void main() {
                        vPosition = position;
                        gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                    }
                `,
                fragmentShader: `
                    varying vec3 vPosition;
                    uniform vec3 color1;
                    uniform vec3 color2;
                    void main() {
                        gl_FragColor = vec4(mix(color1, color2, vPosition.y / 10.0), 1.0);
                    }
                `,
                wireframe: false,
            });

            barData.forEach(function (value, index) {
                var geometry = new THREE.BoxGeometry(barWidth, value, barWidth);
                var bar = new THREE.Mesh(geometry, barMaterials);
                bar.position.x = index * (barWidth + barSpacing);
                bar.position.y = value / 2;
                scene.add(bar);
            });

            var pointLight = new THREE.PointLight(0xffffff, 1, 100);
            pointLight.position.set(5, 10, 10);
            scene.add(pointLight);

            var ambientLight = new THREE.AmbientLight(0x404040);
            scene.add(ambientLight);

            camera.position.z = 15;

            var animate = function () {
                requestAnimationFrame(animate);
                controls.update();
                renderer.render(scene, camera);
            };

            animate();

            window.addEventListener('resize', function () {
                var width = window.innerWidth;
                var height = 600;
                renderer.setSize(width, height);
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
            });
        });
    </script>
</body>
</html><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/dashboard.blade.php ENDPATH**/ ?>