<?php

namespace App\Filament\Resources\JourneyStepResource\Pages;

use App\Filament\Resources\JourneyStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditJourneyStep extends EditRecord
{
    use Translatable;

    protected static string $resource = JourneyStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
