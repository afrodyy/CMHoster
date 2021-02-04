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
        $user = DB::table('users')
            ->where('id', '!=', '4')
            ->get();

        $cashbond = Cashbond::all();
        return view('administrator.cashbond', compact('cashbond', 'user'));
    }

    function cashbondAjax(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            $id = $request->get('user_id');
            if ($query != '') {
                $data = Cashbond::where('user_id', $query)->get();
            } else {
                $data = Cashbond::all();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $number = 0;
                foreach ($data as $row) {
                    $number++;
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td><a href="/karyawan/' . $row->user->id . '/profile">' . $row->user->name . '</a></td>
                            <td style="color: green">Rp. ' . number_format($row->nominal) . '</td>
                            <td style="color: red">Rp. ' . number_format($row->kredit) . '</td>
                            <td>' . $row->tanggal_pengajuan . '</td>
                            <td>' . $row->status . '</td>
                            <td>' . (($row->status !== "-") ? '<a href="/admin/cashbond/' . $row->id . '/konfirmasi" class="btn btn-sm bg-gradient-info">Konfirmasi</a>' : '') . '
                                <a href="/admin/cashbond/' . $row->id . '/hapus" onclick="return confirm' . ('Yakin?') . '" class="btn btn-sm bg-gradient-danger">Hapus</a>
                            </td>
                        </tr>
                        ';
                }
            } else {
                $output = '
                    <tr>
                        <td align="center" colspan="7">Data tidak ditemukan</td>
                    </tr>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
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
        Cashbond::create($request->all());
        $id = auth()->user()->id;
        if ($id == 4 || $id == 6) {
            return redirect('admin/cashbond')->with('success', 'Berhasil input pembayaran cashbond!');
        } else {
            return redirect('cashbond')->with('success', 'Kamu berhasil mengajukan cashbond');
        }
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
        // dd($karyawan);
        $cashbond = Cashbond::where('user_id', $id)
            ->where('status', '!=', 'Menunggu konfirmasi')
            ->where('status', '!=', 'Ditolak')
            ->get();
        // dd($cashbond);
        $absensi = Absensi::where('user_id', $id)->get();
        $tepatWaktu = Absensi::where('user_id', $id)->where('status', 'Tepat Waktu')->count();
        $telat = Absensi::where('user_id', $id)->where('status', 'Telat')->count();
        $tidakMasuk = Absensi::where('user_id', $id)->where('status', 'Tidak Masuk')->count();
        $id = $id;

        return view('administrator/profil_karyawan', compact('karyawan', 'cashbond', 'absensi', 'tepatWaktu', 'telat', 'tidakMasuk', 'id'));
    }

    function cashbondByMonth(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            $id = $request->get('user_id');
            if ($query != '') {
                $data = Cashbond::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->where('status', '!=', 'Menunggu konfirmasi')
                    ->where('status', '!=', 'Ditolak')
                    ->get();
            } else {
                $data = Cashbond::where('user_id', $id)
                    ->where('status', '!=', 'Menunggu konfirmasi')
                    ->where('status', '!=', 'Ditolak')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $number = 0;
                foreach ($data as $row) {
                    $number++;
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td>' . $row->tanggal_pengajuan . '</td>
                            <td style="color: green">Rp. ' . number_format($row->nominal) . '</td>
                            <td style="color: red">Rp. ' . number_format($row->kredit) . '</td>
                            <td>' . '-' . '</td>
                        </tr>
                        ';
                }
            } else {
                $output = '
                    <tr>
                        <td align="center" colspan="5">Data tidak ditemukan</td>
                    </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
    }

    function attendanceByMonth(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            $id = $request->get('user_id');
            if ($query != '') {
                $data = Absensi::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->get();
                $total_tepat = Absensi::where('user_id', $id)
                    ->where('status', 'Tepat Waktu')
                    ->whereMonth('created_at', $query)
                    ->count();
                $total_telat = Absensi::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->where('status', 'Telat')
                    ->count();
                $total_tidakmasuk = Absensi::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->where('status', 'Tidak Masuk')
                    ->count();
                $total_absen = $total_tepat + $total_telat;
            } else {
                $data = Absensi::where('user_id', $id)->get();
                $total_tepat = Absensi::where('user_id', $id)->where('status', 'Tepat Waktu')->count();
                $total_telat = Absensi::where('user_id', $id)->where('status', 'Telat')->count();
                $total_tidakmasuk = Absensi::where('user_id', $id)->where('status', 'Tidak Masuk')->count();
                $total_absen = $total_tepat + $total_telat;
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                $number = 0;
                foreach ($data as $row) {
                    $number++;
                    if ($row->status === 'Telat') {
                        $color = 'orange';
                    } elseif ($row->status === 'Tepat Waktu') {
                        $color = 'green';
                    } else {
                        $color = 'red';
                    }
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td>' . $row->tanggal . '</td>
                            <td>' . $row->waktu . '</td>
                            <td style="color: ' . $color . '">' . $row->status . '</td>
                        </tr>
                        ';
                }
            } else {
                $output = '
                    <tr>
                        <td align="center" colspan="4">Data tidak ditemukan</td>
                    </tr>
                ';
            }

            $data = array(
                'table_data'       => $output,
                'total_data'       => $total_row,
                'total_tepat'      => $total_tepat,
                'total_tidakmasuk' => $total_tidakmasuk,
                'total_telat'      => $total_telat,
                'total_absen'      => $total_absen
            );
            echo json_encode($data);
        }
    }

    public function absensi()
    {
        $month = date('n');
        $id = auth()->user()->id;

        $absensi = Absensi::where('user_id', $id)->get();
        $tepatWaktu = Absensi::where('user_id', $id)->where('status', 'Tepat Waktu')->count();
        $telat = Absensi::where('user_id', $id)->where('status', 'Telat')->count();
        $tidakMasuk = Absensi::where('user_id', $id)->where('status', 'Tidak Masuk')->count();

        return view('karyawan.absensi', compact('absensi', 'tepatWaktu', 'telat', 'tidakMasuk'));
    }

    function absenAjax(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            $id = $request->get('user_id');
            if ($query != '') {
                $data = Absensi::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->get();
                $total_tepat = Absensi::where('user_id', $id)
                    ->where('status', 'Tepat Waktu')
                    ->whereMonth('created_at', $query)
                    ->count();
                $total_telat = Absensi::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->where('status', 'Telat')
                    ->count();
                $total_tidakmasuk = Absensi::where('user_id', $id)
                    ->whereMonth('created_at', $query)
                    ->where('status', 'Tidak Masuk')
                    ->count();
                $total_absen = $total_tepat + $total_telat;
            } else {
                $data = Absensi::where('user_id', $id)->get();
                $total_tepat = Absensi::where('user_id', $id)->where('status', 'Tepat Waktu')->count();
                $total_telat = Absensi::where('user_id', $id)->where('status', 'Telat')->count();
                $total_tidakmasuk = Absensi::where('user_id', $id)->where('status', 'Tidak Masuk')->count();
                $total_absen = $total_tepat + $total_telat;
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                $number = 0;
                foreach ($data as $row) {
                    $number++;
                    if ($row->status === 'Telat') {
                        $color = 'orange';
                    } elseif ($row->status === 'Tepat Waktu') {
                        $color = 'green';
                    } else {
                        $color = 'red';
                    }
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td>' . $row->tanggal . '</td>
                            <td>' . $row->waktu . '</td>
                            <td style="color: ' . $color . '">' . $row->status . '</td>
                        </tr>
                        ';
                }
            } else {
                $output = '
                    <tr>
                        <td align="center" colspan="4">Data tidak ditemukan</td>
                    </tr>
                ';
            }

            $data = array(
                'table_data'       => $output,
                'total_data'       => $total_row,
                'total_tepat'      => $total_tepat,
                'total_tidakmasuk' => $total_tidakmasuk,
                'total_telat'      => $total_telat,
                'total_absen'      => $total_absen
            );
            echo json_encode($data);
        }
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

        if (isset($date)) {
            return redirect('absensi')->with('failed', 'Kamu sudah absen hari ini!');
        } else {
            $absen = Absensi::create($request->all());
            return redirect('absensi')->with('success', 'Kamu berhasil absen hari ini. Lakukan absen lagi besok ya');
        }
    }

    public function add_user(Request $request)
    {
        User::create($request->all());

        return redirect('admin/data_karyawan')->with('success', 'Berhasil tambah user');
    }
}
