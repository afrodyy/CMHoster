@extends('layouts.master')

@section('title')
    {{ '| Server - edit' }}
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
                            <h2 class="content-header-title float-left mb-0">Edit Data Server</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Administrator</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ url('location') }}">Server</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a
                                            href="{{ url('location/' . $location->id . '/edit') }}">Edit</a>
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
                                        <form action="{{ url('location/' . $location->id . '/update') }}" method="post"
                                            class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nama">Nama Server</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="nama" class="form-control"
                                                                    name="nama" value="{{ $location->nama }}"
                                                                    placeholder="Nama Server">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-cloud"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="tanggal">Tanggal Pembelian</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="tanggal" class="form-control"
                                                                    name="tanggal" value="{{ $location->tanggal }}"
                                                                    placeholder="Tanggal Pembelian">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="spesifikasi">Spesifikasi</label>
                                                            <textarea name="spesifikasi" id="spesifikasi" cols="15" rows="3" placeholder="Masukkan alamat lengkap" class="form-control">{{ $location->spesifikasi }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="datacenter">Data Center</label>
                                                            <div class="position-relative">
                                                                <select name="datacenter_id" id="datacenter_id" class="form-control" required>
                                                                    <option value="">-- Pilih Data Center --</option>
                                                                    @foreach ($datacenter as $item)
                                                                        <option value="{{ $item->id }}" @if ($item->id === $location->datacenter_id)
                                                                            selected
                                                                        @endif>{{ $item->lokasi }}</option>
                                                                    @endforeach
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
                            <a href="{{ url('location') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('javascript')
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