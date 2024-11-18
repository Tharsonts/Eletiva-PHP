<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #001022;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            color: white;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.7);
            text-align: center;
            backdrop-filter: blur(10px);
            animation: fadeIn 0.9s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h5 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #00ffea;
            text-shadow: 0px 0px 10px #00ffea;
        }

        .form-control {
            background: none;
            border: 2px solid #00ffea;
            border-radius: 50px;
            padding: 12px 20px;
            color: white;
            transition: border 0.3s ease, background-color 0.3s ease;
        }

        .form-control:focus {
            background-color: #001a3d;
            border-color: #00ffea;
            box-shadow: none;
            outline: none;
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            background-color: #00ffea;
            color: black;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #00e5cc;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 255, 234, 0.5);
        }

        .custom-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.85rem;
        }

        .custom-footer a {
            color: #00ffea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .custom-footer a:hover {
            color: #00e5cc;
        }

        .highlight {
            animation: highlightEffect 1.5s ease-in-out infinite;
        }

        @keyframes highlightEffect {
            0%, 100% { color: #00ffea; text-shadow: 0 0 10px #00ffea; }
            50% { color: #00e5cc; text-shadow: 0 0 20px #00e5cc; }
        }
    </style>
</head>
<body>

<canvas id="background-canvas"></canvas>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 highlight">Registrar</h5>
                <form method="post" action="/register">
                    @csrf
                    <div class="mb-3">
                        <input name="name" type="text" class="form-control" placeholder="Digite seu nome" required>
                    </div>
                    <div class="mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Digite seu email" required>
                    </div>
                    <div class="mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Digite sua senha" required>
                    </div>
                    <div class="mb-3">
                        <input name="password_confirmation" type="password" class="form-control" placeholder="Confirme sua senha" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
                <div class="custom-footer">
                    <a href="/login">Já tem uma conta? Faça login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas: document.querySelector('#background-canvas'), alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);

    const starGeometry = new THREE.BufferGeometry();
    const starCount = 5000;
    const starPositions = new Float32Array(starCount * 3);

    for (let i = 0; i < starCount; i++) {
        starPositions[i * 3] = (Math.random() - 0.5) * 2000;
        starPositions[i * 3 + 1] = (Math.random() - 0.5) * 2000;
        starPositions[i * 3 + 2] = (Math.random() - 0.5) * 2000;
    }

    starGeometry.setAttribute('position', new THREE.BufferAttribute(starPositions, 3));
    const starMaterial = new THREE.PointsMaterial({ color: 0xffffff, size: 0.5 });
    const starField = new THREE.Points(starGeometry, starMaterial);
    scene.add(starField);

    function animateStars() {
        starField.rotation.y += 0.0005;
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
