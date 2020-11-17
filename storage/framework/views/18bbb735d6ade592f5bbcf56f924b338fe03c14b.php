

<?php $__env->startSection('title'); ?>
    <?php echo e('| Data Karyawan'); ?>

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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Data Karyawan CMHoster</h2>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success mt-1">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button type="button" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                data-toggle="modal" data-target="#default">
                                Input Karyawan Alfa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($loop->iteration); ?>.</th>
                                                    <td><?php echo e($k->name); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(url('karyawan/' . $k->id . '/profile')); ?>"
                                                            class="btn btn-sm bg-gradient-info">View Profile</a>
                                                        <form action="<?php echo e(url('karyawan/' . $k->id . '/delete')); ?>"
                                                            method="get" class="d-inline"
                                                            onclick="return confirm('Data Karyawan dengan Nama <?php echo e($k->name); ?> akan dihapus?')">
                                                            <?php echo method_field('delete'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <button class="btn btn-sm bg-gradient-danger"
                                                                type="submit">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table head options end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Input Absen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('admin/absen')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Nama Karyawan</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">-- Pilih Karyawan --</option>
                                <option value="2">Ahmad Dicky Zulfikar</option>
                                <option value="3">Fahmi Imam</option>
                                <option value="6">Faqy Iskandar</option>
                                <option value="1">Herdian Afrody</option>
                                <option value="5">Muhammad Alviansyah</option>
                                <option value="7">Roni Abdul Hamid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php $date = date('d-m-Y'); ?>
                            <label for="">Tanggal</label>
                            <input type="text" name="tanggal" class="form-control" value="<?php echo e($date); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <?php $waktu = date('H:i:s'); ?>
                            <label for="">Waktu</label>
                            <input type="text" name="waktu" class="form-control" value="<?php echo e($waktu); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" name="status" class="form-control" value="Tidak Masuk" readonly>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="button">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/administrator/data_karyawan.blade.php ENDPATH**/ ?>