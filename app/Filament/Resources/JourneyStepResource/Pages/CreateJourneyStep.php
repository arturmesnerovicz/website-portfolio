<?php

namespace App\Filament\Resources\JourneyStepResource\Pages;

use App\Filament\Resources\JourneyStepResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateJourneyStep extends CreateRecord
{
    use Translatable;

    protected static string $resource = JourneyStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
