

<?php $__env->startSection('content'); ?>
<style>
    /* Fundo estrelado e ajustes */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 50% 50%, #000, #001022);
        color: #fff;
    }

    .content-box {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
    }

    .info {
        margin-bottom: 20px;
    }

    .info p {
        font-size: 1.2rem;
        margin: 5px 0;
    }

    .btn-back {
        background-color: #17a2b8;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        display: inline-block;
        margin-top: 20px;
    }

    .btn-back:hover {
        background-color: #138496;
    }

</style>

<div class="content-box">
    <h1>Detalhes da Obra de Arte</h1>

    <div class="info">
        <p><strong>Título:</strong> <?php echo e($artwork->title); ?></p>
        <p><strong>Técnica:</strong> <?php echo e($artwork->technique); ?></p>
        <p><strong>Artista:</strong> <?php echo e($artwork->artist->name ?? 'Artista não definido'); ?></p> <!-- Exibe o nome do artista -->
        <p><strong>Data de Criação:</strong> <?php echo e($artwork->creation_date); ?></p>
    </div>

    <a href="<?php echo e(route('artworks.index')); ?>" class="btn-back">Voltar</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\teste\projetobd\resources\views/artworks/show.blade.php ENDPATH**/ ?>