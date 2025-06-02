<?php

namespace App\Filament\Resources\QuestionnaireResource\Pages;

use App\Filament\Resources\QuestionnaireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionnaires extends ListRecords
{
    protected static string $resource = QuestionnaireResource::class;

    protected static ?string $title = 'Daftar Hasil Pendataan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label("Buat Pendataan Baru")
                ->icon('heroicon-s-plus'),
        ];
    }
}
