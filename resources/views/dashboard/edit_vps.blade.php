@extends('layouts.master')

@section('title')
    {{ '| Server' }}
@endsection

@section('server')
    {{ 'active' }}
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Data VPS</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Administrator</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ url('server') }}">Server</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a
                                            href="{{ url('vps/' . $vps->id . '/edit') }}">Edit</a>
                                    </li>
                                </ol>
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
                                        <form action="{{ url('vps/' . $vps->id . '/update') }}" method="post"
                                            class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">Nama VM</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="first-name-icon" class="form-control"
                                                                    name="nama" value="{{ $vps->nama }}"
                                                                    placeholder="Nama VM">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email-id-icon">Client</label>
                                                            <div class="position-relative has-icon-left">
                                                                <select name="client_id" class="form-control" required>
                                                                    <option value="">-- Pilih Client --</option>
                                                                    @foreach ($client as $c)
                                                                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-mail"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="contact-info-icon">IP Address</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="contact-info-icon"
                                                                    class="form-control" name="ip_address"
                                                                    value="{{ $vps->ip_address }}" placeholder="IP Address">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-smartphone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="contact-info-icon">Lokasi Server</label>
                                                            <div class="position-relative has-icon-left">
                                                                <select name="lokasi" id="" class="form-control" required>
                                                                    <option value="">-- Pilih Lokasi Server --</option>
                                                                    <option value="S3" @if ($vps->lokasi == 'S3')
                                                                        selected
                                                                        @endif>S3</option>
                                                                    <option value="S4" @if ($vps->lokasi == 'S4')
                                                                        selected
                                                                        @endif>S4</option>
                                                                </select>
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-smartphone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="contact-info-icon">Status</label>
                                                            <ul class="list-unstyled my-1">
                                                                <li class="d-inline-block mr-2">
                                                                    <fieldset>
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" class="custom-control-input"
                                                                                name="status" value="Aktif"
                                                                                id="customRadio1" @if ($vps->status == 'Aktif')
                                                                            checked
                                                                            @endif>
                                                                            <label class="custom-control-label"
                                                                                for="customRadio1">Aktif</label>
                                                                        </div>
                                                                    </fieldset>
                                                                </li>
                                                                <li class="d-inline-block mr-2">
                                                                    <fieldset>
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" class="custom-control-input"
                                                                                name="status" value="Non-aktif"
                                                                                id="customRadio2" @if ($vps->status == 'Non-aktif')
                                                                            checked
                                                                            @endif>
                                                                            <label class="custom-control-label"
                                                                                for="customRadio2">Non-aktif</label>
                                                                        </div>
                                                                    </fieldset>
                                                                </li>
                                                            </ul>
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
                            <a href="{{ url('server') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
