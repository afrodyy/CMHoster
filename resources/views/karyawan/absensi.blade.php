@extends('layouts.master')

@section('title')
    {{ '| Absensi' }}
@endsection

@section('absensi')
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
                            <div class="alert alert-success mt-1">
                                {{ session('success') }}
                            </div>
                            @elseif (session('failed'))
                            <div class="alert alert-danger mt-1">
                                {{ session('failed') }}
                            </div>
                            @endif
                            <h2 class="content-header-title float-left">Riwayat absen kamu bulan {{ date('F') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-4 offset-1">
                        <form action="{{ url('absen') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <?php $tanggal = date('d-m-Y'); ?>
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                            <?php $waktu = date('H:i:s'); ?>
                            <input type="hidden" name="waktu" value="{{ $waktu }}">
                            @if ($waktu > '09:10:00')
                                <input type="hidden" name="status" value="Telat">
                            @elseif($waktu <= '09:10:00' ) <input type="hidden" name="status" value="Tepat Waktu">
                            @endif
                            <button type="submit" class="btn-icon btn btn-primary btn-round mb-1">Absen</button>
                        </form>
                    </div>
                </div>
                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-10 offset-1">
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
                                            @php
                                                $total_row = $absensi->count();
                                            @endphp

                                            @if ($total_row > 0)
                                                @foreach ($absensi as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}.</th>
                                                        <td>{{ $item->tanggal }}</td>
                                                        <td>{{ $item->waktu }}</td>
                                                        <td>{{ $item->status }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th class="text-center" colspan="4">Data tidak ditemukan</th>
                                                </tr>
                                            @endif
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
                    <form action="{{ url('absen') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="form-group">
                            <?php $tanggal = date('d-m-Y'); ?>
                            <label for="">Tanggal</label>
                            <input type="text" name="tanggal" class="form-control" value="{{ $tanggal }}">
                        </div>
                        <div class="form-group">
                            <?php $waktu = date('H:i:s'); ?>
                            <label for="">Waktu</label>
                            <input type="text" name="waktu" class="form-control" value="{{ $waktu }}">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <ul class="list-unstyled my-1">

                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status"
                                                value="Tepat Waktu" id="customRadio1" @if ($waktu <= '09:00:00')
                                            checked
                                            @endif>
                                            <label class="custom-control-label" for="customRadio1">Tepat Waktu</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="status" value="Telat"
                                                id="customRadio2" @if ($waktu > '09:00:00')
                                            checked
                                            @endif>
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
@endsection
