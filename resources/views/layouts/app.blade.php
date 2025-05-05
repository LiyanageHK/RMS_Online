<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> 
    
    <style>
        .profile-dropdown {
            min-width: 200px;
        }
        
        .profile-dropdown .dropdown-header {
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
        }
        
        .profile-dropdown .user-info {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .profile-dropdown .dropdown-item {
            padding: 8px 15px;
            transition: all 0.3s ease;
        }
        
        .profile-dropdown .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 20px;
        }
        
        .profile-dropdown .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            color: #6c757d;
        }
        
        .profile-dropdown .dropdown-divider {
            margin: 5px 0;
        }
        
        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #E7592B;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 8px;
        }
        .main-sidebar {
    background: #fff !important;
    color: #222 !important;
    border-right: 1px solid #eee;
}

.main-sidebar .nav-link,
.main-sidebar .brand-link,
.main-sidebar .info a {
    color: #222 !important;
}

.main-sidebar .nav-icon {
    color: #222 !important;
    transition: color 0.2s;
}

.main-sidebar .nav-link.active,
.main-sidebar .nav-link:hover {
    background: #fff3ed !important; /* very light orange background */
    color: var(--primary-color) !important;
    font-weight: 600;
}

.main-sidebar .nav-link.active .nav-icon,
.main-sidebar .nav-link:hover .nav-icon {
    color: var(--primary-color) !important;
}

.main-sidebar .nav-link.active p,
.main-sidebar .nav-link:hover p {
    color: var(--primary-color) !important;
}
</style>
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="navbarDropdown">
                            <li class="dropdown-header">
                                <div class="user-avatar mx-auto mb-2" style="width: 48px; height: 48px; font-size: 1.2rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </li>
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('employees.profile') }}">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('employees.changePasswordForm') }}">
                                    <i class="fas fa-key"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>

        @auth
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar" style="width: 250px; background-color: #ffffff; color: #333; padding: 20px; box-shadow: 2px 0px 8px rgb(255, 255, 255); display: flex; flex-direction: column; min-height: 100vh;">
            <!-- Logo -->
            <div style="text-align: center; margin-bottom: 25px;">
                <img src="{{ asset('uploads/logo/logo2.png') }}" alt="Logo" style="width: 80px;">
                <div style="margin-top: 10px;">
                    <div style="font-size: 22px; color: #E7592B; font-family: 'Castoro Titling'; font-weight: bold;">FLAME & CRUST</div>
                    <div style="font-size: 14px; color: #888; font-family: 'Gloock';">PIZZERIA</div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <div id="sidebarMenu" style="flex-grow: 1;">
                <a href="{{ route('home') }}" class="sidebar-btn {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span class="btn-content">
                        <span class="material-icons">dashboard</span>
                        Dashboard
                    </span>
                </a>


                 
               

                <div id="inventorynav">
                    <button class="sidebar-btn" onclick="toggleMenu(this)">
                        <span class="btn-content"><span class="material-icons">business</span> Inventory Center</span>
                        <span class="material-icons toggle-icon">expand_more</span>
                    </button>
                    <div class="submenu" style="display: none; margin-left: 20px; margin-top: 6px; text-align: left;">
                        <a href="{{ route('admin.inventory.index') }}" class="submenu-link {{ request()->routeIs('admin.inventory.index') ? 'active' : '' }}">Inventory Status</a>
                        <a href="{{ route('admin.categories.index') }}" class="submenu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Item Category</a>
                        <a href="{{ route('admin.items.index') }}" class="submenu-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}">Item</a>
                        <a href="{{ route('admin.productcategories.index') }}" class="submenu-link {{ request()->routeIs('admin.productcategories.*') ? 'active' : '' }}">Product Category</a>
                        <a href="{{ route('admin.production.index') }}" class="submenu-link {{ request()->routeIs('admin.production.*') ? 'active' : '' }}">Product</a>
                    </div>
                </div>

                <!-- Procurement Center -->
                <div id="pronav">
                    <button class="sidebar-btn" onclick="toggleMenu(this)">
                        <span class="btn-content"><span class="material-icons">business</span> Procurement Center</span>
                        <span class="material-icons toggle-icon">expand_more</span>
                    </button>
                    <div class="submenu" style="display: none; margin-left: 20px; margin-top: 6px; text-align: left;">
                        <a href="#" class="submenu-link">Suppliers</a>
                        <a href="#" class="submenu-link">Purchase Orders</a>
                        <a href="#" class="submenu-link">Good Received Notes</a>
                    </div>
                </div>

                <div id="cusnav">
                    <button class="sidebar-btn">
                        <span class="btn-content"><span class="material-icons">group</span> Customer Center</span>
                    </button>
                </div>

                <div id="ordernav">
                    <button class="sidebar-btn">
                        <span class="btn-content"><span class="material-icons">shopping_cart</span> Order Center</span>
                    </button>
                </div>

                <div id="delinav">
                    <button class="sidebar-btn">
                        <span class="btn-content"><span class="material-icons">local_shipping</span> Delivery Center</span>
                    </button>
                </div>

                <div id="empnav">
                    <button class="sidebar-btn">
                        <span class="btn-content"><span class="material-icons">people</span> Employee Center</span>
                    </button>
                </div>

                <div id="accnav">
                    <button class="sidebar-btn" onclick="toggleMenu(this)">
                        <span class="btn-content"><span class="material-icons">security</span> Access Management Center</span>
                        <span class="material-icons toggle-icon">expand_more</span>
                    </button>
                    <div class="submenu" style="display: none; margin-left: 20px; margin-top: 6px; text-align: left;">
                        <a href="{{ route('admin.role.index') }}" class="submenu-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">Role</a>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Material Icons CDN -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            .sidebar-btn {
                background-color: #f8f8f8;
                color: #333;
                font-size: 15px;
                padding: 12px 16px;
                width: 100%;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                transition: background 0.3s, color 0.3s;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
                text-decoration: none;
            }
            .sidebar-btn:hover,
            .sidebar-btn.active {
                background-color: #fff3ed;
                color: #E7592B;
                font-weight: 600;
            }
            .sidebar-btn:hover .material-icons,
            .sidebar-btn.active .material-icons {
                color: #E7592B;
            }
            .btn-content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .submenu-link {
                display: block;
                padding: 8px 15px;
                color: #555;
                text-decoration: none;
                font-size: 14px;
                border-radius: 4px;
                transition: background 0.3s, color 0.3s;
                margin-bottom: 4px;
            }
            .submenu-link:hover,
            .submenu-link.active {
                background-color: #fff3ed;
                color: #E7592B;
                font-weight: 500;
            }
            .toggle-icon {
                font-size: 18px;
                color: #888;
                transition: transform 0.3s;
            }
            .material-icons {
                vertical-align: middle;
                font-size: 20px;
                transition: color 0.3s;
            }
            /* Add active state for parent button when submenu is active */
            .submenu-link.active ~ .sidebar-btn {
                background-color: #fff3ed;
                color: #E7592B;
                font-weight: 600;
            }
        </style>
        <script>
            function toggleMenu(button) {
                const submenu = button.nextElementSibling;
                const icon = button.querySelector('.toggle-icon');
                
                // Check if any submenu link is active
                const hasActiveLink = submenu.querySelector('.submenu-link.active') !== null;
                
                if (hasActiveLink) {
                    submenu.style.display = "block";
                    icon.textContent = "expand_less";
                    button.classList.add('active');
                } else if (submenu.style.display === "none" || submenu.style.display === "") {
                    submenu.style.display = "block";
                    icon.textContent = "expand_less";
                } else {
                    submenu.style.display = "none";
                    icon.textContent = "expand_more";
                }
            }

            // Initialize menu state on page load
            document.addEventListener('DOMContentLoaded', function() {
                const submenus = document.querySelectorAll('.submenu');
                submenus.forEach(submenu => {
                    const hasActiveLink = submenu.querySelector('.submenu-link.active') !== null;
                    if (hasActiveLink) {
                        submenu.style.display = "block";
                        const button = submenu.previousElementSibling;
                        const icon = button.querySelector('.toggle-icon');
                        icon.textContent = "expand_less";
                        button.classList.add('active');
                    }
                });
            });
        </script>
        @endauth

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Main Content -->
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
    @stack('scripts')
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: '/admin/user_permissions',
            method: 'GET',
            success: function(response) {
                console.log('Permissions response:', response);

                // Inventory Center permissions
                if (response.inv === 1) {
                    $('#inventorynav').show();
                } else {
                    $('#inventorynav').hide();
                }

                // Customer Center permissions
                if (response.cus === 1) {
                    $('#cusnav').show();
                } else {
                    $('#cusnav').hide();
                }

                // Order Center permissions
                if (response.order === 1) {
                    $('#ordernav').show();
                } else {
                    $('#ordernav').hide();
                }

                // Delivery Center permissions
                if (response.deli === 1) {
                    $('#delinav').show();
                } else {
                    $('#delinav').hide();
                }

                // Employee Center permissions
                if (response.emp === 1) {
                    $('#empnav').show();
                } else {
                    $('#empnav').hide();
                }

                // Access Management Center permissions
                if (response.acc === 1) {
                    $('#accnav').show();
                } else {
                    $('#accnav').hide();
                }

                // Product permissions
                if (response.pro === 1) {
                    $('#pronav').show();
                } else {
                    $('#pronav').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching permissions:", error);
            }
        });
    });
</script>