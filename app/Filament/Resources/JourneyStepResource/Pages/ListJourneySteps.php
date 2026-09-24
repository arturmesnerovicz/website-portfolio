<?php

namespace App\Filament\Resources\JourneyStepResource\Pages;

use App\Filament\Resources\JourneyStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListJourneySteps extends ListRecords
{
    use Translatable;

    protected static string $resource = JourneyStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
