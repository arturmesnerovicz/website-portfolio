<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageHeroSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'Hero Section';

    protected static ?string $title = 'Gerenciar Hero Section';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-hero-section';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'hero')->pluck('value', 'key')->toArray();

        $this->form->fill([
            'hero_title' => $settings['hero_title'] ?? "Criamos experiências\nque tornam a sua marca\nirresistível",
            'hero_subtitle' => $settings['hero_subtitle'] ?? 'Ajudamos marcas consolidadas criando uma experiência de website, que reflete aquilo que construíram e o que as tornam únicas.',
            'hero_title_en' => $settings['hero_title_en'] ?? "We craft experiences\nthat make your brand\nirresistible",
            'hero_subtitle_en' => $settings['hero_subtitle_en'] ?? 'We empower established brands by creating bespoke web experiences that reflect their ambition and what makes them unique.',
            'hero_image_left' => $settings['hero_image_left'] ?? null,
            'hero_image_right' => $settings['hero_image_right'] ?? null,
            'hero_image_bottom_right' => $settings['hero_image_bottom_right'] ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Textos Principais (Bilingue)')
                    ->description('Edite o título de impacto e o texto de apoio em Português e em Inglês.')
                    ->schema([
                        Tabs::make('Idiomas')
                            ->tabs([
                                Tab::make('Português')
                                    ->schema([
                                        Textarea::make('hero_title')
                                            ->label('Título Principal (PT)')
                                            ->rows(3)
                                            ->required()
                                            ->helperText('Dica: você pode dar quebras de linha com Enter para definir exatamente a diagramação das frases.'),
                                        Textarea::make('hero_subtitle')
                                            ->label('Subtítulo Editorial (PT)')
                                            ->rows(3)
                                            ->required(),
                                    ]),
                                Tab::make('English')
                                    ->schema([
                                        Textarea::make('hero_title_en')
                                            ->label('Headline (EN)')
                                            ->rows(3)
                                            ->helperText('Título em inglês exibido na versão /en do site.'),
                                        Textarea::make('hero_subtitle_en')
                                            ->label('Editorial Subtitle (EN)')
                                            ->rows(3)
                                            ->helperText('Subtítulo de apoio em inglês exibido na versão /en do site.'),
                                    ]),
                            ]),
                    ]),

                Section::make('Dispositivos Flutuantes (Mockups)')
                    ->description('Personalize as 3 imagens dos dispositivos que flutuam ao redor da Hero.')
                    ->schema([
                        FileUpload::make('hero_image_left')
                            ->label('Mockup Superior Esquerdo (iMac)')
                            ->image()
                            ->disk('public')
                            ->directory('hero')
                            ->helperText('Dispositivo no topo esquerdo. Padrão: hero-imac.png'),

                        FileUpload::make('hero_image_right')
                            ->label('Mockup Superior Direito (Tablet)')
                            ->image()
                            ->disk('public')
                            ->directory('hero')
                            ->helperText('Dispositivo no topo direito. Padrão: hero-tablet.png'),

                        FileUpload::make('hero_image_bottom_right')
                            ->label('Mockup Inferior Direito (Tablet Desktop)')
                            ->image()
                            ->disk('public')
                            ->directory('hero')
                            ->helperText('Dispositivo no canto inferior direito. Padrão: hero-tablet-bottom.png'),
                    ])->columns(3),
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
                    'group' => 'hero',
                    'type' => str_contains($key, 'image') ? 'image' : 'textarea',
                ]
            );
        }

        Notification::make()
            ->success()
            ->title('Hero Section atualizada com sucesso!')
            ->send();
    }
}
