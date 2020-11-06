<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ip;

class IpController extends Controller
{
    public function index()
    {
        $ip = Ip::all();
        return view('administrator.ip.index', compact('ip'));
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
