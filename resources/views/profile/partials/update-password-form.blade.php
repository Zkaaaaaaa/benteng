<div class="panel">
    <div class="panel-head">
        <div class="panel-title"><i class="fas fa-lock"></i> Ubah Kata Sandi</div>
    </div>
    <div style="padding:22px;">
        <p style="color:var(--btg-muted); font-size:13px; margin:0 0 20px;">
            Gunakan kata sandi yang kuat dan unik untuk menjaga keamanan akun.
        </p>

        @if ($errors->updatePassword->any())
            <div class="btg-alert danger" style="margin-bottom:16px;">
                <div class="btg-alert-icon"><i class="fas fa-times"></i></div>
                <div style="flex:1;">
                    <ul style="margin:0; padding-left:16px; font-size:12.5px;">
                        @foreach ($errors->updatePassword->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div style="margin-bottom:16px;">
                <label class="btg-label" for="update_password_current_password">Kata Sandi Saat Ini</label>
                <input class="btg-input @error('current_password', 'updatePassword') is-invalid @enderror"
                    id="update_password_current_password" name="current_password" type="password"
                    autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label class="btg-label" for="update_password_password">Kata Sandi Baru</label>
                <input class="btg-input @error('password', 'updatePassword') is-invalid @enderror"
                    id="update_password_password" name="password" type="password" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label class="btg-label" for="update_password_password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <input class="btg-input @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                    id="update_password_password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                <i class="fas fa-key"></i> Simpan Kata Sandi
            </button>
        </form>
    </div>
</div>
