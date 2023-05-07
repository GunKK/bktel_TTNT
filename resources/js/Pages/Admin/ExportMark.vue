<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

import { reactive } from 'vue';

defineProps({
    teachers: Object,
    subjects: Object
})

const currentYear = (new Date()).getFullYear();

const data = reactive({
    reports: [],
    year: null,
    semester: null,
    teacherId: null,
    subjectId: null,
});

const exportMark  = async (event) => {
    var year = event.target.getAttribute('data-year')
    var semester = event.target.getAttribute('data-semester')
    var teacherId = event.target.getAttribute('data-teacherId')
    var subjectId = event.target.getAttribute('data-subjectId')
    window.open('/admin/export.mark?year=' + year + '&semester=' + semester + '&teacherId=' + teacherId + '&subjectId=' + subjectId,'_blank')
};

</script>

<template>
    <Head title="Export Mark" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Export bảng điểm sinh viên</h2>
        
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div @submit.prevent="handelSubmit" class="flex items-center">   
                        <div>
                            <InputLabel class="mt-3" for="year" value="Năm học" />
                            <select id="year" v-model="data.year" class="rounded">
                                <option disabled value="">Please select one</option>
                                <option :value="currentYear-1">{{ currentYear - 1 }}</option>
                                <option :value="currentYear">{{ currentYear }}</option>
                                <option :value="currentYear+1">{{ currentYear + 1 }}</option>
                            </select>
                            <InputLabel class="mt-3" for="semester" value="Học kì" />
                            <select id="semester" v-model="data.semester" class="rounded">
                                <option disabled value="">Please select one</option>
                                <option value="HK1">HK1</option>
                                <option value="HK2">HK2</option>
                                <option value="HK3">HK3</option>
                            </select>
                            <InputLabel class="mt-3" for="teacherId" value="Giảng viên" />
                            <select id="teacherId" v-model="data.teacherId" class="rounded">
                                <option disabled value="">Please select one</option>
                                <option v-for="teacher in teachers" 
                                        :value="teacher.id"
                                >
                                    {{ teacher.last_name }} {{ teacher.first_name }}
                                </option>
                            </select>
                            <InputLabel class="mt-3" for="subjectId" value="Môn học" />
                            <select id="subjectId" v-model="data.subjectId" class="rounded">
                                <option disabled value="">Please select one</option>
                                <option v-for="subject in subjects" 
                                        :value="subject.id"
                                >
                                    {{ subject.code }} - {{ subject.name }}
                                </option>
                            </select>
                        </div>
            
                    </div>
            
                    <div class="mt-6 space-y-6">
                        <button 
                            v-bind:data-year="data.year" 
                            v-bind:data-semester="data.semester" 
                            v-bind:data-teacherId="data.teacherId" 
                            v-bind:data-subjectId="data.subjectId" 
                            @click="exportMark" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-4"
                        >
                            Export
                        </button>
                    </div>   
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>