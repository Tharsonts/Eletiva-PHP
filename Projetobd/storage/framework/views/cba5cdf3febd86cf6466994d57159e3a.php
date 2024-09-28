

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

    canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: -1;
    }

    .container {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        max-width: 700px;
        margin: 50px auto;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
    }

    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1); /* Transparente */
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-right: 10px;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn:hover {
        background-color: #218838;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <h1><?php echo e(isset($artwork) ? 'Editar Obra de Arte' : 'Adicionar Nova Obra de Arte'); ?></h1>

    <form action="<?php echo e(isset($artwork) ? route('artworks.update', $artwork->id) : route('artworks.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php if(isset($artwork)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $artwork->title ?? '')); ?>" required>
        </div>

        <div class="form-group">
            <label for="technique">Técnica</label>
            <input type="text" name="technique" class="form-control" value="<?php echo e(old('technique', $artwork->technique ?? '')); ?>" required>
        </div>

        <div class="form-group">
            <label for="creation_date">Data de Criação</label>
            <input type="date" name="creation_date" class="form-control" value="<?php echo e(old('creation_date', $artwork->creation_date ?? '')); ?>" required>
        </div>

        <button type="submit" class="btn"><?php echo e(isset($artwork) ? 'Atualizar' : 'Salvar'); ?></button>
        <a href="<?php echo e(route('artworks.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/artworks/form.blade.php ENDPATH**/ ?>