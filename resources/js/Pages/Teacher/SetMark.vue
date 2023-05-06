<script setup>

import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { reactive } from 'vue';

const data = reactive({
    reports: [],
    q: null,
});

const handelSubmit  = async () => {
    clearResults();
    try {
        const response = await axios.post('teacher/api/search',{
            q: data.q
        });

        if(response.data.length != 0 ) {
            console.log(response.data)
            data.reports = response.data
        } else {
            data.message = "Không tìm thấy báo cáo nào"
            console.log("Không tìm thấy báo cáo nào")
        }
    } catch(error) {
        console.log(error)
    }
};

const clearResults = () => {
    data.subjects = [];
    data.message = '';
    data.pdf = [];
}

const viewReport  = async (event) => {
    var path = event.target.getAttribute('data-path')
    window.open('/api/view.report?path=' + path ,'_blank')
};

const downloadReport  = async (event) => {
    // console.log(event.target.getAttribute('data-path'))\
    var path = event.target.getAttribute('data-path')
    window.open('/api/download.report?path=' + path ,'_blank')
};


const form = useForm({
    report_id: null,
    mark: null,
})

</script>

<template>
    <div v-if="usePage().props.auth.user.teacher_id != null" class="p-6 text-gray-900">
                        
        <form @submit.prevent="handelSubmit" class="flex items-center">   
            <label for="voice-search" class="sr-only">Search</label>
            
            <div class="relative w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input 
                    type="text" 
                    id="voice-search" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                    placeholder="Search report..." 
                    required
                    v-model="data.q"
                />
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded ml-1">Search</button>
        </form>

        <InputError v-if="data.message" class="mt-2" :message="data.message" />

        <form @submit.prevent="form.post(route('teacher.setmark'))" class="mt-6 space-y-6">
            <div v-for="report in data.reports">
                <InputLabel 
                    :id="report.id" 
                    :value="`${report.code} ${report.name} - Sinh viên: ${report.last_name} ${report.first_name} -Tiêu đề: ${report.title} - ${report.semester}/${report.year}`" 
                />

                <TextInput
                    :key="report.id"
                    id="id"
                    type="radio"
                    class="mt-1"
                    :value="report.id"
                    v-model="form.report_id"
                />

                <div>
                    {{ report.path }}
                    <div>
                        <button v-bind:data-path="report.path" @click="viewReport" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">View</button>
                        <button v-bind:data-path="report.path" @click="downloadReport" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-4">Download</button>
                    </div>
                </div>
            </div>

            <div>
                <InputLabel for="mark" value="Điểm" />

                <TextInput
                    id="mark"
                    type="number"
                    step="any"
                    class="mt-1 block w-full"
                    v-model="form.mark"
                />

                
                <InputError class="mt-2" :message="form.errors.mark" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </div>
</template>