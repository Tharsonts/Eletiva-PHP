

<?php $__env->startSection('content'); ?>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 50% 50%, #000, #001022);
        color: #fff;
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
        background-color: rgba(255, 255, 255, 0.1);
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

    option {
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
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

    .hidden-field {
        display: none;
    }
</style>

<div class="container">
    <h1>Editar Exposição</h1>

    <form action="<?php echo e(route('expositions.update', $exposition->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="gallery_type">Tipo de Galeria</label>
            <select name="gallery_type" id="gallery_type" class="form-select" required onchange="showGalleryFields(this.value)">
                <option value="">Selecione o tipo de galeria</option>
                <option value="Museu" <?php echo e($exposition->gallery_type == 'Museu' ? 'selected' : ''); ?>>Museu</option>
                <option value="Galeria de Arte" <?php echo e($exposition->gallery_type == 'Galeria de Arte' ? 'selected' : ''); ?>>Galeria de Arte</option>
                <option value="Espaço Comercial" <?php echo e($exposition->gallery_type == 'Espaço Comercial' ? 'selected' : ''); ?>>Espaço Comercial</option>
                <option value="Outra" <?php echo e($exposition->gallery_type == 'Outra' ? 'selected' : ''); ?>>Outra</option>
            </select>
        </div>

        <div id="gallery-fields" class="form-group" style="display: <?php echo e($exposition->gallery_type ? 'block' : 'none'); ?>">
            <div class="form-group">
                <label for="gallery_name">Nome da Galeria</label>
                <input type="text" name="gallery_name" id="gallery_name" class="form-control" value="<?php echo e($exposition->gallery_name); ?>">
            </div>

            <div class="form-group">
                <label for="gallery_address">Endereço</label>
                <input type="text" name="gallery_address" id="gallery_address" class="form-control" value="<?php echo e($exposition->gallery_address); ?>">
            </div>

            <div class="form-group">
                <label for="gallery_city_state">Cidade/Estado</label>
                <input type="text" name="gallery_city_state" id="gallery_city_state" class="form-control" value="<?php echo e($exposition->gallery_city_state); ?>">
            </div>

            <div class="form-group">
                <label for="gallery_country">País</label>
                <input type="text" name="gallery_country" id="gallery_country" class="form-control" value="<?php echo e($exposition->gallery_country); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="theme">Tema</label>
            <select name="theme" id="theme" class="form-control" required onchange="toggleOtherTheme(this.value)">
                <option value="">Selecione o tema</option>
                <option value="Arte Contemporânea" <?php echo e($exposition->theme == 'Arte Contemporânea' ? 'selected' : ''); ?>>Arte Contemporânea</option>
                <option value="Surrealismo" <?php echo e($exposition->theme == 'Surrealismo' ? 'selected' : ''); ?>>Surrealismo</option>
                <option value="Impressionismo" <?php echo e($exposition->theme == 'Impressionismo' ? 'selected' : ''); ?>>Impressionismo</option>
                <option value="Renascimento" <?php echo e($exposition->theme == 'Renascimento' ? 'selected' : ''); ?>>Renascimento</option>
                <option value="Outra" <?php echo e($exposition->theme == 'Outra' ? 'selected' : ''); ?>>Outra</option>
            </select>
        </div>

        <div class="form-group" id="other-theme-group" style="display: <?php echo e($exposition->theme == 'Outra' ? 'block' : 'none'); ?>;">
            <label for="other_theme">Especifique o tema</label>
            <input type="text" name="other_theme" id="other_theme" class="form-control" value="<?php echo e($exposition->theme == 'Outra' ? $exposition->theme : ''); ?>">
        </div>

        <div class="form-group">
            <label for="date">Data da Exposição</label>
            <input type="date" name="date" class="form-control" value="<?php echo e($exposition->date); ?>" required>
        </div>

        <div class="form-group">
            <label for="artworks">Obras de Arte</label>
            <select name="artworks[]" id="artworks" class="form-select" multiple>
                <?php $__currentLoopData = $artworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artwork): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($artwork->id); ?>" <?php echo e(in_array($artwork->id, $exposition->artworks->pluck('id')->toArray()) ? 'selected' : ''); ?>>
                        <?php echo e($artwork->title); ?> - <?php echo e($artwork->artist->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn">Atualizar</button>
        <a href="<?php echo e(route('expositions.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    function showGalleryFields(value) {
        const galleryFields = document.getElementById('gallery-fields');
        if (value !== '') {
            galleryFields.style.display = 'block';
        } else {
            galleryFields.style.display = 'none';
        }
    }

    function toggleOtherTheme(value) {
        const otherThemeGroup = document.getElementById('other-theme-group');
        if (value === 'Outra') {
            otherThemeGroup.style.display = 'block';
        } else {
            otherThemeGroup.style.display = 'none';
            document.getElementById('other_theme').value = '';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/expositions/edit.blade.php ENDPATH**/ ?>