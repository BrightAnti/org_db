<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Member;
use Nette\Utils\Image;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MemberResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MemberResource\RelationManagers;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Member Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([Card::make()
            ->schema([
            TextInput::make('first_name')->required(),
            TextInput::make('last_name')->required(),
            DatePicker::make('date_of_birth')->required(),
            Select::make('gender')
            ->options([
                'male' => 'Male',
                'female' => 'Female',
            ])
            ->required(),
            TextInput::make('email')->required(),
            TextInput::make('address')->required(),
            TextInput::make('registration_id')->nullable(),
            DatePicker::make('date_of_joining')->required(),
            
            Select::make('membership_status')
            ->options([
                'Active' => 'active',
                'Inactive' => 'inactive',
                'Alumni' => 'alumni',
            ]) 
            ->nullable(),
            Select::make('rank_grade')
            ->searchable()
            ->options([
                'Boys Brigade' => [
                    'Explorer' => 'Explorer',
                    'Junior Section' => 'Junior Section',
                    'Company Section' => 'Company Section',
                    'Senior Section' => 'Senior Section',
                    'Officer' => 'Officer',

                ],
                'Girls Brigade' => [
                    'Explorer' => 'Explorer',
                    'Junior Section' => 'Junior Section',
                    'Brigaders' => 'Brigaders',
                    'Company Section' => 'Company Section',
                    'Senior Section' => 'Senior Section',
                    'Officer' => 'Officer',
                ],
               ])
            
            ->required(),
            TextInput::make('notes')->nullable(),
            FileUpload::make('photo')
            // ->imageHeight('100px') // Set the image height as needed
            // ->imageWidth('100px') // Set the image width as needed
            ->nullable(),
            ])


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('date_of_birth')->date(),
                
                TextColumn::make('gender')->searchable(),
                // TextColumn::make('email')->searchable(),
                TextColumn::make('address')->searchable(),
                // TextColumn::make('registration_id')->searchable(),
                TextColumn::make('date_of_joining')->searchable(),
                // TextColumn::make('membership_status')->searchable(),
                TextColumn::make('rank_grade')->searchable(),
                // TextColumn::make('notes'),
                // ImageColumn::make('photo'),
                TextColumn::make('created_at')->dateTime(),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }    
}
