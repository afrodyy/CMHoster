

<?php $__env->startSection('title'); ?>
    <?php echo e('| Cashbond'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('cashbond'); ?>
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
                        <div class="col-8">
                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Riwayat Cashbond Kamu</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button type="button" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                data-toggle="modal" data-target="#default">Ajukan Cashbond
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
                                                <th scope="col">Debit</th>
                                                <th scope="col">Kredit</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total_row = $cashbond->count();
                                            ?>
                                            <?php if($total_row > 0): ?>
                                                <?php $__currentLoopData = $cashbond; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th><?php echo e($loop->iteration); ?>.</th>
                                                        <td style="color: green">Rp. <?php echo e(number_format($item->nominal)); ?></td>
                                                        <td style="color: red">Rp. <?php echo e(number_format($item->kredit)); ?></td>
                                                        <td><?php echo e($item->tanggal_pengajuan); ?></td>
                                                        <td><?php echo e($item->status); ?></td>
                                                        <td>
                                                            <?php if($item->status === 'Menunggu konfirmasi'): ?>
                                                                <a href="<?php echo e(url('cashbond/' . $item->id . '/cancel')); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Kamu mau batalin pengajuan cashbond?')">Batal</a>
                                                            <?php elseif($item->status === 'Disetujui'): ?>
                                                                <a href="" class="btn btn-success btn-sm" onclick="return confirm('Langsung bayar ke Faqy ya!')">Bayar</a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <th class="text-center" colspan="6">Data tidak ditemukan</th>
                                                </tr>
                                            <?php endif; ?>
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
                    <h4 class="modal-title" id="myModalLabel1">Form Pengajuan Cashbond</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('cashbond/pengajuan')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="kredit" value="0">
                        <div class="form-group">
                            <label for="">Nominal (Rp)</label>
                            <input type="number" name="nominal" class="form-control" placeholder="50000" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alasan Pengajuan</label>
                            <textarea name="alasan" id="alasan" cols="20" rows="4" class="form-control"
                                maxlength="200" required></textarea>
                        </div>
                        <?php $date = date('d-m-Y'); ?>
                        <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
                        <input type="hidden" name="tanggal_pengajuan" value="<?php echo e($date); ?>">
                        <input type="hidden" name="status" id="status" value="Menunggu konfirmasi">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/karyawan/cashbond.blade.php ENDPATH**/ ?>