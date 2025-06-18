<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Memeriksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Periksa Pasien') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi form di bawah ini untuk mencatat hasil pemeriksaan pasien dan memilih obat') }}
                            </p>
                        </header>

                        <form class="mt-6" id="formPeriksa" action="{{route('dokter.memeriksa.store', $janjiPeriksa->id)}}" method="POST">
                            @csrf
                            <div class="mb-3 form-group">
                                <label for="namaInput">Nama</label>
                                <input type="text" class="rounded form-control" id="namaInput"
                                    value="{{ $janjiPeriksa->pasien->nama }}" readonly>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="tgl_periksa">Tanggal Periksa</label>
                                <input type="datetime-local" class="rounded form-control" id="tgl_periksa"
                                    name="tgl_periksa"  required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="rounded form-control" name="catatan" id="catatan" rows="3" placeholder="catatan pemeriksaan"></textarea>
                            </div>
                            {{-- Konten form lainnya mungkin ada di sini --}}
                            <div class="mb-3 form-group">
                                <label for="obat">Pilih Obat</label>
                                <select class="rounded form-control" id="obat" name="obats[]" multiple
                                    onchange="hitungBiayaPeriksa()">
                                    @foreach ($obats as $obat)
                                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} (Rp
                                            {{ number_format($obat->harga, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Tekan Ctrl (Windows) atau Command (Mac) untuk
                                    memilih lebih dari satu.</small>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="biaya_periksa">Biaya Pemeriksaan (Rp)</label>
                                <input type="text" class="rounded form-control" id="biaya_periksa"
                                    name="biaya_periksa" value="150000" readonly>
                            </div>

                            <a type="button" href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </form>
                        <script>
                            function hitungBiayaPeriksa() {
                                const baseBiayaPeriksa = 150000;
                                let totalBiaya = baseBiayaPeriksa;
                                const select = document.getElementById('obat');
                                const selectedOptions = Array.from(select.selectedOptions);

                                selectedOptions.forEach(option => {
                                    const harga = parseInt(option.getAttribute('data-harga'));
                                    totalBiaya += harga;
                                });

                                document.getElementById('biaya_periksa').value = totalBiaya;
                            }
                        </script>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
