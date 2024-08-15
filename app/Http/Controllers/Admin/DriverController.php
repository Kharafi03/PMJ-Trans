<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    //
    public function index()
    {
        $drivers = User::where('role', 'driver')->where('is_deleted', 0)->get();
        return view('admin.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|min:3',
            'email' => 'required|max:255|min:3|email|unique:users',
            'nomor_telepon' => 'required|max:255|min:3',
            'password' => 'required|max:255|min:3',
            'ktp' => 'required|max:255|min:3',
            'sim' => 'required|max:255|min:3',
            'status' => 'required',
        ]);

        $driver = new User();
        $driver->nama = $request->nama;
        $driver->nomor_telepon = $request->nomor_telepon;
        $driver->email = $request->email;
        $driver->password = bcrypt($request->password);
        $driver->role = 'driver';
        $driver->status = $request->status;

        if ($request->hasFile('ktp')) {
            $driver->ktp = $request->file('ktp')->store('driver', 'public');
        }
        if ($request->hasFile('sim')) {
            $driver->sim = $request->file('sim')->store('driver', 'public');
        }

        $driver->status = $request->status;
        $driver->save();
        return redirect()->route('admin.driver.index')->with([
            'message' => 'Data Driver Berhasi Disimpan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $driver = User::find($id);
        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $driver = User::find($id);
        $driver->nama = $request->nama;
        $driver->nomor_telepon = $request->nomor_telepon;
        $driver->email = $request->email;
        $driver->status = $request->status;

        if ($request->hasFile('ktp')) {
            if ($driver->ktp) {
                Storage::disk('public')->delete($driver->ktp);
            }
            $driver->ktp = $request->file('ktp')->store('driver', 'public');
        }
        if ($request->hasFile('sim')) {
            if ($driver->sim) {
                Storage::disk('public')->delete($driver->sim);
            }
            $driver->sim = $request->file('sim')->store('driver', 'public');
        }

        $driver->save();
        return redirect()->route('admin.driver.index')->with([
            'message' => 'Data Driver Berhasi Disimpan',
            'alert-type' => 'success'
        ]);
    }

    public function editGambar($id, $gambar)
    {
        $driver = User::find($id);
        return view('admin.driver.edit_gambar', compact('driver', 'gambar'));
    }

    public function updateGambar(Request $request, $id, $gambar)
    {
        $request->validate([
            $gambar => 'required|image|max:1024',
        ]);

        $driver = User::findorFail($id);

        if ($request->hasFile($gambar)) {
            if ($driver->$gambar) {
                Storage::disk('public')->delete($driver->$gambar);
            }
            $driver->$gambar = $request->file($gambar)->store('driver', 'public');
        }

        $driver->save();

        return redirect()->route('admin.driver.edit', $id)->with([
            'message' => 'Gambar ' . $gambar . ' Driver Berhasil Disimpan',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $driver = User::find($id);
        
        $driver->update(['is_deleted' => 1]);

        return redirect()->route('admin.driver.index')->with([
            'message' => 'Data Driver Berhasil Dihapus',
            'alert-type' => 'success'
        ]);
    }
}
