<div class="panel" style="border-color:#f5c6c6;">
    <div class="panel-head" style="background:#fff5f5;">
        <div class="panel-title" style="color:#a93226;">
            <i class="fas fa-exclamation-triangle"></i> Hapus Akun
        </div>
    </div>
    <div style="padding:22px;">
        <p style="color:var(--btg-muted); font-size:13px; margin:0 0 16px; line-height:1.55;">
            Setelah akun dihapus, semua data akan dihapus secara permanen. Pastikan Anda telah menyimpan informasi
            penting sebelum melanjutkan.
        </p>

        <button type="button" class="btn-danger" onclick="openModal('modal-delete-account')">
            <i class="fas fa-trash-alt"></i> Hapus Akun Saya
        </button>
    </div>
</div>

<div class="btg-modal-overlay" id="modal-delete-account">
    <div class="btg-modal modal-delete">
        <div class="delete-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>

        <h3 class="delete-title">Hapus Akun</h3>

        <div class="btg-modal-body" style="padding:0 24px;">
            <p class="delete-text" style="margin-bottom:16px;">
                Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi untuk mengonfirmasi penghapusan akun.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" id="form-delete-account">
                @csrf
                @method('delete')

                <label class="btg-label" for="delete-account-password">Kata Sandi</label>
                <input class="btg-input @error('password', 'userDeletion') is-invalid @enderror"
                    id="delete-account-password" name="password" type="password" placeholder="Kata sandi Anda"
                    autocomplete="current-password" required>
                @error('password', 'userDeletion')
                    <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                @enderror
            </form>
        </div>

        <div class="delete-actions" style="margin-top:20px; padding:0 24px 24px;">
            <button type="button" class="btn-cancel" onclick="closeModal('modal-delete-account')">
                Batal
            </button>
            <button type="submit" form="form-delete-account" class="btn-delete-confirm" style="flex:1;">
                <i class="fas fa-trash-alt"></i> Ya, Hapus Akun
            </button>
        </div>
    </div>
</div>
