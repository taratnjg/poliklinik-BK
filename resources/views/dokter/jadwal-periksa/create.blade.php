<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-xl font-semibold mb-2">Tambah Jadwal Periksa</h2>
                    <p class="text-gray-600 mb-6">
                        Silakan isi form di bawah ini untuk menambahkan jadwal pemeriksaan dokter sesuai dengan hari dan
                        waktu yang tersedia.
                    </p>

                    <form method="POST" action="{{ route('dokter.jadwal-periksa.store') }}">
                        @csrf

                        {{-- Pilih Hari --}}
                        <div class="mb-4">
                            <label for="hari" class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                            <select id="hari" name="hari" required
                                class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>

                        {{-- Jam Mulai --}}
                        <div class="mb-4">
                            <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-1">Jam
                                Mulai</label>
                            <input type="time" id="jam_mulai" name="jam_mulai" required
                                class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="mb-4">
                            <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-1">Jam
                                Selesai</label>
                            <input type="time" id="jam_selesai" name="jam_selesai" required
                                class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end gap-2 mt-6">
                            <a href="{{ route('dokter.jadwal-periksa.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
