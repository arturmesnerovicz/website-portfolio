<?php

namespace App\Filament\Pages;

use App\Models\Service;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
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

class ManageServicesSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'Seção de Serviços (Mockups)';

    protected static ?string $title = 'Gerenciar Seção de Serviços & Mockups';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-services-section';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'services')->pluck('value', 'key')->toArray();

        $services = Service::query()->orderBy('sort_order')->get();

        $cardsData = [];
        foreach ($services as $s) {
            $cardsData[] = [
                'id' => $s->id,
                'image' => $s->image,
                'title' => $s->getTranslation('title', 'pt_BR', false) ?: $s->title,
                'title_en' => $s->getTranslation('title', 'en', false) ?: '',
                'category' => $s->getTranslation('category', 'pt_BR', false) ?: $s->category,
                'order_num' => $s->order_num,
                'is_active' => (bool) $s->is_active,
            ];
        }

        $this->form->fill([
            'services_title' => $settings['services_title'] ?? 'Uma Experiência de Website Completa',
            'services_subtitle' => $settings['services_subtitle'] ?? 'Criamos websites que fazem a sua marca não ser só vista, mas entendida',
            'services_title_en' => $settings['services_title_en'] ?? 'A Complete Website Experience',
            'services_subtitle_en' => $settings['services_subtitle_en'] ?? 'We create websites that make your brand not just seen, but understood',
            'services_cards' => $cardsData,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Textos do Cabeçalho da Seção (Bilingue)')
                    ->description('Edite a frase principal e a frase auxiliar exibidas acima do carrossel no site.')
                    ->schema([
                        Tabs::make('Idiomas')
                            ->tabs([
                                Tab::make('Português')
                                    ->schema([
                                        TextInput::make('services_title')
                                            ->label('Frase Principal (Título PT)')
                                            ->required(),
                                        Textarea::make('services_subtitle')
                                            ->label('Frase Auxiliar (Subtítulo PT)')
                                            ->rows(3)
                                            ->required(),
                                    ]),
                                Tab::make('English')
                                    ->schema([
                                        TextInput::make('services_title_en')
                                            ->label('Headline (EN)'),
                                        Textarea::make('services_subtitle_en')
                                            ->label('Auxiliary Subtitle (EN)')
                                            ->rows(3),
                                    ]),
                            ]),
                    ]),

                Section::make('Cards do Carrossel de Mockups (Scroll Motion)')
                    ->description('Personalize aqui todos os cards com mockups que deslizam com o scroll na seção de serviços. Você pode trocar a imagem do mockup, alterar o título, reordenar por drag-and-drop ou adicionar novos mockups.')
                    ->schema([
                        Repeater::make('services_cards')
                            ->label('Lista de Mockups do Carrossel')
                            ->addActionLabel('Adicionar Novo Mockup')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['title'] ?? null) ? ($state['title'].(empty($state['is_active']) ? ' (Inativo)' : '')) : 'Card de Mockup')
                            ->schema([
                                Hidden::make('id'),
                                Grid::make(3)->schema([
                                    FileUpload::make('image')
                                        ->label('Imagem do Mockup (Card)')
                                        ->image()
                                        ->disk('public')
                                        ->directory('services')
                                        ->imagePreviewHeight('180')
                                        ->helperText('Recomendado ~4:3 ou 16:10')
                                        ->columnSpan(1)
                                        ->required(),

                                    Grid::make(1)->schema([
                                        TextInput::make('title')
                                            ->label('Título do Mockup (PT)')
                                            ->required(),
                                        TextInput::make('title_en')
                                            ->label('Título em Inglês (EN)')
                                            ->placeholder('Opcional'),
                                        TextInput::make('category')
                                            ->label('Categoria / Tag')
                                            ->placeholder('Ex: Website Design'),
                                        Grid::make(2)->schema([
                                            TextInput::make('order_num')
                                                ->label('Número')
                                                ->placeholder('01'),
                                            Toggle::make('is_active')
                                                ->label('Ativo no Site')
                                                ->default(true),
                                        ]),
                                    ])->columnSpan(2),
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
                ->label('Salvar Alterações')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        SiteSetting::set('services_title', $state['services_title'], 'services');
        SiteSetting::set('services_subtitle', $state['services_subtitle'], 'services');
        if (! empty($state['services_title_en'])) {
            SiteSetting::set('services_title_en', $state['services_title_en'], 'services');
        }
        if (! empty($state['services_subtitle_en'])) {
            SiteSetting::set('services_subtitle_en', $state['services_subtitle_en'], 'services');
        }

        $cards = $state['services_cards'] ?? [];
        $keepIds = [];

        foreach ($cards as $index => $card) {
            $service = ! empty($card['id']) ? Service::find($card['id']) : null;
            if (! $service) {
                $service = new Service;
                $service->description = ['pt_BR' => $card['title']];
            }

            $service->order_num = ! empty($card['order_num']) ? $card['order_num'] : str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
            $service->setTranslation('title', 'pt_BR', $card['title']);
            if (! empty($card['title_en'])) {
                $service->setTranslation('title', 'en', $card['title_en']);
            }
            $service->setTranslation('category', 'pt_BR', $card['category'] ?? '');
            $service->image = $card['image'];
            $service->sort_order = $index + 1;
            $service->is_active = (bool) ($card['is_active'] ?? true);
            $service->save();

            $keepIds[] = $service->id;
        }

        if (! empty($keepIds)) {
            Service::whereNotIn('id', $keepIds)->delete();
        }

        Notification::make()
            ->success()
            ->title('Seção de Serviços e Mockups atualizados com sucesso!')
            ->send();
    }
}
