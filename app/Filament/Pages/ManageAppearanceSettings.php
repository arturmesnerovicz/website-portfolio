<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageAppearanceSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationGroup = 'Configurações Gerais';

    protected static ?string $navigationLabel = 'Aparência & Efeitos';

    protected static ?string $title = 'Aparência & Efeitos Globais';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-appearance-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'general')->pluck('value', 'key')->toArray();

        $this->form->fill([
            'site_noise_enabled' => ($settings['site_noise_enabled'] ?? '1') !== '0',
            'site_noise_opacity' => $settings['site_noise_opacity'] ?? '0.05',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Efeito de Ruído Visual (Film Grain)')
                    ->description('Controle a textura cinematográfica analógica aplicada sutilmente ao fundo do site.')
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('site_noise_enabled')
                                ->label('Ativar Ruído Visual no Site')
                                ->helperText('📍 Efeito: Aplica granulação sutil estilo estúdio de design às páginas. As áreas 3D permanecem isoladas e nítidas.')
                                ->default(true),

                            TextInput::make('site_noise_opacity')
                                ->label('Opacidade da Granulação (0.01 a 0.20)')
                                ->numeric()
                                ->step(0.01)
                                ->default(0.05)
                                ->helperText('Recomendado: 0.04 a 0.06 para efeito sofisticado e imperceptível sem comprometer legibilidade.')
                                ->required(),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Salvar Configurações de Aparência')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        SiteSetting::set('site_noise_enabled', $state['site_noise_enabled'] ? '1' : '0', 'general', 'boolean');
        SiteSetting::set('site_noise_opacity', (string) ($state['site_noise_opacity'] ?? '0.05'), 'general', 'text');

        Notification::make()
            ->title('Configurações de aparência salvas com sucesso!')
            ->success()
            ->send();
    }
}
