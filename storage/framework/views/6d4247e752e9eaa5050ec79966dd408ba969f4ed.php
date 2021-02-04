

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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->

                        <!-- cashbond start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-8">
                                        <h2 class="mb-1">Riwayat Cashbond</h2>
                                    </div>
                                    <div class="col-4">
                                        <form action="<?php echo e(route('cashbondByMonth')); ?>" method="get">
                                            <select name="tanggal_pengajuan" id="search" class="form-control">
                                                <option value="">-- Pilih Bulan --</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-content mt-1">
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
                                            <tbody id="cashbond">
                                                <?php
                                                    $sum_debit = 0;
                                                    $sum_kredit = 0;
                                                ?>
                                                <?php $__currentLoopData = $cashbond; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th><?php echo e($loop->iteration); ?>.</th>
                                                        <td><?php echo e($item->tanggal_pengajuan); ?></td>
                                                        <td style="color: green">Rp. <?php echo e(number_format($item->nominal)); ?></td>
                                                        <td style="color: red">Rp. <?php echo e(number_format($item->kredit)); ?></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php
                                                        $sum_debit += $item->nominal;
                                                        $sum_kredit += $item->kredit;
                                                    ?>
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
                                        <h2 id="month">Absensi</h2>
                                        <?php
                                            $date = date('n');
                                        ?>
                                        <form action="<?php echo e(route('attendanceByMonth')); ?>" method="get">
                                            <select name="tanggal" id="attendanceFilter" class="form-control">
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
                                    </div>
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
                                            <tbody id="absen">
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
                            <input type="hidden" value="<?php echo e($id); ?>" id="user_id">
                        </div>
                        
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {

            var user_id = $('#user_id').val();

            fetch_cashbond_data();

            function fetch_cashbond_data(query = '') {
                $.ajax({
                    url: "<?php echo e(route('cashbondByMonth')); ?>",
                    method: "GET",
                    data: {
                        query: query,
                        user_id: user_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#cashbond').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                });
            }

            $(document).on('input', '#search', function() {
                var query = $(this).val();
                fetch_cashbond_data(query);
            });

            fetch_attendance_data();

            function fetch_attendance_data(query = '') {
                $.ajax({
                    url: "<?php echo e(route('attendanceByMonth')); ?>",
                    method: "GET",
                    data: {
                        query: query,
                        user_id: user_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#absen').html(data.table_data);
                        $('#total_records').text(data.total_data);
                        $('#total_tepat').text(data.total_tepat);
                        $('#total_telat').text(data.total_telat);
                        $('#total_tidakmasuk').text(data.total_tidakmasuk);
                        $('#total_absen').text(data.total_absen);
                    }
                });
            }

            $(document).on('input', '#attendanceFilter', function() {
                var query = $(this).val();
                fetch_attendance_data(query);
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/administrator/profil_karyawan.blade.php ENDPATH**/ ?>