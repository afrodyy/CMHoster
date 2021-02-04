

<?php $__env->startSection('title'); ?>
    <?php echo e('| Cashbond'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.cashbond'); ?>
    <?php echo e('active'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-6">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success mt-1">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <h2 class="content-header-title float-left mb-0">Data Cashbond Karyawan</h2>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-primary btn-round btn-sm float-right mt-1"
                        data-toggle="modal" data-target="#default">Pembayaran Cashbond
                        <i class="feather icon-plus"></i>
                    </button>
                </div>
                <div class="col-3">
                    <section id="search-bar">
                        <div class="search-bar right">
                            <form action="<?php echo e(url('cashbondAjax')); ?>" method="get">
                                <div class="form-group">
                                    <select name="user_id" id="cashbondFilter" class="form-control" required>
                                        <option value="">-- Pilih Karyawan --</option>
                                        <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </section>
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
                                                <th scope="col">Debit</th>
                                                <th scope="col">Kredit</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $cashbond; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th><?php echo e($loop->iteration); ?>.</th>
                                                    <td><a href="<?php echo e(url('karyawan/' . $item->user->id . '/profile')); ?>"><?php echo e($item->user->name); ?></a></td>
                                                    <td style="color: green">Rp. <?php echo e(number_format($item->nominal)); ?></td>
                                                    <td style="color: red">Rp. <?php echo e(number_format($item->kredit)); ?></td>
                                                    <td><?php echo e($item->tanggal_pengajuan); ?></td>
                                                    <td><?php echo e($item->status); ?></td>
                                                    <td>
                                                        <?php if($item->status !== '-'): ?>
                                                            <a href="<?php echo e(url('admin/cashbond/' . $item->id . '/konfirmasi')); ?>" class="btn btn-sm bg-gradient-info">Konfirmasi</a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo e(url('admin/cashbond/' . $item->id . '/hapus')); ?>"
                                                            class="btn btn-sm bg-gradient-danger"
                                                            onclick="return confirm('Kamu mau batalin pengajuan cashbond?')">Hapus</a>
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
                    <h4 class="modal-title" id="myModalLabel1">Form Pembayaran Cashbond</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('admin/cashbond/pembayaran')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="nominal" value="0">
                        <input type="hidden" name="alasan" value="-">
                        <?php $date = date('d-m-Y'); ?>
                        <input type="hidden" name="tanggal_pengajuan" value="<?php echo e($date); ?>">
                        <input type="hidden" name="status" id="status" value="-">
                        <div class="form-group">
                            <label for="user_id">Karyawan</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">-- Pilih Nama Karyawan --</option>
                                <option value="1">Herdian Afrody</option>
                                <option value="2">Ahmad Dicky Zulfikar</option>
                                <option value="3">Fahmi Imam</option>
                                <option value="5">Muhammad Alviansyah</option>
                                <option value="6">Faqy Iskandar</option>
                                <option value="7">Roni Abdul Hamid Togubu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal (Rp)</label>
                            <input type="number" name="kredit" class="form-control" placeholder="50000" min="1" required>
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

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {

            fetch_cashbond_data();

            function fetch_cashbond_data(query = '') {
                $.ajax({
                    url: "<?php echo e(route('cashbondAjax')); ?>",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                    }
                });
            }

            $(document).on('input', '#cashbondFilter', function() {
                var query = $(this).val();
                fetch_cashbond_data(query);
            });
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/administrator/cashbond.blade.php ENDPATH**/ ?>