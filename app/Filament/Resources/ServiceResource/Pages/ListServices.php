<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Models\SiteSetting;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListServices extends ListRecords
{
    use Translatable;

    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('section_texts')
                ->label('Editar Textos da Seção')
                ->icon('heroicon-o-pencil-square')
                ->color('gray')
                ->modalHeading('Textos do Cabeçalho da Seção de Serviços')
                ->modalDescription('Edite a frase principal e a frase auxiliar exibidas acima do carrossel.')
                ->form([
                    Forms\Components\Tabs::make('Idiomas')->tabs([
                        Forms\Components\Tabs\Tab::make('Português')->schema([
                            Forms\Components\TextInput::make('services_title')
                                ->label('Frase Principal (Título)')
                                ->default(fn () => SiteSetting::get('services_title', 'Uma Experiência de Website Completa'))
                                ->required(),
                            Forms\Components\Textarea::make('services_subtitle')
                                ->label('Frase Auxiliar (Subtítulo)')
                                ->default(fn () => SiteSetting::get('services_subtitle', 'Criamos websites que fazem a sua marca não ser só vista, mas entendida'))
                                ->rows(3)
                                ->required(),
                        ]),
                        Forms\Components\Tabs\Tab::make('English')->schema([
                            Forms\Components\TextInput::make('services_title_en')
                                ->label('Main Heading')
                                ->default(fn () => SiteSetting::get('services_title_en', 'A Complete Website Experience')),
                            Forms\Components\Textarea::make('services_subtitle_en')
                                ->label('Auxiliary Subtitle')
                                ->default(fn () => SiteSetting::get('services_subtitle_en', 'We create websites that make your brand not just seen, but understood'))
                                ->rows(3),
                        ]),
                    ]),
                ])
                ->action(function (array $data): void {
                    SiteSetting::set('services_title', $data['services_title'], 'services');
                    SiteSetting::set('services_subtitle', $data['services_subtitle'], 'services');
                    if (! empty($data['services_title_en'])) {
                        SiteSetting::set('services_title_en', $data['services_title_en'], 'services');
                    }
                    if (! empty($data['services_subtitle_en'])) {
                        SiteSetting::set('services_subtitle_en', $data['services_subtitle_en'], 'services');
                    }
                    Notification::make()->title('Textos da seção salvos com sucesso!')->success()->send();
                }),
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
