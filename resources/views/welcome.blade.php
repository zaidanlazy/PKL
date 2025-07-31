<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Badak LNG </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=roboto:400,500,600,700&display=swap" rel="stylesheet">

        <style>
        /* ===== Base Styles ===== */
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d5bcf;
            --secondary: #34a853;
            --accent: #fbbc05;
            --danger: #ea4335;
            --text-primary: #202124;
            --text-secondary: #5f6368;
            --bg-primary: #ffffff;
            --bg-secondary: #f5f5f5;
            --border: #dadce0;
            --shadow-sm: 0 1px 2px rgba(60,64,67,0.08);
            --shadow-md: 0 1px 3px rgba(60,64,67,0.15);
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ===== Splash Screen Animation ===== */
        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--primary);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeOut 0.5s ease-out 2.5s forwards;
        }

        .logo-animation {
            width: 150px;
            height: 150px;
            position: relative;
            margin-bottom: 20px;
        }

        .logo-circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 8px solid transparent;
            border-top-color: white;
            animation: spin 1.5s linear infinite;
        }

        .logo-inner {
            position: absolute;
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border-radius: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .logo-inner img {
            width: 70%;
            height: auto;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .loading-text {
            color: white;
            font-size: 18px;
            font-weight: 500;
            margin-top: 20px;
            opacity: 0;
            animation: fadeIn 0.5s ease-out 0.5s forwards;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }

        /* ===== Header Styles ===== */
        .app-header {
            height: 80px;
            background-color: var(--bg-primary);
            box-shadow: var(--shadow-md);
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
            gap: 16px;
            transition: transform 0.3s ease;
        }

        .branding:hover {
            transform: translateX(5px);
        }

        .logo-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--bg-primary);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .logo-wrapper:hover {
            transform: rotate(15deg) scale(1.1);
        }

        .logo-wrapper img {
            width: 70%;
            height: auto;
            object-fit: contain;
        }

        .app-name {
            font-size: 22px;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
            position: relative;
        }

        .app-name::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }

        .branding:hover .app-name::after {
            width: 100%;
        }

        .nav-links {
            display: flex;
            gap: 15px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .nav-link {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(26, 115, 232, 0.1), transparent);
            transition: all 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background-color: rgba(26, 115, 232, 0.05);
        }

        .nav-link.primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 2px 8px rgba(26, 115, 232, 0.3);
        }

        .nav-link.primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 115, 232, 0.4);
        }

        .nav-icon {
            width: 18px;
            height: 18px;
        }

        /* ===== Main Content Styles ===== */
        .main-content {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 24px;
            padding-bottom: 100px; /* Added space for floating button */
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 500;
            color: var(--text-primary);
            margin: 0;
        }

        .file-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--bg-primary);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .file-table thead {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
        }

        .file-table th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .file-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .file-table tr:last-child td {
            border-bottom: none;
        }

        .file-table tr:hover {
            background-color: rgba(26, 115, 232, 0.05);
        }

        .file-name {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .file-icon {
            width: 24px;
            height: 24px;
            color: var(--text-secondary);
        }

        .file-owner {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .file-modified {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .file-size {
            color: var(--text-secondary);
            font-size: 14px;
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
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(26, 115, 232, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .fab:hover {
            background-color: var(--primary-dark);
            transform: scale(1.1);
        }

        .fab-icon {
            font-size: 24px;
            transition: transform 0.3s ease;
        }

        .fab-options {
            position: absolute;
            bottom: 70px;
            right: 0;
            width: 200px;
            background-color: white;
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
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
            transition: all 0.2s ease;
        }

        .fab-option:hover {
            background-color: rgba(26, 115, 232, 0.1);
        }

        .fab-option-icon {
            width: 20px;
            height: 20px;
            color: var(--text-secondary);
        }

        .fab-option-text {
            font-size: 14px;
            color: var(--text-primary);
        }

        /* ===== Responsive Styles ===== */
        @media (max-width: 768px) {
            .app-header {
                height: 70px;
            }
            
            .header-container {
                padding: 0 16px;
            }
            
            .logo-wrapper {
                width: 45px;
                height: 45px;
            }
            
            .app-name {
                font-size: 20px;
            }
            
            .nav-link {
                padding: 8px 16px;
                font-size: 14px;
            }

            .file-table th, .file-table td {
                padding: 10px 12px;
            }

            .fab-container {
                bottom: 20px;
                right: 20px;
            }
        }

        @media (max-width: 576px) {
            .app-name {
                display: none;
            }
            
            .nav-link span {
                display: none;
            }
            
            .nav-link {
                padding: 10px;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                justify-content: center;
            }
            
            .nav-icon {
                width: 20px;
                height: 20px;
                margin: 0;
            }

            .file-table {
                display: block;
                overflow-x: auto;
            }

            .fab-options {
                width: 180px;
            }
        }
    </style>
</head>
<body>
    <!-- Splash Screen with Animated Logo -->
    <div class="splash-screen">
        <div class="logo-animation">
            <div class="logo-circle"></div>
            <div class="logo-inner">
                <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo">
                                        </div>
        </div>
        <div class="loading-text"> Badak LNG </div>
                                    </div>

    <!-- Main Header -->
    <header class="app-header">
        <div class="header-container">
            <a href="/" class="branding">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo">
                                </div>
                <h1 class="app-name">Badak LNG </h1>
            </a>
            
            <nav>
                <ul class="nav-links">
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                <span>Log In</span>
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link primary">
                                    <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    <span>Register</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="page-title">My file</h2>
                                </div>

        <table class="file-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Last modified</th>
                    <th>File size</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Classroom
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Jul 22, 2024</td>
                    <td class="file-size">-</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Foto
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Jun 13, 2025</td>
                    <td class="file-size">-</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Game
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Mar 29, 2025</td>
                    <td class="file-size">-</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            serifikat zaidan
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Dec 3, 2024</td>
                    <td class="file-size">-</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            1 cylinder
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Feb 24, 2025</td>
                    <td class="file-size">396 KB</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Contoh Tugas Ide dan Inovasi - Muchamad A Sofyannur Ofii
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Aug 3, 2024</td>
                    <td class="file-size">2 KB</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Contoh Tugas Ide dan Inovasi - Muchamad A Sofyannur Ofii
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Aug 3, 2024</td>
                    <td class="file-size">2 KB</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Contoh Tugas Ide dan Inovasi - Muchamad A Sofyannur Ofii
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Aug 3, 2024</td>
                    <td class="file-size">2 KB</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            databases kampus
                                </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Oct 14, 2024</td>
                    <td class="file-size">85 KB</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Gambar pohon
                            </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Apr 14, 2025</td>
                    <td class="file-size">305 KB</td>
                </tr>
                <tr>
                    <td>
                        <div class="file-name">
                            <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            IMG_20250117_104744.jpg
                        </div>
                    </td>
                    <td class="file-owner">me</td>
                    <td class="file-modified">Jan 17, 2025</td>
                    <td class="file-size">1.1 MB</td>
                </tr>
            </tbody>
        </table>
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

            fab.addEventListener('click', () => {
                fabOptions.classList.toggle('active');
            });

            // Close FAB options when clicking outside
            document.addEventListener('click', (e) => {
                if (!fab.contains(e.target)) {
                    fabOptions.classList.remove('active');
                }
            });
        });

        function uploadFile() {
            alert('Upload File functionality will be implemented here');
            // Here you would typically open a file upload dialog
        }

        function saveFile() {
            alert('Save File functionality will be implemented here');
            // Here you would implement file saving logic
        }

        function openTrash() {
            alert('Trash functionality will be implemented here');
            // Here you would navigate to or show the trash view
        }
    </script>
    </body>
</html>