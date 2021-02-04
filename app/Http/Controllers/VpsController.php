<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vps;
use App\Models\Client;
use App\Models\Location;
use App\Models\Ip;
use Illuminate\Support\Facades\DB;

class VpsController extends Controller
{

    public function index()
    {
        $client = Client::all();
        $vps = Vps::all();
        $location = Location::all();
        $ip = DB::table('ip')->orderBy('ip_address', 'asc')->get();

        return view('dashboard.vps', compact('vps', 'client', 'location', 'ip'));
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Vps::where('nama', 'like', '%' . $query . '%')
                    ->orWhere('ip_address', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Vps::all();
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
                            <td>' . $row->client->nama . '</td>
                            <td>' . $row->ip->ip_address . '</td>
                            <td>' . $row->location->nama . '</td>
                            <td>' . $row->status . '</td>
                            <td>' .
                        '<a href="/vps/' . $row->id . '/edit" class="btn btn-sm bg-gradient-info">Ubah</a>' .
                        '<a href="/vps/' . $row->id . '/delete" method="get" class="btn btn-sm bg-gradient-danger ml-1" onclick="return confirm' . ("Data VPS dengan Nama VM . $row->nama . akan dihapus?") . '">Hapus</a>'
                        . '</td>
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

    public function create(Request $request)
    {
        $nama = DB::table('vps')
            ->select('nama')
            ->where('nama', $request->nama)
            ->first();

        if ($nama === null) {
            Vps::create($request->all());
            $id = $request->ip_id;
            Ip::where('id', $id)->update(['status' => 'Sudah digunakan']);

            return redirect('vps')->with('success', 'Data VPS Berhasil Diinput');
        } else {
            $exist = $nama->nama;
            if ($request->nama === $exist) {
                return redirect('vps')->with('failed', 'Nama VM yang diinput sudah ada dalam list!');
            }
        }
    }

    public function edit($id)
    {
        $vps = Vps::findOrFail($id);
        $client = Client::all();
        $ip = Ip::all();
        $location = Location::all();
        $jumlah = $location->count();

        return view('dashboard.edit_vps', compact('vps', 'client', 'ip', 'location', 'jumlah'));
    }

    public function update(Request $request, $id)
    {
        $vps = Vps::findOrFail($id);
        $vps->update($request->all());
        $vps->save();

        return redirect('vps/')->with('success', 'Data VPS Berhasil Diperbaharui');
    }

    public function delete($id)
    {
        $ip_id = DB::table('vps')
            ->select('ip_id')
            ->where('id', $id)
            ->first();
        $ip_id = $ip_id->ip_id;

        Ip::where('id', $ip_id)->update(['status' => 'Belum digunakan']);

        $vps = Vps::findOrFail($id);
        $vps->delete();
        return redirect('vps')->with('success', 'Data VPS Berhasil Dihapus');
    }
}
