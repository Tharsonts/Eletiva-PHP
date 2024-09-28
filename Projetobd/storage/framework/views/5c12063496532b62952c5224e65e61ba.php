<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <!-- Page Title -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center" style="color: #333; font-weight: bold;">Painel de Controle - Sistema de Exposições de Arte</h3>
                <p class="text-center text-muted">Visualize e gerencie os dados das exposições, obras e artistas</p>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5 class="card-title text-center">Artistas</h5>
                        <p class="card-text text-center"><?php echo e($totalArtists); ?> Artistas Cadastrados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5 class="card-title text-center">Obras de Arte</h5>
                        <p class="card-text text-center"><?php echo e($totalArtworks); ?> Obras Cadastradas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5 class="card-title text-center">Exposições</h5>
                        <p class="card-text text-center"><?php echo e($totalExpositions); ?> Exposições Cadastradas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3D Chart Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h5 class="card-title text-center">Gráfico 3D de Obras por Exposição (Three.js com Shaders)</h5>
                <div id="threejsChart" style="height: 600px;"></div>
            </div>
        </div>
    </div>

    <!-- Three.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuração básica da cena
            var scene = new THREE.Scene();
            var camera = new THREE.PerspectiveCamera(75, window.innerWidth / 600, 0.1, 1000);
            var renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(window.innerWidth, 600);
            document.getElementById('threejsChart').appendChild(renderer.domElement);

            // Controles de rotação e zoom
            var controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableZoom = true; // Permite zoom com o mouse
            controls.enableDamping = true; // Melhora a suavidade da rotação
            controls.dampingFactor = 0.25;

            // Dados para o gráfico
            var barData = [12, 19, 3, 5, 2, 3]; // Dados de exemplo
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

            // Criação das barras 3D
            barData.forEach(function (value, index) {
                var geometry = new THREE.BoxGeometry(barWidth, value, barWidth);
                var bar = new THREE.Mesh(geometry, barMaterials);
                bar.position.x = index * (barWidth + barSpacing);
                bar.position.y = value / 2;
                scene.add(bar);
            });

            // Luzes avançadas
            var pointLight = new THREE.PointLight(0xffffff, 1, 100);
            pointLight.position.set(5, 10, 10);
            scene.add(pointLight);

            var ambientLight = new THREE.AmbientLight(0x404040); // luz ambiente suave
            scene.add(ambientLight);

            // Configuração da câmera
            camera.position.z = 15;

            // Função de animação
            var animate = function () {
                requestAnimationFrame(animate);
                controls.update(); // Atualiza os controles
                renderer.render(scene, camera);
            };

            animate();

            // Ajuste da tela ao redimensionar o navegador
            window.addEventListener('resize', function () {
                var width = window.innerWidth;
                var height = 600;
                renderer.setSize(width, height);
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
            });
        });
    </script>

    <!-- Custom CSS -->
    <style>
        body {
            background: #f5f7fa;
        }
        .card {
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }
        .card-hover:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        .card-title {
            font-weight: 600;
            color: #333;
        }
    </style>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\Desktop\teste\projetobd\resources\views/dashboard.blade.php ENDPATH**/ ?>