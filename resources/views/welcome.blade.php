<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Badak LNG</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=poppins:500,600,700&display=swap" rel="stylesheet">

    <style>
        /* ===== Base Styles ===== */
        :root {
            --primary: #0066CC;
            --primary-light: #E6F2FF;
            --primary-dark: #0052A3;
            --secondary: #00A859;
            --accent: #FFC107;
            --danger: #E53935;
            --warning: #F39C12;
            --info: #17A2B8;
            --text-primary: #2D3748;
            --text-secondary: #718096;
            --text-tertiary: #A0AEC0;
            --bg-primary: #FFFFFF;
            --bg-secondary: #F8FAFC;
            --bg-tertiary: #EDF2F7;
            --border: #E2E8F0;
            --border-dark: #CBD5E0;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --radius-full: 9999px;
            --transition: all 0.2s ease-in-out;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        
        .logo-animation {
            width: 120px;
            height: 120px;
            position: relative;
            margin-bottom: 24px;
        }

        .logo-circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.2);
            animation: pulse 2s ease-in-out infinite;
        }

        .logo-inner {
            position: absolute;
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border-radius: var(--radius-full);
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .logo-inner img {
            width: 60%;
            height: auto;
            transition: var(--transition);
        }

        .loading-container {
            width: 160px;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-full);
            overflow: hidden;
            margin-top: 24px;
        }

        .loading-bar {
            height: 100%;
            width: 0;
            background-color: white;
            animation: loading 2s ease-in-out forwards;
        }

        .loading-text {
            color: white;
            font-size: 18px;
            font-weight: 500;
            margin-top: 16px;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        @keyframes loading {
            0% { width: 0; }
            100% { width: 100%; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }

        /* ===== Header Styles ===== */
        .app-header {
            height: 70px;
            background-color: var(--bg-primary);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: center;
            border-bottom: 1px solid var(--border);
        }

        .header-container {
            width: 100%;
            max-width: 1400px;
            height: 100%;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .branding {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: var(--transition);
        }

        .branding:hover {
            opacity: 0.9;
        }

        .logo-wrapper {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .logo-wrapper img {
            width: 70%;
            height: auto;
            object-fit: contain;
        }

        .app-name {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .app-name span {
            font-weight: 400;
            color: var(--text-secondary);
        }

        /* ===== Main Content Styles ===== */
        .main-content {
            max-width: 1400px;
            margin: 24px auto;
            padding: 0 24px;
            padding-bottom: 100px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* ===== File Table Styles ===== */
        .file-container {
            background-color: var(--bg-primary);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .file-table {
            width: 100%;
            border-collapse: collapse;
        }

        .file-table thead {
            background-color: var(--bg-secondary);
        }

        .file-table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .file-table th:first-child {
            padding-left: 24px;
            border-top-left-radius: var(--radius-lg);
        }

        .file-table th:last-child {
            padding-right: 24px;
            border-top-right-radius: var(--radius-lg);
        }

        .file-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .file-table td:first-child {
            padding-left: 24px;
        }

        .file-table td:last-child {
            padding-right: 24px;
        }

        .file-table tr:last-child td {
            border-bottom: none;
        }

        .file-table tr:hover {
            background-color: var(--bg-tertiary);
        }

        .file-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-icon-container {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background-color: var(--bg-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-icon {
            width: 20px;
            height: 20px;
            color: var(--primary);
        }

        .file-title {
            font-weight: 500;
            color: var(--text-primary);
        }

        .file-path {
            font-size: 12px;
            color: var(--text-tertiary);
            margin-top: 2px;
        }

        .file-owner {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .owner-avatar {
            width: 28px;
            height: 28px;
            border-radius: var(--radius-full);
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary);
        }

        .file-modified, .file-size {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .file-action {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
        }

        .file-action:hover {
            text-decoration: underline;
            opacity: 0.9;
        }

        /* ===== Empty State ===== */
        .empty-state {
            padding: 48px 24px;
            text-align: center;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            color: var(--text-tertiary);
            margin-bottom: 16px;
        }

        .empty-state-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .empty-state-description {
            color: var(--text-secondary);
            max-width: 400px;
            margin: 0 auto 16px;
        }

        /* ===== Success Message ===== */
        .alert-success {
            background-color: #E6FFFA;
            border-left: 4px solid #38B2AC;
            color: #234E52;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success svg {
            width: 20px;
            height: 20px;
            color: #38B2AC;
        }

        /* ===== Floating Action Button ===== */
        .fab-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 99;
        }

        .fab {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-full);
            background-color: var(--primary);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: var(--shadow-lg);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .fab:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 102, 204, 0.2);
        }

        .fab-icon {
            font-size: 24px;
            font-weight: 300;
        }

        .fab-options {
            position: absolute;
            bottom: 70px;
            right: 0;
            width: 220px;
            background-color: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .fab-options.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .fab-option {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: var(--transition);
        }

        .fab-option:hover {
            background-color: var(--bg-secondary);
        }

        .fab-option-icon {
            width: 20px;
            height: 20px;
            color: var(--primary);
        }

        .fab-option-text {
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 500;
        }

        /* ===== Responsive Styles ===== */
        @media (max-width: 768px) {
            .header-container {
                padding: 0 16px;
            }
            
            .file-table th, .file-table td {
                padding: 12px;
            }
            
            .file-table th:first-child, .file-table td:first-child {
                padding-left: 16px;
            }
            
            .file-table th:last-child, .file-table td:last-child {
                padding-right: 16px;
            }
            
            .file-modified {
                display: none;
            }
            
            .fab-container {
                bottom: 20px;
                right: 20px;
            }
        }

        @media (max-width: 576px) {
            .app-name {
                font-size: 18px;
            }
            
            .file-owner-name {
                display: none;
            }
            
            .file-size {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Main Header -->
    <header class="app-header">
        <div class="header-container">
            <a href="/" class="branding">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo">
                </div>
                <h1 class="app-name">Badak <span>LNG</span></h1>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="page-title">My Files</h2>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="file-container">
            <table class="file-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Last Modified</th>
                        <th>File Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $file)
                        <tr>
                            <td>
                                <div class="file-name">
                                    <div class="file-icon-container">
                                        <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="file-title">{{ $file->filename ?? 'Unnamed File' }}</div>
                                        <div class="file-path">/My Files</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="file-owner">
                                    <div class="owner-avatar">ME</div>
                                    <span class="file-owner-name">me</span>
                                </div>
                            </td>
                            <td class="file-modified">{{ \Carbon\Carbon::parse($file->created_at)->format('M d, Y') }}</td>
                            <td class="file-size">
                                @if($file->path && \Storage::disk('public')->exists($file->path))
                                    {{ number_format(Storage::disk('public')->size($file->path) / 1024, 2) }} KB
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('files.download', $file->id) }}" class="file-action">
                                    Download
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>
                                <h3 class="empty-state-title">No files found</h3>
                                <p class="empty-state-description">Upload your first file by clicking the + button below</p>
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
            <div class="fab-options" id="fab-options">
                <div class="fab-option" onclick="uploadFile()">
                    <svg class="fab-option-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <span class="fab-option-text">Upload File</span>
                </div>
                <div class="fab-option" onclick="saveFile()">
                    <svg class="fab-option-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    <span class="fab-option-text">Save File</span>
                </div>
                <div class="fab-option" onclick="openTrash()">
                    <svg class="fab-option-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span class="fab-option-text">Trash</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Remove splash screen after animation completes
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const splash = document.querySelector('.splash-screen');
                if (splash) {
                    splash.addEventListener('animationend', () => {
                        splash.remove();
                    });
                }
            }, 3000);

            // Floating Action Button functionality
            const fab = document.getElementById('fab');
            const fabOptions = document.getElementById('fab-options');

            fab.addEventListener('click', (e) => {
                e.stopPropagation();
                fabOptions.classList.toggle('active');
            });

            // Close FAB options when clicking outside
            document.addEventListener('click', () => {
                fabOptions.classList.remove('active');
            });
        });

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