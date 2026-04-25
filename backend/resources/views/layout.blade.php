<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIDIA - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f9fafb; /* bg-gray-50 */
            font-family: 'Inter', sans-serif;
            color: #111827;
        }

        /* WRAPPER FIX */
        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            transition: 0.3s;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .hide-on-collapse {
            display: none !important;
        }

        .sidebar.collapsed .logo-box {
            margin: 0 auto;
        }

        /* SIDEBAR HEADER */
        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-box {
            background-color: #2563eb; /* bg-blue-600 */
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* NAVIGATION LINKS */
        .sidebar-nav {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 8px;
            color: #4b5563; /* text-gray-700 */
            text-decoration: none;
            font-size: 0.875rem; /* text-sm */
            transition: all 0.2s ease;
        }

        .nav-item i {
            font-size: 1.15rem;
        }

        .nav-item:hover {
            background-color: #f3f4f6; /* bg-gray-100 */
            color: #111827;
        }

        .nav-item.active {
            background-color: #eff6ff; /* bg-blue-50 */
            color: #1d4ed8; /* text-blue-700 */
            font-weight: 500;
        }

        /* SIDEBAR FOOTER */
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .user-info-card {
            background-color: #f3f4f6; /* bg-gray-100 */
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        /* MAIN AREA */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Biar scrollnya hanya di konten */
        }

        /* TOP NAVBAR */
        .navbar-custom {
            background: #ffffff;
            padding: 16px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toggle-btn {
            cursor: pointer;
            font-size: 20px;
            color: #6b7280;
            background: transparent;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
        }
        
        .toggle-btn:hover { color: #111827; }

        /* CONTENT AREA */
        .content {
            padding: 32px;
            flex: 1;
            overflow-y: auto;
        }

    </style>
</head>

<body>

<div class="wrapper">

    <div class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <div class="logo-box">
                <i class="bi bi-activity fs-5"></i>
            </div>
            <div class="hide-on-collapse">
                <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem;">AIDIA</h5>
                <p class="text-muted mb-0" style="font-size: 0.75rem;">Diabetes Awareness</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> <span class="hide-on-collapse">Dashboard</span>
            </a>

            <a href="/patients" class="nav-item {{ request()->is('patients*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> <span class="hide-on-collapse">Data Pasien</span>
            </a>

            <a href="/screenings" class="nav-item {{ request()->is('screenings*') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-check"></i> <span class="hide-on-collapse">Skrining Diabetes</span>
            </a>

             <a href="/monitoring" class="nav-item {{ request()->is('monitoring*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-triangle"></i> <span class="hide-on-collapse">Monitoring Risiko</span>
            </a>

            <a href="/laporan" class="nav-item {{ request()->is('laporan*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> <span class="hide-on-collapse">Laporan</span>
            </a>

            <a href="/edukasi" class="nav-item {{ request()->is('edukasi*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> <span class="hide-on-collapse">Edukasi Kesehatan</span>
            </a>

            <a href="/reminders" class="nav-item {{ request()->is('reminders*') ? 'active' : '' }}">
                <i class="bi bi-capsule"></i> <span class="hide-on-collapse">Pengingat Obat</span>
            </a>

            {{-- @if(auth()->check() && auth()->user()->role == 'admin')
                <hr class="my-2 border-secondary hide-on-collapse">
                <a href="/users/create" class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="bi bi-person-plus"></i> <span class="hide-on-collapse">Tambah Kader</span>
                </a> --}}
            {{-- @endif --}}

        </nav>

        <div class="sidebar-footer">
            <div class="user-info-card hide-on-collapse">
                <p class="mb-0 fw-semibold text-dark" style="font-size: 0.75rem;">
                    {{ auth()->user()->name ?? 'Admin Posbindu' }}
                </p>
                <p class="text-muted mb-0" style="font-size: 0.75rem;">
                    {{ (auth()->check() && auth()->user()->role == 'admin') ? 'Administrator' : 'Kader Kesehatan' }}
                </p>
            </div>
            
            <form action="/logout" method="POST" class="m-0 p-0">
                @csrf
                <button type="submit" class="nav-item w-100 text-start border-0 bg-transparent text-danger">
                    <i class="bi bi-box-arrow-left"></i> <span class="hide-on-collapse">Logout</span>
                </button>
            </form>
        </div>

    </div>

    <div class="main">

        <div class="navbar-custom">
            <div class="d-flex align-items-center">
                <button class="toggle-btn" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
    }
</script>

</body>
</html>