@extends('layouts.userapp')

@section('title', 'Notifikasi - Fatayat NU PAC Pragaan')

@push('styles')
    <style>
        .notifications-page { min-height: calc(100vh - 78px); padding: 48px 20px 80px; background: linear-gradient(180deg, #edf7ef 0, #f8faf9 360px); }.notifications-wrap { width: min(100%, 780px); margin: auto; }.notifications-title { margin-bottom: 26px; }.notifications-title span { color: var(--green); font-size: 12px; font-weight: 800; letter-spacing: .06em; text-transform: uppercase; }.notifications-title h1 { margin-top: 8px; color: var(--green-dark); font: 800 clamp(1.8rem, 4vw, 2.5rem)/1.2 'Playfair Display', serif; }.notifications-list { overflow: hidden; border: 1px solid var(--border); border-radius: 22px; background: #fff; box-shadow: 0 14px 35px rgba(7,91,56,.08); }.notification-item { display: flex; gap: 15px; padding: 20px; border-bottom: 1px solid var(--border); }.notification-item:last-child { border: 0; }.notification-icon { display: grid; width: 40px; height: 40px; flex: 0 0 40px; place-items: center; border-radius: 13px; background: var(--green-light); color: var(--green-dark); }.notification-item h2 { color: var(--green-dark); font-size: 14px; }.notification-item p { margin-top: 4px; color: var(--muted); font-size: 13px; line-height: 1.55; }.notification-item a { display: inline-block; margin-top: 9px; color: var(--green); font-size: 12px; font-weight: 800; }.notifications-empty { padding: 52px 20px; color: var(--muted); text-align: center; }.notifications-pagination { margin-top: 24px; }
    </style>
@endpush

@section('content')
    <main class="notifications-page"><div class="notifications-wrap"><header class="notifications-title"><span>Aktivitas Akun</span><h1>Notifikasi</h1></header><section class="notifications-list">
        @forelse ($notifikasi as $notifikasiItem)
            <article class="notification-item"><div class="notification-icon"><i class="fa-solid fa-bell"></i></div><div><h2>{{ $notifikasiItem->data['title'] }}</h2><p>{{ $notifikasiItem->data['message'] }}</p><a href="{{ $notifikasiItem->data['url'] }}">Cek status {{ $notifikasiItem->data['no_pengaduan'] }} <i class="fa-solid fa-arrow-right"></i></a></div></article>
        @empty <div class="notifications-empty"><i class="fa-regular fa-bell"></i><p>Belum ada notifikasi.</p></div>
        @endforelse
    </section><div class="notifications-pagination">{{ $notifikasi->links() }}</div></div></main>
@endsection
