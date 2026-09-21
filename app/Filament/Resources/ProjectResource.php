<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Services\ImageOptimizer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'Projetos';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\TextInput::make('client'),
                Forms\Components\TextInput::make('year'),
                Forms\Components\TextInput::make('category')
                    ->required(),
                Forms\Components\Textarea::make('short_description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('full_description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')
                    ->label('Imagem de Capa (Card)')
                    ->helperText('Imagem exibida no card do projeto. É redimensionada até 2400px e convertida automaticamente para WebP de alta fidelidade.')
                    ->image()
                    ->maxSize(20480)
                    ->directory('projects')
                    ->saveUploadedFileUsing(fn ($file): string => ImageOptimizer::optimizeAndStore($file, 'projects', 2400, 90))
                    ->required(),
                Forms\Components\FileUpload::make('mockup_image')
                    ->label('Imagem do Site Completo (Pop-up)')
                    ->helperText('Aparece no pop-up quando o projeto não tem URL. Print do site completo, mockup ou prancha. É redimensionada até 4000px e convertida para WebP mantendo máxima qualidade e leveza.')
                    ->image()
                    ->maxSize(25600)
                    ->directory('projects')
                    ->saveUploadedFileUsing(fn ($file): string => ImageOptimizer::optimizeAndStore($file, 'projects', 4000, 92)),
                Forms\Components\FileUpload::make('highlight_video')
                    ->label('Vídeo de Highlights')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                    ->directory('projects/videos')
                    ->maxSize(51200),
                Forms\Components\Textarea::make('gallery')
                    ->columnSpanFull(),
                Forms\Components\CheckboxList::make('tags')
                    ->label('Serviços / Tags')
                    ->options([
                        'Website' => 'Website',
                        'Aplicativo' => 'Aplicativo',
                        'Design 3D' => 'Design 3D',
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('link_url')
                    ->label('URL do Site (Link Externo)')
                    ->helperText('Se preenchido, o clique no projeto abre a URL em nova aba. Se deixado vazio, o clique abre o pop-up com a imagem completa do projeto.')
                    ->url(),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('cover_image'),
                Tables\Columns\ImageColumn::make('mockup_image'),
                Tables\Columns\TextColumn::make('link_url')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
