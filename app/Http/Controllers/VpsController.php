<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vps;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class VpsController extends Controller
{
    // public function index(Request $request)
    // {
    //     if ($request->has('cari')) {
    //         $vps = Vps::where('nama', 'LIKE', '%' . $request->cari . '%')->get();
    //     } else {
    //         $vps = Vps::all();
    //     }
    //     $client = Client::all();
    //     $paginate = Vps::paginate();
    //     return view('dashboard.vps', compact('vps', 'client', 'paginate'));
    // }

    public function index()
    {
        $client = Client::all();
        $vps = Vps::all();
        return view('dashboard.vps', compact('vps', 'client'));
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
                            <td>' . $row->ip_address . '</td>
                            <td>' . $row->lokasi . '</td>
                            <td>' . $row->status . '</td>
                            <td>' .
                        '<a href="/vps/' . $row->id . '/edit" class="btn btn-info btn-sm">Ubah</a>' .
                        '<a href="/vps/' . $row->id . '/delete" method="get" class="btn btn-danger btn-sm ml-1" onclick="return confirm' . ("Data VPS dengan Nama VM . $row->nama . akan dihapus?") . '">Hapus</a>'
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
        $vps = Vps::create($request->all());
        return redirect('vps')->with('success', 'Data VPS Berhasil Diinput');
    }

    public function edit($id)
    {
        $vps = Vps::findOrFail($id);
        $client = Client::all();
        return view('dashboard.edit_vps', compact('vps', 'client'));
    }

    public function update(Request $request, $id)
    {
        $vps = Vps::findOrFail($id);
        $vps->update($request->all());
        $vps->save();
        return redirect('vps/' . $id . '/edit')->with('success', 'Data VPS Berhasil Diperbaharui');
    }

    public function delete($id)
    {
        $vps = Vps::findOrFail($id);
        $vps->delete();
        return redirect('vps')->with('success', 'Data VPS Berhasil Dihapus');
    }
}
