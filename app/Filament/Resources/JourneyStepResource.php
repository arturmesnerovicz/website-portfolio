<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JourneyStepResource\Pages;
use App\Models\JourneyStep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JourneyStepResource extends Resource
{
    protected static ?string $model = JourneyStep::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'Jornada';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('step_num')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('subtitle'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('deliverables')
                    ->columnSpanFull(),
                Forms\Components\Select::make('media_type')
                    ->label('Tipo de Mídia')
                    ->options([
                        'image' => 'Imagem',
                        'video' => 'Vídeo',
                    ])
                    ->default('image')
                    ->required()
                    ->live(),
                Forms\Components\FileUpload::make('image_path')
                    ->label('Imagem')
                    ->image()
                    ->directory('journey/images')
                    ->visible(fn (Forms\Get $get): bool => ($get('media_type') ?? 'image') === 'image'),
                Forms\Components\FileUpload::make('video_path')
                    ->label('Vídeo')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                    ->directory('journey/videos')
                    ->maxSize(51200)
                    ->visible(fn (Forms\Get $get): bool => $get('media_type') === 'video'),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('step_num')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('media_type')
                    ->label('Mídia')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'video' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'video' => 'Vídeo',
                        default => 'Imagem',
                    }),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Imagem'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListJourneySteps::route('/'),
            'create' => Pages\CreateJourneyStep::route('/create'),
            'edit' => Pages\EditJourneyStep::route('/{record}/edit'),
        ];
    }
}
