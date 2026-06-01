@extends('layouts.admin.app')

@section('title', 'Edit Profil')
@section('page_title', 'Edit Profil')
@section('page_subtitle', 'Kelola informasi akun dan keamanan')

@section('content')
    @if (session('status') === 'profile-updated')
        <div class="btg-alert success mb-4">
            <div class="btg-alert-icon"><i class="fas fa-check"></i></div>
            <div style="flex:1;">Profil berhasil diperbarui.</div>
            <button type="button" class="btg-alert-close" onclick="this.closest('.btg-alert').remove()">×</button>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="btg-alert success mb-4">
            <div class="btg-alert-icon"><i class="fas fa-check"></i></div>
            <div style="flex:1;">Kata sandi berhasil diperbarui.</div>
            <button type="button" class="btg-alert-close" onclick="this.closest('.btg-alert').remove()">×</button>
        </div>
    @endif

    @if ($errors->any() && !$errors->updatePassword->any() && !$errors->userDeletion->any())
        <div class="btg-alert danger mb-4">
            <div class="btg-alert-icon"><i class="fas fa-times"></i></div>
            <div style="flex:1;">
                <div style="font-weight:600; margin-bottom:4px;">Terjadi kesalahan</div>
                <ul style="margin:0; padding-left:16px; font-size:12.5px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btg-alert-close" onclick="this.closest('.btg-alert').remove()">×</button>
        </div>
    @endif

    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <div style="font-size:12px; color:var(--btg-muted);">
                <a href="{{ route('admin.dashboard') }}" style="color:var(--btg-muted); text-decoration:none;">Dashboard</a>
                <span style="margin:0 6px;">›</span>
                <span>Profil</span>
            </div>
        </div>
    </div>

    <div style="display:grid; gap:20px; max-width:720px;">
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        {{-- @include('profile.partials.delete-user-form') --}}
    </div>
@endsection

@push('scripts')
    <script>
        function openModal(id) {
            document.getElementById(id)?.classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id)?.classList.remove('open');
        }

        document.querySelectorAll('.btg-modal-overlay').forEach(function(overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.btg-modal-overlay.open').forEach(function(m) {
                    m.classList.remove('open');
                });
            }
        });

        @if ($errors->userDeletion->isNotEmpty())
            openModal('modal-delete-account');
        @endif

        setTimeout(function() {
            document.querySelectorAll('.btg-alert').forEach(function(el) {
                el.style.transition = 'opacity .4s, transform .4s';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(function() {
                    el.remove();
                }, 400);
            });
        }, 4500);
    </script>
@endpush
