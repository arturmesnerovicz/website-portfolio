<?php

namespace App\Filament\Resources\Product3dModelResource\Pages;

use App\Filament\Resources\Product3dModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListProduct3dModels extends ListRecords
{
    use Translatable;

    protected static string $resource = Product3dModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
