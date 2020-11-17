<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::all();
        return view('location.index', compact('location'));
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
                            <td>' . $row->lokasi . '</td>
                            <td>' . $row->tanggal . '</td>
                            <td>' . $row->hdd . '</td>
                            <td>' . $row->memori . '</td>
                            <td>' .
                        '<a href="location/' . $row->id . '/ubah" class="btn btn-sm bg-gradient-info">Ubah</a>' .
                        '<a href="location/' . $row->id . '/hapus" method="get" class="btn btn-sm bg-gradient-danger ml-1" onclick="return confirm' . ("Data VPS dengan Nama VM . $row->nama . akan dihapus?") . '">Hapus</a>'
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

    public function input(Request $request)
    {
        $location = Location::create($request->all());
        return redirect('location')->with('success', 'Data berhasil diinput');
    }

    public function hapus($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect('location')->with('success', 'Data berhasil di hapus');
    }
}
