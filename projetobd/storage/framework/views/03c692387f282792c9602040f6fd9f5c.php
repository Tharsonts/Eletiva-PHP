

<?php $__env->startSection('content'); ?>
<style>
    /* Fundo estrelado */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 50% 50%, #000, #001022);
        color: #fff;
        overflow: hidden;
        position: relative;
        height: 100vh;
    }

    .container-profile {
        margin: 0 auto;
        width: 100%;
        max-width: 600px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        box-shadow: 0px 10px 30px rgba(255, 255, 255, 0.1);
        min-height: 100vh;
        overflow-y: auto;
    }

    .form-profile {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-control-static {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: none;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        cursor: not-allowed;
    }

    .edit-field {
        display: none;
        margin-top: 10px;
    }

    .form-control-editable {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 10px;
        border-radius: 8px;
    }

    .btn-edit {
        background-color: #17a2b8;
        color: white;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
        width: 100%;
        text-align: center;
    }

    .btn-edit:hover {
        background-color: #138496;
    }

    /* Botão para trocar senha */
    .btn-change-password {
        background-color: #ff5733;
        color: white;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 20px;
        text-align: center;
        width: 100%;
    }

    .btn-change-password:hover {
        background-color: #e74c3c;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        .container-profile {
            max-width: 90%;
        }
    }

    /* Mensagens de sucesso */
    .alert-success {
        background-color: #28a745;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
</style>

<div class="container-profile">
    <h1 class="text-center">Seu Perfil</h1>

    <!-- Exibe a mensagem de sucesso -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="form-profile">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <!-- Nome para visualização -->
        <label>Nome</label>
        <input type="text" class="form-control-static" value="<?php echo e(auth()->user()->name); ?>" disabled>

        <!-- Campo para editar o nome -->
        <div class="edit-field" id="edit-name">
            <input type="text" class="form-control-editable" name="name" placeholder="Novo Nome">
            <button type="submit" class="btn-edit">Confirmar Nome</button>
        </div>
        <button type="button" class="btn-edit" onclick="toggleEdit('edit-name')">Editar Nome</button>

        <!-- Email para visualização -->
        <label>Email</label>
        <input type="email" class="form-control-static" value="<?php echo e(auth()->user()->email); ?>" disabled>

        <!-- Botão para trocar a senha -->
        <a href="<?php echo e(route('profile.password')); ?>" class="btn-change-password">Trocar Senha</a>
    </form>
</div>

<script>
    function toggleEdit(fieldId) {
        let editField = document.getElementById(fieldId);
        if (editField.style.display === "none" || editField.style.display === "") {
            editField.style.display = "block";
        } else {
            editField.style.display = "none";
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\teste\projetobd\resources\views/profile/index.blade.php ENDPATH**/ ?>