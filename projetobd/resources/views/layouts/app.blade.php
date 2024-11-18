<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema da Empresa</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #001022;
        }
        .content {
            flex: 1;
        }
        nav {
            display: flex;
            justify-content: space-between;
            background-color: rgba(10, 25, 47, 0.2);
            padding: 10px 20px;
        }
        nav a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.1rem;
        }
        nav a:hover {
            color: white;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: rgba(40, 44, 52, 0.9);
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 10;
        }
        .sidebar a {
            padding: 15px 20px;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar a i {
            font-size: 1.3rem;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1); 
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
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .container {
            padding-bottom: 50px;
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artists.index') }}"><i class="fas fa-palette"></i> Cadastrar Artistas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artworks.index') }}"><i class="fas fa-paint-brush"></i> Cadastrar Obras de Arte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expositions.index') }}"><i class="fas fa-image"></i> Cadastrar Exposições</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/profile">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
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
        @yield('content')
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
            starPositions[i * 3] = (Math.random() - 0.5) * 100; 
            starPositions[i * 3 + 1] = (Math.random() - 0.5) * 100;
            starPositions[i * 3 + 2] = (Math.random() - 0.5) * 100;
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
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
        camera.position.z = 5;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
