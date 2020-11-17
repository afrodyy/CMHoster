<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $client = Client::all();
        return view('administrator.client.index', compact('client'));
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Client::where('nama', 'LIKE', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Client::all();
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
                            <td>' . $row->email . '</td>
                            <td>' . $row->no_telp . '</td>
                            <td>' .
                        '<a href="client/' . $row->id . '/edit" class="btn btn-sm bg-gradient-info">Ubah</a>' .
                        '<a href="client/' . $row->id . '/delete" class="btn btn-sm bg-gradient-danger ml-1" onclick="return confirm' . ('Data client dengan nama ' . $row->nama . ' akan dihapus?') . '">Hapus</a>'
                        . '</td>
                        </tr>
                    ';
                }
            } else {
                $output = '
                    <tr>
                        <th align="center" colspan="5">Data tidak ditemukan</th>
                    </tr>
                ';
            }

            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }

    public function newClient(Request $request)
    {
        $c = Client::create($request->all());
        return redirect('/client')->with('success', 'Data Client Berhasil Diinput');
    }

    public function editClient($id)
    {
        $client = Client::findOrFail($id);
        return view('administrator.client.edit', compact('client'));
    }

    public function updateClient(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        $client->save();
        return redirect('client');
    }

    public function destroyClient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect('/client')->with('success', 'Data Client Berhasil Dihapus');
    }
}
