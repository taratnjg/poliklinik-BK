<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="flex justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Jadwal Periksa</h2>
                    <a href="{{ route('dokter.jadwal-periksa.create') }}" class="btn btn-primary">
                        Tambah Jadwal Periksa
                    </a>
                </div>
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalPeriksas as $jadwalPeriksa)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $jadwalPeriksa->hari }}</td>
                                <td class="align-middle text-start">
                                    {{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i') }}</td>
                                <td class="align-middle text-start">
                                    {{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i') }}</td>
                                <td class="align-middle text-start">
                                    @if ($jadwalPeriksa->status)
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="align-middle text-start">
                                    <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if ($jadwalPeriksa->status)
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Nonaktifkan
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
