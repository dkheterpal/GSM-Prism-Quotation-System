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
    <nav class="sticky top-0 z-50 glass shadow-sm py-4 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-3 items-center">
            <div class="flex items-center justify-start">
                <img src="{{ url('/images/products/image11.png') }}" alt="Sphere Global"
                    class="h-10 hover:opacity-90 transition-opacity">
            </div>
            <div class="flex flex-col items-center justify-center text-center">
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">PRISM</h1>
                <p class="text-[10px] sm:text-xs text-slate-600 font-bold tracking-widest uppercase">Proposal System</p>
            </div>
            <div class="flex items-center justify-end gap-3 sm:gap-4">
                <a href="{{ route('products.index') }}"
                    class="hidden sm:block text-slate-500 hover:text-slate-900 font-medium transition-colors px-2 py-2">Products</a>
                <a href="{{ route('quotes.index') }}"
                    class="hidden sm:block text-slate-500 hover:text-slate-900 font-medium transition-colors px-2 py-2">Quotes</a>
                <a href="{{ route('quotes.create') }}"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> <span class="hidden sm:inline">New Quote</span>
                </a>
            </div>
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
                    document.getElementById('delete-form-' + id).submit();
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
                    document.getElementById('restore-form-' + id).submit();
                }
            })
        }
    </script>
</body>

</html>