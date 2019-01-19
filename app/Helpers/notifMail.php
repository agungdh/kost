<?php
namespace App\Helpers;

use App\Transaksi;

class notifMail {
    // user pesan
    public static function userPesan($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $transaksi->kos->user;
    }

    // user transaksi otomatis cancel
    public static function userAutoCancel($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $transaksi->kos->user;
    }

    // user upload bukti
    public static function userUploadBukti($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $transaksi->kos->user;

        // admin
    }
    
    // user cancel transaksi
    public static function userCancelTransaksi($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $transaksi->kos->user;
    }

    // user transaksi ditolak
    public static function userTransaksiDitolak($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $transaksi->kos->user;
    }

    // user transaksi diterima
    public static function userTransaksiDiterima($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $transaksi->kos->user;
    }
}