<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM PRISM | @yield('title')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Hotwire Turbo (Instant SPA Navigation) -->
    <script src="https://unpkg.com/@hotwired/turbo@7.3.0/dist/turbo.es2017-umd.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f6f6f6',
                            100: '#e7e7e7',
                            500: '#333333',
                            600: '#000000',
                            900: '#000000',
                            950: '#000000',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 flex flex-col">
    <nav class="sticky top-0 z-50 glass shadow-sm py-3 sm:py-4 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center bg-transparent gap-2">
            <!-- Left: Mobile Toggle & Logo -->
            <div class="flex items-center justify-start shrink-0">
                <button type="button" id="mobile-menu-btn" class="sm:hidden mr-4 text-slate-600 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200 rounded p-1 transition-colors">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
                <img src="{{ url('/images/products/image11.png') }}" alt="Sphere Global"
                    class="h-8 sm:h-10 hover:opacity-90 transition-opacity">
            </div>

            <!-- Center: App Title (Hidden on tiny mobile) -->
            <div class="hidden md:flex flex-col items-center justify-center text-center flex-1">
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">PRISM</h1>
                <p class="text-[10px] sm:text-xs text-slate-600 font-bold tracking-widest uppercase">Proposal System</p>
            </div>

            <!-- Right: Action Links -->
            <div class="flex items-center justify-end gap-2 sm:gap-4 shrink-0">
                <a href="{{ route('products.index') }}"
                    class="hidden sm:block text-slate-500 hover:text-slate-900 font-medium transition-colors px-2 py-2">Products</a>
                <a href="{{ route('quotes.index') }}"
                    class="hidden sm:block text-slate-500 hover:text-slate-900 font-medium transition-colors px-2 py-2">Quotes</a>
                <a href="{{ route('quotes.create') }}"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> <span class="hidden sm:inline">New Quote</span>
                </a>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white border-t border-slate-200 shadow-2xl z-50 transition-all duration-200 flex-col sm:hidden pb-2">
            <div class="px-4 py-4 flex flex-col items-center text-center border-b border-slate-100 bg-slate-50 md:hidden">
                 <h1 class="text-xl font-bold text-slate-900 tracking-tight leading-tight">PRISM</h1>
                 <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase">Proposal System</p>
            </div>
            <a href="{{ route('products.index') }}" class="flex items-center w-full px-6 py-4 border-b border-slate-100 text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 active:bg-slate-100 transition-colors">
                <i class="fa-solid fa-box-open w-8 text-center text-slate-400 mr-2 text-lg"></i> Products
            </a>
            <a href="{{ route('quotes.index') }}" class="flex items-center w-full px-6 py-4 border-b border-slate-100 text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 active:bg-slate-100 transition-colors">
                <i class="fa-solid fa-file-invoice-dollar w-8 text-center text-slate-400 mr-2 text-lg"></i> Quotes
            </a>
            <a href="{{ route('quotes.create') }}" class="flex items-center w-full px-6 py-4 text-base font-bold text-brand-600 hover:bg-slate-50 active:bg-slate-100 transition-colors">
                <i class="fa-solid fa-plus-circle w-8 text-center text-brand-400 mr-2 text-lg"></i> Create New Quote
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-6 text-center text-sm text-slate-400 border-t border-slate-200 bg-white">
        &copy; {{ date('Y') }} Sphere Global PRISM. All rights reserved.
    </footer>

    @stack('scripts')
    <script>
        function confirmDelete(id, type = 'quote') {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this immediately!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).requestSubmit();
                }
            })
        }

        function confirmRestore(id) {
            Swal.fire({
                title: 'Restore Quote?',
                text: "This quote will become active again.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('restore-form-' + id).requestSubmit();
                }
            })
        }

        // Initialize mobile menu safely across Turbo navigation events
        document.addEventListener('turbo:load', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            
            if (btn && menu) {
                // Remove existing listeners by cloning (prevents double toggle on quick navigation)
                const newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);
                
                newBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (menu.classList.contains('hidden')) {
                        menu.classList.remove('hidden');
                        menu.classList.add('flex');
                    } else {
                        menu.classList.add('hidden');
                        menu.classList.remove('flex');
                    }
                });

                // Auto-close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!menu.contains(e.target) && !newBtn.contains(e.target) && !menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        menu.classList.remove('flex');
                    }
                });
            }
        });
    </script>
</body>

</html>