<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'BookStock') | Interactive Cares</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              indigo: {
                50: "#eef2ff",
                100: "#e0e7ff",
                500: "#6366f1",
                600: "#4f46e5",
                700: "#4338ca",
              },
              purple: {
                50: "#faf5ff",
                500: "#a855f7",
                600: "#9333ea",
                700: "#7e22ce",
              },
            },
          },
        },
      };
    </script>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
      body { font-family: "Inter", sans-serif; }
      .sidebar-link { transition: all 0.2s ease; }
      .sidebar-link:hover, .sidebar-link.active {
        background-color: #f3f4f6;
        border-left: 4px solid #4f46e5;
      }
    </style>
  </head>

  <body class="bg-gray-50 min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen">
      <!-- Sidebar -->
      <aside class="lg:w-64 bg-white shadow-lg z-10 lg:h-screen lg:sticky lg:top-0">
        <div class="p-6 border-b">
          <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 w-10 h-10 rounded-xl flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-white">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
              </svg>
            </div>
            <div>
              <h1 class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Interactive Cares</h1>
              <p class="text-xs text-gray-500">Dashboard</p>
            </div>
          </div>
        </div>

        <div class="p-4">
          <nav class="space-y-1">
            <div class="pt-2 pb-2">
              <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Book Management</p>
            </div>

            <a href="{{ route('categories.index') }}" class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('categories.*') ? 'text-indigo-600' : 'text-gray-500' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
              </svg>
              <span class="font-medium">Categories</span>
            </a>

            <a href="{{ route('authors.index') }}" class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('authors.*') ? 'active' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('authors.*') ? 'text-indigo-600' : 'text-gray-500' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>
              <span class="font-medium">Authors</span>
            </a>

            <a href="{{ route('books.index') }}" class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('books.*') ? 'text-indigo-600' : 'text-gray-500' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
              </svg>
              <span class="font-medium">Books</span>
            </a>
          </nav>
        </div>
      </aside>

      <!-- Main -->
      <main class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm sticky top-0 z-20">
          <div class="px-6 lg:px-8 py-4 flex items-center justify-between">
            <div>
              <h1 class="text-xl font-bold text-gray-800">@yield('page_title','Dashboard')</h1>
              <p class="text-sm text-gray-500">@yield('page_subtitle','')</p>
            </div>

            <div>
              @yield('top_action')
            </div>
          </div>
        </header>

        <div class="p-6 lg:p-8">
          @if(session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
              {{ session('success') }}
            </div>
          @endif

          @yield('content')
        </div>
      </main>
    </div>
  </body>
</html>
