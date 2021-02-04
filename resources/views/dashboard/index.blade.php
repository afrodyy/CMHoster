@extends('layouts.master')

@section('dashboard')
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
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-3">Selamat datang, {{ auth()->user()->name }}!</h1>
                    </div>
                </div>
                @if (auth()->user()->role !== 'owner')
                <div class="row">
                    <div class="col-4">
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="../../../app-assets/images/slider/04.jpg" alt="Card image cap" class="card-img-top img-fluid">
                                        <div class="card-body">
                                            <h4 class="card-title">Kamu,</h4>
                                            <p class="card-text">
                                                @if ($absensi === 0)
                                                    <strong>Rajin ya masuk kerja terus!</strong>
                                                @else
                                                    <strong>Bulan ini ga masuk sebanyak {{ $absensi }} hari.</strong>
                                                @endif
                                            </p>
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
                                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Absen yuk</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-4">
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="../../../app-assets/images/slider/05.jpg" alt="Card image cap" class="card-img-top img-fluid">
                                        <div class="card-body">
                                            @if ($debit === 0)
                                                <h4 class="card-title">Kamu,</h4>
                                                <p class="card-text">
                                                    <strong>Lagi ga ada kasbon.</strong>
                                                </p>
                                                <a href="{{ url('cashbond') }}" class="btn btn-outline-primary waves-effect waves-light">Detail</a>
                                            @else
                                                @php
                                                    $sum_debit = 0;
                                                    $sum_kredit = 0;
                                                @endphp
                                                @foreach ($cashbond as $item)
                                                    @php
                                                        $debit = $item->nominal;
                                                        $kredit = $item->kredit;
                                                        $sum_debit += $debit;
                                                        $sum_kredit += $kredit;
                                                    @endphp
                                                @endforeach
                                                <h4 class="card-title">Kamu,</h4>
                                                <p class="card-text">
                                                    <strong>Punya kasbon sebesar Rp. {{ number_format($sum_debit - $sum_kredit) }}</strong>
                                                </p>
                                                <a href="{{ url('cashbond') }}" class="btn btn-outline-primary waves-effect waves-light">Detail</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
