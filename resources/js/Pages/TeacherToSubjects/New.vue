<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateTeacherToSubjectsForm from './Partials/CreateTeacherToSubjectsForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    teachers: Object,
    subjects: Object,
});

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tạo mới đăng kí lịch giảng dạy</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateTeacherToSubjectsForm 
                        class="max-w-xl" 
                        :teachers="teachers"
                        :subjects="subjects"
                    />
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
