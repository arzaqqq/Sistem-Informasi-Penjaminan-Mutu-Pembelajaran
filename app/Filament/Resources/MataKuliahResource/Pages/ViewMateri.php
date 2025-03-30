<?php

namespace App\Filament\Resources\MatakuliahResource\Pages;

use Filament\Tables;
use App\Models\Matakuliah;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\MatakuliahResource;

class ViewMateri extends Page
{
    protected static string $resource = MatakuliahResource::class;
    protected static string $view = 'filament.resources.matakuliahs.view-materi';

    public $record;

    public function mount($record)
    {
        $this->record = Matakuliah::with('materis')->findOrFail($record);
    }

    protected function getTable(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('pertemuan')->label('Pertemuan'),
            TextColumn::make('judul_materi')->label('Judul Materi'),
            TextColumn::make('file_materi')
                ->label('File Materi')
                ->formatStateUsing(fn ($state) => '<a href="' . asset('storage/' . $state) . '" target="_blank">Download</a>')
                ->html(),
        ])
        ->query($this->record->materis()->orderBy('pertemuan', 'asc'));
}

}
