<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Ip;
use App\Models\Vps;
use Illuminate\Support\Facades\DB;

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
        $email = DB::table('client')
            ->select('email')
            ->where('email', $request->email)
            ->first();

        if ($email === null) {
            Client::create($request->all());

            return redirect('client')->with('success', 'Data berhasil diinput');
        } else {
            $exist = $email->email;
            if ($request->email === $exist) {
                return redirect('client')->with('failed', 'Email yang diinput sudah ada dalam list!');
            }
        }
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

        return redirect('client')->with('success', 'Data client berhasil diperbarui');
    }

    public function destroyClient($id)
    {
        $vps = Vps::where('client_id', $id)->first();

        $ip_id = $vps->ip_id;
        $client_id = $vps->client_id;
        Ip::where('id', $ip_id)->update(['status' => 'Belum digunakan']);
        Vps::where('client_id', $client_id)->delete();

        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('client')->with('success', 'Data Client Berhasil Dihapus');
    }
}
