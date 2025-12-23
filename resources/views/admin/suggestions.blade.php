@extends('layouts.admin')

@section('title', 'Suggestions - UEP Admin Panel')
@section('page-title', 'Suggestions & Comments')

@section('content')
<!-- Search Filter -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" action="{{ route('admin.suggestions') }}" class="flex gap-4">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   placeholder="Search suggestions..." 
                   value="{{ request('search') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
        </div>
        <button type="submit" class="px-6 py-2 bg-uep-blue text-white rounded-lg hover:opacity-90 transition">
            Search
        </button>
        @if(request('search'))
            <a href="{{ route('admin.suggestions') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Total Suggestions</p>
                <p class="text-3xl font-bold text-uep-blue mt-2">{{ $suggestions->total() }}</p>
            </div>
            <div class="text-4xl">💬</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Average Words</p>
                <p class="text-3xl font-bold text-green-600 mt-2">
                    @php
                        $avgWords = $suggestions->avg(function($entry) {
                            return str_word_count($entry->suggestions);
                        });
                    @endphp
                    {{ number_format($avgWords) }}
                </p>
            </div>
            <div class="text-4xl">📝</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">This Month</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $suggestions->filter(function($entry) {
                        return $entry->created_at->isCurrentMonth();
                    })->count() }}
                </p>
            </div>
            <div class="text-4xl">📅</div>
        </div>
    </div>
</div>

<!-- Suggestions List -->
<div class="space-y-4">
    @forelse($suggestions as $entry)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h4 class="font-semibold text-gray-800">
                        Entry #{{ $entry->id }} - {{ $entry->client_type }}
                        @if($entry->client_name)
                            <span class="text-gray-600 font-normal">({{ $entry->client_name }})</span>
                        @endif
                    </h4>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $entry->campus }} - {{ $entry->office }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">{{ $entry->created_at->format('M d, Y') }}</p>
                    <p class="text-xs text-gray-400">{{ $entry->created_at->format('h:i A') }}</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-3">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $entry->suggestions }}</p>
            </div>

            <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                <div class="flex gap-4 text-sm text-gray-600">
                    <span>Service: <strong>{{ Str::limit($entry->service_availed, 30) }}</strong></span>
                    <span>•</span>
                    <span>{{ str_word_count($entry->suggestions) }} words</span>
                </div>
                <a href="{{ route('admin.entry.show', $entry->id) }}" 
                   class="text-uep-blue hover:underline text-sm font-medium">
                    View Full Entry →
                </a>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <p class="text-gray-500 text-lg">No suggestions found.</p>
            @if(request('search'))
                <p class="text-gray-400 text-sm mt-2">Try adjusting your search.</p>
            @endif
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($suggestions->hasPages())
    <div class="mt-6">
        {{ $suggestions->links() }}
    </div>
@endif
@endsection
