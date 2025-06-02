<?php

namespace App\Filament\Resources\QuestionnaireResource\Pages;

use App\Filament\Resources\QuestionnaireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionnaire extends EditRecord
{
    protected static string $resource = QuestionnaireResource::class;

    protected static ?string $title = 'Edit Kuesioner';


    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            // $this->getCreateFormAction(),
            $this->getSaveFormAction()
                ->label("Simpan Perubahan")
                ->icon('heroicon-s-check-circle')
                ->color('success'),
            $this->getCancelFormAction()
                ->label('Batal')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
