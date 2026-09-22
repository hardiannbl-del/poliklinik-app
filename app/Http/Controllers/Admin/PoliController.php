<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.polis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'nullable',
        ]);

        Poli::create($validated);
        return redirect()->route('polis.index')->with('success', 'Poli Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.polis.edit', compact('poli'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'nullable',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($validated);
        return redirect()->route('polis.index')->with('success', 'Poli Berhasil Di Update');
    }

    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete($poli);
        return redirect()->route('polis.index')->with('success', 'Poli Berhasil Di Hapus');
    }
}
