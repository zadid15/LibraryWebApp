<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Faker\Core\File;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Library Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk judul buku
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                // Field untuk penulis buku
                TextInput::make('author')
                    ->label('Author')
                    ->required()
                    ->maxLength(255),

                // Field untuk ISBN
                TextInput::make('isbn')
                    ->label('ISBN')
                    ->required()
                    ->unique(ignoreRecord: true) // Unique, kecuali untuk record yang sedang di-edit
                    ->maxLength(20),

                // Field untuk penerbit
                TextInput::make('publisher')
                    ->label('Publisher')
                    ->required()
                    ->maxLength(255),

                // Field untuk tahun terbit
                DatePicker::make('published_year')
                    ->label('Published Year')
                    ->required()
                    ->format('Y') // Format tahun saja
                    ->maxDate(now()), // Tidak boleh memilih tahun di masa depan

                // Field untuk genre
                TextInput::make('genre')
                    ->label('Genre')
                    ->required()
                    ->maxLength(100),

                // Field untuk total salinan
                TextInput::make('total_copies')
                    ->label('Total Copies')
                    ->numeric()
                    ->required()
                    ->minValue(1), // Minimal 1 salinan

                // Field untuk salinan yang tersedia
                TextInput::make('available_copies')
                    ->label('Available Copies')
                    ->numeric()
                    ->required()
                    ->minValue(0), // Minimal 0 salinan

                // Field untuk upload cover buku (opsional)
                FileUpload::make('cover_image')
                    ->label('Cover Image')
                    ->directory('book-covers') // Folder penyimpanan
                    ->image()
                    ->maxSize(2048) // Maksimal 2MB
                    ->nullable(),

                // Field untuk deskripsi buku (opsional)
                RichEditor::make('description')
                    ->label('Decription')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author')
                    ->label('Author'),

                TextColumn::make('genre')
                    ->label('Genre')
            ])
            ->actions([
                // Action untuk melihat detail buku
                Tables\Actions\ViewAction::make()
                    ->label('View Detail'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->filters([])
            ->defaultSort('title', 'asc'); // Default urutkan berdasarkan judul buku (A-Z)
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
