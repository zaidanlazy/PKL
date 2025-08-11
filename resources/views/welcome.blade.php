<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Badak LNG</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Modern Color System */
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --primary-light: #f0f4ff;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;

            /* Neutral Palette */
            --white: #ffffff;
            --gray-25: #fcfcfd;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;

            /* Semantic Colors */
            --surface: var(--white);
            --surface-hover: var(--gray-25);
            --border: var(--gray-200);
            --border-light: var(--gray-100);
            --text-primary: var(--gray-900);
            --text-secondary: var(--gray-600);
            --text-tertiary: var(--gray-500);

            /* Shadows */
            --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);

            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-12: 3rem;
            --space-16: 4rem;

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 50rem;

            /* Typography */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;

            /* Transitions */
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-colors: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, system-ui, sans-serif;
            background-color: var(--gray-50);
            color: var(--text-primary);
            line-height: 1.5;
            font-size: var(--text-base);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Header */
        .app-header {
            background-color: var(--surface);
            border-bottom: 1px solid var(--border-light);
            backdrop-filter: blur(8px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            height: 4rem;
            display: flex;
            align-items: center;
        }

        .branding {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            text-decoration: none;
            transition: var(--transition-colors);
        }

        .branding:hover {
            opacity: 0.8;
        }

        .logo-wrapper {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        .logo-wrapper img {
            width: 70%;
            height: auto;
            object-fit: contain;
        }

        .app-name {
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: -0.025em;
        }

        .app-name span {
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--space-8) var(--space-6) var(--space-16);
        }

        .content-header {
            margin-bottom: var(--space-8);
        }

        .page-title {
            font-size: var(--text-2xl);
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: -0.025em;
        }

        /* Alert */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
            padding: var(--space-4);
            margin-bottom: var(--space-6);
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: var(--radius-lg);
            font-size: var(--text-sm);
            color: #065f46;
        }

        .alert svg {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            color: var(--success);
        }

        /* File Container */
        .file-container {
            background-color: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-xs);
        }

        .file-table {
            width: 100%;
            border-collapse: collapse;
        }

        .file-table thead {
            background-color: var(--gray-25);
        }

        .file-table th {
            padding: var(--space-4) var(--space-6);
            text-align: left;
            font-size: var(--text-xs);
            font-weight: 500;
            color: var(--text-tertiary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-light);
        }

        .file-table td {
            padding: var(--space-5) var(--space-6);
            border-bottom: 1px solid var(--border-light);
            font-size: var(--text-sm);
        }

        .file-table tr:hover {
            background-color: var(--surface-hover);
        }

        .file-table tr:last-child td {
            border-bottom: none;
        }

        /* File Name */
        .file-name {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .file-icon-container {
            width: 2.5rem;
            height: 2.5rem;
            background-color: var(--primary-light);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .file-icon {
            width: 1.25rem;
            height: 1.25rem;
            color: var(--primary);
        }

        .file-info {
            min-width: 0;
        }

        .file-title {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 1px;
        }

        .file-path {
            font-size: var(--text-xs);
            color: var(--text-tertiary);
        }

        /* File Details */
        .file-modified,
        .file-size {
            color: var(--text-secondary);
            font-variant-numeric: tabular-nums;
        }

        /* File Actions */
        .file-actions {
            display: flex;
            gap: var(--space-2);
        }

        .file-action {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-3);
            color: var(--primary);
            text-decoration: none;
            font-size: var(--text-sm);
            font-weight: 500;
            border-radius: var(--radius-md);
            transition: var(--transition-colors);
        }

        .file-action:hover {
            background-color: var(--primary-light);
        }

        .file-action-icon {
            width: 1rem;
            height: 1rem;
        }

        /* Empty State */
        .empty-state {
            padding: var(--space-16) var(--space-8);
            text-align: center;
        }

        .empty-state-icon {
            width: 4rem;
            height: 4rem;
            color: var(--gray-300);
            margin: 0 auto var(--space-6);
        }

        .empty-state-title {
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--space-2);
        }

        .empty-state-description {
            color: var(--text-secondary);
            max-width: 28rem;
            margin: 0 auto var(--space-6);
        }

        /* Floating Action Button */
        .fab-container {
            position: fixed;
            bottom: var(--space-8);
            right: var(--space-8);
            z-index: 40;
        }

        .fab {
            width: 3.5rem;
            height: 3.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .fab:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 20px 25px rgba(59, 130, 246, 0.25), 0 10px 10px rgba(59, 130, 246, 0.1);
        }

        .fab-icon {
            font-size: 1.5rem;
            color: var(--white);
            font-weight: 300;
            transition: var(--transition);
            line-height: 1;
        }

        .fab.active .fab-icon {
            transform: rotate(45deg);
        }

        .fab-options {
            position: absolute;
            bottom: 4.5rem;
            right: 0;
            width: 12rem;
            background-color: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(0.5rem) scale(0.95);
            transition: var(--transition);
        }

        .fab.active .fab-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .fab-option {
            padding: var(--space-4);
            display: flex;
            align-items: center;
            gap: var(--space-3);
            cursor: pointer;
            transition: var(--transition-colors);
            border-bottom: 1px solid var(--border-light);
        }

        .fab-option:last-child {
            border-bottom: none;
        }

        .fab-option:hover {
            background-color: var(--surface-hover);
        }

        .fab-option-icon {
            width: 1.25rem;
            height: 1.25rem;
            color: var(--text-secondary);
        }

        .fab-option-text {
            font-size: var(--text-sm);
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container,
            .main-content {
                padding-left: var(--space-4);
                padding-right: var(--space-4);
            }

            .file-table th,
            .file-table td {
                padding: var(--space-3) var(--space-4);
            }

            .file-modified {
                display: none;
            }

            .fab-container {
                bottom: var(--space-6);
                right: var(--space-6);
            }

            .fab-options {
                right: -2rem;
            }
        }

        @media (max-width: 640px) {
            .file-size {
                font-size: var(--text-xs);
            }

            .file-actions {
                justify-content: flex-end;
            }

            .empty-state {
                padding: var(--space-12) var(--space-4);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <div class="header-container">
            <a href="/" class="branding">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG">
                </div>
                <h1 class="app-name">Badak<span>LNG</span></h1>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="page-title">My Files</h2>
        </div>

        @if(session('success'))
            <div class="alert">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="file-container">
            <table class="file-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Modified</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $file)
                        <tr>
                            <td>
                                <div class="file-name">
                                    <div class="file-icon-container">
                                        <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                    <div class="file-info">
                                        <div class="file-title">{{ $file->filename ?? 'Unnamed File' }}</div>
                                        <div class="file-path">My Files</div>
                                    </div>
                                </div>
                            </td>
                            <td class="file-modified">{{ \Carbon\Carbon::parse($file->created_at)->format('M d, Y') }}</td>
                            <td class="file-size">
                                @if($file->path && \Storage::disk('public')->exists($file->path))
                                    {{ number_format(Storage::disk('public')->size($file->path) / 1024, 1) }} KB
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                </svg>
                                <h3 class="empty-state-title">No files yet</h3>
                                <p class="empty-state-description">Upload your first file to get started with file management</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Floating Action Button -->
    <div class="fab-container">
        <div class="fab" id="fab">
            <span class="fab-icon">+</span>
            <div class="fab-options">
                <div class="fab-option" onclick="uploadFile()">
                    <svg class="fab-option-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <span class="fab-option-text">Share File</span>
                </div>
                <div class="fab-option" onclick="saveFile()">
                    <svg class="fab-option-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <span class="fab-option-text">Save File</span>
                </div>
                <div class="fab-option" onclick="openTrash()">
                    <svg class="fab-option-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span class="fab-option-text">Trash</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // FAB functionality
        const fab = document.getElementById('fab');

        fab.addEventListener('click', (e) => {
            e.stopPropagation();
            fab.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            fab.classList.remove('active');
        });

        // Navigation functions
        function uploadFile() {
            window.location.href = '{{ route("upload") }}';
        }

        function saveFile() {
            window.location.href = '{{ route("save-file") }}';
        }

        function openTrash() {
            window.location.href = '{{ route("trash") }}';
        }
    </script>
</body>
</html>
