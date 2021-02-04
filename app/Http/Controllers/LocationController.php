<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Datacenter;
use App\Models\Ip;
use App\Models\Vps;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::all();
        $datacenter = Datacenter::all();

        return view('location.index', compact('location', 'datacenter'));
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Location::where('nama', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Location::all();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $number = 0;
                foreach ($data as $row) {
                    $number++;
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td>' . $row->nama . '</td>
                            <td>' . $row->datacenter->lokasi . '</td>
                            <td>' . $row->tanggal . '</td>
                            <td>' . $row->spesifikasi . '</td>
                            <td>' .
                        '<a href="location/' . $row->id . '/edit" class="btn btn-sm bg-gradient-info">Ubah</a>' .
                        '<a href="location/' . $row->id . '/delete" method="get" class="btn btn-sm bg-gradient-danger ml-1" onclick="return confirm' . ("Data VPS dengan Nama VM . $row->nama . akan dihapus?") . '">Hapus</a>'
                        . '</td>
                        </tr>
                        ';
                }
            } else {
                $output = '
                    <tr>
                        <td align="center" colspan="6">Data tidak ditemukan</td>
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

    public function input(Request $request)
    {
        $nama = DB::table('location')
            ->select('nama')
            ->where('nama', $request->nama)
            ->first();

        if ($nama === null) {
            Location::create($request->all());
            return redirect('location')->with('success', 'Data berhasil diinput');
        } else {
            $namaServer = $nama->nama;
            if ($request->nama === $namaServer) {
                return redirect('location')->with('failed', 'Nama Server yang diinput sudah ada dalam list!');
            }
        }
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $datacenter = Datacenter::all();

        return view('location.edit', compact('location', 'datacenter'));
    }

    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->all());
        $location->save();

        return redirect('location')->with('success', 'Data Server berhasil diperbaharui!');
    }

    public function destroy($id)
    {
        $ip_id = DB::table('vps')
            ->select('ip_id')
            ->where('location_id', $id)
            ->first();
        $ip = $ip_id->ip_id;

        Ip::where('id', $ip)->update(['status' => 'Belum digunakan']);

        $vps = Vps::where('location_id', $id);
        $vps->delete();

        $location = Location::findOrFail($id);
        $location->delete();

        return redirect('location')->with('success', 'Data berhasil di hapus');
    }
}
