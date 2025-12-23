@extends('layouts.admin')

@section('title', 'Dashboard - UEP Admin Panel')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Entries Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Total Entries</p>
                <p class="text-3xl font-bold text-uep-blue mt-2">{{ number_format($totalEntries ?? 0) }}</p>
            </div>
            <div class="text-4xl">📊</div>
        </div>
    </div>

    <!-- Today's Entries Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Today</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($todayEntries ?? 0) }}</p>
            </div>
            <div class="text-4xl">📅</div>
        </div>
    </div>

    <!-- This Week Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">This Week</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ number_format($weekEntries ?? 0) }}</p>
            </div>
            <div class="text-4xl">📆</div>
        </div>
    </div>

    <!-- This Month Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">This Month</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ number_format($monthEntries ?? 0) }}</p>
            </div>
            <div class="text-4xl">🗓️</div>
        </div>
    </div>
</div>

<!-- Average Scores Row -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Avg SQD Score -->
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 font-medium mb-2">Avg SQD Score</p>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-uep-blue">{{ number_format($avgSqdScore ?? 0, 2) }}</p>
            <p class="text-sm text-gray-500">/ 5.00</p>
        </div>
        <div class="mt-3 bg-gray-200 rounded-full h-2">
            <div class="bg-uep-blue rounded-full h-2" style="width: {{ ($avgSqdScore ?? 0) * 20 }}%"></div>
        </div>
    </div>

    <!-- Avg CC1 -->
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 font-medium mb-2">CC1 (Awareness)</p>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-green-600">{{ number_format($avgCc1 ?? 0, 2) }}</p>
            <p class="text-sm text-gray-500">/ 4.00</p>
        </div>
        <div class="mt-3 bg-gray-200 rounded-full h-2">
            <div class="bg-green-600 rounded-full h-2" style="width: {{ ($avgCc1 ?? 0) * 25 }}%"></div>
        </div>
    </div>

    <!-- Avg CC2 -->
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 font-medium mb-2">CC2 (Visibility)</p>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-blue-600">{{ number_format($avgCc2 ?? 0, 2) }}</p>
            <p class="text-sm text-gray-500">/ 4.00</p>
        </div>
        <div class="mt-3 bg-gray-200 rounded-full h-2">
            <div class="bg-blue-600 rounded-full h-2" style="width: {{ ($avgCc2 ?? 0) * 25 }}%"></div>
        </div>
    </div>

    <!-- Avg CC3 -->
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 font-medium mb-2">CC3 (Helpfulness)</p>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-purple-600">{{ number_format($avgCc3 ?? 0, 2) }}</p>
            <p class="text-sm text-gray-500">/ 4.00</p>
        </div>
        <div class="mt-3 bg-gray-200 rounded-full h-2">
            <div class="bg-purple-600 rounded-full h-2" style="width: {{ ($avgCc3 ?? 0) * 25 }}%"></div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Campus Distribution -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Feedback by Campus</h3>
        <canvas id="campusChart"></canvas>
    </div>

    <!-- Client Type Distribution -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Client Type Distribution</h3>
        <canvas id="clientTypeChart"></canvas>
    </div>
</div>

<!-- Daily Trend Chart -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-4">7-Day Trend</h3>
    <canvas id="dailyTrendChart"></canvas>
</div>

<!-- Recent Entries Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-800">Recent Feedback Entries</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Office</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentEntries ?? [] as $entry)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $entry->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($entry->campus, 20) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($entry->office, 25) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->client_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.entry.show', $entry->id) }}" class="text-uep-blue hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">No entries yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(($recentEntries ?? collect())->count() > 0)
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <a href="{{ route('admin.entries') }}" class="text-uep-blue hover:underline text-sm font-medium">View All Entries →</a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Campus Chart
    const campusCtx = document.getElementById('campusChart');
    if (campusCtx) {
        new Chart(campusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(($campusStats ?? collect())->pluck('campus')->toArray()) !!},
                datasets: [{
                    data: {!! json_encode(($campusStats ?? collect())->pluck('total')->toArray()) !!},
                    backgroundColor: ['#364388', '#5b68a8', '#8490c8'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Client Type Chart
    const clientTypeCtx = document.getElementById('clientTypeChart');
    if (clientTypeCtx) {
        new Chart(clientTypeCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(($clientTypeStats ?? collect())->pluck('client_type')->toArray()) !!},
                datasets: [{
                    label: 'Count',
                    data: {!! json_encode(($clientTypeStats ?? collect())->pluck('total')->toArray()) !!},
                    backgroundColor: '#364388',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    // Daily Trend Chart
    const dailyTrendCtx = document.getElementById('dailyTrendChart');
    if (dailyTrendCtx) {
        new Chart(dailyTrendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(($dailyTrend ?? collect())->pluck('date')->toArray()) !!},
                datasets: [{
                    label: 'Submissions',
                    data: {!! json_encode(($dailyTrend ?? collect())->pluck('count')->toArray()) !!},
                    borderColor: '#364388',
                    backgroundColor: 'rgba(54, 67, 136, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#364388',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
