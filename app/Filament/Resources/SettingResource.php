<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Parametres';
    protected static ?string $modelLabel = 'Parametre';
    protected static ?string $pluralModelLabel = 'Parametres';
    protected static ?string $navigationGroup = 'Configuration';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')
                ->label('Cle')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Select::make('group')
                ->label('Groupe')
                ->options([
                    'general' => 'General',
                    'social' => 'Reseaux sociaux',
                    'contact' => 'Contact',
                    'seo' => 'SEO',
                    'hero' => 'Hero',
                ])
                ->default('general')
                ->required(),
            Forms\Components\FileUpload::make('value')
                ->label('Fichier (photo ou PDF)')
                ->disk('public')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                ->visible(fn ($get) => str_contains($get('key') ?? '', 'photo') || str_contains($get('key') ?? '', 'file') || str_contains($get('key') ?? '', 'cv'))
                ->columnSpanFull(),
            Forms\Components\Textarea::make('value')
                ->label('Valeur texte')
                ->visible(fn ($get) => !str_contains($get('key') ?? '', 'photo') && !str_contains($get('key') ?? '', 'file') && !str_contains($get('key') ?? '', 'cv'))
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key')
                ->label('Cle')
                ->searchable(),
            Tables\Columns\TextColumn::make('value')
                ->label('Valeur')
                ->limit(50),
            Tables\Columns\BadgeColumn::make('group')
                ->label('Groupe'),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Modifie le')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier le parametre'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
        ];
    }
}