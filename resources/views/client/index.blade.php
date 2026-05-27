@extends('layouts.client.app')

@section('content')

    {{-- ===== FIXED MOBILE ORDER BUTTON ===== --}}
    @include('client.partials.mobile-order-button')

    {{-- ===== SIDE MENU OVERLAY ===== --}}
    @include('client.partials.side-menu')

    {{-- ===== PAGE LOADER ===== --}}
    @include('client.partials.loader')

    {{-- ===== MODAL: OPENINGSTIJDEN ===== --}}
    @include('client.partials.modal-openingstijden')

    {{-- ===== HERO SECTION ===== --}}
    @include('client.sections.hero')

    {{-- ===== ABOUT / VERHAAL SECTION ===== --}}
    @include('client.sections.about')

    {{-- ===== RAMES MENU SECTION ===== --}}
    @include('client.sections.rames-menu')

    {{-- ===== RIJSTTAFEL SECTION ===== --}}
    @include('client.sections.rijsttafel')

    {{-- ===== DISCOVER MORE SECTION ===== --}}
    @include('client.sections.more', ['categories' => $categories ?? collect()])

@endsection