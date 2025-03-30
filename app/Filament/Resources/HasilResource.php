<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Hasil;
use App\Models\Kelas;
use App\Models\Persen;
use Filament\Forms\Form;
use App\Models\Matakuliah;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\HasilResource\Pages;

class HasilResource extends Resource
{
    protected static ?string $model = Hasil::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Hasil & Evaluasi';
    protected static ?int $navigationSort = 3;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Your form schema here
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                // Menggunakan query builder untuk mengelompokkan berdasarkan matakuliah_id dan kelas_id
                Hasil::query()
                    ->select('matakuliah_id', 'kelas_id', DB::raw('MAX(id) as id'))
                    ->groupBy('matakuliah_id', 'kelas_id')
                    ->orderBy(DB::raw('MAX(id)'))
            )
            ->columns([
                Tables\Columns\TextColumn::make('matakuliah.nama_mk')
                    ->label('Mata Kuliah')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('matakuliah.tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_mahasiswa')
                    ->label('Jumlah Mahasiswa')
                    ->alignCenter()
                    ->getStateUsing(function ($record): int {
                        return Hasil::query()
                            ->where('matakuliah_id', $record->matakuliah_id)
                            ->where('kelas_id', $record->kelas_id)
                            ->count();
                    }),
            ])
            ->filters([
                SelectFilter::make('matakuliah_id')
                    ->label('Mata Kuliah')
                    ->relationship('matakuliah', 'nama_mk')
                    ->searchable()
                    ->placeholder('Pilih Mata Kuliah')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return "{$record->nama_mk} - {$record->tahun_ajaran}";
                    }),

                SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->relationship('kelas', 'nama_kelas')
                    ->searchable()
                    ->placeholder('Pilih Kelas'),
            ])
            ->actions([
                // Tombol untuk melihat nilai semua mahasiswa
                Action::make('lihat_nilai')
                    ->label('Lihat Nilai Mahasiswa')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => route('filament.admin.resources.hasils.nilai-mahasiswa', [
                        'matakuliah' => $record->matakuliah_id,
                        'kelas' => $record->kelas_id
                    ]))
                    ->openUrlInNewTab(),


              // Tombol untuk menghapus
              Tables\Actions\DeleteAction::make()
                  ->label('Hapus')
                  ->icon('heroicon-o-trash')
                  ->requiresConfirmation(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHasils::route('/'),
            'create' => Pages\CreateHasil::route('/create'),
            'edit' => Pages\EditHasil::route('/{record}/edit'),
            'nilai-mahasiswa' => Pages\NilaiMahasiswa::route('/nilai-mahasiswa/{matakuliah}/{kelas}'),
        ];
    }
}
