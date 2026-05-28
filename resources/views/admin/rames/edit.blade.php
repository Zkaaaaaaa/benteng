@extends('layouts.admin.app')

@section('title', 'Manage Rames')
@section('page_title', 'Manage Rames')
@section('page_subtitle', 'Atur section rames homepage')

@section('content')
    @if (session('success'))
        <div class="btg-alert success">
            <div class="btg-alert-icon"><i class="fas fa-check"></i></div>
            <div style="flex:1;">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="btg-alert danger">
            <div class="btg-alert-icon"><i class="fas fa-times"></i></div>
            <div style="flex:1;">
                <ul style="margin:0; padding-left:16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.rames.update') }}">
        @csrf
        @method('PUT')

        <div class="panel mb-4">
            <div class="panel-head">
                <div class="panel-title"><i class="fas fa-heading"></i> Header Settings</div>
            </div>
            <div style="padding:22px;">
                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; margin-bottom:14px;">
                    <div><label class="btg-label">Title NL</label><input class="btg-input" name="title_nl" value="{{ old('title_nl', $setting->title_nl) }}"></div>
                    <div><label class="btg-label">Subtitle NL</label><input class="btg-input" name="subtitle_nl" value="{{ old('subtitle_nl', $setting->subtitle_nl) }}"></div>
                    <div><label class="btg-label">Title EN</label><input class="btg-input" name="title_en" value="{{ old('title_en', $setting->title_en) }}"></div>
                    <div><label class="btg-label">Subtitle EN</label><input class="btg-input" name="subtitle_en" value="{{ old('subtitle_en', $setting->subtitle_en) }}"></div>
                </div>

                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px;">
                    <div><label class="btg-label">Klein Title NL</label><input class="btg-input" name="small_title_nl" value="{{ old('small_title_nl', $setting->small_title_nl) }}"></div>
                    <div><label class="btg-label">Klein Title EN</label><input class="btg-input" name="small_title_en" value="{{ old('small_title_en', $setting->small_title_en) }}"></div>
                    <div><label class="btg-label">Klein Price</label><input type="number" step="0.01" class="btg-input" name="small_price" value="{{ old('small_price', $setting->small_price) }}"></div>
                    <div><label class="btg-label">Klein Description</label><input class="btg-input" name="small_desc" value="{{ old('small_desc', $setting->small_desc) }}"></div>

                    <div><label class="btg-label">Groot Title NL</label><input class="btg-input" name="large_title_nl" value="{{ old('large_title_nl', $setting->large_title_nl) }}"></div>
                    <div><label class="btg-label">Groot Title EN</label><input class="btg-input" name="large_title_en" value="{{ old('large_title_en', $setting->large_title_en) }}"></div>
                    <div><label class="btg-label">Groot Price (+)</label><input type="number" step="0.01" class="btg-input" name="large_surcharge" value="{{ old('large_surcharge', $setting->large_surcharge) }}"></div>
                    <div><label class="btg-label">Groot Description</label><input class="btg-input" name="large_desc" value="{{ old('large_desc', $setting->large_desc) }}"></div>
                </div>

                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; margin-top:14px;">
                    <div><label class="btg-label">Top Center Description NL</label><input class="btg-input" name="instruction_nl" value="{{ old('instruction_nl', $setting->instruction_nl) }}"></div>
                    <div><label class="btg-label">Top Center Description EN</label><input class="btg-input" name="instruction_en" value="{{ old('instruction_en', $setting->instruction_en) }}"></div>
                    <div><label class="btg-label">Bottom Title NL (optional)</label><input class="btg-input" name="bottom_title_nl" value="{{ old('bottom_title_nl', $setting->bottom_title_nl) }}"></div>
                    <div><label class="btg-label">Bottom Title EN (optional)</label><input class="btg-input" name="bottom_title_en" value="{{ old('bottom_title_en', $setting->bottom_title_en) }}"></div>
                    <div><label class="btg-label">Bottom Text NL (optional)</label><input class="btg-input" name="bottom_text_nl" value="{{ old('bottom_text_nl', $setting->bottom_text_nl) }}"></div>
                    <div><label class="btg-label">Bottom Text EN (optional)</label><input class="btg-input" name="bottom_text_en" value="{{ old('bottom_text_en', $setting->bottom_text_en) }}"></div>
                    <div><label class="btg-label">Button Label NL</label><input class="btg-input" name="button_label_nl" value="{{ old('button_label_nl', $setting->button_label_nl) }}"></div>
                    <div><label class="btg-label">Button Label EN</label><input class="btg-input" name="button_label_en" value="{{ old('button_label_en', $setting->button_label_en) }}"></div>
                </div>
            </div>
        </div>

        @php
            $sectionConfig = [
                'basis' => ['label' => 'DE BASIS', 'input' => 'rames_basis_ids'],
                'kip' => ['label' => 'KIP', 'input' => 'rames_kip_ids'],
                'vlees' => ['label' => 'VLEES', 'input' => 'rames_vlees_ids'],
                'vis' => ['label' => 'VIS', 'input' => 'rames_vis_ids'],
                'groenten' => ['label' => 'DE GROENTEN', 'input' => 'rames_groenten_ids'],
            ];
        @endphp

        @foreach ($sectionConfig as $key => $conf)
            <div class="panel mb-4">
                <div class="panel-head">
                    <div class="panel-title"><i class="fas fa-check-square"></i> {{ $conf['label'] }}</div>
                </div>
                <div style="padding:18px 22px;">
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:10px 14px;">
                        @forelse(($groupedOptions[$key] ?? collect()) as $product)
                            <label style="display:flex; gap:10px; align-items:flex-start; border:1px solid var(--btg-border); border-radius:10px; padding:10px; cursor:pointer;">
                                <input type="checkbox" name="{{ $conf['input'] }}[]" value="{{ $product->id }}"
                                    @checked(in_array($product->id, old($conf['input'], $selectedByGroup[$key] ?? []), true))>
                                <span>
                                    <strong style="display:block;">{{ $product->name }}</strong>
                                    @php($desc = $product->description_nl ?: ($product->description_en ?: $product->description))
                                    @if($desc)<small style="color:var(--btg-muted);">{{ $desc }}</small>@endif
                                </span>
                            </label>
                        @empty
                            <p style="color:var(--btg-muted); font-size:13px;">Belum ada item untuk section ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @endforeach

        <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Simpan Rames</button>
    </form>
@endsection
