

<?php $__env->startSection('dashboard'); ?>
    <?php echo e('active'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-3">Selamat datang, <?php echo e(auth()->user()->name); ?>!</h1>
                    </div>
                </div>
                <?php if(auth()->user()->role !== 'owner'): ?>
                <div class="row">
                    <div class="col-4">
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="../../../app-assets/images/slider/04.jpg" alt="Card image cap" class="card-img-top img-fluid">
                                        <div class="card-body">
                                            <h4 class="card-title">Kamu,</h4>
                                            <p class="card-text">
                                                <?php if($absensi === 0): ?>
                                                    <strong>Rajin ya masuk kerja terus!</strong>
                                                <?php else: ?>
                                                    <strong>Bulan ini ga masuk sebanyak <?php echo e($absensi); ?> hari.</strong>
                                                <?php endif; ?>
                                            </p>
                                            <form action="<?php echo e(url('absen')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
                                                <?php $tanggal = date('d-m-Y'); ?>
                                                <input type="hidden" name="tanggal" value="<?php echo e($tanggal); ?>">
                                                <?php $waktu = date('H:i:s'); ?>
                                                <input type="hidden" name="waktu" value="<?php echo e($waktu); ?>">
                                                <?php if($waktu > '09:10:00'): ?>
                                                    <input type="hidden" name="status" value="Telat">
                                                <?php elseif($waktu <= '09:10:00' ): ?> <input type="hidden" name="status" value="Tepat Waktu">
                                                <?php endif; ?>
                                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Absen yuk</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="../../../app-assets/images/slider/05.jpg" alt="Card image cap" class="card-img-top img-fluid">
                                        <div class="card-body">
                                            <?php if($debit === 0): ?>
                                                <h4 class="card-title">Kamu,</h4>
                                                <p class="card-text">
                                                    <strong>Lagi ga ada kasbon.</strong>
                                                </p>
                                                <a href="<?php echo e(url('cashbond')); ?>" class="btn btn-outline-primary waves-effect waves-light">Detail</a>
                                            <?php else: ?>
                                                <?php
                                                    $sum_debit = 0;
                                                    $sum_kredit = 0;
                                                ?>
                                                <?php $__currentLoopData = $cashbond; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $debit = $item->nominal;
                                                        $kredit = $item->kredit;
                                                        $sum_debit += $debit;
                                                        $sum_kredit += $kredit;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <h4 class="card-title">Kamu,</h4>
                                                <p class="card-text">
                                                    <strong>Punya kasbon sebesar Rp. <?php echo e(number_format($sum_debit - $sum_kredit)); ?></strong>
                                                </p>
                                                <a href="<?php echo e(url('cashbond')); ?>" class="btn btn-outline-primary waves-effect waves-light">Detail</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/dashboard/index.blade.php ENDPATH**/ ?>