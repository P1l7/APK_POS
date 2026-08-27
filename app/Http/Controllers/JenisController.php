<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisController extends Controller
{
    /**
     * Tampilkan daftar jenis.
     */
    public function index()
    {
        $jenis = Jenis::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Tampilkan form tambah jenis.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Simpan jenis baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'user_id'    => Auth::id(),
            'nama_jenis' => $validated['nama_jenis'],
        ]);

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail jenis (opsional, jarang dipakai untuk data master).
     */
    public function show(Jenis $jeni)
    {
        return view('jenis.show', compact('jeni'));
    }

    /**
     * Tampilkan form edit jenis.
     */
    public function edit(Jenis $jeni)
    {
        return view('jenis.edit', compact('jeni'));
    }

    /**
     * Update data jenis.
     */
    public function update(Request $request, Jenis $jeni)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jeni->update([
            'nama_jenis' => $validated['nama_jenis'],
        ]);

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil diperbarui.');
    }

    /**
     * Hapus data jenis.
     */
    public function destroy(Jenis $jeni)
    {
        $jeni->delete();

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil dihapus.');
    }
}