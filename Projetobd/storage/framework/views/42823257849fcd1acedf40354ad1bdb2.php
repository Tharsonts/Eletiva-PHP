

<?php $__env->startSection('content'); ?>
<style>
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

    .form-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 15px;
    width: 100%;
    background-image: url("https://cdn-icons-png.flaticon.com/512/60/60781.png"); /* Ícone de seta */
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px;
}
.form-select option {
    background-color: rgba(0, 0, 0, 0.8); /* Fundo transparente */
    color: #fff;
    border-bottom-left-radius: 8px; /* Arredonda o canto inferior esquerdo */
    border-bottom-right-radius: 8px; /* Arredonda o canto inferior direito */
}
.form-select:focus option {
    border-bottom-left-radius: 8px; /* Arredonda o canto inferior esquerdo ao abrir */
    border-bottom-right-radius: 8px; /* Arredonda o canto inferior direito ao abrir */
}

.form-select:focus {
    outline: none;
    border: 1px solid rgba(255, 255, 255, 0.5);
}

    button.btn-primary {
        width: 100%;
        background-color: #17a2b8;
        padding: 10px;
        font-size: 1.1rem;
        color: white;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    button.btn-primary:hover {
        background-color: #138496;
    }

    /* Ajuste do rodapé para fora do contêiner */
    footer {
        background-color: transparent;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        width: 100%;
        position: fixed; /* Mantém o rodapé fixo no final da página */
        bottom: 0;
    }
</style>

<div class="container">
    <h1>Create New Artist</h1>
    <form action="<?php echo e(route('artists.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" name="biography" required><?php echo e(old('biography')); ?></textarea>
        </div>

        <div class="form-group">
            <label for="nationality" class="form-label">Nationality</label>
            <select class="form-select" id="nationality" name="nationality" required>
                <option value="">Select Nationality</option>
                <option value="Brazilian">Brazilian</option>
                <option value="American">American</option>
                <option value="British">British</option>
                <option value="Canadian">Canadian</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Indian">Indian</option>
                <option value="Chinese">Chinese</option>
            </select>
        </div>

        <div class="form-group">
            <label for="artist_category" class="form-label">Artist Category</label>
            <select class="form-select" id="artist_category" name="artist_category" required>
                <option value="">Select Category</option>
                <option value="Painter">Painter</option>
                <option value="Sculptor">Sculptor</option>
                <option value="Photographer">Photographer</option>
                <option value="Digital Artist">Digital Artist</option>
                <option value="Illustrator">Illustrator</option>
                <option value="Graphic Designer">Graphic Designer</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/artists/create.blade.php ENDPATH**/ ?>