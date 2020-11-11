

<?php $__env->startSection('title'); ?>
    <?php echo e('| Profil Karyawan'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('app-assets/css/pages/app-user.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.karyawan'); ?>
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
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Account</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-12.jpg"
                                                class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Username</td>
                                                    <td><?php echo e($karyawan->username); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Name</td>
                                                    <td><?php echo e($karyawan->name); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td><?php echo e($karyawan->email); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">Status</td>
                                                    <td>active</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Role</td>
                                                    <td><?php echo e($karyawan->role); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <a href="app-user-edit.html" class="btn btn-primary mr-1"><i
                                                    class="feather icon-edit-1"></i> Edit</a>
                                            <button class="btn btn-outline-danger"><i class="feather icon-trash-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->

                        <!-- cashbond start -->
                        
                        <!-- cashbond end -->

                        <!-- cashbond start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-1">Riwayat Cashbond</h2>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Debit</th>
                                                    <th scope="col">Kredit</th>
                                                    <th scope="col">Sisa Kasbon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sum_debit = 0; ?>
                                                <?php $sum_kredit = 0; ?>
                                                <?php $__currentLoopData = $cashbond; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th><?php echo e($loop->iteration); ?>.</th>
                                                        <td><?php echo e($item->tanggal_pengajuan); ?></td>
                                                        <td>Rp. <?php echo e(number_format($item->nominal)); ?></td>
                                                        <td>Rp. <?php echo e(number_format($item->kredit)); ?></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php $sum_debit += $item->nominal ?>
                                                    <?php $sum_kredit += $item->kredit ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <th>Rp. <?php echo e(number_format($sum_debit)); ?></th>
                                                    <th>Rp. <?php echo e(number_format($sum_kredit)); ?></th>
                                                    <th>Rp. <?php echo e(number_format($sum_debit - $sum_kredit)); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- cashbond end -->

                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <?php if(session('success')): ?>
                            <div class="alert alert-info">
                                <?php echo e(session('success')); ?>

                            </div>
                            <?php endif; ?>
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h2>Absensi</h2>
                                        <p class="card-text">Total Absensi : <span class="badge badge-pill bg-info"><?php echo e($tepatWaktu + $telat); ?></span></p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-success float-right"><?php echo e($tepatWaktu); ?></span>
                                            Tepat Waktu
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-warning float-right"><?php echo e($telat); ?></span>
                                            Telat
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-danger float-right"><?php echo e($tidakMasuk); ?></span>
                                            Tidak Masuk
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Waktu</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th><?php echo e($loop->iteration); ?>.</th>
                                                        <td><?php echo e($item->tanggal); ?></td>
                                                        <td><?php echo e($item->waktu); ?></td>
                                                        <td><?php echo e($item->status); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/administrator/profil_karyawan.blade.php ENDPATH**/ ?>