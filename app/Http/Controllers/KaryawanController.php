<?php

namespace App\Http\Controllers;

use App\Models\Cashbond;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $cashbond = Cashbond::all();
        return view('administrator.cashbond', compact('cashbond'));
    }

    public function konfirmasi($id)
    {
        $cashbond = Cashbond::findOrFail($id);
        return view('administrator.konfirmasi', compact('cashbond'));
    }

    public function update(Request $request, $id)
    {
        $cashbond = Cashbond::findOrFail($id);
        $cashbond->update($request->all());
        $cashbond->save();
        return redirect('admin/cashbond')->with('success', 'Data Cashbond Berhasil Diperbaharui');
    }

    public function cashbond()
    {
        $id = auth()->user()->id;
        $cashbond = Cashbond::where('user_id', $id)->get();
        return view('karyawan.cashbond', compact('cashbond'));
    }

    public function pengajuan(Request $request)
    {
        $cashbond = Cashbond::create($request->all());
        return redirect('cashbond')->with('success', 'Kamu berhasil mengajukan cashbond');
    }

    public function pembayaran(Request $request, $id)
    {
        $cashbond = Cashbond::findOrFail($id);
        $cashbond->update($request->all());
        $cashbond->save();
        return redirect('admin/cashbond')->with('success', 'Berhasil update data cashbond');
    }

    public function cancel($id)
    {
        $cashbond = Cashbond::findOrFail($id);
        $cashbond->delete();
        return redirect('cashbond')->with('success', 'Kamu berhasil batalin cashbond');
    }

    public function hapus($id)
    {
        $cashbond = Cashbond::findOrFail($id);
        $cashbond->delete();
        return redirect('admin/cashbond')->with('success', 'Data cashbond berhasil dihapus');
    }

    public function data_karyawan()
    {
        $karyawan = User::where('id', '!=', '4')
            ->orderBy('name', 'asc')
            ->get();
        return view('administrator/data_karyawan', compact('karyawan'));
    }

    public function admin_absen(Request $request)
    {
        $absensi = Absensi::create($request->all());
        return redirect('karyawan/' . $request->user_id . '/profile')->with('success', 'Keterangan Tidak Masuk berhasil diinput');
    }

    public function profil_karyawan($id)
    {
        $month = date('n');
        $karyawan = User::findOrFail($id);
        $cashbond = Cashbond::where('user_id', $id)
            ->where('status', 'Disetujui')
            ->orWhere('status', '-')
            ->whereMonth('created_at', $month)
            ->get();
        $absensi = Absensi::where('user_id', $id)->get();
        $tepatWaktu = Absensi::where('user_id', $id)->where('status', 'Tepat Waktu')->count();
        $telat = Absensi::where('user_id', $id)->where('status', 'Telat')->count();
        $tidakMasuk = Absensi::where('user_id', $id)->where('status', 'Tidak Masuk')->count();

        return view('administrator/profil_karyawan', compact('karyawan', 'cashbond', 'absensi', 'tepatWaktu', 'telat', 'tidakMasuk'));
    }

    public function absensi()
    {
        $month = date('n');
        $id = auth()->user()->id;
        $absensi = Absensi::where('user_id', $id)
            ->whereMonth('created_at', $month)
            ->get();
        return view('karyawan.absensi', compact('absensi'));
    }

    public function absen(Request $request)
    {
        $id = auth()->user()->id;
        $tanggal = date('d-m-Y');
        $absensi = DB::table('absensi')->select('tanggal')->where([
            ['user_id', '=', $id],
            ['tanggal', '=', $tanggal],
        ])->take(1)->get();
        foreach ($absensi as $key => $value) {
            $date = $value->tanggal;
        };
        // dd($date);
        // $month = date('n');
        // $absensi = Absensi::where('user_id', $id)
        //     ->whereMonth('created_at', $month)
        //     ->get();
        // dd($date);
        if (isset($date)) {
            return redirect('absensi')->with('failed', 'Kamu sudah absen hari ini!');
        } else {
            $absen = Absensi::create($request->all());
            return redirect('absensi')->with('success', 'Kamu berhasil absen hari ini. Lakukan absen lagi besok ya');
        }
    }
}
