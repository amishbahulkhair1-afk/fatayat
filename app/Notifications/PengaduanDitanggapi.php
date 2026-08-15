<?php

namespace App\Notifications;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengaduanDitanggapi extends Notification
{
    use Queueable;

    public function __construct(private readonly Pengaduan $pengaduan)
    {
    }

    public function via(object $notifiable): array
    {
        return $notifiable instanceof User ? ['database'] : ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Tanggapan Pengaduan ' . $this->pengaduan->no_pengaduan)
            ->greeting('Assalamu\'alaikum,')
            ->line('Admin PAC telah memberikan tanggapan untuk pengaduan Anda.')
            ->line('Nomor pengaduan: ' . $this->pengaduan->no_pengaduan)
            ->action('Cek Status Pengaduan', route('pengaduan.publik.cek'))
            ->line('Silakan masukkan nomor pengaduan tersebut untuk melihat tanggapan lengkap.')
            ->salutation('Fatayat NU PAC Pragaan');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Tanggapan baru untuk pengaduan Anda',
            'message' => 'Admin PAC telah memberi tanggapan untuk laporan ' . $this->pengaduan->no_pengaduan . '.',
            'no_pengaduan' => $this->pengaduan->no_pengaduan,
            'url' => route('pengaduan.publik.cek'),
        ];
    }
}
