<x-filament::page>
    <div class="p-4 mb-6 bg-white rounded-xl shadow dark:bg-gray-800">
        @if($matakuliahData && $kelasData)
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $matakuliahData->nama_mk }}
                    </h2>
                    <div class="mt-1 text-gray-500 dark:text-gray-400">
                        Tahun Ajaran: {{ $matakuliahData->tahun_ajaran }}
                    </div>
                    <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 dark:bg-primary-900 dark:text-primary-300">
                        {{ $kelasData->nama_kelas }}
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="text-right text-gray-500 dark:text-gray-400">
                        Kode Mata Kuliah: {{ $matakuliahData->kode_mk ?? 'N/A' }}
                    </div>
                    <div class="text-right text-gray-500 dark:text-gray-400 mt-1">
                        SKS: {{ $matakuliahData->sks ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Mahasiswa</p>
                        <p class="text-xl font-bold">
                            {{ App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->count() }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Nilai Rata-rata</p>
                        <p class="text-xl font-bold">
                            {{ number_format(App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->avg('total_nilai'), 2) }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Nilai Tertinggi</p>
                        <p class="text-xl font-bold">
                            {{ number_format(App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->max('total_nilai'), 2) }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Nilai Terendah</p>
                        <p class="text-xl font-bold">
                            {{ number_format(App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->min('total_nilai'), 2) }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="p-4 bg-yellow-50 text-yellow-700 rounded-lg">
                <p>Data mata kuliah atau kelas tidak ditemukan. Silakan kembali ke halaman sebelumnya.</p>
            </div>
        @endif
    </div>

    <!-- Distribusi Nilai - Simpel & Horizontal -->
    <div class="my-6">
        <h3 class="text-lg font-medium mb-2 text-center">Distribusi Nilai</h3>
        <div class=" bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            @php
                // Menghitung distribusi nilai
                $gradeDistribution = [
                    'A' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'A')->count(),
                    'A-' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'A-')->count(),
                    'B+' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'B+')->count(),
                    'B' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'B')->count(),
                    'B-' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'B-')->count(),
                    'C+' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'C+')->count(),
                    'C' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'C')->count(),
                    'C-' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'C-')->count(),
                    'D' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'D')->count(),
                    'E' => App\Models\Hasil::where('matakuliah_id', $matakuliah)->where('kelas_id', $kelas)->where('huruf_mutu', 'E')->count(),
                ];
                $total = array_sum($gradeDistribution);
            @endphp

            <!-- Tabel dengan konten di tengah -->
            <div class="flex justify-center">
                <table class="w-full max-w-md">
                    <tr>
                        <th class="text-center px-4 py-2 w-1/3">Nilai</th>
                        <th class="text-center px-4 py-2 w-1/3">Jumlah</th>
                        <th class="text-center px-4 py-2 w-1/3">Persentase</th>
                    </tr>
                    @foreach(['A','A-', 'B','B+','B-', 'C','C+','C-', 'D', 'E'] as $grade)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-2 font-bold px-4 text-center">{{ $grade }}</td>
                            <td class="py-2 px-4 text-center">{{ $gradeDistribution[$grade] }}</td>
                            <td class="py-2 px-4 text-center">{{ $total > 0 ? number_format(($gradeDistribution[$grade] / $total) * 100, 1) : 0 }}%</td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-50 dark:bg-gray-700 font-bold">
                        <td class="py-2 px-4 text-center">Total</td>
                        <td class="py-2 px-4 text-center">{{ $total }}</td>
                        <td class="py-2 px-4 text-center">100%</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel Nilai Mahasiswa -->
    {{ $this->table }}
</x-filament::page>
