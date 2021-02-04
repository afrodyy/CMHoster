@extends('layouts.master')

@section('title')
    {{ '| Ip - edit' }}
@endsection

@section('ip')
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
                            <h2 class="content-header-title float-left mb-0">Edit Data Ip</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Administrator</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ url('master_ip') }}">Ip</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a
                                            href="{{ url('master_ip/' . $ip->id . '/edit') }}">Edit</a>
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
                                        <form action="{{ url('master_ip/' . $ip->id . '/update') }}" method="post"
                                            class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nama">Alamat IP</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="ip_address" class="form-control"
                                                                    name="ip_address" value="{{ $ip->ip_address }}"
                                                                    placeholder="Alamat IP">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-server"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <div class="position-relative">
                                                                <select name="status" id="status" class="form-control" required>
                                                                    <option value="">-- Pilih Data Center --</option>
                                                                    <option value="Sudah digunakan" @if ($ip->status === 'Sudah digunakan')
                                                                        selected
                                                                    @endif>Sudah digunakan</option>
                                                                    <option value="Belum digunakan" @if ($ip->status === 'Belum digunakan')
                                                                        selected
                                                                    @endif>Belum digunakan</option>
                                                                </select>
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
                            <a href="{{ url('master_ip') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection