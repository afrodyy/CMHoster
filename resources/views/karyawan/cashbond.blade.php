@extends('layouts.master')

@section('title')
    {{ '| Cashbond' }}
@endsection

@section('cashbond')
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
                        <div class="col-8">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Riwayat Cashbond Kamu</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button type="button" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                data-toggle="modal" data-target="#default">Ajukan Cashbond
                                <i class="feather icon-plus"></i>
                            </button>
                        </div>
                    </div>
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
                                                <th scope="col">Debit</th>
                                                <th scope="col">Kredit</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_row = $cashbond->count();
                                            @endphp
                                            @if ($total_row > 0)
                                                @foreach ($cashbond as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}.</th>
                                                        <td style="color: green">Rp. {{ number_format($item->nominal) }}</td>
                                                        <td style="color: red">Rp. {{ number_format($item->kredit) }}</td>
                                                        <td>{{ $item->tanggal_pengajuan }}</td>
                                                        <td>{{ $item->status }}</td>
                                                        <td>
                                                            @if ($item->status === 'Menunggu konfirmasi')
                                                                <a href="{{ url('cashbond/' . $item->id . '/cancel') }}" class="btn btn-danger btn-sm" onclick="return confirm('Kamu mau batalin pengajuan cashbond?')">Batal</a>
                                                            @elseif ($item->status === 'Disetujui')
                                                                <a href="" class="btn btn-success btn-sm" onclick="return confirm('Langsung bayar ke Faqy ya!')">Bayar</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th class="text-center" colspan="6">Data tidak ditemukan</th>
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
                    <h4 class="modal-title" id="myModalLabel1">Form Pengajuan Cashbond</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('cashbond/pengajuan') }}" method="post">
                        @csrf
                        <input type="hidden" name="kredit" value="0">
                        <div class="form-group">
                            <label for="">Nominal (Rp)</label>
                            <input type="number" name="nominal" class="form-control" placeholder="50000" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alasan Pengajuan</label>
                            <textarea name="alasan" id="alasan" cols="20" rows="4" class="form-control"
                                maxlength="200" required></textarea>
                        </div>
                        <?php $date = date('d-m-Y'); ?>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="tanggal_pengajuan" value="{{ $date }}">
                        <input type="hidden" name="status" id="status" value="Menunggu konfirmasi">
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
