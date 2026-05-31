<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::latest()->paginate(10);
        $total         = Umkm::count();
        $terverifikasi = Umkm::where('status', 'terverifikasi')->count();
        $menunggu      = Umkm::where('status', 'menunggu')->count();
        $wilayah       = Umkm::distinct('kelurahan')->whereNotNull('kelurahan')->count('kelurahan');

        return view('admin.umkm.index', compact(
            'umkms', 'total', 'terverifikasi', 'menunggu', 'wilayah'
        ));
    }

    public function create()
    {
        return view('admin.umkm.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'address'     => 'required|string|max:500',
            'kelurahan'   => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'owner'       => 'nullable|string|max:255',
            'status'      => 'required|in:terverifikasi,menunggu,ditolak',
        ]);

        Umkm::create($data);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'address'     => 'required|string|max:500',
            'kelurahan'   => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'owner'       => 'nullable|string|max:255',
            'status'      => 'required|in:terverifikasi,menunggu,ditolak',
        ]);

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'UMKM berhasil dihapus.');
    }
}
