@extends('layouts.master')

@section('title')
    {{ '| Profil Karyawan' }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('admin.karyawan')
    {{ 'active' }}
@endsection

@section('content')
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
                                                    <td>{{ $karyawan->username }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Name</td>
                                                    <td>{{ $karyawan->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td>{{ $karyawan->email }}</td>
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
                                                    <td>{{ $karyawan->role }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <a href="app-user-edit.html" class="btn btn-primary mr-1"><i
                                                    class="feather icon-edit-1"></i> Edit</a>
                                            <button class="btn btn-outline-danger"><i class="feather icon-trash-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->

                        <!-- cashbond start -->
                        {{-- <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-1">Riwayat Cashbond</h2>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nominal</th>
                                                    <th scope="col">Tanggal Pengajuan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cashbond as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}.</th>
                                                        <td>Rp. {{ number_format($item->nominal) }}</td>
                                                        <td>{{ $item->tanggal_pengajuan }}</td>
                                                        <td>{{ $item->status }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/cashbond/' . $item->id . '/konfirmasi') }}"
                                                                class="btn btn-info btn-sm">Konfirmasi</a>
                                                            <a href="{{ url('cashbond/' . $item->id . '/cancel') }}"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Kamu mau batalin pengajuan cashbond?')">Batal</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- cashbond end -->

                        <!-- cashbond start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-1">Riwayat Cashbond</h2>
                                </div>
                                <div class="card-content">
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
                                            <tbody>
                                                <?php $sum_debit = 0; ?>
                                                <?php $sum_kredit = 0; ?>
                                                @foreach ($cashbond as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}.</th>
                                                        <td>{{ $item->tanggal_pengajuan }}</td>
                                                        <td>Rp. {{ number_format($item->nominal) }}</td>
                                                        <td>Rp. {{ number_format($item->kredit) }}</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php $sum_debit += $item->nominal ?>
                                                    <?php $sum_kredit += $item->kredit ?>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <th>Rp. {{ number_format($sum_debit) }}</th>
                                                    <th>Rp. {{ number_format($sum_kredit) }}</th>
                                                    <th>Rp. {{ number_format($sum_debit - $sum_kredit) }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- cashbond end -->

                        <div class="col-xl-4 col-md-6 col-sm-12">
                            @if (session('success'))
                            <div class="alert alert-info">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h2>Absensi</h2>
                                        <p class="card-text">Total Absensi : <span class="badge badge-pill bg-info">{{ $tepatWaktu + $telat }}</span></p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-success float-right">{{ $tepatWaktu }}</span>
                                            Tepat Waktu
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-warning float-right">{{ $telat }}</span>
                                            Telat
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-danger float-right">{{ $tidakMasuk }}</span>
                                            Tidak Masuk
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Absensi --}}
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
                                            <tbody>
                                                @foreach ($absensi as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}.</th>
                                                        <td>{{ $item->tanggal }}</td>
                                                        <td>{{ $item->waktu }}</td>
                                                        <td>{{ $item->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Akhir Absensi --}}
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
