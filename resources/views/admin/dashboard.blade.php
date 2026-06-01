@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan aktivitas hari ini')

@push('styles')
    <style>
        /* ── STAT CARDS ─────────────────────── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--btg-border);
            border-radius: var(--radius);
            padding: 22px 22px 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--card-accent, var(--btg-accent));
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--btg-muted);
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: #fff;
            background: var(--card-accent, var(--btg-accent));
            flex-shrink: 0;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--btg-text);
            line-height: 1;
        }

        .stat-sub {
            font-size: 12px;
            color: var(--btg-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-sub .up {
            color: #27ae60;
        }

        .stat-sub .down {
            color: var(--btg-accent);
        }

        /* ── MAIN GRID ───────────────────────── */
        .dash-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            margin-bottom: 24px;
        }

        /* ── PANEL BASE ──────────────────────── */
        .panel {
            background: #fff;
            border: 1px solid var(--btg-border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 22px 14px;
            border-bottom: 1px solid var(--btg-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--btg-text);
        }

        .panel-action {
            font-size: 11.5px;
            font-weight: 500;
            color: var(--btg-accent);
            text-decoration: none;
        }

        .panel-action:hover {
            text-decoration: underline;
        }

        .panel-body {
            padding: 18px 22px;
        }

        /* ── CHART WRAPPER ───────────────────── */
        .chart-wrap {
            position: relative;
            height: 220px;
        }

        /* ── PRODUCT TABLE ───────────────────── */
        .prod-table {
            width: 100%;
            border-collapse: collapse;
        }

        .prod-table th {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--btg-muted);
            padding: 0 10px 10px;
            text-align: left;
            border-bottom: 1px solid var(--btg-border);
        }

        .prod-table td {
            padding: 12px 10px;
            font-size: 13px;
            border-bottom: 1px solid #f5f0eb;
            vertical-align: middle;
        }

        .prod-table tr:last-child td {
            border-bottom: none;
        }

        .prod-table tr:hover td {
            background: #faf7f4;
        }

        .prod-thumb {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--btg-bg);
            border: 1px solid var(--btg-border);
        }

        .prod-thumb-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #f0ebe5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--btg-muted);
            font-size: 13px;
            border: 1px solid var(--btg-border);
        }

        .prod-name {
            font-weight: 500;
            color: var(--btg-text);
        }

        .prod-cat {
            font-size: 11px;
            color: var(--btg-muted);
        }

        .badge-stock {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-stock.ok {
            background: #eafaf1;
            color: #27ae60;
        }

        .badge-stock.low {
            background: #fef9ec;
            color: #d4a017;
        }

        .badge-stock.empty {
            background: #fdf0f0;
            color: var(--btg-accent);
        }

        /* ── QUICK ACTIONS ───────────────────── */
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 16px 22px 22px;
        }

        .qa-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 16px;
            border-radius: 10px;
            background: var(--btg-bg);
            border: 1px solid var(--btg-border);
            text-decoration: none;
            color: var(--btg-text);
            font-size: 13px;
            font-weight: 500;
            transition: all .18s;
        }

        .qa-btn:hover {
            background: var(--btg-accent);
            color: #fff;
            border-color: var(--btg-accent);
        }

        .qa-btn:hover .qa-icon {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .qa-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: var(--btg-accent);
            border: 1px solid var(--btg-border);
            flex-shrink: 0;
            transition: all .18s;
        }

        /* ── CATEGORY LIST ───────────────────── */
        .cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid #f5f0eb;
            font-size: 13px;
        }

        .cat-item:last-child {
            border-bottom: none;
        }

        .cat-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
            display: inline-block;
        }

        .cat-name {
            display: flex;
            align-items: center;
            color: var(--btg-text);
            font-weight: 450;
        }

        .cat-count {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--btg-muted);
            background: var(--btg-bg);
            padding: 2px 9px;
            border-radius: 20px;
        }

        /* ── BOTTOM ROW ──────────────────────── */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        /* ── ACTIVITY FEED ───────────────────── */
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f5f0eb;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--btg-accent);
            margin-top: 5px;
            flex-shrink: 0;
        }

        .activity-dot.gold {
            background: var(--btg-gold);
        }

        .activity-dot.green {
            background: #27ae60;
        }

        .activity-text {
            font-size: 12.5px;
            color: var(--btg-text);
            line-height: 1.45;
        }

        .activity-time {
            font-size: 11px;
            color: var(--btg-muted);
            margin-top: 2px;
        }

        /* ── RESPONSIVE ──────────────────────── */
        @media (max-width: 1100px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .dash-grid {
                grid-template-columns: 1fr;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ── STAT CARDS ── --}}
    <div class="stat-grid">

        <div class="stat-card" style="--card-accent: #c0392b;">
            <div class="stat-top">
                <div class="stat-label">Total Produk</div>
                <div class="stat-icon"><i class="fas fa-utensils"></i></div>
            </div>
            <div class="stat-value">{{ $totalProducts ?? 0 }}</div>
            <div class="stat-sub">
                <span class="up"><i class="fas fa-arrow-up"></i> {{ $newProductsThisMonth ?? 0 }}</span>
                produk baru bulan ini
            </div>
        </div>

        <div class="stat-card" style="--card-accent: #c8973a;">
            <div class="stat-top">
                <div class="stat-label">Kategori</div>
                <div class="stat-icon" style="background:#c8973a;"><i class="fas fa-tags"></i></div>
            </div>
            <div class="stat-value">{{ $totalCategories ?? 0 }}</div>
            <div class="stat-sub">
                <i class="fas fa-layer-group"></i>
                kelompok menu aktif
            </div>
        </div>

    </div>

    {{-- ── MAIN GRID: Chart + Sidebar ── --}}
    <div class="dash-grid">

        {{-- Chart panel --}}
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">Distribusi Produk per Kategori</div>
                <a href="{{ route('admin.categories.index') }}" class="panel-action">Kelola →</a>
            </div>
            <div class="panel-body">
                <div class="chart-wrap">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            {{-- Recent products table --}}
            <div style="padding: 0 22px 22px;">
                <div
                    style="font-size:11px; font-weight:600; letter-spacing:.08em; text-transform:uppercase; color:var(--btg-muted); margin-bottom:10px;">
                    Produk Terbaru
                </div>
                <table class="prod-table">
                    <thead>
                        <tr>
                            <th style="width:40px;"></th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProducts ?? [] as $product)
                            <tr>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                            class="prod-thumb">
                                    @else
                                        <div class="prod-thumb-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="prod-name">{{ $product->name }}</div>
                                    <div class="prod-cat">{{ Str::limit($product->description, 40) }}</div>
                                </td>
                                <td style="color:var(--btg-muted); font-size:12px;">
                                    {{ $product->category->name ?? '—' }}
                                </td>
                                <td style="font-weight:600; font-size:13px;">
                                    € {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        style="font-size:12px; color:var(--btg-accent); text-decoration:none;">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    style="text-align:center; color:var(--btg-muted); font-size:13px; padding:24px 0;">
                                    Belum ada produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if (($recentProducts ?? collect())->count() > 0)
                    <div style="margin-top:14px; text-align:right;">
                        <a href="{{ route('admin.products.index') }}" class="panel-action">Lihat semua produk →</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right sidebar --}}
        <div style="display:flex; flex-direction:column; gap:20px;">

            {{-- Quick actions --}}
            <div class="panel">
                <div class="panel-head">
                    <div class="panel-title">Aksi Cepat</div>
                </div>
                <div class="quick-actions">
                    <a href="{{ route('admin.products.index') }}" class="qa-btn">
                        <div class="qa-icon"><i class="fas fa-plus"></i></div>
                        Tambah Produk Baru
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="qa-btn">
                        <div class="qa-icon"><i class="fas fa-folder-plus"></i></div>
                        Tambah Kategori
                    </a>
                    <a href="{{ route('client.index') }}" target="_blank" class="qa-btn">
                        <div class="qa-icon"><i class="fas fa-eye"></i></div>
                        Lihat Halaman Website
                    </a>
                </div>
            </div>

            {{-- Category breakdown --}}
            <div class="panel">
                <div class="panel-head">
                    <div class="panel-title">Kategori Menu</div>
                    <a href="{{ route('admin.categories.index') }}" class="panel-action">Kelola →</a>
                </div>
                <div class="panel-body" style="padding-top:6px;">
                    @php
                        $dotColors = ['#c0392b', '#c8973a', '#27ae60', '#2980b9', '#8e44ad', '#16a085'];
                    @endphp
                    <ul class="cat-list">
                        @forelse($categories ?? [] as $i => $category)
                            <li class="cat-item">
                                <span class="cat-name">
                                    <span class="cat-dot"
                                        style="background: {{ $dotColors[$i % count($dotColors)] }};"></span>
                                    {{ $category->name }}
                                </span>
                                <span class="cat-count">{{ $category->products_count ?? $category->products->count() }}
                                    produk</span>
                            </li>
                        @empty
                            <li style="text-align:center; color:var(--btg-muted); font-size:13px; padding:16px 0;">
                                Belum ada kategori.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{-- ── BOTTOM ROW ── --}}
    <div class="bottom-grid">

        {{-- Aktivitas terbaru --}}
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">Aktivitas Terbaru</div>
            </div>
            <div class="panel-body" style="padding-top:6px;">
                <ul class="activity-list">
                    @forelse($recentActivities ?? [] as $activity)
                        <li class="activity-item">
                            <div class="activity-dot {{ $activity['type'] ?? '' }}"></div>
                            <div>
                                <div class="activity-text">{{ $activity['message'] }}</div>
                                <div class="activity-time">{{ $activity['time'] }}</div>
                            </div>
                        </li>
                    @empty
                        {{-- Fallback placeholder activities --}}
                        <li class="activity-item">
                            <div class="activity-dot green"></div>
                            <div>
                                <div class="activity-text">Dashboard berhasil dimuat</div>
                                <div class="activity-time">Baru saja</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot gold"></div>
                            <div>
                                <div class="activity-text">Sistem siap digunakan</div>
                                <div class="activity-time">{{ now()->format('d M Y, H:i') }}</div>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const categoryData = @json(
                $categoryChartData ?? [
                    'labels' => ['Belum ada data'],
                    'values' => [1],
                ]
            );

            const colors = [
                '#c0392b', '#c8973a', '#27ae60',
                '#2980b9', '#8e44ad', '#16a085',
                '#d35400', '#7f8c8d'
            ];

            const ctx = document.getElementById('categoryChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categoryData.labels,
                    datasets: [{
                        label: 'Jumlah Produk',
                        data: categoryData.values,
                        backgroundColor: colors.slice(0, categoryData.labels.length).map(c => c +
                            'cc'),
                        borderColor: colors.slice(0, categoryData.labels.length),
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1c1612',
                            titleFont: {
                                family: 'DM Sans',
                                size: 12
                            },
                            bodyFont: {
                                family: 'DM Sans',
                                size: 12
                            },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: ctx => ` ${ctx.parsed.y} produk`
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'DM Sans',
                                    size: 11
                                },
                                color: '#9e8f87'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f5f0eb'
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    family: 'DM Sans',
                                    size: 11
                                },
                                color: '#9e8f87'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
