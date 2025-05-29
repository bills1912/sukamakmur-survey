<?php

namespace App\Filament\Resources;

use Filament\Forms\Get;
use App\Filament\Resources\QuestionnaireResource\Pages;
use App\Filament\Resources\QuestionnaireResource\RelationManagers;
use Afsakar\LeafletMapPicker\LeafletMapPicker;
use App\Models\Questionnaire;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;
use Carbon\Carbon;
use Filament\Forms\Set;

class QuestionnaireResource extends Resource
{
    protected static ?string $model = Questionnaire::class;

    protected static ?string $navigationLabel = 'Kuesioner';
    protected static ?string $title = 'User Management';

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Data Keluarga')
                    // ->relationship('survey')
                    ->schema([
                        Forms\Components\Select::make('survey_id')
                            ->label(__('ID Survey'))
                            ->required()
                            ->disabled()
                            ->relationship('survey', 'id')
                            ->default(1)
                            ->native(false)
                            ->columnSpanFull(),
                        Forms\Components\Section::make("Identitas Petugas")
                            ->schema([
                                Forms\Components\TextInput::make('nama_petugas')
                                    ->label(__('Nama Petugas'))
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('kelompok_dasa_wisma')
                                    ->label(__('Kelompok Dasa Wisma'))
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('dusun')
                                    ->required()
                                    ->label(__('Dusun'))
                                    ->options([
                                        '1' => 'Dusun I-A',
                                        '2' => 'Dusun I-B',
                                        '3' => 'Dusun II Timur',
                                        '4' => 'Dusun II Barat',
                                        '5' => 'Dusun III',
                                        '6' => 'Dusun IV',
                                    ])
                                    ->native(false),
                                Forms\Components\TimePicker::make('waktu_pendataan')
                                    ->default(Carbon::now())
                                    ->label(__('Waktu Pendataan'))
                                    ->required()
                                    ->readonly()
                                    ->format('H:i:s')
                                    ->timezone('Asia/Jakarta')
                                    ->native(false),
                                LeafletMapPicker::make('lokasi_rumah')
                                    ->label('Lokasi Rumah Responden')
                                    ->myLocationButtonLabel('Go to My Location')
                                    ->hideTileControl()
                                    ->draggable(false)
                            ]),
                        Forms\Components\TextInput::make('r_102')
                            ->label(__('Nomor Kartu Keluarga'))
                            ->required()
                            ->columnSpanFull()
                            ->length(16)
                            ->extraInputAttributes([
                                'oninput' => "this.value = this.value.slice(0, 16);",
                            ]),
                        Forms\Components\Radio::make('r_103')
                            ->live()
                            ->label(__('Status KK'))
                            ->options([
                                '1' => 'KK Suka Makmur',
                                '2' => 'Bukan KK Suka Makmur',
                                '3' => 'Belum Punya KK',
                            ])
                            ->required(),
                        Forms\Components\Radio::make('r_104')
                            ->label(__('Apakah Keluarga Sudah Mengurus KK di Desa Suka Makmur?'))
                            ->visible(fn(Get $get) => $get('r_103') == '2' || $get('r_103') == '3')
                            ->options([
                                '1' => 'Sudah',
                                '2' => 'Belum',
                            ])
                            ->required(),
                        Forms\Components\Repeater::make('r_200')
                            ->label(__('Anggota Keluarga'))
                            ->schema([
                                Forms\Components\TextInput::make('r_201')
                                    ->label(__('Nama Anggota Keluarga'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('r_202')
                                    ->label(__('Nomor Induk Kependudukan (NIK)'))
                                    ->required()
                                    // ->numeric()
                                    ->length(16)
                                    ->extraInputAttributes([
                                        'oninput' => "this.value = this.value.slice(0, 16);",
                                    ]),
                                Forms\Components\Radio::make('r_203')
                                    ->required()
                                    ->label(__('Status Keluarga'))
                                    ->options([
                                        '1' => 'Kepala Keluarga',
                                        '2' => 'Istri/Suami',
                                        '3' => 'Anak Kandung',
                                        '4' => 'Anak Tiri/Angkat',
                                        '5' => 'Orang Tua/Mertua',
                                        '6' => 'Famili Lain',
                                    ]),
                                Forms\Components\Radio::make('r_204')
                                    ->required()
                                    ->label(__('Status Perkawinan'))
                                    ->options([
                                        '1' => 'Kawin',
                                        '2' => 'Belum Kawin',
                                        '3' => 'Cerai Hidup',
                                        '4' => 'Cerai Mati',
                                    ]),
                                Forms\Components\Radio::make('r_205')
                                    ->required()
                                    ->label(__('Jenis Kelamin'))
                                    ->options([
                                        '1' => 'Laki-laki',
                                        '2' => 'Perempuan',
                                    ]),
                                Forms\Components\TextInput::make('r_206')
                                    ->required()
                                    ->label(__('Tempat Lahir'))
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('r_207')
                                    ->required()
                                    ->locale('id')
                                    ->timezone('Asia/Jakarta')
                                    ->live()
                                    ->label(__('Tanggal Lahir'))
                                    ->native(false)
                                    ->displayFormat('D, d M Y')
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        $set('r_207_usia', Carbon::parse($state)->age);
                                    }),
                                Forms\Components\TextInput::make('r_207_usia')
                                    ->label(__('Usia'))
                                    ->readonly()
                                    ->required()
                                    ->dehydrated(true)
                                    ->helperText(__('Usia dalam tahun')),
                                Forms\Components\TextInput::make('r_208')
                                    ->maxLength(255)
                                    ->required()
                                    ->label(__('Suku')),
                                Forms\Components\Radio::make('r_209')
                                    ->required()
                                    ->label(__('Kewarganegaraan'))
                                    ->options([
                                        '1' => 'WNI',
                                        '2' => 'WNA',
                                    ]),
                                Forms\Components\Radio::make('r_210')
                                    ->required()
                                    ->live()
                                    ->label(__('Keberadaan Penduduk'))
                                    ->options([
                                        '1' => 'Berdomisili di Desa Suka Makmur',
                                        '2' => 'Sudah Pindah ke luar Desa Suka Makmur',
                                        '3' => 'Membentuk Keluarga Baru di Desa Suka Makmur',
                                        '4' => 'Sudah Meninggal',
                                    ]),
                                Forms\Components\CheckboxList::make('r_211')
                                    ->label(__('Apakah Penyandang Disabilitas? (Boleh lebih dari satu)'))
                                    ->options([
                                        '1' => 'Penglihatan',
                                        '2' => 'Pendengaran',
                                        '3' => 'Berjalan/Naik Tangga',
                                        '4' => 'Menggunakan/Menggerakkan Tangan/Jari',
                                        '5' => 'Mengingat/Konsentrasi',
                                        '6' => 'Merawat Diri',
                                        '7' => 'Komunikasi',
                                        '8' => 'Perilaku/Emosi',
                                    ]),
                                Forms\Components\Radio::make('r_212')
                                    ->required()
                                    ->label(__('Pendidikan Terakhir'))
                                    ->options([
                                        '1' => 'Tidak Sekolah/Belum Tamat SD',
                                        '2' => 'SD/Sederajat',
                                        '3' => 'SMP/Sederajat',
                                        '4' => 'SMA/Sederajat',
                                        '5' => 'D1/D2/D3',
                                        '6' => 'S1/S2/S3',
                                    ]),
                                Forms\Components\Section::make('Pekerjaan')
                                    ->visible(fn(Get $get) => $get('r_210') == '1')
                                    ->schema([
                                        Forms\Components\Select::make("r_301")
                                            ->label(__('Di Sektor Apa Pekerjaan Utama '))
                                            ->required()
                                            ->live()
                                            ->options([
                                                '1' => 'Pertanian Padi/Palawija',
                                                '2' => 'Perikanan',
                                                '3' => 'Peternakan',
                                                '4' => 'Lainnya',
                                            ])
                                            ->native(false)
                                            ->searchable(),
                                        Forms\Components\Repeater::make('Sektor Pertanian Tanaman Padi/Palawija')
                                            ->visible(fn(Get $get) => $get('r_301') == '1')
                                            ->schema([
                                                Forms\Components\TextInput::make('r_302_a')
                                                    ->label(__('Komoditas yang Diusahakan'))
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\Radio::make('r_302_b')
                                                    ->label(__('Jenis Lahan'))
                                                    ->options([
                                                        '1' => 'Sawah',
                                                        '2' => 'Kebun',
                                                        '3' => 'Lahan Kering',
                                                    ])
                                                    ->required(),
                                                Forms\Components\Radio::make('r_302_c')
                                                    ->label(__('Status Kepemilikan Lahan'))
                                                    ->options([
                                                        '1' => 'Milik Sendiri',
                                                        '2' => 'Sewa',
                                                        '3' => 'Bebas Sewa',
                                                        '4' => 'Lainnya',
                                                    ])
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_302_d')
                                                    ->label(__('Luas Lahan yang Diusahakan (m2)'))
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_302_e')
                                                    ->label(__('Jumlah Produksi Padi/Palawija dalam Setahun Terakhir (Kg)'))
                                                    ->required()
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('r_302_f')
                                                    ->label(__('Nilai Produksi dalam Setahun Terakhir (Rp)'))
                                                    ->required()
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('r_302_g')
                                                    ->label(__('Penghasilan Bersih dalam Setahun Terakhir (Rp)'))
                                                    ->required()
                                                    ->numeric(),
                                            ]),
                                        Forms\Components\Repeater::make('Perikanan')
                                            ->visible(fn(Get $get) => $get('r_301') == '2')
                                            ->schema([
                                                Forms\Components\TextInput::make('r_303_a')
                                                    ->label(__('Luas Lahan Budidaya'))
                                                    ->required()
                                                    ->numeric(255),
                                                Forms\Components\Select::make('r_303_b')
                                                    ->label(__('Jenis Ikan yang Diusahakan Setahun Terakhir'))
                                                    ->options([
                                                        '1' => 'Ikan Lele',
                                                        '2' => 'Ikan Nila',
                                                        '3' => 'Ikan Gurame',
                                                        '4' => 'Ikan Patin',
                                                        '5' => 'Ikan Mas',
                                                        '6' => 'Lainnya',
                                                    ])
                                                    ->native(false)
                                                    ->searchable()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_303_c')
                                                    ->label(__('Jumlah Produksi Hasil Perikanan dalam Setahun Terakhir (Kg)'))
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_303_d')
                                                    ->label(__('Nilai Produksi dalam Setahun Terakhir (Rp)'))
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_303_e')
                                                    ->label(__('Penghasilan Bersih dalam Setahun Terakhir (Rp)'))
                                                    ->numeric()
                                                    ->required(),
                                            ]),
                                        Forms\Components\Repeater::make('Peternakan')
                                            ->visible(fn(Get $get) => $get('r_301') == '3')
                                            ->schema([
                                                Forms\Components\Select::make('r_304_a')
                                                    ->required()
                                                    ->label(__('Jenis Ternak'))
                                                    ->options([
                                                        '1' => 'Sapi',
                                                        '2' => 'Kambing',
                                                        '3' => 'Ayam',
                                                        '4' => 'Bebek',
                                                        '5' => 'Lainnya',
                                                    ]),
                                                Forms\Components\TextInput::make('r_304_b')
                                                    ->numeric()
                                                    ->label(__('Jumlah Ternak'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_304_c')
                                                    ->numeric()
                                                    ->label(__('Nilai Produksi dalam Setahun Terakhir (Rp)'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_304_d')
                                                    ->numeric()
                                                    ->label(__('Penghasilan Bersih dalam Setahun Terakhir (Rp)'))
                                                    ->required(),
                                            ]),
                                        Forms\Components\Repeater::make('Lainnya')
                                            ->visible(fn(Get $get) => $get('r_301') == '4')
                                            ->schema([
                                                Forms\Components\TextInput::make('r_305_a')
                                                    ->maxLength(255)
                                                    ->label(__('Nama Pemilik Usaha'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_b')
                                                    ->maxLength(255)
                                                    ->label(__('Produk Usaha'))
                                                    ->required(),
                                                Forms\Components\Textarea::make('r_305_c')
                                                    ->maxLength(255)
                                                    ->label(__('Alamat Tempat Usaha'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_d')
                                                    ->numeric()
                                                    ->label(__('Jumlah Pekerja'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_e')
                                                    ->numeric()
                                                    ->label(__('Rata-Rata Omset Usaha per Bulan (Rp)'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_f')
                                                    ->numeric()
                                                    ->label(__('Rata-Rata Penghasilan Bersih per Bulan (Rp)'))
                                                    ->required(),
                                            ]),
                                        Forms\Components\Radio::make("r_306")
                                            ->label(__('Apakah Ada Pekerjaan Lain?'))
                                            ->live()
                                            ->required()
                                            ->options([
                                                '1' => 'Ya',
                                                '2' => 'Tidak',
                                            ])
                                            ->default('2')
                                            ->columnSpanFull(),
                                        Forms\Components\Select::make("r_301_tambah")
                                            ->label(__('Di Sektor Apa Pekerjaan Tambahan Anda'))
                                            ->visible(fn(Get $get) => $get('r_306') == '1')
                                            ->required()
                                            ->live()
                                            ->options([
                                                '1' => 'Pertanian Padi/Palawija',
                                                '2' => 'Perikanan',
                                                '3' => 'Peternakan',
                                                '4' => 'Lainnya',
                                            ])
                                            ->native(false)
                                            ->searchable(),
                                        Forms\Components\Repeater::make('Sektor Pertanian Tanaman Padi/Palawija')
                                            ->visible(fn(Get $get) => $get('r_301_tambah') == '1')
                                            ->schema([
                                                Forms\Components\TextInput::make('r_302_a_tambah')
                                                    ->label(__('Komoditas yang Diusahakan'))
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\Radio::make('r_302_b_tambah')
                                                    ->label(__('Jenis Lahan'))
                                                    ->options([
                                                        '1' => 'Sawah',
                                                        '2' => 'Kebun',
                                                        '3' => 'Lahan Kering',
                                                    ])
                                                    ->required(),
                                                Forms\Components\Radio::make('r_302_c_tambah')
                                                    ->label(__('Status Kepemilikan Lahan'))
                                                    ->options([
                                                        '1' => 'Milik Sendiri',
                                                        '2' => 'Sewa',
                                                        '3' => 'Bebas Sewa',
                                                        '4' => 'Lainnya',
                                                    ])
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_302_d_tambah')
                                                    ->label(__('Luas Lahan yang Diusahakan (m2)'))
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_302_e_tambah')
                                                    ->label(__('Jumlah Produksi Padi/Palawija dalam Setahun Terakhir (Kg)'))
                                                    ->required()
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('r_302_f_tambah')
                                                    ->label(__('Nilai Produksi dalam Setahun Terakhir (Rp)'))
                                                    ->required()
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('r_302_g_tambah')
                                                    ->label(__('Penghasilan Bersih dalam Setahun Terakhir (Rp)'))
                                                    ->required()
                                                    ->numeric(),
                                            ]),
                                        Forms\Components\Repeater::make('Perikanan')
                                            ->visible(fn(Get $get) => $get('r_301_tambah') == '2')
                                            ->schema([
                                                Forms\Components\TextInput::make('r_303_a_tambah')
                                                    ->label(__('Luas Lahan Budidaya'))
                                                    ->required()
                                                    ->numeric(255),
                                                Forms\Components\Select::make('r_303_b_tambah')
                                                    ->label(__('Jenis Ikan yang Diusahakan Setahun Terakhir'))
                                                    ->options([
                                                        '1' => 'Ikan Lele',
                                                        '2' => 'Ikan Nila',
                                                        '3' => 'Ikan Gurame',
                                                        '4' => 'Ikan Patin',
                                                        '5' => 'Ikan Mas',
                                                        '6' => 'Lainnya',
                                                    ])
                                                    ->native(false)
                                                    ->searchable()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_303_c_tambah')
                                                    ->label(__('Jumlah Produksi Hasil Perikanan dalam Setahun Terakhir (Kg)'))
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_303_d_tambah')
                                                    ->label(__('Nilai Produksi dalam Setahun Terakhir (Rp)'))
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_303_e_tambah')
                                                    ->label(__('Penghasilan Bersih dalam Setahun Terakhir (Rp)'))
                                                    ->numeric()
                                                    ->required(),
                                            ]),
                                        Forms\Components\Repeater::make('Peternakan')
                                            ->visible(fn(Get $get) => $get('r_301_tambah') == '3')
                                            ->schema([
                                                Forms\Components\Select::make('r_304_a_tambah')
                                                    ->required()
                                                    ->label(__('Jenis Ternak'))
                                                    ->options([
                                                        '1' => 'Sapi',
                                                        '2' => 'Kambing',
                                                        '3' => 'Ayam',
                                                        '4' => 'Bebek',
                                                        '5' => 'Lainnya',
                                                    ]),
                                                Forms\Components\TextInput::make('r_304_b_tambah')
                                                    ->numeric()
                                                    ->label(__('Jumlah Ternak'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_304_c_tambah')
                                                    ->numeric()
                                                    ->label(__('Nilai Produksi dalam Setahun Terakhir (Rp)'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_304_d_tambah')
                                                    ->numeric()
                                                    ->label(__('Penghasilan Bersih dalam Setahun Terakhir (Rp)'))
                                                    ->required(),
                                            ]),
                                        Forms\Components\Repeater::make('Lainnya')
                                            ->visible(fn(Get $get) => $get('r_301_tambah') == '4')
                                            ->schema([
                                                Forms\Components\TextInput::make('r_305_a_tambah')
                                                    ->maxLength(255)
                                                    ->label(__('Nama Pemilik Usaha'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_b_tambah')
                                                    ->maxLength(255)
                                                    ->label(__('Produk Usaha'))
                                                    ->required(),
                                                Forms\Components\Textarea::make('r_305_c_tambah')
                                                    ->maxLength(255)
                                                    ->label(__('Alamat Tempat Usaha'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_d_tambah')
                                                    ->numeric()
                                                    ->label(__('Jumlah Pekerja'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_e_tambah')
                                                    ->numeric()
                                                    ->label(__('Rata-Rata Omset Usaha per Bulan (Rp)'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('r_305_f_tambah')
                                                    ->numeric()
                                                    ->label(__('Rata-Rata Penghasilan Bersih per Bulan (Rp)'))
                                                    ->required(),
                                            ]),
                                    ])
                            ])

                            ->columns(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('r_401')
                            ->label(__('Keterangan'))
                            // ->maxLength(255)
                            ->columnSpanFull(),
                    ])

            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('r_102')
                    ->label(__('Nomor KK'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('r_103')
                    ->label(__('Status KK'))
                    ->formatStateUsing(fn($state) => match ($state) {
                        '1' => 'KK Suka Makmur',
                        '2' => 'Bukan KK Suka',
                        '3' => 'Belum Punya KK',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_petugas')
                    ->label(__('Petugas Pendata'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListQuestionnaires::route('/'),
            'create' => Pages\CreateQuestionnaire::route('/create'),
            'edit' => Pages\EditQuestionnaire::route('/{record}/edit'),
        ];
    }
}
