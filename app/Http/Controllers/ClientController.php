<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $client = Client::where('nama', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $client = Client::all();
        }
        return view('administrator.client.index', compact('client'));
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
