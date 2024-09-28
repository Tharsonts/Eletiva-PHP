

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

    .content-box {
        max-width: 1200px;
        margin: 20px auto; 
        padding: 20px;
    }

    h1 {
        font-size: 3rem;
        color: #fff;
        margin-bottom: 20px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: rgba(255, 255, 255, 0.1);
        margin-bottom: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    th {
        font-weight: bold;
    }

    .btn {
        padding: 10px 20px;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-view {
        background-color: #17a2b8;
    }

    .btn-view:hover {
        background-color: #138496;
    }

    .btn-edit {
        background-color: #ffc107;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .btn-add {
        background-color: #17a2b8;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin-bottom: 20px;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .btn-add:hover {
        background-color: #138496;
    }
</style>

<div class="content-box">
    <h1>Gerenciar Artistas</h1>

    <a href="<?php echo e(route('artists.create')); ?>" class="btn-add">Add New Artist</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Artist Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($artist->name); ?></td>
                <td><?php echo e($artist->artist_category); ?></td>
                <td class="actions">
                    <a href="<?php echo e(route('artists.show', $artist->id)); ?>" class="btn btn-view">View</a>
                    <a href="<?php echo e(route('artists.edit', $artist->id)); ?>" class="btn btn-edit">Edit</a>
                    <form action="<?php echo e(route('artists.destroy', $artist->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/artists/index.blade.php ENDPATH**/ ?>