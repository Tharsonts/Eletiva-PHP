<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema da Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #001022; /* Fundo escuro */
        }

        .content {
            flex: 1;
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

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 1rem;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Fundo estrelado */
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .container {
            padding-bottom: 50px; /* Espaço adicional para o rodapé */
        }

        /* CSS para o dropdown */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            left: auto;
            z-index: 1000;
            display: none; /* Esconde o dropdown por padrão */
            background-color: #ffffff; /* Cor de fundo branco */
            border: 1px solid #ccc; /* Borda cinza para combinar com o estilo */
            border-radius: 5px; /* Borda arredondada */
        }

        .nav-item.dropdown:hover .dropdown-menu,
        .nav-item.dropdown .dropdown-menu:hover {
            display: block; /* Garante que o dropdown permaneça visível enquanto o mouse estiver sobre ele */
        }

        .dropdown-item {
            color: #343a40; /* Cor do texto (preto ou cinza escuro) */
            padding: 10px 20px; /* Espaçamento interno */
        }

        .dropdown-item:hover {
            background-color: #f8f9fa; /* Cor de fundo ao passar o mouse */
            color: #212529; /* Cor do texto ao passar o mouse */
        }

        /* Certifique-se que o rodapé esteja sempre fora do conteúdo principal */
    </style>
</head>
<body>

<!-- Canvas para fundo estrelado -->
<canvas id="background-canvas"></canvas>

<!-- Mantendo o menu como já foi definido -->
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

    <div class="container content my-5">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <canvas id="three-canvas"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script>
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: document.querySelector('#three-canvas'), alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        
        const starGeometry = new THREE.BufferGeometry();
        const starsCount = 2000;
        const starPositions = new Float32Array(starsCount * 3);

        for (let i = 0; i < starsCount; i++) {
            starPositions[i * 3] = (Math.random() - 0.5) * 100; // x
            starPositions[i * 3 + 1] = (Math.random() - 0.5) * 100; // y
            starPositions[i * 3 + 2] = (Math.random() - 0.5) * 100; // z
        }

        starGeometry.setAttribute('position', new THREE.BufferAttribute(starPositions, 3));
        const starMaterial = new THREE.PointsMaterial({ color: 0xffffff, size: 0.1 });
        const starField = new THREE.Points(starGeometry, starMaterial);
        scene.add(starField);

        function animateStars() {
            starField.rotation.y += 0.001;
            renderer.render(scene, camera);
            requestAnimationFrame(animateStars);
        }

        animateStars();

        gsap.fromTo('h1', { y: -100, opacity: 0 }, { y: 0, opacity: 1, duration: 1.5, ease: 'bounce.out' });
        gsap.fromTo('h2', { y: 100, opacity: 0 }, { y: 0, opacity: 1, duration: 1.5, ease: 'power3.out', delay: 0.5 });
        gsap.fromTo('li', { opacity: 0 }, { opacity: 1, duration: 1.5, stagger: 0.3, ease: 'power3.out', delay: 1 });

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        camera.position.z = 5;

        // Animação dos links, excluindo os itens do dropdown
        const links = document.querySelectorAll('a:not(.dropdown-item)');

        links.forEach(link => {
            link.addEventListener('mouseenter', () => {
                gsap.to(link, { color: '#00ffea', duration: 0.3, scale: 1.1 });
            });
            link.addEventListener('mouseleave', () => {
                gsap.to(link, { color: '#fff', duration: 0.3, scale: 1 });
            });
        });
    </script>

    <!-- Script para o fundo estrelado -->
    <script>
        const canvas = document.getElementById('background-canvas');
        const ctx = canvas.getContext('2d');
        let w, h;
        let stars = [];
        let angle = 0; // Ângulo para simular o movimento da galáxia

        function initCanvas() {
            w = canvas.width = window.innerWidth;
            h = canvas.height = window.innerHeight;
        }

        function createStars() {
            for (let i = 0; i < 100; i++) {
                stars.push({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    radius: Math.random() * 1.5,
                    color: '#FFFFFF'
                });
            }
        }

        function drawStars() {
            ctx.clearRect(0, 0, w, h);
            ctx.save();
            ctx.translate(w / 2, h / 2); // Transladar para o centro da tela
            ctx.rotate(angle); // Rotacionar as estrelas em torno do centro
            stars.forEach(star => {
                ctx.beginPath();
                ctx.arc(star.x - w / 2, star.y - h / 2, star.radius, 0, Math.PI * 2);
                ctx.fillStyle = star.color;
                ctx.fill();
                ctx.closePath();
            });
            ctx.restore();
        }

        function animate() {
            angle += 0.001; // Aumentar o ângulo para simular o movimento
            drawStars();
            requestAnimationFrame(animate);
        }

        window.addEventListener('resize', initCanvas);
        initCanvas();
        createStars();
        animate();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\teste\projetobd\resources\views/layouts/app.blade.php ENDPATH**/ ?>