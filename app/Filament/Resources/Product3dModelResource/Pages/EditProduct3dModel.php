<?php

namespace App\Filament\Resources\Product3dModelResource\Pages;

use App\Filament\Resources\Product3dModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditProduct3dModel extends EditRecord
{
    use Translatable;

    protected static string $resource = Product3dModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
