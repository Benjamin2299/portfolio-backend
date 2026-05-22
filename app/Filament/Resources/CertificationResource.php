<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Certifications';
    protected static ?string $modelLabel = 'Certification';
    protected static ?string $pluralModelLabel = 'Certifications';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required(),
            Forms\Components\TextInput::make('issuer')
                ->label('Organisme')
                ->required(),
            Forms\Components\TextInput::make('credential_id')
                ->label('ID Certificat'),
            Forms\Components\TextInput::make('credential_url')
                ->label('URL Certificat')
                ->url(),
            Forms\Components\FileUpload::make('image')
                ->label('Image')
                ->image()
                ->columnSpanFull(),
            Forms\Components\DatePicker::make('issued_at')
                ->label('Date d\'obtention')
                ->required(),
            Forms\Components\DatePicker::make('expires_at')
                ->label('Date d\'expiration'),
            Forms\Components\Toggle::make('featured')
                ->label('En vedette'),
            Forms\Components\TextInput::make('order')
                ->label('Ordre')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Image'),
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable(),
            Tables\Columns\TextColumn::make('issuer')
                ->label('Organisme')
                ->searchable(),
            Tables\Columns\TextColumn::make('issued_at')
                ->label('Obtenu le')
                ->date('d/m/Y')
                ->sortable(),
            Tables\Columns\TextColumn::make('expires_at')
                ->label('Expire le')
                ->date('d/m/Y')
                ->sortable(),
            Tables\Columns\IconColumn::make('featured')
                ->label('Vedette')
                ->boolean(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier la certification'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertifications::route('/'),
        ];
    }
}