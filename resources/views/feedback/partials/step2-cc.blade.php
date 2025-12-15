<div>
    <h2 class="text-black text-xs font-bold mb-4">Citizen's Charter (CC)</h2>
    
    <div class="space-y-4">
        <!-- CC1: Awareness -->
        <div>
            <label class="block text-black text-xs font-bold mb-2 leading-tight">
                CC1. Which of the following best describes your<br>
                awareness of a Citizen's Charter (CC)? <span class="text-red-500">*</span>
            </label>
            <div class="space-y-3">
                <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                    <input type="radio" 
                           name="cc1_awareness" 
                           value="1" 
                           x-model="formData.cc1_awareness"
                           @change="if (formData.cc1_awareness == '4') { formData.cc2_visibility = '0'; formData.cc3_helpfulness = '0'; }"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">I know what a CC is and I saw this office's CC.</span>
                </label>
                <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                    <input type="radio" 
                           name="cc1_awareness" 
                           value="2" 
                           x-model="formData.cc1_awareness"
                           @change="if (formData.cc1_awareness == '4') { formData.cc2_visibility = '0'; formData.cc3_helpfulness = '0'; }"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">I know what a CC is but I did NOT see this office's CC.</span>
                </label>
                <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                    <input type="radio" 
                           name="cc1_awareness" 
                           value="3" 
                           x-model="formData.cc1_awareness"
                           @change="if (formData.cc1_awareness == '4') { formData.cc2_visibility = '0'; formData.cc3_helpfulness = '0'; }"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs">I learned of the CC only when I saw this office's CC.</span>
                </label>
                <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                    <input type="radio" 
                           name="cc1_awareness" 
                           value="4" 
                           x-model="formData.cc1_awareness"
                           @change="formData.cc2_visibility = '0'; formData.cc3_helpfulness = '0';"
                           required
                           class="radio-uep">
                    <span class="text-black text-xs leading-tight">I do not know what a CC is and I did not see one in this office. (If this is selected, answer 'N/A' on CC2 and CC3)</span>
                </label>
            </div>
        </div>

        <!-- CC2: Visibility -->
        <template x-if="formData.cc1_awareness != '4'">
            <div>
                <label class="block text-black text-xs font-bold mb-2 leading-tight">
                    CC2. If aware of Citizen's Charter (answered 1-3 in CC1),<br>
                    would you say that the CC of this office was...? <span class="text-red-500">*</span>
                </label>
                <div class="space-y-3">
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc2_visibility" 
                               value="1" 
                               x-model="formData.cc2_visibility"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Easy to see</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc2_visibility" 
                               value="2" 
                               x-model="formData.cc2_visibility"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Somewhat easy to see</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc2_visibility" 
                               value="3" 
                               x-model="formData.cc2_visibility"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Difficult to see</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc2_visibility" 
                               value="4" 
                               x-model="formData.cc2_visibility"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Not visible at all</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc2_visibility" 
                               value="0" 
                               x-model="formData.cc2_visibility"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">N/A</span>
                    </label>
                </div>
            </div>
        </template>

        <!-- Hidden input for CC2 when N/A -->
        <template x-if="formData.cc1_awareness == '4'">
            <input type="hidden" 
                   name="cc2_visibility" 
                   value="0">
        </template>

        <!-- CC3: Helpfulness -->
        <template x-if="formData.cc1_awareness != '4'">
            <div>
                <label class="block text-black text-xs font-bold mb-2 leading-tight">
                    CC3. If aware of Citizen's Charter (answered 1-3 in CC1),<br>
                    how much did the CC help you in your transactions? <span class="text-red-500">*</span>
                </label>
                <div class="space-y-3">
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc3_helpfulness" 
                               value="1" 
                               x-model="formData.cc3_helpfulness"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Helped very much</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc3_helpfulness" 
                               value="2" 
                               x-model="formData.cc3_helpfulness"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Somewhat helped</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc3_helpfulness" 
                               value="3" 
                               x-model="formData.cc3_helpfulness"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">Did not help</span>
                    </label>
                    <label class="flex items-start gap-2 cursor-pointer leading-snug radio-row">
                        <input type="radio" 
                               name="cc3_helpfulness" 
                               value="0" 
                               x-model="formData.cc3_helpfulness"
                               required
                               class="radio-uep">
                        <span class="text-black text-xs">N/A</span>
                    </label>
                </div>
            </div>
        </template>

        <!-- Hidden input for CC3 when N/A -->
        <template x-if="formData.cc1_awareness == '4'">
            <input type="hidden" 
                   name="cc3_helpfulness" 
                   value="0">
        </template>
    </div>
</div>

