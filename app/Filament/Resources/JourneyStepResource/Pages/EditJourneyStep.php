<?php

namespace App\Filament\Resources\JourneyStepResource\Pages;

use App\Filament\Resources\JourneyStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJourneyStep extends EditRecord
{
    protected static string $resource = JourneyStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
