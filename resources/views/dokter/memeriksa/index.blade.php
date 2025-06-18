<x-app-layout>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <table class="table mt-6 overflow-hidden rounded table-hover">
                            <thead class="thead-light">
                                <th scope="col">No Urut</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($janjiPeriksas as $janjiPeriksa)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">
                                            {{ $janjiPeriksa->no_antrian }}</th>
                                        <td class="align-middle text-start">{{ $janjiPeriksa->pasien->nama }}</td>
                                        <td class="align-middle text-start">{{ $janjiPeriksa->keluhan }}</td>
                                        <td class="align-middle text-start">
                                            @if (is_null($janjiPeriksa->periksa))
                                                <a href="{{route('dokter.memeriksa.periksa', $janjiPeriksa->id)}}" class="btn btn-primary btn-sm">Periksa</a>
                                            @else
                                                <a href="{{route('dokter.memeriksa.edit', $janjiPeriksa->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </header>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
