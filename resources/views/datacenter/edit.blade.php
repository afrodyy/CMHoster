@extends('layouts.master')

@section('title')
    {{ '| Data Center - edit' }}
@endsection

@section('data-center')
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
                            <h2 class="content-header-title float-left mb-0">Edit Data Center</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Administrator</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ url('data-center') }}">Data Center</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a
                                            href="{{ url('data-center/' . $datacenter->id . '/edit') }}">Edit</a>
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
                                        <form action="{{ url('data-center/' . $datacenter->id . '/update') }}" method="post"
                                            class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="lokasi">Lokasi</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="lokasi" class="form-control"
                                                                    name="lokasi" value="{{ $datacenter->lokasi }}"
                                                                    placeholder="Lokasi">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-map"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea name="alamat" id="alamat" cols="15" rows="3" placeholder="Masukkan alamat lengkap" class="form-control">{{ $datacenter->alamat }}</textarea>
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
                            <a href="{{ url('data-center') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection