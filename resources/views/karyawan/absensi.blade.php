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
                            <h2 class="content-header-title float-left mb-0">Riwayat absen kamu</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-4">
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
                            <button type="submit" class="btn-icon btn btn-primary btn-round mb-1 mt-0">Absen</button>
                        </form>
                    </div>
                </div>

                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    @php
                                        $date = date('n');
                                    @endphp
                                    <form action="{{ route('absenAjax') }}" method="get">
                                        <select name="tanggal" id="absenFilter" class="form-control">
                                            <option value="">-- Pilih Bulan --</option>
                                            <option value="01" @if ($date === '01')
                                                selected
                                            @endif>Januari</option>
                                            <option value="02" @if ($date === '02')
                                                selected
                                            @endif>Februari</option>
                                            <option value="03" @if ($date === '03')
                                                selected
                                            @endif>Maret</option>
                                            <option value="04" @if ($date === '04')
                                                selected
                                            @endif>April</option>
                                            <option value="05" @if ($date === '05')
                                                selected
                                            @endif>Mei</option>
                                            <option value="06" @if ($date === '06')
                                                selected
                                            @endif>Juni</option>
                                            <option value="07" @if ($date === '07')
                                                selected
                                            @endif>Juli</option>
                                            <option value="08" @if ($date === '08')
                                                selected
                                            @endif>Agustus</option>
                                            <option value="09" @if ($date === '09')
                                                selected
                                            @endif>September</option>
                                            <option value="10" @if ($date === '10')
                                                selected
                                            @endif>Oktober</option>
                                            <option value="11" @if ($date === '11')
                                                selected
                                            @endif>November</option>
                                            <option value="12" @if ($date === '12')
                                                selected
                                            @endif>Desember</option>
                                        </select>
                                    </form>
                                    <p class="card-text mt-1">Total Absensi : <span class="badge badge-pill bg-info" id="total_absen">{{ $tepatWaktu + $telat }}</span></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-success float-right" id="total_tepat">{{ $tepatWaktu }}</span>
                                            Tepat Waktu
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-warning float-right" id="total_telat">{{ $telat }}</span>
                                            Telat
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-pill bg-danger float-right" id="total_tidakmasuk">{{ $tidakMasuk }}</span>
                                            Tidak Masuk
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
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
    <input type="hidden" value="{{ auth()->user()->id }}" id="user_id">
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {

            var user_id = $('#user_id').val();

            fetch_attendance_data();

            function fetch_attendance_data(query = '') {
                $.ajax({
                    url: "{{ route('absenAjax') }}",
                    method: "GET",
                    data: {
                        query: query,
                        user_id: user_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                        $('#total_tepat').text(data.total_tepat);
                        $('#total_telat').text(data.total_telat);
                        $('#total_tidakmasuk').text(data.total_tidakmasuk);
                        $('#total_absen').text(data.total_absen);
                    }
                });
            }

            $(document).on('input', '#absenFilter', function() {
                var query = $(this).val();
                fetch_attendance_data(query);
            });
        });

    </script>
@endsection