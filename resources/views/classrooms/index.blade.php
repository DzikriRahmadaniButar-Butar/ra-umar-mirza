@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-900 text-gray-100">
    @if (session('success'))
        <div class="mx-6 my-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="px-6 py-4 border-b border-blue-800">
        <div class="flex justify-between items-center pb-4">
            <div>
                <nav class="flex items-center space-x-2 text-sm text-blue-300 mb-2">
                    <span>Data Kelas</span>
                    <span>></span>
                    <span>List</span>
                </nav>
                <h1 class="text-2xl font-bold text-white">Data Kelas</h1>
            </div>
            <a href="{{ route('classrooms.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                + Tambah Kelas
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6">
        <div class="bg-white rounded-lg border border-blue- shadow-sm overflow-hidden">
            <!-- Search Bar -->
            <div class="p-4 border-b border-blue- bg-white-900">
                <div class="relative">
                    <form method="GET" action="{{ route('classrooms.index') }}" class="w-full">
                        <!-- Hidden fields untuk mempertahankan sorting -->
                        <input type="hidden" name="sort" value="{{ request()->get('sort') }}">
                        <input type="hidden" name="direction" value="{{ request()->get('direction') }}">
                        <input type="hidden" name="per_page" value="{{ request()->get('per_page') }}">
                        
                        <input 
                            type="text" 
                            name="search"
                            placeholder="Cari Kelas..." 
                            value="{{ $search ?? '' }}"
                            class="w-full bg-blue-200 border border-blue-700 rounded-lg px-4 py-2 pl-10 text-black placeholder-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                        >
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        @php
                            $sort = request()->get('sort');
                            $direction = request()->get('direction') === 'asc' ? 'desc' : 'asc';
                            // Function untuk membuat URL sorting dengan parameter yang ada
                            function getSortUrl($sortField, $currentSort, $currentDirection, $request) {
                                $newDirection = ($currentSort === $sortField && $currentDirection === 'asc') ? 'desc' : 'asc';
                                $params = $request->except(['sort', 'direction']);
                                $params['sort'] = $sortField;
                                $params['direction'] = $newDirection;
                                return '?' . http_build_query($params);
                            }
                        @endphp

                        <tr class="bg-blue-100 border-b border-blue-800">
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase tracking-wider hover:bg-blue-700 hover:text-white transition-colors duration-200">
                                <a href="{{ getSortUrl('name', $sort, request()->get('direction'), request()) }}"
                                   class="hover:underline flex items-center gap-1 hover:text-white">
                                    Nama Kelas
                                    @if ($sort === 'name')
                                        {{ request()->get('direction') === 'asc' ? '🔼' : (request()->get('direction') === 'desc' ? '🔽' : '<>') }}
                                    @else
                                        🔼🔽
                                    @endif
                                </a>
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase tracking-wider hover:bg-blue-700 hover:text-white transition-colors duration-200">
                                <a href="{{ getSortUrl('created_at', $sort, request()->get('direction'), request()) }}"
                                   class="hover:underline flex items-center gap-1 hover:text-white">
                                    Tanggal Dibuat
                                    @if ($sort === 'created_at')
                                        {{ request()->get('direction') === 'asc' ? '🔼' : (request()->get('direction') === 'desc' ? '🔽' : '<>') }}
                                    @else
                                        🔼🔽
                                    @endif
                                </a>
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase tracking-wider hover:bg-blue-700 hover:text-white transition-colors duration-200">
                                <a href="{{ getSortUrl('updated_at', $sort, request()->get('direction'), request()) }}"
                                   class="hover:underline flex items-center gap-1 hover:text-white">
                                    Terakhir Diperbarui
                                    @if ($sort === 'updated_at')
                                        {{ request()->get('direction') === 'asc' ? '🔼' : (request()->get('direction') === 'desc' ? '🔽' : '<>') }}
                                    @else
                                        🔼🔽
                                    @endif
                                </a>
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-600 text-black">
                        @forelse($classrooms as $classroom)
                            <tr class="hover:bg-blue-300 hover:text-white transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $classroom->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($classroom->created_at)->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($classroom->updated_at)->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm flex gap-2">
                                    <a href="{{ route('classrooms.edit', $classroom->id) }}" class="text-blue-600 hover:text-white transition-colors">✏️ Edit</a>
                                    <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')" class="inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-white transition-colors">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center px-6 py-12 text-blue-300">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-6 4h6m-6 4h6"></path>
                                        </svg>
                                        <p class="text-sm">Belum ada data kelas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-blue-800 bg-blue-900 flex items-center justify-between">
                <div class="text-sm text-blue-300">
                    Showing {{ $classrooms->firstItem() ?? 0 }} to {{ $classrooms->lastItem() ?? 0 }} of {{ $classrooms->total() }} results
                </div>
                
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-blue-300 mr-2">Per page</span>
                    <form method="GET" action="{{ route('classrooms.index') }}" class="inline">
                        <!-- Hidden fields untuk mempertahankan parameter yang ada -->
                        <input type="hidden" name="search" value="{{ request()->get('search') }}">
                        <input type="hidden" name="sort" value="{{ request()->get('sort') }}">
                        <input type="hidden" name="direction" value="{{ request()->get('direction') }}">
                        <input type="hidden" name="page" value="1">
                        
                        <select name="per_page" onchange="this.form.submit()" class="bg-blue-800 border border-blue-700 rounded px-3 py-1 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="10" {{ request()->get('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request()->get('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request()->get('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request()->get('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    
                    <div class="flex items-center space-x-1 ml-4">
                        <!-- Laravel Pagination Links -->
                        {{ $classrooms->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection