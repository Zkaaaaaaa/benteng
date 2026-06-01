<div class="panel">
    <div class="panel-head">
        <div class="panel-title"><i class="fas fa-user"></i> Informasi Profil</div>
    </div>
    <div style="padding:22px;">
        <p style="color:var(--btg-muted); font-size:13px; margin:0 0 20px;">
            Perbarui nama dan alamat email akun admin Anda.
        </p>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div style="margin-bottom:16px;">
                <label class="btg-label" for="name">Nama</label>
                <input class="btg-input @error('name') is-invalid @enderror" id="name" name="name" type="text"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label class="btg-label" for="email">Email</label>
                <input class="btg-input @error('email') is-invalid @enderror" id="email" name="email" type="email"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div
                        style="margin-top:12px; padding:12px 14px; background:#fff8e6; border:1px solid #f0d78c; border-radius:9px; font-size:12.5px;">
                        <p style="margin:0 0 8px; color:var(--btg-text);">Email belum diverifikasi.</p>
                        <button type="submit" form="send-verification" class="btn-cancel" style="font-size:12px;">
                            Kirim ulang email verifikasi
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <p style="margin:8px 0 0; color:#1a6b3c; font-weight:500;">
                                Link verifikasi baru telah dikirim.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Profil
            </button>
        </form>
    </div>
</div>
