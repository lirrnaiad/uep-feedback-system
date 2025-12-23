@extends('layouts.admin')

@section('title', 'Analytics - UEP Admin Panel')
@section('page-title', 'Analytics & Reports')

@section('content')
<!-- Date Filter Form -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" action="{{ route('admin.analytics') }}" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
            <input type="date" 
                   name="date_from" 
                   id="date_from" 
                   value="{{ $dateFrom ?? '' }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
            <input type="date" 
                   name="date_to" 
                   id="date_to" 
                   value="{{ $dateTo ?? '' }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue">
        </div>
        <button type="submit" class="px-6 py-2 bg-uep-blue text-white rounded-lg hover:opacity-90 transition">
            Apply Filter
        </button>
    </form>
</div>

<!-- Service Quality Dimensions (SQD) Analysis -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-xl font-bold text-gray-800 mb-6">Service Quality Dimensions (SQD) - Average Scores</h3>
    
    <div class="space-y-4 mb-8">
        @foreach($sqdScores ?? [] as $sqd)
            <div>
                <div class="flex justify-between items-center mb-2">
                    <div class="flex-1">
                        <span class="font-semibold text-gray-800">{{ $sqd['question']->code }}</span>
                        <span class="text-gray-600 text-sm ml-2">{{ $sqd['question']->text }}</span>
                    </div>
                    <div class="text-right ml-4">
                        <span class="text-2xl font-bold text-uep-blue">{{ $sqd['average'] }}</span>
                        <span class="text-gray-500 text-sm">/ 5.00</span>
                        <div class="text-xs text-gray-500 mt-1">{{ $sqd['responses'] }} responses</div>
                    </div>
                </div>
                <div class="bg-gray-200 rounded-full h-3">
                    <div class="bg-uep-blue rounded-full h-3 transition-all" style="width: {{ $sqd['average'] * 20 }}%"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border-t pt-6">
        <canvas id="sqdChart"></canvas>
    </div>
</div>

<!-- Citizen's Charter Analysis -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-xl font-bold text-gray-800 mb-6">Citizen's Charter (CC) Performance</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- CC1 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-2">CC1 - Awareness of Service</h4>
            <p class="text-sm text-gray-600 mb-4">I knew what service to avail through information posted</p>
            <div class="text-center mb-4">
                <span class="text-4xl font-bold text-green-600">{{ $ccAnalysis['cc1']['average'] ?? 0 }}</span>
                <span class="text-gray-500">/ 4.00</span>
            </div>
            <div class="space-y-2">
                @foreach([1 => 'Strongly Disagree', 2 => 'Disagree', 3 => 'Agree', 4 => 'Strongly Agree'] as $value => $label)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $value }} - {{ $label }}</span>
                        <span class="font-semibold">{{ $ccAnalysis['cc1']['distribution'][$value] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CC2 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-2">CC2 - Visibility</h4>
            <p class="text-sm text-gray-600 mb-4">Information posted was visible and easily located</p>
            <div class="text-center mb-4">
                <span class="text-4xl font-bold text-blue-600">{{ $ccAnalysis['cc2']['average'] ?? 0 }}</span>
                <span class="text-gray-500">/ 4.00</span>
            </div>
            <div class="space-y-2">
                @foreach([1 => 'Strongly Disagree', 2 => 'Disagree', 3 => 'Agree', 4 => 'Strongly Agree'] as $value => $label)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $value }} - {{ $label }}</span>
                        <span class="font-semibold">{{ $ccAnalysis['cc2']['distribution'][$value] ?? 0 }}</span>
                    </div>
                @endforeach
                <div class="flex justify-between text-sm border-t pt-2">
                    <span class="text-gray-600">N/A</span>
                    <span class="font-semibold">{{ $ccAnalysis['cc2']['distribution']['NA'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- CC3 -->
        <div class="border border-gray-200 rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-2">CC3 - Helpfulness</h4>
            <p class="text-sm text-gray-600 mb-4">Information helped me understand the service procedure</p>
            <div class="text-center mb-4">
                <span class="text-4xl font-bold text-purple-600">{{ $ccAnalysis['cc3']['average'] ?? 0 }}</span>
                <span class="text-gray-500">/ 4.00</span>
            </div>
            <div class="space-y-2">
                @foreach([1 => 'Strongly Disagree', 2 => 'Disagree', 3 => 'Agree', 4 => 'Strongly Agree'] as $value => $label)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $value }} - {{ $label }}</span>
                        <span class="font-semibold">{{ $ccAnalysis['cc3']['distribution'][$value] ?? 0 }}</span>
                    </div>
                @endforeach
                <div class="flex justify-between text-sm border-t pt-2">
                    <span class="text-gray-600">N/A</span>
                    <span class="font-semibold">{{ $ccAnalysis['cc3']['distribution']['NA'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <canvas id="ccChart"></canvas>
</div>

<!-- Demographics -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Gender Distribution -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Gender Distribution</h3>
        <canvas id="genderChart"></canvas>
    </div>

    <!-- Age Groups -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Age Groups</h3>
        <canvas id="ageChart"></canvas>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Campus Distribution -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Campus Distribution</h3>
        <canvas id="campusChart"></canvas>
    </div>

    <!-- Client Type -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Client Type</h3>
        <canvas id="clientTypeChart"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // SQD Comparison Chart
    new Chart(document.getElementById('sqdChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(collect($sqdScores ?? [])->pluck('question.code')->toArray()) !!},
            datasets: [{
                label: 'Average Score',
                data: {!! json_encode(collect($sqdScores ?? [])->pluck('average')->toArray()) !!},
                backgroundColor: '#364388',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // CC Comparison Chart
    new Chart(document.getElementById('ccChart'), {
        type: 'bar',
        data: {
            labels: ['CC1 - Awareness', 'CC2 - Visibility', 'CC3 - Helpfulness'],
            datasets: [{
                label: 'Average Score',
                data: [
                    {{ $ccAnalysis['cc1']['average'] ?? 0 }},
                    {{ $ccAnalysis['cc2']['average'] ?? 0 }},
                    {{ $ccAnalysis['cc3']['average'] ?? 0 }}
                ],
                backgroundColor: ['#10b981', '#3b82f6', '#a855f7'],
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 4,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Gender Chart
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(($demographics['gender'] ?? collect())->pluck('sex')->toArray()) !!},
            datasets: [{
                data: {!! json_encode(($demographics['gender'] ?? collect())->pluck('total')->toArray()) !!},
                backgroundColor: ['#364388', '#ffff88'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Age Groups Chart
    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($demographics['age_groups'] ?? [])) !!},
            datasets: [{
                label: 'Count',
                data: {!! json_encode(array_values($demographics['age_groups'] ?? [])) !!},
                backgroundColor: '#364388',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Campus Chart
    new Chart(document.getElementById('campusChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(($demographics['campus'] ?? collect())->pluck('campus')->toArray()) !!},
            datasets: [{
                data: {!! json_encode(($demographics['campus'] ?? collect())->pluck('total')->toArray()) !!},
                backgroundColor: ['#364388', '#5b68a8', '#8490c8'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Client Type Chart
    new Chart(document.getElementById('clientTypeChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(($demographics['client_type'] ?? collect())->pluck('client_type')->toArray()) !!},
            datasets: [{
                label: 'Count',
                data: {!! json_encode(($demographics['client_type'] ?? collect())->pluck('total')->toArray()) !!},
                backgroundColor: '#364388',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
