<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ip;
use App\Models\Vps;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\IpUtils;

use function PHPUnit\Framework\isNull;

class IpController extends Controller
{
    public function index()
    {
        $ip = DB::table('ip')->orderBy('ip_address', 'asc')->get();

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
                $data = DB::table('ip')->orderBy('ip_address', 'asc')->get();
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
                        '<a href="master_ip/' . $row->id . '/edit" class="btn btn-sm bg-gradient-info">Ubah</a>' .
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
        $ip_address = DB::table('ip')
            ->select('ip_address')
            ->where('ip_address', $request->ip_address)
            ->first();

        if ($ip_address === null) {
            Ip::create($request->all());
            return redirect('master_ip')->with('success', 'IP berhasil diinput.');
        } else {
            $ip = $ip_address->ip_address;
            if ($request->ip_address === $ip) {
                return redirect('master_ip')->with('failed', 'IP yang diinput sudah ada dalam list!');
            }
        }
    }

    public function edit($id)
    {
        $ip = Ip::findOrFail($id);

        return view('administrator.ip.edit', compact('ip'));
    }

    public function update(Request $request, $id)
    {
        $ip = Ip::findOrFail($id);
        $ip->update($request->all());
        $ip->save();

        return redirect('master_ip')->with('success', 'Data IP berhasil diperbaharui!');
    }

    public function destroy($id)
    {
        Vps::where('ip_id', $id)->delete();
        $ip = Ip::findOrFail($id);
        $ip->delete();
        return redirect('master_ip')->with('success', 'IP Address berhasil dihapus');
    }
}
