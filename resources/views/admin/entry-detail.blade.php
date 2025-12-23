@extends('layouts.admin')

@section('title', 'Entry Details - UEP Admin Panel')
@section('page-title', 'Feedback Entry #' . $entry->id)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.entries') }}" class="text-uep-blue hover:underline">
        ← Back to All Entries
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Client Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-3 border-b">Client Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Client Name</label>
                    <p class="font-medium">{{ $entry->client_name ?: 'Anonymous' }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Client Type</label>
                    <p class="font-medium">{{ $entry->client_type }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Sex</label>
                    <p class="font-medium">{{ $entry->sex }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Age</label>
                    <p class="font-medium">{{ $entry->age }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Region</label>
                    <p class="font-medium">{{ $entry->region }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <p class="font-medium">{{ $entry->email ?: 'Not provided' }}</p>
                </div>
            </div>
        </div>

        <!-- Transaction Details -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-3 border-b">Transaction Details</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Campus</label>
                    <p class="font-medium">{{ $entry->campus }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Office</label>
                    <p class="font-medium">{{ $entry->office }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Service Availed</label>
                    <p class="font-medium">{{ $entry->service_availed }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Transaction Date</label>
                    <p class="font-medium">{{ $entry->transaction_date->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Service Quality Dimensions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-3 border-b">Service Quality Dimensions (SQD)</h3>
            <div class="space-y-4">
                @php
                    $scoreLabels = [
                        0 => 'N/A',
                        1 => 'Strongly Disagree',
                        2 => 'Disagree',
                        3 => 'Neutral',
                        4 => 'Agree',
                        5 => 'Strongly Agree'
                    ];
                @endphp

                @foreach($entry->responses as $response)
                    <div class="border-b pb-3 last:border-b-0">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800">{{ $response->question->code }}</span>
                                <p class="text-sm text-gray-600 mt-1">{{ $response->question->text }}</p>
                            </div>
                            <div class="ml-4 text-right">
                                <div class="text-2xl font-bold {{ $response->score == 0 ? 'text-gray-400' : 'text-uep-blue' }}">
                                    {{ $response->score == 0 ? 'N/A' : $response->score }}
                                </div>
                                @if($response->score > 0)
                                    <div class="text-xs text-gray-500">/ 5</div>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $response->score >= 4 ? 'bg-green-100 text-green-800' : ($response->score >= 3 ? 'bg-yellow-100 text-yellow-800' : ($response->score > 0 ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                {{ $scoreLabels[$response->score] }}
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Suggestions -->
        @if($entry->suggestions)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-3 border-b">Suggestions/Comments</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $entry->suggestions }}</p>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Summary Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Summary</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="text-sm text-gray-600">Submitted</label>
                    <p class="font-medium">{{ $entry->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $entry->created_at->format('h:i A') }}</p>
                </div>

                <div class="border-t pt-4">
                    <label class="text-sm text-gray-600">Average SQD Score</label>
                    @php
                        $avgScore = $entry->responses->where('score', '>', 0)->avg('score');
                    @endphp
                    @if($avgScore)
                        <p class="text-3xl font-bold text-uep-blue">{{ number_format($avgScore, 2) }}</p>
                        <p class="text-sm text-gray-500">out of 5.00</p>
                        <div class="mt-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-uep-blue rounded-full h-2" style="width: {{ $avgScore * 20 }}%"></div>
                        </div>
                    @else
                        <p class="text-gray-400">No valid scores</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Citizen's Charter Scores -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Citizen's Charter</h3>
            
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm text-gray-600">CC1 - Awareness</span>
                        <span class="font-semibold">{{ $entry->cc1_awareness }}/4</span>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 rounded-full h-2" style="width: {{ $entry->cc1_awareness * 25 }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm text-gray-600">CC2 - Visibility</span>
                        <span class="font-semibold">{{ $entry->cc2_visibility ?: 'N/A' }}{{ $entry->cc2_visibility ? '/4' : '' }}</span>
                    </div>
                    @if($entry->cc2_visibility)
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 rounded-full h-2" style="width: {{ $entry->cc2_visibility * 25 }}%"></div>
                        </div>
                    @else
                        <div class="bg-gray-200 rounded-full h-2"></div>
                    @endif
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm text-gray-600">CC3 - Helpfulness</span>
                        <span class="font-semibold">{{ $entry->cc3_helpfulness ?: 'N/A' }}{{ $entry->cc3_helpfulness ? '/4' : '' }}</span>
                    </div>
                    @if($entry->cc3_helpfulness)
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 rounded-full h-2" style="width: {{ $entry->cc3_helpfulness * 25 }}%"></div>
                        </div>
                    @else
                        <div class="bg-gray-200 rounded-full h-2"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
