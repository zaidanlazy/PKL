<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BADAK DRIVE</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=roboto:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            :root {
                --primary-color: #1a73e8;
                --secondary-color: #34a853;
                --accent-color: #fbbc05;
                --danger-color: #ea4335;
                --text-primary: #202124;
                --text-secondary: #5f6368;
                --bg-primary: #ffffff;
                --bg-secondary: #f5f5f5;
                --border-color: #dadce0;
                --shadow-sm: 0 1px 2px 0 rgba(60,64,67,0.08);
                --shadow-md: 0 1px 3px 1px rgba(60,64,67,0.15);
            }

            .dark {
                --primary-color: #8ab4f8;
                --secondary-color: #81c995;
                --accent-color: #fdd663;
                --danger-color: #f28b82;
                --text-primary: #e8eaed;
                --text-secondary: #9aa0a6;
                --bg-primary: #202124;
                --bg-secondary: #303134;
                --border-color: #5f6368;
                --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.3);
                --shadow-md: 0 1px 3px 1px rgba(0,0,0,0.15);
            }

            body {
                font-family: 'Roboto', sans-serif;
                background-color: var(--bg-secondary);
                color: var(--text-primary);
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .header {
                height: 72px;
                padding: 0 24px;
                display: flex;
                align-items: center;
                background-color: var(--bg-primary);
                border-bottom: 1px solid var(--border-color);
                box-shadow: var(--shadow-sm);
            }

            .logo-container {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .logo-img {
                background: var(--bg-primary);
                border-radius: 50%;
                padding: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: var(--shadow-sm);
                height: 48px;
                width: 48px;
            }

            .logo-img img {
                height: 100%;
                width: 100%;
                object-fit: contain;
            }

            .logo-text {
                font-size: 20px;
                font-weight: 600;
                color: var(--primary-color);
                letter-spacing: 0.5px;
            }

            .auth-links {
                margin-left: auto;
                display: flex;
                gap: 12px;
            }

            .auth-link {
                padding: 8px 16px;
                border-radius: 20px;
                color: var(--text-primary);
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: all 0.2s ease;
            }

            .auth-link:hover {
                background-color: rgba(66, 133, 244, 0.1);
            }

            .auth-link.primary {
                background-color: var(--primary-color);
                color: white;
            }

            .auth-link.primary:hover {
                background-color: #0d5bcf;
                box-shadow: 0 1px 2px rgba(66, 133, 244, 0.3);
            }

            .main-container {
                flex: 1;
                max-width: 1400px;
                margin: 24px auto;
                padding: 0 24px;
                width: 100%;
            }

            .toolbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
            }

            .breadcrumbs {
                font-size: 14px;
                color: var(--text-secondary);
                font-weight: 500;
            }

            .search-bar {
                width: 600px;
                height: 48px;
                background-color: rgba(241, 243, 244, 0.8);
                border-radius: 8px;
                display: flex;
                align-items: center;
                padding: 0 16px;
                transition: all 0.2s ease;
                border: 1px solid transparent;
            }

            .dark .search-bar {
                background-color: rgba(60, 64, 67, 0.8);
            }

            .search-bar:focus-within {
                background-color: var(--bg-primary);
                border-color: var(--border-color);
                box-shadow: var(--shadow-md);
            }

            .search-bar input {
                flex: 1;
                border: none;
                background: transparent;
                margin-left: 8px;
                font-size: 16px;
                outline: none;
                color: var(--text-primary);
            }

            .search-bar svg {
                color: var(--text-secondary);
            }

            .file-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 20px;
            }

            .file-card {
                background-color: var(--bg-primary);
                border-radius: 12px;
                padding: 20px;
                text-align: center;
                cursor: pointer;
                border: 1px solid var(--border-color);
                transition: all 0.2s ease;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .file-card:hover {
                box-shadow: var(--shadow-md);
                transform: translateY(-2px);
            }

            .file-icon {
                width: 56px;
                height: 56px;
                margin-bottom: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 12px;
                color: white;
                font-size: 24px;
            }

            .file-name {
                font-size: 15px;
                font-weight: 500;
                color: var(--text-primary);
                margin-bottom: 4px;
                width: 100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .file-meta {
                font-size: 12px;
                color: var(--text-secondary);
                width: 100%;
            }

            .footer {
                text-align: center;
                padding: 24px;
                color: var(--text-secondary);
                font-size: 13px;
                border-top: 1px solid var(--border-color);
                margin-top: 40px;
                background-color: var(--bg-primary);
            }

            @media (max-width: 1024px) {
                .search-bar {
                    width: 400px;
                }
            }

            @media (max-width: 768px) {
                .header {
                    padding: 0 16px;
                }
                
                .main-container {
                    padding: 0 16px;
                }
                
                .toolbar {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 16px;
                }
                
                .search-bar {
                    width: 100%;
                }
                
                .file-grid {
                    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                }
            }

            @media (max-width: 480px) {
                .logo-text {
                    display: none;
                }
                
                .file-grid {
                    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
                    gap: 12px;
                }
                
                .file-card {
                    padding: 16px;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <!-- Header -->
            <header class="header">
                <div class="logo-container">
                    <div class="logo-img">
                        <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" />
                    </div>
                    <span class="logo-text">BADAK DRIVE</span>
                </div>
                
                @if (Route::has('login'))
                    <nav class="auth-links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="auth-link">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="auth-link">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="auth-link primary">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <!-- Main Content -->
            <div class="main-container">
                <div class="toolbar">
                    <div class="breadcrumbs">My Drive</div>
                    <div class="search-bar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" placeholder="Search in Drive">
                    </div>
                </div>

                <div class="file-grid">
                    <!-- Document Card -->
                    <div class="file-card">
                        <div class="file-icon" style="background-color: var(--primary-color);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <div class="file-name">Documents</div>
                        <div class="file-meta">Updated 2 days ago</div>
                    </div>

                    <!-- Video Card -->
                    <div class="file-card">
                        <div class="file-icon" style="background-color: var(--danger-color);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                            </svg>
                        </div>
                        <div class="file-name">Videos</div>
                        <div class="file-meta">Updated 1 week ago</div>
                    </div>

                    <!-- Images Card -->
                    <div class="file-card">
                        <div class="file-icon" style="background-color: var(--accent-color);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <div class="file-name">Images</div>
                        <div class="file-meta">Updated today</div>
                    </div>

                    <!-- Shared Card -->
                    <div class="file-card">
                        <div class="file-icon" style="background-color: var(--secondary-color);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                <polyline points="16 6 12 2 8 6"></polyline>
                                <line x1="12" y1="2" x2="12" y2="15"></line>
                            </svg>
                        </div>
                        <div class="file-name">Shared Files</div>
                        <div class="file-meta">Updated 3 days ago</div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                BADAK LNG &copy; {{ date('Y') }} | v{{ PHP_VERSION }}
            </footer>
        </div>
    </body>
</html>