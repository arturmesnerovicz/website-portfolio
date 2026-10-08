<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
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

class ManageSeoSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Configurações Gerais';

    protected static ?string $navigationLabel = 'SEO & Redes Sociais';

    protected static ?string $title = 'SEO & Compartilhamento Social (Open Graph)';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-seo-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::query()->pluck('value', 'key')->toArray();

        $this->form->fill([
            'og_image' => $settings['og_image'] ?? null,
            'seo_title' => $settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web de Alto Padrão',
            'seo_title_en' => $settings['seo_title_en'] ?? 'Estúdio Norra | Web Design & Digital Engineering',
            'seo_description' => $settings['seo_description'] ?? 'Estúdio de design e engenharia digital focado em websites modernos, interfaces de precisão e identidades visuais marcantes.',
            'seo_description_en' => $settings['seo_description_en'] ?? 'Bespoke design and digital engineering studio crafting modern websites, precision interfaces, and striking visual identities.',
            'seo_keywords' => $settings['seo_keywords'] ?? 'estúdio norra, web design, desenvolvimento web, design 3d, websites modernos',
            'brand_favicon' => $settings['brand_favicon'] ?? 'settings/favicons/1779475070756-vkuzh.webp',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Imagem de Compartilhamento Social (Open Graph / og:image)')
                    ->description('Esta é a imagem exibida na pré-visualização quando o link do site for compartilhado no WhatsApp, LinkedIn, Facebook, Slack, iMessage e Twitter/X.')
                    ->schema([
                        FileUpload::make('og_image')
                            ->label('Imagem Open Graph (og:image)')
                            ->helperText('📍 Dimensão recomendada: 1200 x 630 pixels (proporção 1.91:1) nos formatos JPG, PNG ou WebP. Redes como WhatsApp e LinkedIn não aceitam imagens em SVG. Ao subir sua imagem aqui, a pré-visualização no WhatsApp e LinkedIn exibirá exatamente esta imagem em vez de capas de projetos aleatórias.')
                            ->image()
                            ->directory('settings/seo')
                            ->maxSize(10240)
                            ->columnSpanFull(),
                    ]),

                Section::make('Títulos e Descrições (Google & Redes Sociais)')
                    ->description('Defina o texto que acompanha o link ao ser compartilhado nas redes sociais e nos resultados de busca do Google.')
                    ->schema([
                        Tabs::make('Idiomas')
                            ->tabs([
                                Tab::make('Português')
                                    ->schema([
                                        TextInput::make('seo_title')
                                            ->label('Título da Página / Compartilhamento (PT)')
                                            ->helperText('Título principal em negrito nos cards do WhatsApp/LinkedIn.')
                                            ->required(),

                                        Textarea::make('seo_description')
                                            ->label('Descrição do Compartilhamento (PT)')
                                            ->rows(3)
                                            ->helperText('Texto resumo exibido abaixo do título nos cards de compartilhamento.')
                                            ->required(),
                                    ]),

                                Tab::make('Inglês')
                                    ->schema([
                                        TextInput::make('seo_title_en')
                                            ->label('Share & Meta Title (EN)')
                                            ->required(),

                                        Textarea::make('seo_description_en')
                                            ->label('Share & Meta Description (EN)')
                                            ->rows(3)
                                            ->required(),
                                    ]),
                            ]),

                        TextInput::make('seo_keywords')
                            ->label('Palavras-chave (Keywords)')
                            ->helperText('Termos separados por vírgula para indexação em buscadores.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Favicon do Navegador')
                    ->description('Ícone exibido na aba do navegador ao lado do título do site.')
                    ->schema([
                        FileUpload::make('brand_favicon')
                            ->label('Arquivo de Favicon')
                            ->helperText('Formatos aceitos: ICO, PNG ou WebP (quadrado, ex: 64x64, 128x128 ou 512x512).')
                            ->image()
                            ->directory('settings/favicons')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Salvar Configurações de SEO')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        SiteSetting::set('og_image', $state['og_image'] ?? null, 'seo', 'image');
        SiteSetting::set('seo_title', $state['seo_title'] ?? '', 'seo', 'text');
        SiteSetting::set('seo_title_en', $state['seo_title_en'] ?? '', 'seo', 'text');
        SiteSetting::set('seo_description', $state['seo_description'] ?? '', 'seo', 'text');
        SiteSetting::set('seo_description_en', $state['seo_description_en'] ?? '', 'seo', 'text');
        SiteSetting::set('seo_keywords', $state['seo_keywords'] ?? '', 'seo', 'text');

        if (! empty($state['brand_favicon'])) {
            SiteSetting::set('brand_favicon', $state['brand_favicon'], 'general', 'image');
        }

        Notification::make()
            ->title('Configurações de SEO e Open Graph salvas com sucesso!')
            ->success()
            ->send();
    }
}
