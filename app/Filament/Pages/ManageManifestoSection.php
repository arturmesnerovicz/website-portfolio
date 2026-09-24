<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
            'manifesto_headline_en' => $settings['manifesto_headline_en'] ?? "We believe great\nfounders deserve a digital\npresence matching what they\nare building.",
            'manifesto_p1' => $settings['manifesto_p1'] ?? 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.',
            'manifesto_p1_en' => $settings['manifesto_p1_en'] ?? 'Many ambitious companies have developed incredible brands, but their websites do not reflect it yet.',
            'manifesto_metric_number' => $settings['manifesto_metric_number'] ?? '1k+',
            'manifesto_metric_label' => $settings['manifesto_metric_label'] ?? 'designs entregues',
            'manifesto_metric_label_en' => $settings['manifesto_metric_label_en'] ?? 'delivered designs',
            'manifesto_stat2_number' => $settings['manifesto_stat2_number'] ?? '98%',
            'manifesto_stat2_label' => $settings['manifesto_stat2_label'] ?? 'satisfação comprovada',
            'manifesto_stat2_label_en' => $settings['manifesto_stat2_label_en'] ?? 'client satisfaction',
            'manifesto_stat3_number' => $settings['manifesto_stat3_number'] ?? '10+',
            'manifesto_stat3_label' => $settings['manifesto_stat3_label'] ?? 'anos de excelência',
            'manifesto_stat3_label_en' => $settings['manifesto_stat3_label_en'] ?? 'years of excellence',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Textos do Manifesto (Bilingue)')
                    ->description('Edite a declaração de posicionamento em Português e em Inglês.')
                    ->schema([
                        Tabs::make('Idiomas do Manifesto')
                            ->tabs([
                                Tab::make('Português')
                                    ->schema([
                                        Textarea::make('manifesto_headline')
                                            ->label('Manchete Principal (PT)')
                                            ->rows(4)
                                            ->required()
                                            ->helperText('O texto é diagramado dinamicamente com balanceamento automático de linhas e prevenção de palavras órfãs em qualquer dispositivo.'),
                                        Textarea::make('manifesto_p1')
                                            ->label('Parágrafo Complementar (PT)')
                                            ->rows(3)
                                            ->required(),
                                    ]),
                                Tab::make('English')
                                    ->schema([
                                        Textarea::make('manifesto_headline_en')
                                            ->label('Main Headline (EN)')
                                            ->rows(4)
                                            ->helperText('Manchete em inglês exibida na versão /en do site.'),
                                        Textarea::make('manifesto_p1_en')
                                            ->label('Complementary Paragraph (EN)')
                                            ->rows(3)
                                            ->helperText('Parágrafo em inglês exibido na versão /en do site.'),
                                    ]),
                            ]),
                    ]),

                Section::make('Estatísticas Rotativas (Métricas Bilingue)')
                    ->description('Defina os 3 números e legendas que alternam automaticamente no carrossel vertical do manifesto.')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('manifesto_metric_number')
                                ->label('Métrica 1 • Número')
                                ->placeholder('ex: 1k+')
                                ->required(),
                            TextInput::make('manifesto_metric_label')
                                ->label('Métrica 1 • Legenda (PT)')
                                ->placeholder('ex: designs entregues')
                                ->required(),
                            TextInput::make('manifesto_metric_label_en')
                                ->label('Métrica 1 • Label (EN)')
                                ->placeholder('ex: delivered designs'),
                        ]),

                        Grid::make(3)->schema([
                            TextInput::make('manifesto_stat2_number')
                                ->label('Métrica 2 • Número')
                                ->placeholder('ex: 98%')
                                ->required(),
                            TextInput::make('manifesto_stat2_label')
                                ->label('Métrica 2 • Legenda (PT)')
                                ->placeholder('ex: satisfação comprovada')
                                ->required(),
                            TextInput::make('manifesto_stat2_label_en')
                                ->label('Métrica 2 • Label (EN)')
                                ->placeholder('ex: client satisfaction'),
                        ]),

                        Grid::make(3)->schema([
                            TextInput::make('manifesto_stat3_number')
                                ->label('Métrica 3 • Número')
                                ->placeholder('ex: 10+')
                                ->required(),
                            TextInput::make('manifesto_stat3_label')
                                ->label('Métrica 3 • Legenda (PT)')
                                ->placeholder('ex: anos de excelência')
                                ->required(),
                            TextInput::make('manifesto_stat3_label_en')
                                ->label('Métrica 3 • Label (EN)')
                                ->placeholder('ex: years of excellence'),
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
