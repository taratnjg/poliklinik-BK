<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class JadwalPeriksaController extends Controller
{

    public function index(): View
    {
        // Ambil data jadwal periksa dokter yang sedang login
        $jadwalPeriksas = JadwalPeriksa::where(column: 'id_dokter', operator: Auth::user()->id)->get();

        return view(view: 'dokter.jadwal-periksa.index')->with(
            key: [
                'jadwalPeriksas' => $jadwalPeriksas,
            ],
        );
    }

    public function create(): View
    {
        return view(view: 'dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek apakah jadwal yang sama sudah ada
        $exists = JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $validatedData['hari'])
            ->where('jam_mulai', $validatedData['jam_mulai'])
            ->where('jam_selesai', $validatedData['jam_selesai'])
            ->exists();

        if ($exists) {
            return redirect()->route('dokter.jadwal-periksa.create')->with('error', 'Jadwal tersebut sudah ada.');
        }

        // Simpan jadwal baru
        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $validatedData['hari'],
            'jam_mulai' => $validatedData['jam_mulai'],
            'jam_selesai' => $validatedData['jam_selesai'],
            'status' => 0,
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail(id: $id);

        // Jika user mengaktifkan jadwal yang dipilih
        if (!$jadwalPeriksa->status) {
            // Menonaktifkan semua jadwal periksa dokter yang sedang Login
            JadwalPeriksa::where('id_dokter', Auth::user()->id)->update(['status' => 0]);

            // Mengaktifkan jadwal periksa yang dipilih
            $jadwalPeriksa->status = true;
            $jadwalPeriksa->save();

            return redirect()->route(route: 'dokter.jadwal-periksa.index');
        }

        // Jika user menonaktifkan jadwal yang dipilih
        $jadwalPeriksa->status = false;
        $jadwalPeriksa->save();

        return redirect()->route(route: 'dokter.jadwal-periksa.index');
    }
}
