

<?php $__env->startSection('title'); ?>
    <?php echo e('| Client'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('client'); ?>
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
                            <h2 class="content-header-title float-left mb-0">Edit Data Client</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Administrator</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('client')); ?>">Client</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a
                                            href="<?php echo e(url('client/' . $client->id . '/edit')); ?>">Edit</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a
                                    class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="<?php echo e(url('client/' . $client->id . '/update')); ?>" method="post"
                                            class="form form-vertical">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">Full Name</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="first-name-icon" class="form-control"
                                                                    name="nama" value="<?php echo e($client->nama); ?>"
                                                                    placeholder="Full Name">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email-id-icon">Email</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="email" id="email-id-icon" class="form-control"
                                                                    name="email" value="<?php echo e($client->email); ?>"
                                                                    placeholder="Your Email">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-mail"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="contact-info-icon">No. Telpon</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="number" id="contact-info-icon"
                                                                    class="form-control" name="no_telp"
                                                                    value="<?php echo e($client->no_telp); ?>" placeholder="Mobile">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-smartphone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo e(url('client')); ?>" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noc\resources\views/administrator/client/edit.blade.php ENDPATH**/ ?>