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

class ManageCtaSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'CTA Final';

    protected static ?string $title = 'Gerenciar Seção CTA Final';

    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.pages.manage-cta-section';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'cta')->pluck('value', 'key')->toArray();

        $defaultPtTitle = "VAMOS CRIAR\nUMA EXPERIÊNCIA\nQUE MOVE\nSUA MARCA";
        $rawPtTitle = $settings['cta_title'] ?? null;
        $legacyPtTitles = [
            'VAMOS CRIAR UMA EXPERIÊNCIA QUE MOVE SUA MARCA',
            "VAMOS CRIAR\nUMA EXPERIÊNCIA QUE\nMOVE\nSUA MARCA",
            "VAMOS CRIAR\r\nUMA EXPERIÊNCIA QUE\r\nMOVE\r\nSUA MARCA",
        ];
        if (empty($rawPtTitle) || in_array(trim($rawPtTitle), $legacyPtTitles, true)) {
            $rawPtTitle = $defaultPtTitle;
        }

        $this->form->fill([
            'cta_title' => $rawPtTitle,
            'cta_button_text' => $settings['cta_button_text'] ?? 'Nos conte a sua história',
            'cta_title_en' => $settings['cta_title_en'] ?? "LET'S BUILD\nAN EXPERIENCE\nTHAT ELEVATES\nYOUR BRAND",
            'cta_button_text_en' => $settings['cta_button_text_en'] ?? 'Tell us your story',
            'cta_bg_image' => $settings['cta_bg_image'] ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Textos da Seção CTA Final (Bilingue)')
                    ->description('Edite a frase principal de impacto e o texto do botão da seção CTA Final em Português e em Inglês.')
                    ->schema([
                        Tabs::make('Idiomas do CTA')
                            ->tabs([
                                Tab::make('Português')
                                    ->schema([
                                        Textarea::make('cta_title')
                                            ->label('Frase Principal do CTA (PT)')
                                            ->rows(4)
                                            ->required()
                                            ->helperText('Dica: use Enter para quebrar as linhas exatamente como deseja exibir no site.'),
                                        TextInput::make('cta_button_text')
                                            ->label('Texto do Botão (PT)')
                                            ->required(),
                                    ]),
                                Tab::make('English')
                                    ->schema([
                                        Textarea::make('cta_title_en')
                                            ->label('Main CTA Headline (EN)')
                                            ->rows(4)
                                            ->required()
                                            ->helperText('Use Enter para definir as quebras de linha na versão em inglês (/en).'),
                                        TextInput::make('cta_button_text_en')
                                            ->label('Button Text (EN)')
                                            ->required(),
                                    ]),
                            ]),
                    ]),

                Section::make('Imagem de Fundo (Opcional)')
                    ->description('Caso queira substituir a fotografia padrão de fundo da seção CTA Final.')
                    ->schema([
                        FileUpload::make('cta_bg_image')
                            ->label('Imagem de Fundo do CTA')
                            ->image()
                            ->disk('public')
                            ->directory('cta')
                            ->helperText('Se deixado em branco, utiliza a imagem padrão do estúdio (cta-bg.webp).'),
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

        $labels = [
            'cta_title' => 'Título do CTA Final (PT)',
            'cta_button_text' => 'Texto do Botão CTA (PT)',
            'cta_title_en' => 'Título do CTA Final (EN)',
            'cta_button_text_en' => 'Texto do Botão CTA (EN)',
            'cta_bg_image' => 'Imagem de Fundo do CTA',
        ];

        foreach ($state as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => 'cta',
                    'type' => str_contains($key, 'image') ? 'image' : (str_contains($key, 'title') ? 'textarea' : 'text'),
                    'label' => $labels[$key] ?? $key,
                ]
            );
        }

        Notification::make()
            ->success()
            ->title('Seção CTA Final atualizada com sucesso!')
            ->send();
    }
}
