

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
                            <h2 class="content-header-title float-left mb-0">Data Client CMHoster</h2>
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
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <a href="/vps" class="btn-icon btn btn-primary btn-round btn-sm">
                            Tampilkan Semua Data
                        </a>
                    </div>
                    <div class="col-md-4 offset-4">
                        <section id="search-bar">
                            <div class="search-bar right">
                                <form action="/vps" method="get">
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="search" name="cari" class="form-control round" id="searchbar"
                                            placeholder="Cari Data VPS">
                                        <div class="form-control-position">
                                            <i class="feather icon-search px-1"></i>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Nama</th>
                                                <th scope="col" class="text-center">Email</th>
                                                <th scope="col" class="text-center">No. Telpon</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th class="text-center" scope="row"><?php echo e($loop->iteration); ?>.</th>
                                                    <td class="text-center"><?php echo e($c->nama); ?></td>
                                                    <td class="text-center"><?php echo e($c->email); ?></td>
                                                    <td class="text-center"><?php echo e($c->no_telp); ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo e(url('client/' . $c->id . '/delete')); ?>"
                                                            class="btn btn-info btn-sm">Ubah</a>
                                                        <form action="<?php echo e(url('client/' . $c->id . '/delete')); ?>"
                                                            method="get" class="d-inline">
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
                    <h4 class="modal-title" id="myModalLabel1">Tambah Data Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('/client/create')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="yourEmail@example.com"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">No. Telpon</label>
                            <input type="number" name="no_telp" class="form-control" placeholder="08123456789" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="button">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/administrator/client.blade.php ENDPATH**/ ?>