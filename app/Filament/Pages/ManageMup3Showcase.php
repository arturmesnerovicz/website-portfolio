<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Studio3D;
use App\Models\Product3dModel;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageMup3Showcase extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $cluster = Studio3D::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationLabel = 'Apresentação MUP3';

    protected static ?string $title = 'Gerenciar Apresentação MUP3';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-mup3-showcase';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::whereIn('group', ['mup3_showcase', 'general'])->pluck('value', 'key')->toArray();

        $this->form->fill([
            'mup3_title' => $settings['mup3_title'] ?? 'YOUR CARDS, PROTECTED',
            'mup3_title_en' => $settings['mup3_title_en'] ?? 'YOUR CARDS, PROTECTED',
            'mup3_description' => $settings['mup3_description'] ?? 'Our cutting-edge security features, and team of specialists, are monitoring your spend 24/7. We\'ve helped prevent more than £475m worth of fraud in 2023 alone.',
            'mup3_description_en' => $settings['mup3_description_en'] ?? 'Our cutting-edge security features, and team of specialists, are monitoring your spend 24/7. We\'ve helped prevent more than £475m worth of fraud in 2023 alone.',
            'mup3_cta_text' => $settings['mup3_cta_text'] ?? 'Learn more',
            'mup3_cta_text_en' => $settings['mup3_cta_text_en'] ?? 'Learn more',
            'mup3_cta_url' => $settings['mup3_cta_url'] ?? '#contato',

            // Card 1
            'mup3_card1_model_slug' => $settings['mup3_card1_model_slug'] ?? 'cabo-carnes',
            'mup3_card1_title' => $settings['mup3_card1_title'] ?? 'Air Force 1 Low Supr...',
            'mup3_card1_brand' => $settings['mup3_card1_brand'] ?? 'Nike',
            'mup3_card1_price' => $settings['mup3_card1_price'] ?? '59$',
            'mup3_card1_button_url' => $settings['mup3_card1_button_url'] ?? '#contato',
            'mup3_card1_scale' => $settings['mup3_card1_scale'] ?? '1.0',
            'mup3_card1_fov' => $settings['mup3_card1_fov'] ?? '40',
            'mup3_card1_rotation_y' => $settings['mup3_card1_rotation_y'] ?? '0',
            'mup3_card1_rotation_x' => $settings['mup3_card1_rotation_x'] ?? '0',
            'mup3_card1_auto_rotate_speed' => $settings['mup3_card1_auto_rotate_speed'] ?? '0.6',
            'mup3_card1_light_intensity' => $settings['mup3_card1_light_intensity'] ?? '1.2',
            'mup3_card1_mat_override' => ($settings['mup3_card1_mat_override'] ?? '0') === '1',
            'mup3_card1_tint_color' => $settings['mup3_card1_tint_color'] ?? null,
            'mup3_card1_roughness' => $settings['mup3_card1_roughness'] ?? '0.35',
            'mup3_card1_metalness' => $settings['mup3_card1_metalness'] ?? '0.15',

            // Card 2
            'mup3_card2_model_slug' => $settings['mup3_card2_model_slug'] ?? 'stam_803_29i',
            'mup3_card2_title' => $settings['mup3_card2_title'] ?? 'Stam 803 Edition',
            'mup3_card2_brand' => $settings['mup3_card2_brand'] ?? 'Norra Studio',
            'mup3_card2_price' => $settings['mup3_card2_price'] ?? '89$',
            'mup3_card2_button_url' => $settings['mup3_card2_button_url'] ?? '#contato',
            'mup3_card2_scale' => $settings['mup3_card2_scale'] ?? '1.0',
            'mup3_card2_fov' => $settings['mup3_card2_fov'] ?? '40',
            'mup3_card2_rotation_y' => $settings['mup3_card2_rotation_y'] ?? '0',
            'mup3_card2_rotation_x' => $settings['mup3_card2_rotation_x'] ?? '0',
            'mup3_card2_auto_rotate_speed' => $settings['mup3_card2_auto_rotate_speed'] ?? '0.6',
            'mup3_card2_light_intensity' => $settings['mup3_card2_light_intensity'] ?? '1.2',
            'mup3_card2_mat_override' => ($settings['mup3_card2_mat_override'] ?? '0') === '1',
            'mup3_card2_tint_color' => $settings['mup3_card2_tint_color'] ?? null,
            'mup3_card2_roughness' => $settings['mup3_card2_roughness'] ?? '0.35',
            'mup3_card2_metalness' => $settings['mup3_card2_metalness'] ?? '0.15',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Cabeçalho Principal da Página')
                    ->description('Defina a grande manchete, o texto descritivo e o botão CTA da apresentação (Referência 2).')
                    ->schema([
                        Tabs::make('Idiomas')
                            ->tabs([
                                Tab::make('Português')
                                    ->icon('heroicon-o-globe-alt')
                                    ->schema([
                                        TextInput::make('mup3_title')
                                            ->label('Título Principal (Headline)')
                                            ->placeholder('ex: YOUR CARDS, PROTECTED')
                                            ->helperText('📍 Onde aparece: Título em destaque em caixa alta no centro do topo da página.')
                                            ->required(),

                                        Textarea::make('mup3_description')
                                            ->label('Descrição / Subtítulo Editorial')
                                            ->placeholder('ex: Our cutting-edge security features...')
                                            ->helperText('📍 Onde aparece: Parágrafo explicativo abaixo do título principal.')
                                            ->rows(3)
                                            ->required(),

                                        Grid::make(2)->schema([
                                            TextInput::make('mup3_cta_text')
                                                ->label('Texto do Botão Pill CTA')
                                                ->default('Learn more')
                                                ->required(),

                                            TextInput::make('mup3_cta_url')
                                                ->label('Link / Destino do Botão')
                                                ->default('#contato')
                                                ->required(),
                                        ]),
                                    ]),

                                Tab::make('English')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('mup3_title_en')
                                            ->label('Main Headline (EN)')
                                            ->placeholder('ex: YOUR CARDS, PROTECTED')
                                            ->required(),

                                        Textarea::make('mup3_description_en')
                                            ->label('Editorial Description (EN)')
                                            ->rows(3)
                                            ->required(),

                                        TextInput::make('mup3_cta_text_en')
                                            ->label('CTA Button Text (EN)')
                                            ->default('Learn more')
                                            ->required(),
                                    ]),
                            ]),
                    ]),

                Grid::make(2)->schema([
                    Section::make('Card de Produto 01 (Esquerda)')
                        ->description('Configure o primeiro card com produto 3D interativo.')
                        ->schema([
                            Select::make('mup3_card1_model_slug')
                                ->label('Modelo 3D Base do Catálogo')
                                ->options(fn () => Product3dModel::query()->orderBy('sort_order')->get()->mapWithKeys(function ($m) {
                                    $name = $m->getNorraTranslation('name') ?: $m->slug;
                                    $status = $m->is_active ? '' : ' (Inativo no Catálogo)';

                                    return [$m->slug => $name.$status];
                                })->toArray())
                                ->helperText('📍 Objeto 3D que renderizará dentro do container superior do card (permite selecionar mesmo se inativo no catálogo).')
                                ->required(),

                            TextInput::make('mup3_card1_title')
                                ->label('Título do Produto')
                                ->placeholder('ex: Air Force 1 Low Supr...')
                                ->required(),

                            TextInput::make('mup3_card1_brand')
                                ->label('Subtítulo / Marca')
                                ->placeholder('ex: Nike')
                                ->required(),

                            TextInput::make('mup3_card1_price')
                                ->label('Preço ou Destaque')
                                ->placeholder('ex: 59$')
                                ->required(),

                            TextInput::make('mup3_card1_button_url')
                                ->label('Link do Botão de Ação Circular')
                                ->default('#contato')
                                ->required(),

                            Section::make('Personalização 3D Local (Exclusiva deste Card)')
                                ->description('Ajuste fino de câmera, proporção e acabamento sem alterar o modelo global.')
                                ->collapsed()
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('mup3_card1_scale')
                                            ->label('Escala / Zoom Local')
                                            ->numeric()
                                            ->step(0.05)
                                            ->default(1.0)
                                            ->helperText('Multiplicador de tamanho do modelo (ex: 1.0, 1.2, 0.85).'),

                                        TextInput::make('mup3_card1_fov')
                                            ->label('FOV da Câmera (Graus)')
                                            ->numeric()
                                            ->default(40)
                                            ->helperText('Ângulo de lente (padrão 40°, menor = teleobjetiva, maior = grande angular).'),

                                        TextInput::make('mup3_card1_light_intensity')
                                            ->label('Intensidade da Luz')
                                            ->numeric()
                                            ->step(0.1)
                                            ->default(1.2)
                                            ->helperText('Iluminação de estúdio no container escuro.'),
                                    ]),

                                    Grid::make(3)->schema([
                                        TextInput::make('mup3_card1_rotation_y')
                                            ->label('Rotação Inicial Y (°)')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Giro horizontal inicial em graus.'),

                                        TextInput::make('mup3_card1_rotation_x')
                                            ->label('Inclinação Inicial X (°)')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Inclinação vertical inicial em graus.'),

                                        TextInput::make('mup3_card1_auto_rotate_speed')
                                            ->label('Velocidade Auto-rotação')
                                            ->numeric()
                                            ->step(0.1)
                                            ->default(0.6)
                                            ->helperText('0 = estático até o usuário interagir.'),
                                    ]),

                                    Toggle::make('mup3_card1_mat_override')
                                        ->label('Personalizar Material / Acabamento Localmente')
                                        ->helperText('Se ativado, aplica estes acabamentos sem modificar o modelo original no catálogo.')
                                        ->reactive(),

                                    Grid::make(3)
                                        ->visible(fn (callable $get) => (bool) $get('mup3_card1_mat_override'))
                                        ->schema([
                                            ColorPicker::make('mup3_card1_tint_color')
                                                ->label('Cor Predominante / Tonalidade')
                                                ->helperText('Deixe vazio para manter as cores originais.'),

                                            TextInput::make('mup3_card1_roughness')
                                                ->label('Rugosidade (0.0 a 1.0)')
                                                ->numeric()
                                                ->step(0.05)
                                                ->default(0.35)
                                                ->helperText('0 = espelhado, 1 = fosco.'),

                                            TextInput::make('mup3_card1_metalness')
                                                ->label('Metalicidade (0.0 a 1.0)')
                                                ->numeric()
                                                ->step(0.05)
                                                ->default(0.15)
                                                ->helperText('0 = não-metálico, 1 = metálico.'),
                                        ]),
                                ]),
                        ]),

                    Section::make('Card de Produto 02 (Direita)')
                        ->description('Configure o segundo card com produto 3D interativo.')
                        ->schema([
                            Select::make('mup3_card2_model_slug')
                                ->label('Modelo 3D Base do Catálogo')
                                ->options(fn () => Product3dModel::query()->orderBy('sort_order')->get()->mapWithKeys(function ($m) {
                                    $name = $m->getNorraTranslation('name') ?: $m->slug;
                                    $status = $m->is_active ? '' : ' (Inativo no Catálogo)';

                                    return [$m->slug => $name.$status];
                                })->toArray())
                                ->helperText('📍 Objeto 3D que renderizará dentro do container superior do card (permite selecionar mesmo se inativo no catálogo).')
                                ->required(),

                            TextInput::make('mup3_card2_title')
                                ->label('Título do Produto')
                                ->placeholder('ex: Stam 803 Edition')
                                ->required(),

                            TextInput::make('mup3_card2_brand')
                                ->label('Subtítulo / Marca')
                                ->placeholder('ex: Norra Studio')
                                ->required(),

                            TextInput::make('mup3_card2_price')
                                ->label('Preço ou Destaque')
                                ->placeholder('ex: 89$')
                                ->required(),

                            TextInput::make('mup3_card2_button_url')
                                ->label('Link do Botão de Ação Circular')
                                ->default('#contato')
                                ->required(),

                            Section::make('Personalização 3D Local (Exclusiva deste Card)')
                                ->description('Ajuste fino de câmera, proporção e acabamento sem alterar o modelo global.')
                                ->collapsed()
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('mup3_card2_scale')
                                            ->label('Escala / Zoom Local')
                                            ->numeric()
                                            ->step(0.05)
                                            ->default(1.0)
                                            ->helperText('Multiplicador de tamanho do modelo (ex: 1.0, 1.2, 0.85).'),

                                        TextInput::make('mup3_card2_fov')
                                            ->label('FOV da Câmera (Graus)')
                                            ->numeric()
                                            ->default(40)
                                            ->helperText('Ângulo de lente (padrão 40°, menor = teleobjetiva, maior = grande angular).'),

                                        TextInput::make('mup3_card2_light_intensity')
                                            ->label('Intensidade da Luz')
                                            ->numeric()
                                            ->step(0.1)
                                            ->default(1.2)
                                            ->helperText('Iluminação de estúdio no container escuro.'),
                                    ]),

                                    Grid::make(3)->schema([
                                        TextInput::make('mup3_card2_rotation_y')
                                            ->label('Rotação Inicial Y (°)')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Giro horizontal inicial em graus.'),

                                        TextInput::make('mup3_card2_rotation_x')
                                            ->label('Inclinação Inicial X (°)')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Inclinação vertical inicial em graus.'),

                                        TextInput::make('mup3_card2_auto_rotate_speed')
                                            ->label('Velocidade Auto-rotação')
                                            ->numeric()
                                            ->step(0.1)
                                            ->default(0.6)
                                            ->helperText('0 = estático até o usuário interagir.'),
                                    ]),

                                    Toggle::make('mup3_card2_mat_override')
                                        ->label('Personalizar Material / Acabamento Localmente')
                                        ->helperText('Se ativado, aplica estes acabamentos sem modificar o modelo original no catálogo.')
                                        ->reactive(),

                                    Grid::make(3)
                                        ->visible(fn (callable $get) => (bool) $get('mup3_card2_mat_override'))
                                        ->schema([
                                            ColorPicker::make('mup3_card2_tint_color')
                                                ->label('Cor Predominante / Tonalidade')
                                                ->helperText('Deixe vazio para manter as cores originais.'),

                                            TextInput::make('mup3_card2_roughness')
                                                ->label('Rugosidade (0.0 a 1.0)')
                                                ->numeric()
                                                ->step(0.05)
                                                ->default(0.35)
                                                ->helperText('0 = espelhado, 1 = fosco.'),

                                            TextInput::make('mup3_card2_metalness')
                                                ->label('Metalicidade (0.0 a 1.0)')
                                                ->numeric()
                                                ->step(0.05)
                                                ->default(0.15)
                                                ->helperText('0 = não-metálico, 1 = metálico.'),
                                        ]),
                                ]),
                        ]),
                ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Salvar Configurações da Apresentação')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        SiteSetting::set('mup3_title', $state['mup3_title'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_title_en', $state['mup3_title_en'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_description', $state['mup3_description'], 'mup3_showcase', 'textarea');
        SiteSetting::set('mup3_description_en', $state['mup3_description_en'], 'mup3_showcase', 'textarea');
        SiteSetting::set('mup3_cta_text', $state['mup3_cta_text'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_cta_text_en', $state['mup3_cta_text_en'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_cta_url', $state['mup3_cta_url'], 'mup3_showcase', 'text');

        // Card 1
        SiteSetting::set('mup3_card1_model_slug', $state['mup3_card1_model_slug'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_title', $state['mup3_card1_title'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_brand', $state['mup3_card1_brand'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_price', $state['mup3_card1_price'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_button_url', $state['mup3_card1_button_url'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_scale', (string) ($state['mup3_card1_scale'] ?? '1.0'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_fov', (string) ($state['mup3_card1_fov'] ?? '40'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_rotation_y', (string) ($state['mup3_card1_rotation_y'] ?? '0'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_rotation_x', (string) ($state['mup3_card1_rotation_x'] ?? '0'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_auto_rotate_speed', (string) ($state['mup3_card1_auto_rotate_speed'] ?? '0.6'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_light_intensity', (string) ($state['mup3_card1_light_intensity'] ?? '1.2'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_mat_override', ! empty($state['mup3_card1_mat_override']) ? '1' : '0', 'mup3_showcase', 'boolean');
        SiteSetting::set('mup3_card1_tint_color', $state['mup3_card1_tint_color'] ?? '', 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_roughness', (string) ($state['mup3_card1_roughness'] ?? '0.35'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card1_metalness', (string) ($state['mup3_card1_metalness'] ?? '0.15'), 'mup3_showcase', 'text');

        // Card 2
        SiteSetting::set('mup3_card2_model_slug', $state['mup3_card2_model_slug'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_title', $state['mup3_card2_title'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_brand', $state['mup3_card2_brand'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_price', $state['mup3_card2_price'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_button_url', $state['mup3_card2_button_url'], 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_scale', (string) ($state['mup3_card2_scale'] ?? '1.0'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_fov', (string) ($state['mup3_card2_fov'] ?? '40'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_rotation_y', (string) ($state['mup3_card2_rotation_y'] ?? '0'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_rotation_x', (string) ($state['mup3_card2_rotation_x'] ?? '0'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_auto_rotate_speed', (string) ($state['mup3_card2_auto_rotate_speed'] ?? '0.6'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_light_intensity', (string) ($state['mup3_card2_light_intensity'] ?? '1.2'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_mat_override', ! empty($state['mup3_card2_mat_override']) ? '1' : '0', 'mup3_showcase', 'boolean');
        SiteSetting::set('mup3_card2_tint_color', $state['mup3_card2_tint_color'] ?? '', 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_roughness', (string) ($state['mup3_card2_roughness'] ?? '0.35'), 'mup3_showcase', 'text');
        SiteSetting::set('mup3_card2_metalness', (string) ($state['mup3_card2_metalness'] ?? '0.15'), 'mup3_showcase', 'text');

        Notification::make()
            ->title('Apresentação MUP3 atualizada com sucesso!')
            ->success()
            ->send();
    }
}
