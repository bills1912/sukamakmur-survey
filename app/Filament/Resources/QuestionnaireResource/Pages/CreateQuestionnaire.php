<?php

namespace App\Filament\Resources\QuestionnaireResource\Pages;

use App\Filament\Resources\QuestionnaireResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestionnaire extends CreateRecord
{
    protected static string $resource = QuestionnaireResource::class;
    protected static bool $canCreateAnother = false;

    protected static ?string $title = 'Pendataan Baru';


    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getFormActions(): array
    {
        return [
            // $this->getCreateFormAction(),
            $this->getCreateFormAction()
                ->label("Submit Pendataan")
                ->icon('heroicon-s-check-circle')
                ->color('success'),
            $this->getCancelFormAction()
                ->label('Batal')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
