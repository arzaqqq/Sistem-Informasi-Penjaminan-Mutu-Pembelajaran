<x-filament::page>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="bg-gray-900 dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6 text-white">
            <h2 class="text-3xl font-bold flex items-center space-x-2">
                📖 <span>Materi untuk Mata Kuliah: <span class="text-blue-400">{{ $record->nama_mk }}</span></span>
            </h2>
            <p class="text-gray-400 mt-1 text-lg">
                Semester: <span class="font-medium">{{ ucfirst($record->semester) }}</span> |
                Tahun Ajaran: <span class="font-medium">{{ $record->tahun_ajaran }}</span>
            </p>
        </div>

        <!-- Wrapper Tabel agar tidak sempit -->
        <div class="bg-gray-900 dark:bg-gray-800 shadow-md rounded-lg mt-6 p-6">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-600 min-w-[1000px]">
                    <thead class="bg-blue-600 dark:bg-blue-500 text-white text-left text-lg font-semibold">
                        <tr>
                            <th class="border border-gray-600 px-6 py-3">Pertemuan</th>
                            <th class="border border-gray-600 px-6 py-3">Judul Materi</th>
                            <th class="border border-gray-600 px-6 py-3 text-center">File Materi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($record->materis as $materi)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="border border-gray-600 px-6 py-4 text-gray-300 font-medium text-center text-lg">
                                    {{ $materi->pertemuan }}
                                </td>
                                <td class="border border-gray-600 px-6 py-4 text-gray-300 text-lg">
                                    {{ $materi->judul_materi }}
                                </td>
                                <td class="border border-gray-600 px-6 py-4 text-center">
                                    <a href="{{ asset('storage/' . $materi->file_materi) }}"
                                       class="text-blue-400 hover:text-blue-300 font-medium flex items-center justify-center space-x-2 text-lg"
                                       target="_blank">
                                        📥 Download
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</x-filament::page>
