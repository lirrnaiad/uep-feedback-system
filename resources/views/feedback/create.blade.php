@extends('layouts.app')

@section('title', 'Feedback Form')

@section('content')
<div x-data="feedbackForm('{{ date('Y-m-d') }}', {{ $questions->count() }})">
    <form action="{{ route('feedback.store') }}" method="POST" id="feedbackForm">
        @csrf

        <!-- Instructions Card (Step 1) -->
        <div x-show="step === 1" class="bg-uep-blue rounded-t-md p-4 md:p-5 mb-0 shadow-lg w-full max-w-[380px] md:max-w-[520px] lg:max-w-[640px] mx-auto">
            <h2 class="text-white text-xs font-times font-bold text-center mb-2">CLIENT SATISFACTION MEASUREMENT</h2>
            <p class="text-white text-xs leading-tight">This Client Satisfaction Measurement (CMS) mocks the customer experience of government offices Your feedback on your recently concluded transaction will help this office provide a better service. Personal Information shared will be kept confidential and you always have the option to not answer this form.</p>
        </div>

        <!-- Instructions Card (Step 2) -->
        <div x-show="step === 2" class="bg-uep-blue rounded-t-md p-4 md:p-5 mb-0 shadow-lg w-full max-w-[380px] md:max-w-[520px] lg:max-w-[640px] mx-auto">
            <h2 class="text-white text-xs font-times font-bold text-center mb-2">CLIENT SATISFACTION MEASUREMENT</h2>
            <p class="text-white text-xs leading-tight">INSTRUCTIONS: Select your answer to the Citizen's Charter questions. The Citizen's Charter is an official document that reflects the services of a government agency/office including its requirement fees, and processing times among others.</p>
        </div>

        <!-- Instructions Card (Step 3) -->
        <div x-show="step === 3" class="bg-uep-blue rounded-t-md p-4 md:p-5 mb-0 shadow-lg w-full max-w-[380px] md:max-w-[520px] lg:max-w-[640px] mx-auto">
            <h2 class="text-white text-xs font-times font-bold text-center mb-2">CLIENT SATISFACTION MEASUREMENT</h2>
            <p class="text-white text-xs leading-tight">INSTRUCTIONS: For Service Quality Dimension (SQD), select on the bullets that best corresponds your answer.</p>
        </div>

        <!-- Yellow Stripe with Page Indicator -->
        <div class="bg-uep-yellow h-5 flex items-center justify-between px-3 text-[11px] font-semibold text-black w-full max-w-[380px] md:max-w-[520px] lg:max-w-[640px] mx-auto">
            <span x-show="step === 1">Client's Details</span>
            <span x-show="step === 2">Citizen's Charter (CC)</span>
            <span x-show="step === 3">Service Quality Dimension</span>
            <div class="flex items-center gap-2 text-[11px] font-semibold">
                <div class="w-2 h-2 bg-black"></div>
                <span>Page <span x-text="step"></span> of <span x-text="totalSteps"></span></span>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-form-gray rounded-b-md shadow-lg p-5 pb-7 md:p-6 md:pb-8 lg:p-7 lg:pb-9 border border-gray-200 w-full max-w-[380px] md:max-w-[520px] lg:max-w-[640px] mx-auto">
            <!-- Step 1: Client Details -->
            <div x-show="step === 1" x-transition>
                @include('feedback.partials.step1-client')
            </div>

            <!-- Step 2: Citizen's Charter -->
            <div x-show="step === 2" x-transition>
                @include('feedback.partials.step2-cc')
            </div>

            <!-- Step 3: Service Quality Dimensions -->
            <div x-show="step === 3" x-transition>
                @include('feedback.partials.step3-sqd')
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-center items-center gap-4 mt-6">
                <button type="button" 
                        @click="prevStep()" 
                        x-show="step > 1"
                        class="px-6 py-2 bg-uep-blue text-white rounded-lg hover:opacity-90 transition-opacity text-xs font-bold shadow-md min-w-[110px] md:min-w-[140px]">
                    PREVIOUS
                </button>
                <button type="button" 
                        @click="nextStep()" 
                        x-show="step < totalSteps"
                        :disabled="!isStepValid(step)"
                        class="px-6 py-2 bg-uep-blue text-white rounded-lg hover:opacity-90 transition-opacity text-xs font-bold shadow-md min-w-[110px] md:min-w-[140px]"
                        :class="{ 'opacity-50 cursor-not-allowed': !isStepValid(step) }">
                    NEXT
                </button>
                <button type="submit" 
                        x-show="step === totalSteps"
                        :disabled="!isStepValid(step)"
                        class="px-6 py-2 bg-uep-blue text-white rounded-lg hover:opacity-90 transition-opacity text-xs font-bold shadow-md min-w-[110px] md:min-w-[140px]"
                        :class="{ 'opacity-50 cursor-not-allowed': !isStepValid(step) }">
                    SUBMIT
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

