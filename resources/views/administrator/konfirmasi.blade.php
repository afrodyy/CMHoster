@extends('layouts.master')

@section('title')
    {{ '| Konfirmasi' }}
@endsection

@section('admin.cashbond')
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
                            <h2 class="content-header-title float-left mb-0">Form Konfirmasi Cashbond</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Administrator</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ url('client') }}">Cashbond</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a
                                            href="{{ url('admin/cashbond/' . $cashbond->id . '/konfirmasi') }}">Konfirmasi</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Kasbon --}}
            {{-- <div class="content-body">
                <section id="card-actions">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detail Cashbond </h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <p>
                                            You can create a collapsible content by by adding <code>[data-action="collapse"]</code> and wrapping it up
                                            with <code>.heading-elements</code> in <code>.card-header</code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div> --}}

            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h2>Konfirmasi Pengajuan</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ url('admin/cashbond/' . $cashbond->id . '/update') }}"
                                            method="post" class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <table>
                                                                <tr>
                                                                    <td>Nominal Pinjaman</td>
                                                                    <td> : </td>
                                                                    <th>Rp. {{ number_format($cashbond->nominal) }}</th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email-id-icon">Alasan</label>
                                                            <div class="position-relative">
                                                                <textarea name="alasan" class="form-control" id="alasan"
                                                                    cols="15" rows="3"
                                                                    disabled>{{ $cashbond->alasan }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email-id-icon">Status</label>
                                                            <div class="position-relative has-icon-left">
                                                                <select name="status" class="form-control" required>
                                                                    <option value="">-- Perbarui Status --</option>
                                                                    <option value="Menunggu konfirmasi" @if ($cashbond->status == 'Menunggu konfirmasi')
                                                                        selected
                                                                        @endif>Menunggu konfirmasi
                                                                    </option>
                                                                    <option value="Disetujui" @if ($cashbond->status == 'Disetujui')
                                                                        selected
                                                                        @endif>Disetujui</option>
                                                                    <option value="Ditolak" @if ($cashbond->status == 'Ditolak')
                                                                        selected
                                                                        @endif>Ditolak</option>
                                                                </select>
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-mail"></i>
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
                            <a href="{{ url('admin/cashbond') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
