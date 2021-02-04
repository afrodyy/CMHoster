<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datacenter;
use App\Models\Location;
use App\Models\Vps;
use App\Models\Ip;
use Illuminate\Support\Facades\DB;

class DatacenterController extends Controller
{
    public function index()
    {
        $datacenter = Datacenter::all();

        return view('datacenter.index', compact('datacenter'));
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Datacenter::where('lokasi', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Datacenter::all();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $number = 0;
                foreach ($data as $row) {
                    $number++;
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td>' . $row->lokasi . '</td>
                            <td>' . $row->alamat . '</td>
                            <td>' .
                        '<a href="data-center/' . $row->id . '/edit" class="btn btn-sm bg-gradient-info">Ubah</a>' .
                        '<a href="data-center/' . $row->id . '/delete" method="get" class="btn btn-sm bg-gradient-danger ml-1" onclick="return confirm' . ("Data VPS dengan Nama VM . $row->lokasi . akan dihapus?") . '">Hapus</a>'
                        . '</td>
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
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
    }

    public function create(Request $request)
    {
        $datacenter = Datacenter::create($request->all());

        return redirect('data-center')->with('success', 'Data berhasil diinput');
    }

    public function edit($id)
    {
        $datacenter = Datacenter::find($id);

        return view('datacenter.edit', compact('datacenter'));
    }

    public function update(Request $request, $id)
    {
        $datacenter = Datacenter::findOrFail($id);
        $datacenter->update($request->all());
        $datacenter->save();

        return redirect('data-center')->with('success', 'Data Center berhasil diperbaharui!');
    }

    public function destroy($id)
    {
        $location_id = Location::where('datacenter_id', $id)->first();
        $lokasi = $location_id->id;

        $ip_id = Vps::where('location_id', $lokasi)->first();
        $ip = $ip_id->ip_id;
        $updateIp = Ip::where('id', $ip)->update(['status' => 'Belum digunakan']);

        $vps = Vps::where('location_id', $lokasi);
        $vps->delete();

        $datacenter = Datacenter::findOrFail($id);
        $datacenter->delete();

        $location = Location::where('datacenter_id', $id);
        $location->delete();

        return redirect('data-center')->with('success', 'Datacenter dan data server berhasil dihapus.');
    }
}
