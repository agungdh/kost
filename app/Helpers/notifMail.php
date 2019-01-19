<?php
namespace App\Helpers;

use App\Transaksi;

class notifMail {
    // user pesan
    public static function userPesan($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userPesan', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        echo $htmlUser;
        echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userPesan', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        echo $htmlPemilik;
    }

    // user transaksi otomatis cancel
    public static function userAutoCancel($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userAutoCancel', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        echo $htmlUser;
        echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userAutoCancel', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        echo $htmlPemilik;
    }

    // user upload bukti
    public static function userUploadBukti($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        // admin
    }
    
    // user cancel transaksi
    public static function userCancelTransaksi($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;
    }

    // user transaksi ditolak
    public static function userTransaksiDitolak($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;
    }

    // user transaksi diterima
    public static function userTransaksiDiterima($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;
    }
}