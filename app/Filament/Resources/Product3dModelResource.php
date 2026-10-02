<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Studio3D;
use App\Filament\Resources\Product3dModelResource\Pages;
use App\Models\Product3dModel;
use App\Services\ImageOptimizer;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class Product3dModelResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product3dModel::class;

    protected static ?string $cluster = Studio3D::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Modelos 3D';

    protected static ?string $pluralModelLabel = 'Modelos 3D';

    protected static ?string $modelLabel = 'Modelo 3D';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Gerenciador de Modelo 3D')
                    ->tabs([
                        Tabs\Tab::make('Informações & Arquivo')
                            ->icon('heroicon-o-cube')
                            ->schema([
                                Grid::make(3)->schema([
                                    Grid::make(1)->schema([
                                        Section::make('Identificação do Modelo')
                                            ->description('Defina o nome, identificadores e descrições do produto.')
                                            ->schema([
                                                Grid::make(3)->schema([
                                                    TextInput::make('name')
                                                        ->label('Nome do Produto')
                                                        ->placeholder('ex: Faca do Chef Norra')
                                                        ->helperText('📍 Onde aparece: Título principal do produto no canto inferior esquerdo do visualizador 3D e botão da aba no topo.')
                                                        ->required(),
                                                    TextInput::make('slug')
                                                        ->label('Slug (Identificador URL)')
                                                        ->placeholder('ex: faca-chef')
                                                        ->helperText('📍 Técnico: Identificador único usado internamente na alternância de modelos 3D.')
                                                        ->required()
                                                        ->unique(ignoreRecord: true),
                                                    TextInput::make('badge')
                                                        ->label('Badge / Etiqueta de Destaque')
                                                        ->placeholder('ex: EDIÇÃO ESPECIAL')
                                                        ->helperText('📍 Onde aparece: Selo dourado acima do nome no canto inferior esquerdo. Opcional: se em branco, não será exibido.'),
                                                ]),
                                                TextInput::make('subtitle')
                                                    ->label('Subtítulo / Categoria')
                                                    ->placeholder('ex: Faca Artesanal 8" em Aço Damasco')
                                                    ->helperText('📍 Onde aparece: Linha descritiva sutil abaixo do nome no visualizador. Opcional: se em branco, não será exibido.'),
                                                Textarea::make('description')
                                                    ->label('Descrição Detalhada')
                                                    ->helperText('📍 Onde aparece: Texto descritivo para acessibilidade, leitores de tela e SEO.')
                                                    ->rows(3),
                                            ]),

                                        Section::make('Arquivo 3D')
                                            ->description('Upload do modelo compactado no formato padrão GLB binário.')
                                            ->schema([
                                                FileUpload::make('glb_file')
                                                    ->label('Upload do Arquivo (.glb)')
                                                    ->helperText('📍 Onde aparece: Objeto 3D interativo renderizado no centro do visualizador. Aceita arquivos .glb exportados do Blender.')
                                                    ->acceptedFileTypes([
                                                        '.glb',
                                                        '.GLB',
                                                        'glb',
                                                        'GLB',
                                                        'model/gltf-binary',
                                                        'model/gltf+json',
                                                        'application/octet-stream',
                                                        'application/json',
                                                    ])
                                                    ->rules([
                                                        'file',
                                                        'extensions:glb,GLB',
                                                    ])
                                                    ->directory('product3d/models')
                                                    ->maxSize(102400)
                                                    ->required(),
                                            ]),
                                    ])->columnSpan(2),

                                    Grid::make(1)->schema([
                                        Section::make('Status & Publicação')
                                            ->description('Controle de visibilidade na vitrine.')
                                            ->schema([
                                                Toggle::make('is_active')
                                                    ->label('Ativo na Home')
                                                    ->helperText('📍 Comportamento: Exibe ou oculta a aba deste modelo no visualizador 3D da Home.')
                                                    ->default(true),
                                                Toggle::make('is_initial')
                                                    ->label('Modelo Inicial Padrão')
                                                    ->helperText('📍 Comportamento: Define este produto como o primeiro a ser exibido ao carregar a página.')
                                                    ->default(false),
                                                TextInput::make('sort_order')
                                                    ->label('Ordem de Exibição')
                                                    ->helperText('📍 Comportamento: Posição da aba deste modelo no topo (menor número aparece antes).')
                                                    ->numeric()
                                                    ->default(0),
                                            ]),

                                        Section::make('Imagem de Fallback (Thumbnail)')
                                            ->description('Exibida em navegadores sem suporte a WebGL.')
                                            ->schema([
                                                FileUpload::make('thumbnail')
                                                    ->label('Thumbnail / Prévia')
                                                    ->helperText('📍 Onde aparece: Prévia estática antes do carregamento 3D ou caso o visitante utilize dispositivo sem suporte a WebGL.')
                                                    ->image()
                                                    ->directory('product3d/thumbnails')
                                                    ->saveUploadedFileUsing(fn ($file): string => ImageOptimizer::optimizeAndStore($file, 'product3d/thumbnails', 1600, 90)),
                                            ]),
                                    ])->columnSpan(1),
                                ]),
                            ]),

                        Tabs\Tab::make('Partes & Acabamentos')
                            ->icon('heroicon-o-swatch')
                            ->badge(fn ($record) => count($record?->parts ?? []))
                            ->schema([
                                Section::make('Partes Configuráveis & Materiais')
                                    ->description('Mapeie os meshes do arquivo GLB (ex: Blade, Handle, Bolster) e cadastre as variações de cores e materiais que o visitante poderá alternar no dock 3D.')
                                    ->schema([
                                        Repeater::make('parts')
                                            ->label('Partes da Peça')
                                            ->addActionLabel('Adicionar Nova Parte')
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => ($state['name'] ?? 'Nova Parte').'  ➜  Mesh no GLB: ['.($state['mesh_name'] ?? 'Não definido').']')
                                            ->schema([
                                                Grid::make(3)->schema([
                                                    TextInput::make('name')
                                                        ->label('Nome de Exibição da Parte')
                                                        ->placeholder('ex: Cabo / Empunhadura')
                                                        ->helperText('📍 Onde aparece: Botão da aba de partes no dock inferior direito (ex: Cabo, Lâmina).')
                                                        ->required(),
                                                    TextInput::make('mesh_name')
                                                        ->label('Nome do Mesh no GLB')
                                                        ->placeholder('ex: Handle')
                                                        ->helperText('📍 Conexão Técnica: Nome exato do objeto/mesh dentro da malha GLB no Blender.')
                                                        ->required(),
                                                    Select::make('type')
                                                        ->label('Tipo de Customização')
                                                        ->options([
                                                            'color' => 'Cor & Tonalidade',
                                                            'material' => 'Material / Metalicidade',
                                                            'texture' => 'Textura / Padrão',
                                                        ])
                                                        ->default('color')
                                                        ->helperText('📍 Comportamento: Define se altera cor pura, física de material ou textura.')
                                                        ->required(),
                                                ]),

                                                Section::make('Opções de Acabamento')
                                                    ->compact()
                                                    ->schema([
                                                        Repeater::make('options')
                                                            ->label('Swatches / Variações de Acabamento')
                                                            ->addActionLabel('Adicionar Acabamento')
                                                            ->grid(2)
                                                            ->collapsible()
                                                            ->collapsed(fn (array $state): bool => ! empty($state['name']))
                                                            ->itemLabel(fn (array $state): ?string => ($state['name'] ?? 'Novo Acabamento').' ('.($state['color'] ?? '#...').')')
                                                            ->schema([
                                                                Grid::make(2)->schema([
                                                                    TextInput::make('name')
                                                                        ->label('Nome do Acabamento')
                                                                        ->placeholder('ex: Ébano Noturno')
                                                                        ->helperText('📍 Onde aparece: Exibido no dock ao passar o mouse ou selecionar.')
                                                                        ->required(),
                                                                    ColorPicker::make('color')
                                                                        ->label('Cor / Swatch')
                                                                        ->default('#111111')
                                                                        ->helperText('📍 Onde aparece: Círculo de cor clicável e tom aplicado ao mesh.')
                                                                        ->required(),
                                                                ]),
                                                                Grid::make(2)->schema([
                                                                    TextInput::make('roughness')
                                                                        ->label('Rugosidade (0.0 a 1.0)')
                                                                        ->helperText('📍 Efeito 3D: 0.0 = espelhado/lustroso; 1.0 = fosco/matte.')
                                                                        ->numeric()
                                                                        ->default(0.4)
                                                                        ->step(0.05),
                                                                    TextInput::make('metalness')
                                                                        ->label('Metalicidade (0.0 a 1.0)')
                                                                        ->helperText('📍 Efeito 3D: 0.0 = resina/madeira; 1.0 = aço/ouro/titânio.')
                                                                        ->numeric()
                                                                        ->default(0.0)
                                                                        ->step(0.05),
                                                                ]),
                                                                Grid::make(2)->schema([
                                                                    Select::make('material_type')
                                                                        ->label('Tipo de Material Three.js')
                                                                        ->options([
                                                                            'physical' => 'MeshPhysicalMaterial (Premium)',
                                                                            'standard' => 'MeshStandardMaterial',
                                                                        ])
                                                                        ->default('physical')
                                                                        ->helperText('📍 Motor 3D: Physical traz reflexos mais fidedignos.'),
                                                                    Toggle::make('is_default')
                                                                        ->label('Acabamento Inicial Padrão')
                                                                        ->helperText('📍 Estado Inicial: Acabamento selecionado ao abrir.')
                                                                        ->inline(false)
                                                                        ->default(false),
                                                                ]),
                                                                FileUpload::make('texture')
                                                                    ->label('Textura Opcional (Mapa)')
                                                                    ->helperText('📍 Opcional: Imagem para simular veios de madeira, damasco ou fibra.')
                                                                    ->directory('product3d/textures')
                                                                    ->image()
                                                                    ->columnSpanFull(),
                                                            ]),
                                                    ]),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Câmera & Visualização')
                            ->icon('heroicon-o-video-camera')
                            ->schema([
                                Section::make('Configuração da Câmera & Ajustes 3D')
                                    ->description('Ajuste o campo de visão (FOV), a distância inicial da câmera, o multiplicador de escala e permissões de zoom deste modelo.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('camera_settings.fov')
                                                ->label('Campo de Visão (FOV em graus)')
                                                ->helperText('📍 Lente 3D: Ângulo de visão da lente (recomendado: 35° a 45°). Menor valor reduz distorção.')
                                                ->numeric()
                                                ->default(40),
                                            TextInput::make('camera_settings.distance')
                                                ->label('Distância Z da Câmera')
                                                ->helperText('📍 Posição 3D: Distância focal padrão no eixo Z ao carregar (recomendado: 3.8 a 4.5).')
                                                ->numeric()
                                                ->default(4.2),
                                            TextInput::make('transform_settings.scale')
                                                ->label('Escala Inicial do Modelo')
                                                ->helperText('📍 Escala 3D: Fator multiplicador de tamanho caso o modelo exportado seja muito grande ou pequeno.')
                                                ->numeric()
                                                ->default(1.0),
                                        ]),
                                        Toggle::make('camera_settings.allow_zoom')
                                            ->label('Permitir Zoom Neste Modelo')
                                            ->helperText('📍 Interatividade: Permite ao usuário aproximar e afastar a visão deste modelo 3D usando scroll do mouse, gesto de pinça no touch e botões + / -.')
                                            ->default(true),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Prévia')
                    ->square(),
                TextColumn::make('name')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subtitle')
                    ->label('Subtítulo')
                    ->limit(35),
                TextColumn::make('parts_count')
                    ->label('Partes')
                    ->state(fn (Product3dModel $record): int => is_array($record->parts) ? count($record->parts) : 0),
                IconColumn::make('is_active')
                    ->label('Visível na Home')
                    ->boolean(),
                IconColumn::make('is_initial')
                    ->label('Padrão')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\Action::make('toggle_active')
                    ->label(fn (Product3dModel $record): string => $record->is_active ? 'Desativar da Home' : 'Ativar na Home')
                    ->icon(fn (Product3dModel $record): string => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Product3dModel $record): string => $record->is_active ? 'warning' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Product3dModel $record): string => $record->is_active ? 'Desativar Modelo da Vitrine?' : 'Ativar Modelo na Vitrine?')
                    ->modalDescription(fn (Product3dModel $record): string => $record->is_active
                        ? 'Ao salvar a alteração, este produto deixará de aparecer na seção 3D da página inicial (ele ainda pode ser usado na apresentação MUP3).'
                        : 'Ao salvar a alteração, este produto passará a ser exibido na seção 3D da página inicial.')
                    ->modalSubmitActionLabel('Salvar Alteração')
                    ->action(function (Product3dModel $record): void {
                        $record->is_active = ! $record->is_active;
                        $record->save();

                        Notification::make()
                            ->title($record->is_active ? 'Modelo ativado na Home com sucesso!' : 'Modelo desativado da Home com sucesso!')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduct3dModels::route('/'),
            'create' => Pages\CreateProduct3dModel::route('/create'),
            'edit' => Pages\EditProduct3dModel::route('/{record}/edit'),
        ];
    }
}
