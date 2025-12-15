<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-black text-xs font-bold">Client's Details</h2>
        <span class="text-red-500 text-xs font-bold">*Required</span>
    </div>
    
    <div class="space-y-4">
        <!-- Client Name (Optional) -->
        <div>
            <label for="client_name" class="block text-black text-xs font-bold mb-1">
                Name of Client (Optional) :
            </label>
            <input type="text" 
                   id="client_name" 
                   name="client_name" 
                   x-model="formData.client_name"
                   class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs text-input-gray placeholder:text-input-gray shadow-inner"
                   placeholder="Enter your name....">
        </div>

        <!-- Unit/Office -->
        <div>
            <label for="unit_office" class="block text-black text-xs font-bold mb-1">
                UEP's Official Unit:
            </label>
            <input type="text" 
                   id="unit_office" 
                   name="unit_office" 
                   x-model="formData.unit_office"
                   required
                   class="w-full px-3 py-2 bg-gray-100 border border-input-gray rounded text-xs shadow-inner text-input-gray"
                   placeholder="ODFI"
                   readonly>
        </div>

        <!-- Transaction Date -->
        <div>
            <label for="transaction_date" class="block text-black text-xs font-bold mb-1">
                Date: <span class="text-red-500">*</span>
            </label>
            <input type="date" 
                   id="transaction_date" 
                   name="transaction_date" 
                   x-model="formData.transaction_date"
                   required
                   class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs shadow-inner">
        </div>

        <!-- Client Type -->
        <div>
            <label class="block text-black text-xs font-bold mb-2">
                Client type (Select One): <span class="text-red-500">*</span>
            </label>
            <div class="space-y-2">
                <label class="flex items-center gap-2 cursor-pointer radio-row">
                    <input type="radio" 
                           name="client_type" 
                           value="Citizen" 
                           x-model="formData.client_type"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">Citizen</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer radio-row">
                    <input type="radio" 
                           name="client_type" 
                           value="Business" 
                           x-model="formData.client_type"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">Business</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer radio-row">
                    <input type="radio" 
                           name="client_type" 
                           value="Internal" 
                           x-model="formData.client_type"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">Internal (Faculty/Employee)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer radio-row">
                    <input type="radio" 
                           name="client_type" 
                           value="External" 
                           x-model="formData.client_type"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">External (student/other groups)</span>
                </label>
            </div>
        </div>

        <!-- Sex -->
        <div>
            <label class="block text-black text-xs font-bold mb-2">
                Sex: <span class="text-red-500">*</span>
            </label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer radio-row">
                    <input type="radio" 
                           name="sex" 
                           value="Male" 
                           x-model="formData.sex"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">Male</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer radio-row">
                    <input type="radio" 
                           name="sex" 
                           value="Female" 
                           x-model="formData.sex"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">Female</span>
                </label>
            </div>
        </div>

        <!-- Age -->
        <div>
            <label for="age" class="block text-black text-xs font-bold mb-1">
                Age: <span class="text-red-500">*</span>
            </label>
            <input type="number" 
                   id="age" 
                   name="age" 
                   x-model="formData.age"
                   required
                   min="1"
                   max="150"
                   class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs text-input-gray placeholder:text-input-gray shadow-inner"
                   placeholder="Select number">
        </div>

        <!-- Region -->
        <div>
            <label for="region" class="block text-black text-xs font-bold mb-1">
                Region of Residence: <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="region" 
                   name="region" 
                   x-model="formData.region"
                   required
                   class="w-full px-3 py-2 bg-gray-100 border border-input-gray rounded text-xs shadow-inner text-input-gray"
                   readonly>
        </div>

        <!-- Campus -->
        <div>
            <label for="campus" class="block text-black text-xs font-bold mb-1">
                Campus: <span class="text-red-500">*</span>
            </label>
            <select 
                id="campus" 
                name="campus" 
                x-model="formData.campus"
                required
                class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs shadow-inner"
                @change="onCampusChange($event.target.value)">
                <option value="" disabled>Select campus</option>
                <option value="UEP Main Campus (Catarman)">UEP Main Campus (Catarman)</option>
                <option value="UEP Laoang Campus">UEP Laoang Campus</option>
                <option value="UEP Catubig Campus">UEP Catubig Campus</option>
            </select>
        </div>

        <!-- Office (dependent on campus) -->
        <div>
            <label for="office" class="block text-black text-xs font-bold mb-1">
                Office: <span class="text-red-500">*</span>
            </label>
            <select
                id="office"
                name="office"
                x-model="formData.office"
                :disabled="!formData.campus"
                required
                class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs shadow-inner disabled:bg-gray-100 disabled:text-gray-400"
            >
                <option value="" disabled>Select office</option>
                <template x-for="office in campusOffices()" :key="office">
                    <option :value="office" x-text="office"></option>
                </template>
            </select>
        </div>

        <!-- Service Availed -->
        <div class="space-y-2">
            <label class="block text-black text-xs font-bold mb-1">
                Service Availed: <span class="text-red-500">*</span>
            </label>
            <select 
                class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs shadow-inner"
                @change="updateService($event.target.value)"
                :value="formData.service_choice || ''"
                :disabled="!formData.campus || !formData.office || !formData.client_type"
            >
                <option value="" disabled>Select a service</option>
                <template x-for="service in filteredServices()" :key="service">
                    <option :value="service" x-text="service"></option>
                </template>
                <option value="other">Other (please specify below)</option>
            </select>

            <div x-show="formData.service_choice === 'other'" class="space-y-1">
                <label for="service_other" class="block text-black text-xs font-bold">
                    Please specify:
                </label>
                <input type="text"
                       id="service_other"
                       class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs shadow-inner"
                       x-model="formData.service_other"
                       @input="formData.service_availed = formData.service_other"
                       placeholder="Describe the service">
            </div>

            <!-- Hidden field to submit the resolved value -->
            <input type="hidden" name="service_availed" :value="formData.service_availed">
        </div>
    </div>
</div>

