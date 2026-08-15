@push('styles')
    <style>
        .complaint-page { padding: 48px 20px 88px; background: linear-gradient(180deg, #eef7f0 0, #f8faf9 360px); }
        .complaint-shell { width: min(100%, 820px); margin: 0 auto; }
        .complaint-hero { text-align: center; margin: 0 auto 28px; max-width: 650px; }
        .complaint-kicker { display: inline-flex; align-items: center; gap: 8px; padding: 8px 13px; border-radius: 999px; background: var(--green-light); color: var(--green-dark); font-size: 12px; font-weight: 800; }
        .complaint-hero h1 { margin: 14px 0 9px; color: var(--green-dark); font: 800 clamp(1.9rem, 4vw, 2.7rem)/1.15 'Playfair Display', serif; }
        .complaint-hero p { color: var(--muted); }
        .complaint-card { background: #fff; border: 1px solid var(--border); border-radius: 24px; padding: clamp(24px, 5vw, 44px); box-shadow: 0 20px 50px rgba(7, 91, 56, .09); }
        .complaint-icon { width: 56px; height: 56px; display: grid; place-items: center; margin: 0 auto 16px; border-radius: 18px; color: var(--green-dark); background: var(--green-light); font-size: 23px; }
        .complaint-card-title { margin-bottom: 6px; color: var(--green-dark); font-size: 1.35rem; font-weight: 800; text-align: center; }
        .complaint-card-intro { color: var(--muted); text-align: center; margin-bottom: 26px; }
        .complaint-field { margin-top: 20px; }
        .complaint-label, .complaint-field label { display: block; margin-bottom: 8px; color: #314139; font-size: 13px; font-weight: 700; }
        .complaint-input { width: 100%; border: 1px solid #dce6de; border-radius: 12px; padding: 13px 14px; color: var(--dark); outline: none; transition: border-color .2s, box-shadow .2s; }
        .complaint-input:focus { border-color: var(--green); box-shadow: 0 0 0 4px rgba(8, 127, 79, .11); }
        .complaint-error { margin-top: 7px; color: #c53030; font-size: 12px; }
        .complaint-actions { display: flex; align-items: center; justify-content: center; gap: 12px; flex-wrap: wrap; margin-top: 28px; }
        .complaint-button, .complaint-link { display: inline-flex; justify-content: center; align-items: center; gap: 8px; min-height: 46px; padding: 0 19px; border: 0; border-radius: 12px; font-size: 13px; font-weight: 800; cursor: pointer; transition: .2s ease; }
        .complaint-button { background: var(--green); color: white; box-shadow: 0 9px 18px rgba(8, 127, 79, .2); }
        .complaint-button:hover { background: var(--green-dark); transform: translateY(-1px); }
        .complaint-link { color: var(--green-dark); background: var(--green-light); }
        .complaint-link:hover { background: #d8efe1; }
        .complaint-details { display: grid; gap: 0; margin: 23px 0; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
        .complaint-detail { padding: 15px 17px; border-bottom: 1px solid var(--border); }
        .complaint-detail:last-child { border: 0; }
        .complaint-detail small { display: block; margin-bottom: 3px; color: var(--muted); font-weight: 600; }
        .complaint-detail strong { color: var(--dark); font-size: 14px; }
        .complaint-response { margin-top: 21px; padding: 16px; border-radius: 14px; background: #f4faf5; color: #445148; font-size: 14px; line-height: 1.65; }
        .complaint-status { display: inline-flex; align-items: center; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 800; }
        .status-selesai { background: #dcfce7; color: #166534; }.status-diproses { background: #fef3c7; color: #92400e; }.status-ditolak { background: #fee2e2; color: #b91c1c; }.status-baru { background: #edf2f7; color: #4a5568; }
        .complaint-number { margin: 21px 0; padding: 16px; border: 2px dashed #a9cfb5; border-radius: 14px; color: var(--green-dark); background: #f7fcf8; font-size: clamp(1.1rem, 4vw, 1.45rem); font-weight: 800; letter-spacing: .04em; }
        .page-header { padding: 54px 20px 82px; background: linear-gradient(135deg, var(--green-dark), var(--green)); color: #fff; }
        .page-header .container, .section .container { width: min(100%, 1000px); margin: 0 auto; }
        .page-header-content { max-width: 640px; }
        .page-badge { display: inline-block; padding: 8px 13px; border: 1px solid rgba(255,255,255,.25); border-radius: 999px; background: rgba(255,255,255,.12); font-size: 12px; font-weight: 800; }
        .page-header h1 { margin: 14px 0 8px; font: 800 clamp(2rem, 5vw, 3rem)/1.15 'Playfair Display', serif; }.page-header p { color: rgba(255,255,255,.84); }
        .section { padding: 0 20px 84px; background: #f8faf9; }.section .form-card { margin-top: -36px; position: relative; }
        .form-card { padding: clamp(24px, 5vw, 44px); border: 1px solid var(--border); border-radius: 24px; background: #fff; box-shadow: 0 20px 50px rgba(7, 91, 56, .1); }
        .form-header { display: flex; gap: 16px; align-items: center; padding-bottom: 24px; margin-bottom: 24px; border-bottom: 1px solid var(--border); }.form-icon { width: 54px; height: 54px; display: grid; place-items: center; border-radius: 17px; background: var(--green-light); font-size: 22px; }.form-header h2 { color: var(--green-dark); font-size: 1.3rem; }.form-header p { color: var(--muted); font-size: 13px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }.form-grid-full { grid-column: 1 / -1; }.form-group { margin-bottom: 22px; }.form-label { display: block; margin-bottom: 8px; color: #314139; font-size: 13px; font-weight: 700; }.required { color: #d93636; }.form-control { width: 100%; border: 1px solid #dce6de; border-radius: 12px; padding: 12px 14px; background: #fff; color: var(--dark); font: inherit; outline: 0; transition: .2s ease; }.form-control:focus { border-color: var(--green); box-shadow: 0 0 0 4px rgba(8,127,79,.11); }.form-error { margin-top: 7px; color: #c53030; font-size: 12px; }.alert-danger { display: flex; gap: 12px; margin-bottom: 24px; padding: 14px 16px; border: 1px solid #fecaca; border-radius: 14px; background: #fff5f5; color: #991b1b; font-size: 13px; }.address-box { margin: 4px 0 24px; padding: 24px; border: 1px solid #dceee1; border-radius: 18px; background: #f8fcf9; }.address-title { margin-bottom: 20px; color: var(--green-dark); font-weight: 800; }.form-help { margin-top: 4px; color: var(--muted); font-size: 12px; line-height: 1.6; }.upload-box { padding: 25px; border: 2px dashed #b8d7c0; border-radius: 15px; background: #fafdfa; text-align: center; color: var(--muted); }.upload-box strong, .upload-box span { display: block; }.upload-icon { margin-bottom: 7px; font-size: 22px; }.upload-box input { display: block; max-width: 250px; margin: 15px auto 0; font: inherit; font-size: 12px; }.form-actions { display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid var(--border); }.btn { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 19px; border: 0; border-radius: 12px; cursor: pointer; font: 800 13px inherit; transition: .2s ease; }.btn-primary { color: #fff; background: var(--green); box-shadow: 0 9px 18px rgba(8,127,79,.2); }.btn-secondary { color: var(--green-dark); background: var(--green-light); }.btn:hover { transform: translateY(-1px); }.btn-primary:hover { background: var(--green-dark); }.btn-secondary:hover { background: #d8efe1; }
        @media (max-width: 560px) { .complaint-page { padding: 32px 14px 60px; }.complaint-card { border-radius: 20px; }.complaint-actions > *, .form-actions > * { width: 100%; }.form-grid { grid-template-columns: 1fr; }.form-header { align-items: flex-start; }.page-header { padding: 40px 20px 70px; }.section { padding: 0 14px 60px; }.address-box { padding: 18px; }.form-actions { flex-direction: column-reverse; } }
    </style>
@endpush
