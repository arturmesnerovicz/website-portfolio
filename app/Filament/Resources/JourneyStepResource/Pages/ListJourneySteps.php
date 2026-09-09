<?php

namespace App\Filament\Resources\JourneyStepResource\Pages;

use App\Filament\Resources\JourneyStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJourneySteps extends ListRecords
{
    protected static string $resource = JourneyStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
