<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowingResource\Pages;
use App\Filament\Resources\BorrowingResource\RelationManagers;
use App\Models\Borrowing;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BorrowingResource extends Resource
{
    protected static ?string $model = Borrowing::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('user_id')
                    ->label('Peminjam')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('book_id')
                    ->label('Buku')
                    ->relationship('book', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),

                DatePicker::make('borrow_date')
                    ->label('Tanggal Peminjaman')
                    ->required()
                    ->default(now()),

                DatePicker::make('due_date')
                    ->label('Tanggal Jatuh Tempo')
                    ->required()
                    ->minDate(now()),

                DatePicker::make('return_date')
                    ->label('Tanggal Pengembalian')
                    ->nullable(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'borrowed' => 'Borrowed',
                        'returned' => 'Returned',
                        'overdue' => 'Overdue',
                    ])
                    ->default('borrowed')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Borrower')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('book.title')
                    ->label('Book Title')
                    ->searchable(),

                TextColumn::make('borrow_date')
                    ->label('Borrow Date')
                    ->date('d M Y'),


                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        // Format teks status
                        return match ($state) {
                            'borrowed' => 'Borrowed',
                            'returned' => 'Returned',
                            'overdue' => 'Overdue',
                            default => $state, // Default jika nilai tidak sesuai
                        };
                    })
                    ->colors([
                        'info' => 'borrowed',
                        'success' => 'returned',
                        'danger' => 'overdue',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('gray')
                    ->label('View Detail')
                    ->iconPosition(IconPosition::After),
                Tables\Actions\EditAction::make()
                    ->color('warning')
                    ->label('Edit')
                    ->iconPosition(IconPosition::After),
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
            'index' => Pages\ListBorrowings::route('/'),
            'create' => Pages\CreateBorrowing::route('/create'),
            'edit' => Pages\EditBorrowing::route('/{record}/edit'),
        ];
    }
}
