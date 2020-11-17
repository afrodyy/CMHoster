<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ip;
use Symfony\Component\HttpFoundation\IpUtils;

class IpController extends Controller
{
    public function index()
    {
        $ip = Ip::all();
        return view('administrator.ip.index', compact('ip'));
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Ip::where('ip_address', 'LIKE', '%' . $query . '%')
                    ->orWhere('status', 'LIKE', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Ip::all();
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                $number = 0;

                foreach ($data as $row) {
                    $number++;
                    $output .= '
                        <tr>
                            <th>' . $number . '.' . '</th>
                            <td>' . $row->ip_address . '</td>
                            <td>' . $row->status . '</td>
                            <td>' .
                        '<a href="" class="btn btn-sm bg-gradient-info">Ubah</a>' .
                        '<a href="master_ip/' . $row->id . '/delete" class="btn btn-sm bg-gradient-danger ml-1" onclick="return confirm' . ('IP Address ' . $row->ip_address . ' akan dihapus?') . '">Hapus</a>'
                        . '</td>
                        </tr>
                    ';
                }
            } else {
                $output = '
                    <tr>
                        <th align="center" colspan="4">Data tidak ditemukan</th>
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

    public function create(Request $request)
    {
        $ip = Ip::create($request->all());
        return redirect('master_ip');
    }

    public function destroy($id)
    {
        $ip = Ip::findOrFail($id);
        $ip->delete();
        return redirect('master_ip')->with('success', 'IP Address berhasil dihapus');
    }
}
