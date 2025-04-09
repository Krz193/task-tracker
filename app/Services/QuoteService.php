<?php

namespace App\Services;

class QuoteService
{
    protected static array $quotes = [
        'low' => [
            'Spes est initium',        // Harapan adalah awal
            'Credere in te',           // Percayalah pada dirimu
            'Gradatim ad metam',       // Selangkah demi selangkah menuju tujuan
            'Initium semper durum',    // Awal selalu sulit
            'Non cede nunc',           // Jangan menyerah sekarang
            'Futurum est tuum',        // Masa depan adalah milikmu
            'Tentare iterum fortiter', // Coba lagi dengan kuat
            'Spes dat vires',          // Harapan memberi kekuatan
            'Lente sed certe',         // Perlahan tapi pasti
            'Parvus progressus est',   // Kemajuan kecil tetap berarti
        ],
        'medium' => [
            'Fortiter in via',         // Kuat di jalanmu
            'Virtus per constantiam',  // Kekuatan lewat ketekunan
            'Audax ad finem',          // Berani sampai akhir
            'Crescere per laborem',    // Tumbuh lewat kerja keras
            'Perge sine metu',         // Terus maju tanpa takut
            'Fides tua te ducit',      // Keyakinanmu memimpinmu
            'Labor gloriae via',       // Kerja keras adalah jalan kemuliaan
            'Ascende adhuc altius',    // Naik lebih tinggi lagi
            'Non desistas nunc',       // Jangan berhenti sekarang
            'Progredere confidenter',  // Maju dengan percaya diri
        ],
        'high' => [
            'Victoria tua est',        // Kemenangan adalah milikmu
            'Splendidum opus fecisti', // Kamu telah membuat karya yang luar biasa
            'Honor et gloria',         // Kehormatan dan kejayaan
            'Finis coronat opus',      // Akhir memahkotai usaha
            'Triumphus meritus est',   // Kemenangan yang layak
            'Perfectus et gloriosus',  // Sempurna dan gemilang
            'Laus pro labore',         // Pujian atas kerja keras
            'Felicitations magnae sunt', // Selamat besar-besaran
            'Complere cum honore',     // Menyelesaikan dengan kehormatan
            'Stellariter perfecisti',  // Kamu menyelesaikannya dengan gemilang
        ],
    ];

    public static function getQuote(float $percentage)
    {
        // if ($percentage <= 50) {
        //     $category = 'low';
        // } elseif ($percentage <= 75) {
        //     $category = 'medium';
        // } else {
        //     $category = 'high';
        // }

        $category = 
        ($percentage>75) 
        ? 'high' 
        : (
            ($percentage>50) 
            ? 'medium' 
            : 'low'
        );

        return collect(self::$quotes[$category])->random();
    }
}