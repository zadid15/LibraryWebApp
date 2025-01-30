<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Library Management';

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        TextInput::make('title')
            ->label('Title')
            ->required()
            ->maxLength(255),

        TextInput::make('author')
            ->label('Author')
            ->required()
            ->maxLength(255),

        TextInput::make('isbn')
            ->label('ISBN')
            ->required()
            ->maxLength(13), // ISBN biasanya 10 atau 13 digit

        TextInput::make('publisher')
            ->label('Publisher')
            ->required()
            ->maxLength(255),

        TextInput::make('published_year')
            ->label('Published Year')
            ->required()
            ->numeric() // Pastikan hanya angka
            ->minValue(1000) // Validasi agar masuk akal
            ->maxValue((int) date('Y')) // Tidak bisa lebih dari tahun sekarang
            ->maxLength(4),

        TextInput::make('genre')
            ->label('Genre')
            ->required()
            ->maxLength(255),

        TextInput::make('total_copies')
            ->label('Total Copies')
            ->required()
            ->numeric()
            ->minValue(1), // Minimal 1 buku

        TextInput::make('available_copies')
            ->label('Available Copies')
            ->required()
            ->numeric()
            ->minValue(0), // Bisa 0 jika semua sedang dipinjam
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('title'),
                TextColumn::make('genre'),
                TextColumn::make('author'),
                TextColumn::make('publisher'),
                TextColumn::make('published_year'),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
