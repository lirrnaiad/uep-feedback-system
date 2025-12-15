<div>
    <h2 class="text-black text-xs font-bold mb-4">Service Quality Dimension</h2>
    
    <!-- Legend -->
    <div class="mb-4">
        <p class="text-black text-xs italic mb-2">Kindly rate the service based on the choices below:</p>
        <div class="text-black text-xs leading-tight">
            <div>5 - Strongly Agree</div>
            <div>4 - Agree</div>
            <div>3 - Neither Disagree nor Agree</div>
            <div>2 - Disagree</div>
            <div>1 - Strongly Disagree</div>
            <div>N/A - Not Applicable</div>
        </div>
    </div>

    <div class="space-y-6">
        @foreach($questions as $question)
        <div class="border-t border-gray-400 pt-4 first:border-t-0 first:pt-0">
            <label class="block text-black text-xs font-bold mb-3 leading-tight">
                {{ $question->code }}. {{ $question->text }} <span class="text-red-500">*</span>
            </label>
            
            <!-- Horizontal radio buttons -->
            <div class="flex items-center gap-2 flex-wrap">
                <!-- 5 - Strongly Agree -->
                <label class="flex items-center justify-center cursor-pointer relative radio-row sqd-option">
                    <input type="radio" 
                           name="responses[{{ $question->id }}]" 
                           value="5" 
                           x-model="formData.responses[{{ $question->id }}]"
                           required
                           class="absolute opacity-0 w-0 h-0">
                    <div class="w-[31px] h-[31px] border border-input-gray rounded-full flex items-center justify-center text-black text-sm font-bold transition-colors sqd-circle"
                         :class="formData.responses[{{ $question->id }}] == '5' ? 'bg-uep-blue border-uep-blue text-white shadow-md' : 'bg-white'">
                        5
                    </div>
                </label>

                <!-- 4 - Agree -->
                <label class="flex items-center justify-center cursor-pointer relative radio-row sqd-option">
                    <input type="radio" 
                           name="responses[{{ $question->id }}]" 
                           value="4" 
                           x-model="formData.responses[{{ $question->id }}]"
                           required
                           class="absolute opacity-0 w-0 h-0">
                    <div class="w-[31px] h-[31px] border border-input-gray rounded-full flex items-center justify-center text-black text-sm font-bold transition-colors sqd-circle"
                         :class="formData.responses[{{ $question->id }}] == '4' ? 'bg-uep-blue border-uep-blue text-white shadow-md' : 'bg-white'">
                        4
                    </div>
                </label>

                <!-- 3 - Neither Disagree nor Agree -->
                <label class="flex items-center justify-center cursor-pointer relative radio-row sqd-option">
                    <input type="radio" 
                           name="responses[{{ $question->id }}]" 
                           value="3" 
                           x-model="formData.responses[{{ $question->id }}]"
                           required
                           class="absolute opacity-0 w-0 h-0">
                    <div class="w-[31px] h-[31px] border border-input-gray rounded-full flex items-center justify-center text-black text-sm font-bold transition-colors sqd-circle"
                         :class="formData.responses[{{ $question->id }}] == '3' ? 'bg-uep-blue border-uep-blue text-white shadow-md' : 'bg-white'">
                        3
                    </div>
                </label>

                <!-- 2 - Disagree -->
                <label class="flex items-center justify-center cursor-pointer relative radio-row sqd-option">
                    <input type="radio" 
                           name="responses[{{ $question->id }}]" 
                           value="2" 
                           x-model="formData.responses[{{ $question->id }}]"
                           required
                           class="absolute opacity-0 w-0 h-0">
                    <div class="w-[31px] h-[31px] border border-input-gray rounded-full flex items-center justify-center text-black text-sm font-bold transition-colors sqd-circle"
                         :class="formData.responses[{{ $question->id }}] == '2' ? 'bg-uep-blue border-uep-blue text-white shadow-md' : 'bg-white'">
                        2
                    </div>
                </label>

                <!-- 1 - Strongly Disagree -->
                <label class="flex items-center justify-center cursor-pointer relative radio-row sqd-option">
                    <input type="radio" 
                           name="responses[{{ $question->id }}]" 
                           value="1" 
                           x-model="formData.responses[{{ $question->id }}]"
                           required
                           class="absolute opacity-0 w-0 h-0">
                    <div class="w-[31px] h-[31px] border border-input-gray rounded-full flex items-center justify-center text-black text-sm font-bold transition-colors sqd-circle"
                         :class="formData.responses[{{ $question->id }}] == '1' ? 'bg-uep-blue border-uep-blue text-white shadow-md' : 'bg-white'">
                        1
                    </div>
                </label>

                <!-- N/A -->
                <label class="flex items-center justify-center cursor-pointer relative radio-row sqd-option">
                    <input type="radio" 
                           name="responses[{{ $question->id }}]" 
                           value="0" 
                           x-model="formData.responses[{{ $question->id }}]"
                           required
                           class="absolute opacity-0 w-0 h-0">
                    <div class="w-[31px] h-[31px] border border-input-gray rounded-full flex items-center justify-center text-black text-xs font-bold transition-colors sqd-circle"
                         :class="formData.responses[{{ $question->id }}] == '0' ? 'bg-uep-blue border-uep-blue text-white shadow-md' : 'bg-white'">
                        N/A
                    </div>
                </label>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Suggestions -->
    <div class="mt-6">
        <label for="suggestions" class="block text-black text-xs font-bold mb-2 leading-tight">
            Suggestion on how we can further improve<br>
            our service (optional):
        </label>
        <textarea id="suggestions" 
                  name="suggestions" 
                  x-model="formData.suggestions"
                  rows="4"
                  class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs text-input-gray placeholder:text-input-gray"
                  placeholder="Enter text...."></textarea>
    </div>

    <!-- Email -->
    <div class="mt-4">
        <label for="email" class="block text-black text-xs font-bold mb-2">
            Email Address (optional):
        </label>
        <input type="email" 
               id="email" 
               name="email" 
               x-model="formData.email"
               class="w-full px-3 py-2 bg-white border border-input-gray rounded text-xs text-input-gray placeholder:text-input-gray"
               placeholder="abc@gmail.com">
    </div>

    <!-- Thank you message -->
    <div class="mt-6 text-center">
        <p class="text-black text-lg font-cedarville leading-tight">Help us serve better<br>Thank you!</p>
    </div>
</div>
