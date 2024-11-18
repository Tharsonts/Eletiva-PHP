<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h5>Novo Equipamento</h5>
        <form action="/categoria" method="POST">
            <?php echo csrf_field(); ?>   
            <div class="row">
                <div class="col">
                    <label for="nome" class="form-label">
                    Informe o Nome do Equipamento:</label>
                    <input type="text" name="nome" class="form-control"/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="nome" class="form-label">
                    Informe o Valor do Equipamento</label>
                    <input type="text" name="nome" class="form-control"/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="nome" class="form-label">
                    Informe a Data de Aquisição:</label>
                    <input type="text" name="nome" class="form-control"/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Salvar
                    </button>
                </div>
            </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\User\Desktop\EletivaII-22024-main\projetobd\resources\views/categoria/create.blade.php ENDPATH**/ ?>