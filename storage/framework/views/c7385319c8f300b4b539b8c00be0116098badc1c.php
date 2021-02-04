

<?php $__env->startSection('title'); ?>
    <?php echo e('| Absensi'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('absensi'); ?>
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
                            <?php if(session('success')): ?>
                            <div class="alert alert-success mt-1">
                                <?php echo e(session('success')); ?>

                            </div>
                            <?php elseif(session('failed')): ?>
                            <div class="alert alert-danger mt-1">
                                <?php echo e(session('failed')); ?>

                            </div>
                            <?php endif; ?>
                            <h2 class="content-header-title float-left mb-0">Riwayat absen kamu</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-4">
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
                            <button type="submit" class="btn-icon btn btn-primary btn-round mb-1 mt-0">Absen</button>
                        </form>
                    </div>
                </div>

                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                        $date = date('n');
                                    ?>
                                    <form action="<?php echo e(route('absenAjax')); ?>" method="get">
                                        <select name="tanggal" id="absenFilter" class="form-control">
                                            <option value="">-- Pilih Bulan --</option>
                                            <option value="01" <?php if($date === '01'): ?>
                                                selected
                                            <?php endif; ?>>Januari</option>
                                            <option value="02" <?php if($date === '02'): ?>
                                                selected
                                            <?php endif; ?>>Februari</option>
                                            <option value="03" <?php if($date === '03'): ?>
                                                selected
                                            <?php endif; ?>>Maret</option>
                                            <option value="04" <?php if($date === '04'): ?>
                                                selected
                                            <?php endif; ?>>April</option>
                                            <option value="05" <?php if($date === '05'): ?>
                                                selected
                                            <?php endif; ?>>Mei</option>
                                            <option value="06" <?php if($date === '06'): ?>
                                                selected
                                            <?php endif; ?>>Juni</option>
                                            <option value="07" <?php if($date === '07'): ?>
                                                selected
                                            <?php endif; ?>>Juli</option>
                                            <option value="08" <?php if($date === '08'): ?>
                                                selected
                                            <?php endif; ?>>Agustus</option>
                                            <option value="09" <?php if($date === '09'): ?>
                                                selected
                                            <?php endif; ?>>September</option>
                                            <option value="10" <?php if($date === '10'): ?>
                                                selected
                                            <?php endif; ?>>Oktober</option>
                                            <option value="11" <?php if($date === '11'): ?>
                                                selected
                                            <?php endif; ?>>November</option>
                                            <option value="12" <?php if($date === '12'): ?>
                                                selected
                                            <?php endif; ?>>Desember</option>
                                        </select>
                                    </form>
                                    <p class="card-text mt-1">Total Absensi : <span class="badge badge-pill bg-info" id="total_absen"><?php echo e($tepatWaktu + $telat); ?></span></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-success float-right" id="total_tepat"><?php echo e($tepatWaktu); ?></span>
                                            Tepat Waktu
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-warning float-right" id="total_telat"><?php echo e($telat); ?></span>
                                            Telat
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-danger float-right" id="total_tidakmasuk"><?php echo e($tidakMasuk); ?></span>
                                            Tidak Masuk
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
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
                                            <?php
                                                $total_row = $absensi->count();
                                            ?>

                                            <?php if($total_row > 0): ?>
                                                <?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th><?php echo e($loop->iteration); ?>.</th>
                                                        <td><?php echo e($item->tanggal); ?></td>
                                                        <td><?php echo e($item->waktu); ?></td>
                                                        <td><?php echo e($item->status); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <th class="text-center" colspan="4">Data tidak ditemukan</th>
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
                    <h4 class="modal-title" id="myModalLabel1">Tambah Data VPS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('absen')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
                        <div class="form-group">
                            <?php $tanggal = date('d-m-Y'); ?>
                            <label for="">Tanggal</label>
                            <input type="text" name="tanggal" class="form-control" value="<?php echo e($tanggal); ?>">
                        </div>
                        <div class="form-group">
                            <?php $waktu = date('H:i:s'); ?>
                            <label for="">Waktu</label>
                            <input type="text" name="waktu" class="form-control" value="<?php echo e($waktu); ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <ul class="list-unstyled my-1">

                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status"
                                                value="Tepat Waktu" id="customRadio1" <?php if($waktu <= '09:00:00'): ?>
                                            checked
                                            <?php endif; ?>>
                                            <label class="custom-control-label" for="customRadio1">Tepat Waktu</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status" value="Telat"
                                                id="customRadio2" <?php if($waktu > '09:00:00'): ?>
                                            checked
                                            <?php endif; ?>>
                                            <label class="custom-control-label" for="customRadio2">Telat</label>
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
    <input type="hidden" value="<?php echo e(auth()->user()->id); ?>" id="user_id">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {

            var user_id = $('#user_id').val();

            fetch_attendance_data();

            function fetch_attendance_data(query = '') {
                $.ajax({
                    url: "<?php echo e(route('absenAjax')); ?>",
                    method: "GET",
                    data: {
                        query: query,
                        user_id: user_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                        $('#total_tepat').text(data.total_tepat);
                        $('#total_telat').text(data.total_telat);
                        $('#total_tidakmasuk').text(data.total_tidakmasuk);
                        $('#total_absen').text(data.total_absen);
                    }
                });
            }

            $(document).on('input', '#absenFilter', function() {
                var query = $(this).val();
                fetch_attendance_data(query);
            });
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/karyawan/absensi.blade.php ENDPATH**/ ?>