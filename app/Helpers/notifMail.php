<?php
namespace App\Helpers;

use App\Transaksi;
use App\User;
use App\Helpers\adhMail;

class notifMail {
    // user pesan
    public static function userPesan($id_transaksi)
    {
        $adhMail = new adhMail();

        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userPesan', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pencari_kos->email, 'Pesanan Baru', $htmlUser);
        // echo $htmlUser;
        // echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userPesan', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pemilik_kos->email, 'Pesanan Baru', $htmlPemilik);
        // echo $htmlPemilik;
    }

    // user transaksi otomatis cancel
    public static function userAutoCancel($id_transaksi)
    {
        $adhMail = new adhMail();

        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userAutoCancel', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pencari_kos->email, 'Pembatalan otomatis pesanan', $htmlUser);
        // echo $htmlUser;
        // echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userAutoCancel', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pemilik_kos->email, 'Pembatalan otomatis pesanan', $htmlPemilik);
        // echo $htmlPemilik;
    }

    // user upload bukti
    public static function userUploadBukti($id_transaksi)
    {
        $adhMail = new adhMail();

        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userUploadBukti', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pencari_kos->email, 'Upload bukti transfer pembayaran pesanan', $htmlUser);
        // echo $htmlUser;
        // echo '<hr>';
        $htmlAdmin = view('template.email.notif.admin.userUploadBukti', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();

        foreach (User::where('level', 'a')->get() as $value) {
            $adhMail->mail($value->email, 'Upload bukti transfer pembayaran pesanan', $htmlAdmin);
        }

        // echo $htmlAdmin;
    }
    
    // user cancel transaksi
    public static function userCancelTransaksi($id_transaksi)
    {
        $adhMail = new adhMail();

        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userCancelTransaksi', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pencari_kos->email, 'Pembatalan pesanan', $htmlUser);
        // echo $htmlUser;
        // echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userCancelTransaksi', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pemilik_kos->email, 'Pembatalan pesanan', $htmlPemilik);
        // echo $htmlPemilik;
    }

    // user transaksi ditolak
    public static function userTransaksiDitolak($id_transaksi)
    {
        $adhMail = new adhMail();

        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userTransaksiDitolak', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pencari_kos->email, 'Penolakan Pesanan', $htmlUser);
        // echo $htmlUser;
        // echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userTransaksiDitolak', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pemilik_kos->email, 'Penolakan Pesanan', $htmlPemilik);
        // echo $htmlPemilik;
    }

    // user transaksi diterima
    public static function userTransaksiDiterima($id_transaksi)
    {
        $adhMail = new adhMail();

        $transaksi = Transaksi::find($id_transaksi);
        $kos = $transaksi->kos;
        $pencari_kos = $transaksi->userPencariKos;
        $pemilik_kos = $kos->user;

        $htmlUser = view('template.email.notif.pencari.userTransaksiDiterima', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pencari_kos->email, 'Pemesanan Sukses', $htmlUser);
        // echo $htmlUser;
        // echo '<hr>';
        $htmlPemilik = view('template.email.notif.pemilik.userTransaksiDiterima', compact(['transaksi', 'pencari_kos', 'pemilik_kos', 'kos']))->with('pustaka', new \agungdh\Pustaka())->render();
        $adhMail->mail($pemilik_kos->email, 'Pemesanan Sukses', $htmlPemilik);
        // echo $htmlPemilik;
    }
}