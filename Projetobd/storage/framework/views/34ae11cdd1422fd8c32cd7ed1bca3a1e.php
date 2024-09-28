

<?php $__env->startSection('content'); ?>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 50% 50%, #000, #001022);
        color: #fff;
    }

    .content-box {
        max-width: 700px;
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

    .info-group {
        margin-bottom: 15px;
    }

    .info-group label {
        font-weight: bold;
        color: #17a2b8;
        display: block;
    }

    .info-group span {
        color: #fff;
    }

    .btn {
        padding: 10px 20px;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-right: 10px;
    }

    .btn-back {
        background-color: #17a2b8;
    }

    .btn-back:hover {
        background-color: #138496;
    }
</style>

<div class="content-box">
    <h1>Detalhes da Exposição</h1>

    <div class="info-group">
        <label>Tipo de Galeria:</label>
        <span><?php echo e($exposition->gallery_type); ?></span>
    </div>

    <div class="info-group">
        <label>Galeria:</label>
        <span><?php echo e($exposition->gallery_name); ?></span>
    </div>

    <div class="info-group">
        <label>Endereço:</label>
        <span><?php echo e($exposition->gallery_address); ?></span>
    </div>

    <div class="info-group">
        <label>Cidade/Estado:</label>
        <span><?php echo e($exposition->gallery_city_state); ?></span>
    </div>

    <div class="info-group">
        <label>País:</label>
        <span><?php echo e($exposition->gallery_country); ?></span>
    </div>

    <div class="info-group">
        <label>Tema:</label>
        <span><?php echo e($exposition->theme); ?></span>
    </div>

    <div class="info-group">
        <label>Data:</label>
        <span><?php echo e($exposition->date); ?></span>
    </div>

    <div class="info-group">
        <label>Obras de Arte:</label>
        <?php if($exposition->artworks->count()): ?>
            <ul>
                <?php $__currentLoopData = $exposition->artworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artwork): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($artwork->title); ?></li>
                    <li>Artista: <?php echo e($artwork->artist->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <span>Nenhuma obra de arte associada.</span>
        <?php endif; ?>
    </div>

    <a href="<?php echo e(route('expositions.index')); ?>" class="btn btn-back">Voltar à Lista</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/expositions/show.blade.php ENDPATH**/ ?>