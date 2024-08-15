<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Bus;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class BusController extends Controller
{
    //
    public function index()
    {
        $buses = Bus::where('is_deleted', 0)->get();
        return view('admin.bus.index', compact('buses'));
    }

    public function create()
    {
        return view('admin.bus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bus' => 'required|max:255|min:3',
            'plat_nomor' => 'required|max:255|min:3',
            'tahun' => 'required|integer|min:1990|max:' . date('Y'),
            'warna' => 'required|max:255|min:3',
            'no_mesin' => 'required|max:255|min:3',
            'no_sasis' => 'required|max:255|min:3',
            'jumlah_penumpang' => 'required|integer|min:1|max:100',
            'bagasi' => 'required|integer|min:1|max:100',
            'gambar1' => 'nullable|image|max:2048',
            'gambar2' => 'nullable|image|max:2048',
            'gambar3' => 'nullable|image|max:2048',
            'gambar4' => 'nullable|image|max:2048',
            'status' => 'required',
        ]);

        $bus = new Bus();
        $bus->nama_bus = $request->nama_bus;
        $bus->plat_nomor = $request->plat_nomor;
        $bus->tahun = $request->tahun;
        $bus->warna = $request->warna;
        $bus->no_mesin = $request->no_mesin;
        $bus->no_sasis = $request->no_sasis;
        $bus->jumlah_penumpang = $request->jumlah_penumpang;
        $bus->bagasi = $request->bagasi;

        if ($request->hasFile('gambar1')) {
            $bus->gambar1 = $request->file('gambar1')->store('bus', 'public');
        }
        if ($request->hasFile('gambar2')) {
            $bus->gambar2 = $request->file('gambar2')->store('bus', 'public');
        }
        if ($request->hasFile('gambar3')) {
            $bus->gambar3 = $request->file('gambar3')->store('bus', 'public');
        }
        if ($request->hasFile('gambar4')) {
            $bus->gambar4 = $request->file('gambar4')->store('bus', 'public');
        }
        $bus->status = $request->status;
        $bus->save();

        return redirect()->route('admin.bus.index')->with([
            'message' => 'Data Bus Berhasi Disimpan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $bus = Bus::find($id);
        return view('admin.bus.edit', compact('bus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bus' => 'required|max:255|min:3',
            'plat_nomor' => 'required|max:255|min:3',
            'tahun' => 'required|integer|min:1990|max:' . date('Y'),
            'warna' => 'required|max:255|min:3',
            'no_mesin' => 'required|max:255|min:3',
            'no_sasis' => 'required|max:255|min:3',
            'jumlah_penumpang' => 'required|integer|min:1|max:100',
            'bagasi' => 'required|integer|min:1|max:100',
            'gambar1' => 'nullable|image|max:2048',
            'gambar2' => 'nullable|image|max:2048',
            'gambar3' => 'nullable|image|max:2048',
            'gambar4' => 'nullable|image|max:2048',
            'status' => 'required',
        ]);
        $bus = Bus::find($id);
        $bus->nama_bus = $request->nama_bus;
        $bus->plat_nomor = $request->plat_nomor;
        $bus->tahun = $request->tahun;
        $bus->warna = $request->warna;
        $bus->no_mesin = $request->no_mesin;
        $bus->no_sasis = $request->no_sasis;
        $bus->bagasi = $request->bagasi;
        $bus->jumlah_penumpang = $request->jumlah_penumpang;
        $bus->status = $request->status;
        if ($request->hasFile('gambar1')) {
            if ($bus->gambar1) {
                Storage::disk('public')->delete($bus->gambar1);
            }
            $bus->gambar1 = $request->file('gambar1')->store('bus', 'public');
        }
        if ($request->hasFile('gambar2')) {
            if ($bus->gambar2) {
                Storage::disk('public')->delete($bus->gambar2);
            }
            $bus->gambar2 = $request->file('gambar2')->store('bus', 'public');
        }
        if ($request->hasFile('gambar3')) {
            if ($bus->gambar3) {
                Storage::disk('public')->delete($bus->gambar3);
            }
            $bus->gambar3 = $request->file('gambar3')->store('bus', 'public');
        }
        if ($request->hasFile('gambar4')) {
            if ($bus->gambar4) {
                Storage::disk('public')->delete($bus->gambar4);
            }
            $bus->gambar4 = $request->file('gambar4')->store('bus', 'public');
        }
        $bus->save();
        return redirect()->route('admin.bus.index')->with([
            'message' => 'Data Bus Berhasi Disimpan',
            'alert-type' => 'success'
        ]);
    }

    public function editGambar($id, $gambar)
    {
        $bus = Bus::find($id);
        return view('admin.bus.edit_gambar', compact('bus', 'gambar'));
    }

    public function updateGambar(Request $request, $id, $gambar)
    {
        $request->validate([
            $gambar => 'required|image|max:1024',
        ]);

        $bus = Bus::findorFail($id);

        if ($request->hasFile($gambar)) {
            if ($bus->$gambar) {
                Storage::disk('public')->delete($bus->$gambar);
            }
            $bus->$gambar = $request->file($gambar)->store('bus', 'public');
        }
        
        $bus->save();

        return redirect()->route('admin.bus.edit', $id)->with([
            'message' => 'Gambar Bus Berhasi Disimpan',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $bus = Bus::find($id);
        // if ($bus->gambar1) {
        //     Storage::disk('public')->delete($bus->gambar1);
        // }
        // if ($bus->gambar2) {
        //     Storage::disk('public')->delete($bus->gambar2);
        // }    
        // if ($bus->gambar3) {
        //     Storage::disk('public')->delete($bus->gambar3);
        // }
        // if ($bus->gambar4) {
        //     Storage::disk('public')->delete($bus->gambar4);
        // }
        // $bus->delete();

        $bus->update(['is_deleted' => 1]);

        return redirect()->route('admin.bus.index')->with([
            'message' => 'Data Bus Berhasi Dihapus',
            'alert-type' => 'success'
        ]);
    }
}
