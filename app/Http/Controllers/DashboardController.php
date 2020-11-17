<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Absensi;
use App\Models\Cashbond;

class DashboardController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $absensi = Absensi::where('user_id', $id)->where('status', 'Tidak Masuk')->count();
        $month = date('n');
        $cashbond = Cashbond::where('user_id', $id)
            ->where('status', 'Disetujui')
            ->orWhere('status', '-')
            ->whereMonth('created_at', $month)
            ->get();

        foreach ($cashbond as $c) {
            $debit = $c->nominal;
        }

        if (empty($debit)) {
            $debit = 0;
        }

        return view('dashboard.index', compact('absensi', 'cashbond', 'debit'));
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->save();
        return redirect('dashboard/' . $user->id . '/profile')->with('success', 'Data Kamu Berhasil Diubah');
    }

    public function change_password(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect('dashboard/' . auth()->user()->id . '/profile')->with('success', 'Password change successfully.');
    }
}
