<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <section>
                <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat Terhapus') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Obat</a>
                        </div>
                    </header>

                    @if($obatsTerhapus->isEmpty())
                        <div class="alert alert-info">
                            Tidak ada data obat yang terhapus.
                        </div>
                    @else
                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Kemasan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($obatsTerhapus as $obat)
                                <tr>
                                    <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                    <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                    <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                    <td class="align-middle text-start">
                                        {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                    </td>
                                    <!-- original -->
                                    <!-- <td class="flex items-center gap-3">
                                        {{-- Button Edit --}}
                                        <a href="{{route('dokter.obat.edit', $obat->id)}}" class="btn btn-secondary btn-sm">Edit</a>

                                        {{-- Button Delete --}}
                                        <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td> -->
                                    <td class="flex items-center gap-3">
                                        {{-- Button Restore --}}
                                        <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin mengembalikan obat ini?')">Restore</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                            @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                        </tbody>
                    </table>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <script>
        setTimeout(() => {
            let alert = document.getElementById('alert-success');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('hide');
            }
        }, 4000); // auto-hide setelah 4 detik
    </script>
</x-app-layout>
