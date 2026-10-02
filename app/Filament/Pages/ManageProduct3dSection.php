<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Studio3D;
use App\Models\Product3dModel;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
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

class ManageProduct3dSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $cluster = Studio3D::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Seção 3D (Site / Home)';

    protected static ?string $title = 'Configuração da Seção 3D';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-product3d-section';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'product_3d')->pluck('value', 'key')->toArray();

        $this->form->fill([
            'section_3d_enabled' => ($settings['section_3d_enabled'] ?? '1') === '1',
            'section_3d_allow_zoom' => ($settings['section_3d_allow_zoom'] ?? '1') === '1',
            'active_models' => Product3dModel::where('is_active', true)->pluck('id')->toArray(),
            'section_3d_eyebrow' => $settings['section_3d_eyebrow'] ?? 'DESIGN & ENGENHARIA',
            'section_3d_eyebrow_en' => $settings['section_3d_eyebrow_en'] ?? 'DESIGN & CRAFTSMANSHIP',
            'section_3d_title' => $settings['section_3d_title'] ?? "Estrutura unibody.\nUma obra única.",
            'section_3d_title_en' => $settings['section_3d_title_en'] ?? "Unibody structure.\nA singular masterpiece.",
            'section_3d_subtitle' => $settings['section_3d_subtitle'] ?? $settings['section_3d_description'] ?? 'Explore cada detalhe de engenharia e customize acabamentos exclusivos sob medida em tempo real.',
            'section_3d_subtitle_en' => $settings['section_3d_subtitle_en'] ?? $settings['section_3d_description_en'] ?? 'Explore every engineering nuance and configure bespoke materials in real-time.',
            'section_3d_default_model' => $settings['section_3d_default_model'] ?? null,
            'section_3d_badge' => $settings['section_3d_badge'] ?? 'CONFIGURADOR 3D INTERATIVO',
            'section_3d_badge_en' => $settings['section_3d_badge_en'] ?? 'INTERACTIVE 3D CONFIGURATOR',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Status & Interatividade da Seção')
                    ->description('Ative ou oculte a seção 3D interativa na Home e configure as opções globais de interação.')
                    ->schema([
                        Grid::make(3)->schema([
                            Toggle::make('section_3d_enabled')
                                ->label('Seção 3D Ativa na Home')
                                ->helperText('📍 Visibilidade: Quando desativada, a seção não será renderizada no frontend.')
                                ->default(true),

                            Toggle::make('section_3d_allow_zoom')
                                ->label('Permitir Zoom no Modelo 3D')
                                ->helperText('📍 Interatividade: Permite aproximar/afastar (scroll do mouse, gesto de pinça e botões + / -).')
                                ->default(true),

                            Select::make('section_3d_default_model')
                                ->label('Modelo 3D Inicial Padrão')
                                ->options(fn () => Product3dModel::where('is_active', true)->pluck('name', 'slug')->toArray())
                                ->placeholder('Automático (Primeiro modelo ativo)')
                                ->helperText('📍 Inicialização: Selecione qual modelo carregará por padrão quando o visitante chegar à seção.'),
                        ]),
                    ]),

                Section::make('Modelos 3D Exibidos na Home')
                    ->description('Selecione quais modelos do catálogo ficam ativos para visualização e customização no site. As alterações só são salvas após clicar no botão "Salvar Configurações".')
                    ->schema([
                        CheckboxList::make('active_models')
                            ->label('Modelos Ativos na Vitrine')
                            ->options(fn () => Product3dModel::query()->orderBy('sort_order')->pluck('name', 'id')->toArray())
                            ->columns(2)
                            ->helperText('📍 Dica: Modelos desmarcados aqui deixam de aparecer na Home, mas continuam disponíveis para uso exclusivo na página de apresentação MUP3.'),
                    ]),

                Section::make('Textos da Seção (Bilíngue)')
                    ->description('Defina os títulos e textos de apoio com estética minimalista inspirada nas páginas de produto Apple.')
                    ->schema([
                        Tabs::make('Idiomas')
                            ->tabs([
                                Tab::make('Português')
                                    ->icon('heroicon-o-globe-alt')
                                    ->schema([
                                        TextInput::make('section_3d_eyebrow')
                                            ->label('Subtítulo Superior (Eyebrow)')
                                            ->helperText('📍 Onde aparece: Texto fino em caixa alta acima do título principal da seção.')
                                            ->required(),

                                        TextInput::make('section_3d_badge')
                                            ->label('Badge / Tag de Destaque')
                                            ->helperText('📍 Onde aparece: Rótulo de apoio ou categoria de inovação da seção.')
                                            ->required(),

                                        Textarea::make('section_3d_title')
                                            ->label('Título Principal (Suporta quebras de linha)')
                                            ->helperText('📍 Onde aparece: Grande manchete da seção 3D com a tipografia oficial do site.')
                                            ->rows(2)
                                            ->required(),

                                        Textarea::make('section_3d_subtitle')
                                            ->label('Descrição de Apoio')
                                            ->helperText('📍 Onde aparece: Parágrafo explicativo elegante abaixo do título principal.')
                                            ->rows(2)
                                            ->required(),
                                    ]),

                                Tab::make('English')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('section_3d_eyebrow_en')
                                            ->label('Top Eyebrow')
                                            ->helperText('📍 Where it appears: Thin uppercase line above the main section title.')
                                            ->required(),

                                        TextInput::make('section_3d_badge_en')
                                            ->label('Badge Tag')
                                            ->helperText('📍 Where it appears: Innovation highlight tag.')
                                            ->required(),

                                        Textarea::make('section_3d_title_en')
                                            ->label('Main Headline (Supports line breaks)')
                                            ->helperText('📍 Where it appears: Main large headline for the 3D section in English.')
                                            ->rows(2)
                                            ->required(),

                                        Textarea::make('section_3d_subtitle_en')
                                            ->label('Supporting Description')
                                            ->helperText('📍 Where it appears: Elegant explanatory paragraph below the headline.')
                                            ->rows(2)
                                            ->required(),
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
                ->label('Salvar Configurações')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        SiteSetting::set('section_3d_enabled', $state['section_3d_enabled'] ? '1' : '0', 'product_3d', 'boolean');
        SiteSetting::set('section_3d_allow_zoom', $state['section_3d_allow_zoom'] ? '1' : '0', 'product_3d', 'boolean');
        SiteSetting::set('section_3d_eyebrow', $state['section_3d_eyebrow'], 'product_3d', 'text');
        SiteSetting::set('section_3d_eyebrow_en', $state['section_3d_eyebrow_en'], 'product_3d', 'text');
        SiteSetting::set('section_3d_badge', $state['section_3d_badge'], 'product_3d', 'text');
        SiteSetting::set('section_3d_badge_en', $state['section_3d_badge_en'], 'product_3d', 'text');
        SiteSetting::set('section_3d_title', $state['section_3d_title'], 'product_3d', 'textarea');
        SiteSetting::set('section_3d_title_en', $state['section_3d_title_en'], 'product_3d', 'textarea');
        SiteSetting::set('section_3d_subtitle', $state['section_3d_subtitle'], 'product_3d', 'textarea');
        SiteSetting::set('section_3d_subtitle_en', $state['section_3d_subtitle_en'], 'product_3d', 'textarea');
        SiteSetting::set('section_3d_description', $state['section_3d_subtitle'], 'product_3d', 'textarea');
        SiteSetting::set('section_3d_description_en', $state['section_3d_subtitle_en'], 'product_3d', 'textarea');
        SiteSetting::set('section_3d_default_model', $state['section_3d_default_model'] ?? '', 'product_3d', 'text');

        if (isset($state['active_models']) && is_array($state['active_models'])) {
            Product3dModel::query()->update(['is_active' => false]);
            if (! empty($state['active_models'])) {
                Product3dModel::whereIn('id', $state['active_models'])->update(['is_active' => true]);
            }
        }

        Notification::make()
            ->title('Configurações 3D salvas com sucesso!')
            ->success()
            ->send();
    }
}
