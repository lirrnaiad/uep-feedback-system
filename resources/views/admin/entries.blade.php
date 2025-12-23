@extends('layouts.admin')

@section('title', 'Feedback Entries - UEP Admin Panel')
@section('page-title', 'Feedback Entries')

@section('content')
<!-- Filters and Export -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" action="{{ route('admin.entries') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <div>
                <label for="campus" class="block text-sm font-medium text-gray-700 mb-2">Campus</label>
                <select name="campus" id="campus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
                    <option value="">All Campuses</option>
                    <option value="UEP Main Campus (Catarman)" {{ request('campus') == 'UEP Main Campus (Catarman)' ? 'selected' : '' }}>Main Campus</option>
                    <option value="UEP Laoang Campus" {{ request('campus') == 'UEP Laoang Campus' ? 'selected' : '' }}>Laoang Campus</option>
                    <option value="UEP Catubig Campus" {{ request('campus') == 'UEP Catubig Campus' ? 'selected' : '' }}>Catubig Campus</option>
                </select>
            </div>

            <div>
                <label for="office" class="block text-sm font-medium text-gray-700 mb-2">Office</label>
                <input type="text" 
                       name="office" 
                       id="office" 
                       value="{{ request('office') }}"
                       placeholder="Search office..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
            </div>

            <div>
                <label for="client_type" class="block text-sm font-medium text-gray-700 mb-2">Client Type</label>
                <select name="client_type" id="client_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
                    <option value="">All Types</option>
                    <option value="Citizen" {{ request('client_type') == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                    <option value="Business" {{ request('client_type') == 'Business' ? 'selected' : '' }}>Business</option>
                    <option value="Internal" {{ request('client_type') == 'Internal' ? 'selected' : '' }}>Internal</option>
                    <option value="External" {{ request('client_type') == 'External' ? 'selected' : '' }}>External</option>
                </select>
            </div>

            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" 
                       name="date_from" 
                       id="date_from" 
                       value="{{ request('date_from') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" 
                       name="date_to" 
                       id="date_to" 
                       value="{{ request('date_to') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-uep-blue text-white rounded-lg hover:opacity-90 transition">
                Apply Filters
            </button>
            <a href="{{ route('admin.entries') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                Clear Filters
            </a>
            <div class="flex-1"></div>
            <a href="{{ route('admin.export') }}?{{ http_build_query(request()->all()) }}" 
               class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                📥 Export to CSV
            </a>
        </div>
    </form>
</div>

<!-- Entries Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">
            All Entries 
            <span class="text-sm font-normal text-gray-500">({{ $entries->total() }} total)</span>
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Office</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Score</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($entries as $entry)
                    @php
                        $avgScore = $entry->responses->where('score', '>', 0)->avg('score');
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $entry->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $entry->created_at->format('M d, Y') }}
                            <div class="text-xs text-gray-400">{{ $entry->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($entry->campus, 20) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($entry->office, 25) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $entry->client_type }}
                            <div class="text-xs text-gray-400">{{ $entry->sex }}, {{ $entry->age }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($entry->service_availed, 30) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($avgScore)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $avgScore >= 4 ? 'bg-green-100 text-green-800' : ($avgScore >= 3 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ number_format($avgScore, 2) }} / 5
                                </span>
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.entry.show', $entry->id) }}" 
                               class="text-uep-blue hover:underline font-medium">
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            No entries found. Try adjusting your filters.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($entries->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $entries->links() }}
        </div>
    @endif
</div>
@endsection
