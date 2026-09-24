<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageManifestoSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'Manifesto';

    protected static ?string $title = 'Gerenciar Manifesto';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-manifesto-section';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'manifesto')->pluck('value', 'key')->toArray();

        $this->form->fill([
            'manifesto_headline' => $settings['manifesto_headline'] ?? "Acreditamos que grandes\nfundadores merecem uma\npresença digital a altura do\nque estão construindo.",
            'manifesto_p1' => $settings['manifesto_p1'] ?? 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.',
            'manifesto_metric_number' => $settings['manifesto_metric_number'] ?? '1k+',
            'manifesto_metric_label' => $settings['manifesto_metric_label'] ?? 'designs entregues',
            'manifesto_stat2_number' => $settings['manifesto_stat2_number'] ?? '98%',
            'manifesto_stat2_label' => $settings['manifesto_stat2_label'] ?? 'satisfação comprovada',
            'manifesto_stat3_number' => $settings['manifesto_stat3_number'] ?? '10+',
            'manifesto_stat3_label' => $settings['manifesto_stat3_label'] ?? 'anos de excelência',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Textos do Manifesto')
                    ->description('Edite a declaração de posicionamento e o parágrafo reflexivo da agência.')
                    ->schema([
                        Textarea::make('manifesto_headline')
                            ->label('Manchete Principal')
                            ->rows(4)
                            ->required()
                            ->helperText('Dica: você pode utilizar quebras de linha (Enter) para ajustar a diagramação das frases.'),

                        Textarea::make('manifesto_p1')
                            ->label('Parágrafo Complementar')
                            ->rows(3)
                            ->required(),
                    ]),

                Section::make('Estatísticas Rotativas (Métricas)')
                    ->description('Defina os 3 números e legendas que alternam automaticamente no carrossel vertical do manifesto.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('manifesto_metric_number')
                                ->label('Métrica 1 • Número / Dado')
                                ->placeholder('ex: 1k+')
                                ->required(),
                            TextInput::make('manifesto_metric_label')
                                ->label('Métrica 1 • Legenda')
                                ->placeholder('ex: designs entregues')
                                ->required(),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('manifesto_stat2_number')
                                ->label('Métrica 2 • Número / Dado')
                                ->placeholder('ex: 98%')
                                ->required(),
                            TextInput::make('manifesto_stat2_label')
                                ->label('Métrica 2 • Legenda')
                                ->placeholder('ex: satisfação comprovada')
                                ->required(),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('manifesto_stat3_number')
                                ->label('Métrica 3 • Número / Dado')
                                ->placeholder('ex: 10+')
                                ->required(),
                            TextInput::make('manifesto_stat3_label')
                                ->label('Métrica 3 • Legenda')
                                ->placeholder('ex: anos de excelência')
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
                ->label('Salvar Alterações')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => 'manifesto',
                    'type' => str_contains($key, 'headline') || str_contains($key, 'p1') ? 'textarea' : 'text',
                ]
            );
        }

        Notification::make()
            ->success()
            ->title('Manifesto atualizado com sucesso!')
            ->send();
    }
}
