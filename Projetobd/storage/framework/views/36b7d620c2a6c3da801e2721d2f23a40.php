

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
        height: 100vh; /* Mantém a altura da tela inteira */
    }

    canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: -1;
    }

    .container-password {
        margin: 0 auto;
        width: 100%;
        max-width: 500px;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        box-shadow: 0px 10px 30px rgba(255, 255, 255, 0.1);
    }

    .form-password {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-control-password {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 15px;
        border-radius: 8px;
        width: 100%;
        position: relative;
        font-size: 1.1rem;
    }

    .form-control-password input {
        background-color: transparent;
        border: none;
        color: #fff;
        width: 90%;
        outline: none;
        font-size: 1.1rem;
    }

    /* Placeholder com cor mais visível */
    .form-control-password input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Ícone de olho */
    .form-control-password .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .btn-change-password {
        background-color: #17a2b8;
        color: white;
        padding: 15px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 20px;
        text-align: center;
        width: 100%;
        font-size: 1.2rem;
    }

    .btn-change-password:hover {
        background-color: #138496;
    }

</style>

<div class="container-password">
    <h1 class="text-center">Trocar Senha</h1>

    <!-- Exibe mensagem de sucesso ou erro -->
    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('profile.password.update')); ?>" method="POST" class="form-password">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <!-- Campo de senha atual -->
        <div class="form-control-password">
            <input type="password" id="current_password" name="current_password" placeholder="Digite sua senha atual" required>
            <span class="toggle-password" onclick="togglePassword('current_password')">👁️</span>
        </div>

        <!-- Campo de nova senha -->
        <div class="form-control-password">
            <input type="password" id="new_password" name="new_password" placeholder="Digite a nova senha" required>
            <span class="toggle-password" onclick="togglePassword('new_password')">👁️</span>
        </div>

        <!-- Campo de confirmação de senha -->
        <div class="form-control-password">
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirme a nova senha" required>
            <span class="toggle-password" onclick="togglePassword('new_password_confirmation')">👁️</span>
        </div>

        <button type="submit" class="btn-change-password">Alterar Senha</button>
    </form>
</div>

<script>
    // Função para alternar entre mostrar e esconder a senha
    function togglePassword(fieldId) {
        var input = document.getElementById(fieldId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/profile/password.blade.php ENDPATH**/ ?>