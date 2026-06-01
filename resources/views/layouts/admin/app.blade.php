<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — BENTENG Admin</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    {{-- Icons --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    {{-- AdminLTE core (grid, utilities) --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    {{-- Custom admin styles --}}
    <style>
        :root {
            --btg-bg: #f7f4f0;
            --btg-sidebar: #1c1612;
            --btg-accent: #c0392b;
            --btg-accent-lt: #e74c3c;
            --btg-gold: #c8973a;
            --btg-text: #2d2420;
            --btg-muted: #9e8f87;
            --btg-border: #ede8e3;
            --btg-white: #ffffff;
            --btg-card: #ffffff;
            --radius: 14px;
            --sidebar-w: 260px;
            --nav-h: 64px;
            --shadow-sm: 0 1px 3px rgba(44, 28, 18, .06), 0 4px 12px rgba(44, 28, 18, .04);
            --shadow-md: 0 4px 20px rgba(44, 28, 18, .10);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--btg-bg);
            color: var(--btg-text);
            min-height: 100vh;
        }

        /* ── WRAPPER ─────────────────────── */
        .btg-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ─────────────────────── */
        .btg-sidebar {
            width: var(--sidebar-w);
            background: var(--btg-sidebar);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            transition: transform .3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .btg-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .btg-sidebar::-webkit-scrollbar-thumb {
            background: #3a2e28;
            border-radius: 4px;
        }

        /* Brand */
        .btg-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
            text-decoration: none;
        }

        .btg-brand-icon {
            width: 38px;
            height: 38px;
            background: var(--btg-accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #fff;
            flex-shrink: 0;
        }

        .btg-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            line-height: 1.2;
        }

        .btg-brand-sub {
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 400;
            color: var(--btg-muted);
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        /* User panel */
        a.btg-user {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            transition: background .18s ease, box-shadow .18s ease;
        }

        a.btg-user:hover {
            background: rgba(255, 255, 255, .08);
        }

        a.btg-user.is-active {
            background: rgba(192, 57, 43, .18);
            box-shadow: inset 0 0 0 1px rgba(192, 57, 43, .35);
        }

        .btg-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 20px;
            margin: 12px 12px 0;
            background: rgba(255, 255, 255, .04);
            border-radius: 10px;
        }

        .btg-user-chevron {
            font-size: 10px;
            color: rgba(255, 255, 255, .35);
            flex-shrink: 0;
            transition: color .18s ease, transform .18s ease;
        }

        a.btg-user:hover .btg-user-chevron,
        a.btg-user.is-active .btg-user-chevron {
            color: rgba(255, 255, 255, .7);
            transform: translateX(2px);
        }

        .btg-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--btg-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
        }

        .btg-user-name {
            font-size: 13px;
            font-weight: 500;
            color: rgba(255, 255, 255, .85);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btg-user-role {
            font-size: 10px;
            color: var(--btg-muted);
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        /* Nav section header */
        .btg-nav-header {
            padding: 20px 20px 6px;
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #5a4e48;
        }

        /* Nav item */
        .btg-nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 20px;
            margin: 2px 12px;
            border-radius: 9px;
            font-size: 13.5px;
            font-weight: 450;
            color: rgba(255, 255, 255, .55);
            text-decoration: none;
            transition: background .18s, color .18s;
            position: relative;
        }

        .btg-nav-link i {
            width: 18px;
            text-align: center;
            font-size: 13px;
            opacity: .7;
        }

        .btg-nav-link:hover {
            background: rgba(255, 255, 255, .06);
            color: rgba(255, 255, 255, .9);
        }

        .btg-nav-link:hover i {
            opacity: 1;
        }

        .btg-nav-link.active {
            background: var(--btg-accent);
            color: #fff;
        }

        .btg-nav-link.active i {
            opacity: 1;
        }

        .btg-nav-link.danger {
            color: #e07070;
        }

        .btg-nav-link.danger:hover {
            background: rgba(192, 57, 43, .18);
            color: #ff8080;
        }

        /* Divider */
        .btg-nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, .05);
            margin: 10px 20px;
        }

        /* Sidebar footer */
        .btg-sidebar-footer {
            margin-top: auto;
            padding: 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, .05);
        }

        .btg-sidebar-footer span {
            font-size: 10px;
            color: #3a3028;
        }

        /* ── MAIN AREA ───────────────────── */
        .btg-main {
            margin-left: var(--sidebar-w);
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 100vh;
        }

        /* ── TOPBAR ──────────────────────── */
        .btg-topbar {
            height: var(--nav-h);
            background: var(--btg-white);
            border-bottom: 1px solid var(--btg-border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .btg-topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--btg-text);
            flex: 1;
        }

        .btg-topbar-title span {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: var(--btg-muted);
            display: block;
            margin-top: -2px;
        }

        /* Topbar actions */
        .btg-topbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btg-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--btg-bg);
            border: 1px solid var(--btg-border);
            color: var(--btg-muted);
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: all .18s;
            position: relative;
        }

        .btg-icon-btn:hover {
            background: var(--btg-border);
            color: var(--btg-text);
        }

        .btg-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 7px;
            height: 7px;
            background: var(--btg-accent);
            border-radius: 50%;
            border: 1.5px solid #fff;
        }

        .btg-view-site {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 0 14px;
            height: 38px;
            border-radius: 10px;
            background: var(--btg-text);
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: background .18s;
        }

        .btg-view-site:hover {
            background: var(--btg-accent);
            color: #fff;
        }

        /* ── CONTENT ─────────────────────── */
        .btg-content {
            flex: 1;
            padding: 28px 28px 40px;
        }

        /* ── FOOTER ──────────────────────── */
        .btg-footer {
            padding: 14px 28px;
            border-top: 1px solid var(--btg-border);
            background: var(--btg-white);
            font-size: 11.5px;
            color: var(--btg-muted);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btg-footer a {
            color: var(--btg-accent);
            text-decoration: none;
        }

        /* ── HELPER CARDS (for child views) ─ */
        .btg-card {
            background: var(--btg-card);
            border: 1px solid var(--btg-border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .btg-card-header {
            padding: 18px 22px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btg-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--btg-text);
        }

        .btg-card-body {
            padding: 18px 22px 22px;
        }

        /* ── RESPONSIVE ──────────────────── */
        @media (max-width: 768px) {
            .btg-sidebar {
                transform: translateX(-100%);
            }

            .btg-sidebar.open {
                transform: translateX(0);
            }

            .btg-main {
                margin-left: 0;
            }

            .btg-topbar-title span {
                display: none;
            }
        }
    </style>

    <style>
        /* ── PAGE LAYOUT ──────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        /* ── ALERT ────────────────────────────── */
        .btg-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            animation: fadeSlideIn .3s ease;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btg-alert.success {
            background: #f0faf5;
            border-color: #a8e6c3;
            color: #1a6b3c;
        }

        .btg-alert.danger {
            background: #fdf2f2;
            border-color: #f5b7b7;
            color: #7b1f1f;
        }

        .btg-alert-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .btg-alert.success .btg-alert-icon {
            background: #d4f4e2;
            color: #27ae60;
        }

        .btg-alert.danger .btg-alert-icon {
            background: #fde8e8;
            color: #c0392b;
        }

        .btg-alert-close {
            margin-left: auto;
            background: none;
            border: none;
            font-size: 16px;
            color: inherit;
            opacity: .5;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
        }

        .btg-alert-close:hover {
            opacity: 1;
        }

        /* ── PANEL ────────────────────────────── */
        .panel {
            background: #fff;
            border: 1px solid var(--btg-border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 22px;
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-title i {
            color: var(--btg-accent);
            font-size: 13px;
        }

        /* ── ADD BUTTON ───────────────────────── */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            background: var(--btg-accent);
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background .18s, transform .15s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-add:hover {
            background: #a93226;
            color: #fff;
            transform: translateY(-1px);
        }

        /* ── TABLE ────────────────────────────── */
        .cat-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cat-table thead th {
            padding: 12px 20px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--btg-muted);
            border-bottom: 1px solid var(--btg-border);
            text-align: left;
            white-space: nowrap;
        }

        .cat-table tbody td {
            padding: 14px 20px;
            font-size: 13.5px;
            border-bottom: 1px solid #f5f0eb;
            vertical-align: middle;
            color: var(--btg-text);
        }

        .cat-table tbody tr:last-child td {
            border-bottom: none;
        }

        .cat-table tbody tr {
            transition: background .15s;
        }

        .cat-table tbody tr:hover td {
            background: #faf7f4;
        }

        /* Row number */
        .row-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            background: var(--btg-bg);
            border: 1px solid var(--btg-border);
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--btg-muted);
        }

        /* Category name with dot */
        .cat-name-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cat-color-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .cat-name-text {
            font-weight: 500;
            color: var(--btg-text);
        }

        /* Slug badge */
        .slug-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            background: #f5f0eb;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 500;
            color: var(--btg-muted);
            font-family: monospace;
            letter-spacing: .02em;
        }

        /* Product count */
        .prod-count {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12.5px;
            color: var(--btg-muted);
        }

        .prod-count strong {
            color: var(--btg-text);
        }

        /* Action buttons */
        .action-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .15s;
            background: none;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-action.edit {
            background: #f0f7ff;
            border-color: #bdd9f7;
            color: #2471a3;
        }

        .btn-action.edit:hover {
            background: #2471a3;
            color: #fff;
            border-color: #2471a3;
        }

        .btn-action.delete {
            background: #fdf0f0;
            border-color: #f5c6c6;
            color: var(--btg-accent);
        }

        .btn-action.delete:hover {
            background: var(--btg-accent);
            color: #fff;
            border-color: var(--btg-accent);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 52px 24px;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
            background: var(--btg-bg);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--btg-muted);
            margin: 0 auto 16px;
        }

        .empty-state p {
            font-size: 14px;
            color: var(--btg-muted);
            margin: 0 0 16px;
        }

        /* ── MODAL ────────────────────────────── */
        .btg-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(28, 22, 18, .45);
            z-index: 200;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
        }

        .btg-modal-overlay.open {
            display: flex;
            animation: overlayIn .2s ease;
        }

        @keyframes overlayIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .btg-modal {
            background: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .18);
            animation: modalIn .25s cubic-bezier(.34, 1.56, .64, 1);
            overflow: hidden;
            margin: 20px;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(.94) translateY(10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .btg-modal-head {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--btg-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btg-modal-head-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .btg-modal-head-icon.primary {
            background: #fde8e8;
            color: var(--btg-accent);
        }

        .btg-modal-head-icon.blue {
            background: #e8f4fd;
            color: #2471a3;
        }

        .btg-modal-head-icon.danger {
            background: #fde8e8;
            color: #c0392b;
        }

        .btg-modal-head-title {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--btg-text);
        }

        .btg-modal-close {
            margin-left: auto;
            background: none;
            border: none;
            font-size: 18px;
            color: var(--btg-muted);
            cursor: pointer;
            line-height: 1;
            padding: 4px;
            border-radius: 6px;
            transition: all .15s;
        }

        .btg-modal-close:hover {
            background: var(--btg-bg);
            color: var(--btg-text);
        }

        .btg-modal-body {
            padding: 20px 24px;
        }

        .btg-modal-footer {
            padding: 14px 24px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        /* Form elements */
        .btg-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .04em;
            color: var(--btg-text);
            margin-bottom: 6px;
        }

        .btg-label span {
            color: var(--btg-accent);
        }

        .btg-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--btg-border);
            border-radius: 9px;
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
            color: var(--btg-text);
            background: var(--btg-bg);
            transition: border-color .18s, box-shadow .18s;
            outline: none;
        }

        .btg-input:focus {
            border-color: var(--btg-accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, .1);
        }

        .btg-input::placeholder {
            color: #c0b4ae;
        }

        /* Buttons */
        .btn-cancel {
            padding: 9px 18px;
            background: var(--btg-bg);
            border: 1px solid var(--btg-border);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: var(--btg-muted);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all .15s;
        }

        .btn-cancel:hover {
            background: var(--btg-border);
            color: var(--btg-text);
        }

        .btn-primary {
            padding: 9px 18px;
            background: var(--btg-accent);
            border: 1px solid var(--btg-accent);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background .15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary:hover {
            background: #a93226;
        }

        .btn-blue {
            padding: 9px 18px;
            background: #2471a3;
            border: 1px solid #2471a3;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background .15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-blue:hover {
            background: #1a5276;
        }

        .btn-danger {
            padding: 9px 18px;
            background: #c0392b;
            border: 1px solid #c0392b;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background .15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-danger:hover {
            background: #a93226;
        }

        /* ===== DELETE MODAL ===== */
        .modal-delete {
            width: 440px;
            max-width: 95%;
            padding: 28px;
            text-align: center;
        }

        .delete-icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fdf2f2;
            border: 1px solid #f8d0d0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .delete-icon i {
            font-size: 30px;
            color: #c0392b;
        }

        .delete-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--btg-text);
            margin-bottom: 10px;
        }

        .delete-text {
            color: var(--btg-muted);
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .delete-text strong {
            color: var(--btg-text);
            font-weight: 700;
        }

        .delete-warning {
            background: #fdf2f2;
            border: 1px solid #f5b7b7;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 24px;

            display: flex;
            align-items: flex-start;
            gap: 10px;

            text-align: left;
            font-size: 13px;
            line-height: 1.5;
            color: #7b1f1f;
        }

        .delete-warning i {
            color: #c0392b;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .delete-actions {
            display: flex;
            gap: 12px;
        }

        .delete-actions button {
            flex: 1;
            height: 46px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-cancel {
            border: 1px solid #dbe2ea;
            background: #fff;
            color: #64748b;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-delete-confirm {
            border: none;
            color: #fff;
            background: linear-gradient(135deg,
                    #e74c3c,
                    #c0392b);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-delete-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(192, 57, 43, .25);
            color: #fff;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="btg-wrapper">

        {{-- ── SIDEBAR ── --}}
        @include('layouts.admin.sidebar')

        {{-- ── MAIN ── --}}
        <div class="btg-main">

            {{-- Topbar --}}
            @include('layouts.admin.navbar')

            {{-- Page content --}}
            <div class="btg-content">
                @yield('content')
            </div>

            {{-- Footer --}}
            <footer class="btg-footer">
                <span>&copy; {{ date('Y') }} <a href="{{ route('client.index') }}" target="_blank">BENTENG</a> —
                    Semua
                    hak dilindungi.</span>
                <span>v1.0.0</span>
            </footer>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
            document.querySelector('.btg-sidebar').classList.toggle('open');
        });
    </script>

    @stack('scripts')
</body>

</html>
