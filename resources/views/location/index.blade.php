@extends('layouts.master')

@section('title')
    {{ '| Location' }}
@endsection

@section('location')
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
                            <h2 class="content-header-title float-left mb-0">Data Server</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button type="button" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                data-toggle="modal" data-target="#default">Input Data
                                <i class="feather icon-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-8">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('failed'))
                            <div class="alert alert-danger">
                                {{ session('failed') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-4">
                        <section id="search-bar">
                            <div class="search-bar right">
                                <form action="{{ url('location/search') }}" method="get">
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" name="search" autocomplete="off" class="form-control round"
                                            id="search" placeholder="Cari data server">
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
                                                <th scope="col">Nama Server</th>
                                                <th scope="col">Lokasi Data Center</th>
                                                <th scope="col">Tanggal Pembelian</th>
                                                <th scope="col">Spesifikasi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($location as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}.</th>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->datacenter->lokasi }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->spesifikasi }}</td>
                                                <td>
                                                    <a href="{{ url('location/' . $item->id . '/hapus') }}" class="btn btn-sm bg-gradient-danger" onclick="return confirm('Yakin ingin hapus data?')">Hapus</a>
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
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Input Data Server</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('location/input') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Server</label>
                            <input type="text" name="nama" id="nama" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi Data Center</label>
                            <select name="datacenter_id" id="datacenter_id" class="form-control" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach ($datacenter as $d)
                                    <option value="{{ $d->id }}">{{ $d->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pembelian Server</label>
                            <input type="text" name="tanggal" id="tanggal" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="spesifikasi">Spesifikasi</label>
                            <textarea name="spesifikasi" id="spesifikasi" class="form-control" cols="15" rows="5"></textarea>
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

@section('javascript')
    <script>
        $(document).ready(function() {

            fetch_server_data();

            function fetch_server_data(query = '') {
                $.ajax({
                    url: "{{ route('location.search') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                });
            }

            $(document).on('keyup', '#search', function() {
                var query = $(this).val();
                fetch_server_data(query);
            });
        });

    </script>

    <script>
        $( function() {
            $( "#tanggal" ).datepicker({
                dateFormat: "dd-mm-yy"
            });
        });

    </script>
@endsection

@section('jquery')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection