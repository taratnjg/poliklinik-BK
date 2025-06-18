<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cari jadwal periksa dokter yang sedang aktif
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('status', true)
            ->first();

        // Dapatkan daftar janji periksa yang terkait dengan jadwal periksa yang aktif
        $janjiPeriksas = JanjiPeriksa::where('id_jadwal_periksa', $jadwalPeriksa->id)->get();

        return view('dokter.memeriksa.index')->with([
            'janjiPeriksas' => $janjiPeriksas,
            'jadwalPeriksa' => $jadwalPeriksa,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function periksa($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail(id: $id);
        $obats = Obat::all();

        return view(view: 'dokter.memeriksa.periksa')->with([
            'janjiPeriksa' => $janjiPeriksa,
            'obats' => $obats,
        ]);
    }

    public function store($id, Request $request)
    {
        $validatedData = $request->validate(
            rules: [
                'tgl_periksa' => 'required|date',
                'catatan' => 'nullable|string|max:255',
                'biaya_periksa' => 'required|numeric|min:0',
                'obats' => 'array',
                'obats.*' => 'exists:obats,id',
            ],
        );

        $janjiPeriksa = JanjiPeriksa::findOrFail(id: $id);

        $periksa = Periksa::create(
            attributes: [
                'id_janji_periksa' => $janjiPeriksa->id,
                'tgl_periksa' => $validatedData['tgl_periksa'],
                'catatan' => $validatedData['catatan'],
                'biaya_periksa' => $validatedData['biaya_periksa'],
            ],
        );

        foreach ($validatedData['obats'] as $obatId) {
            DetailPeriksa::create(
                attributes: [
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ],
            );
        }

        return redirect()->route(route: 'dokter.memeriksa.index');
    }

    public function edit($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail(id: $id);
        $obats = Obat::all();

        return view('dokter.memeriksa.edit')->with([
            'janjiPeriksa' => $janjiPeriksa,
            'obats' => $obats,
        ]);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate(
            rules: [
                'tgl_periksa' => 'required|date',
                'catatan' => 'nullable|string|max:255',
                'biaya_periksa' => 'required|numeric|min:0',
                'obats' => 'array',
                'obats.*' => 'exists:obats,id',
            ],
        );

        $janjiPeriksa = JanjiPeriksa::findOrFail(id: $id);

        $periksa = Periksa::where('id_janji_periksa', $janjiPeriksa->id)->first();

        $periksa->update(
            attributes: [
                'tgl_periksa' => $validatedData['tgl_periksa'],
                'catatan' => $validatedData['catatan'],
                'biaya_periksa' => $validatedData['biaya_periksa'],
            ],
        );

        //hapus detail periksa lama
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        //menambahkan detail periksa baru
        foreach ($validatedData['obats'] as $obatId) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obatId,
            ]);
        }

        return redirect()->route(route: 'dokter.memeriksa.index');
    }
}
