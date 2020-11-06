@extends('layouts.master')

@section('title')
    {{ '| IP Address' }}
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
                            <h2 class="content-header-title float-left mb-0">IP Addresses</h2>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success mt-1">
                                {{ session('success') }}
                            </div>
                        @endif
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
                        <a href="{{ url('master_ip') }}" class="btn-icon btn btn-primary btn-round btn-sm">
                            Tampilkan Semua Data
                        </a>
                    </div>
                    <div class="col-md-4 offset-4">
                        <section id="search-bar">
                            <div class="search-bar right">
                                <form action="{{ url('master_ip') }}" method="get">
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="search" name="cari" class="form-control round" id="searchbar"
                                            placeholder="Cari Alamat IP">
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
                                                <th scope="col">#</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ip as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}.</th>
                                                    <td>{{ $item->ip_address }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-info btn-sm">Ubah</a>
                                                        <form action="{{ url('master_ip/' . $item->id . '/delete') }}"
                                                            method="get" class="d-inline"
                                                            onclick="return confirm('IP Address {{ $item->ip_address }} akan dihapus?')">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm"
                                                                type="submit">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
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
                    <form action="{{ url('master_ip/create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">IP Address</label>
                            <input type="text" name="ip_address" class="form-control" placeholder="255.255.255" required>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <ul class="list-unstyled my-1">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status"
                                                value="Sudah digunakan" id="customRadio1" checked>
                                            <label class="custom-control-label" for="customRadio1">Sudah digunakan</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status"
                                                value="Belum digunakan" id="customRadio2">
                                            <label class="custom-control-label" for="customRadio2">Belum digunakan</label>
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
@endsection
