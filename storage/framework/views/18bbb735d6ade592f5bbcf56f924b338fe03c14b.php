

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
                                <i class="feather icon-plus"></i>
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
                                                            class="btn btn-info btn-sm">View Profile</a>
                                                        <form action="<?php echo e(url('karyawan/' . $k->id . '/delete')); ?>"
                                                            method="get" class="d-inline"
                                                            onclick="return confirm('Data Karyawan dengan Nama <?php echo e($k->name); ?> akan dihapus?')">
                                                            <?php echo method_field('delete'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <button class="btn btn-danger btn-sm"
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
                    <h4 class="modal-title" id="myModalLabel1">Tambah Data VPS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('vps/create')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Nama Client</label>
                            <select name="client_id" class="form-control" required>
                                <option value="">-- Pilih Client --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama VM</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama VM" required>
                        </div>
                        <div class="form-group">
                            <label for="">IP Address</label>
                            <input type="text" name="ip_address" class="form-control" placeholder="IP Address" required>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi Server</label>
                            <select name="lokasi" id="" class="form-control" required>
                                <option value="">-- Pilih Lokasi Server --</option>
                                <option value="S3">S3</option>
                                <option value="S4">S4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <ul class="list-unstyled my-1">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status" value="Aktif"
                                                id="customRadio1" checked>
                                            <label class="custom-control-label" for="customRadio1">Aktif</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status" value="Non-aktif"
                                                id="customRadio2">
                                            <label class="custom-control-label" for="customRadio2">Non-aktif</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
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