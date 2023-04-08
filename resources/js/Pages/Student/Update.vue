<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import UpdateStudentForm from './Partials/UpdateStudentForm.vue';

const props = defineProps({
    student: Object,
});


const form = useForm({
    last_name: props.student.last_name,
    first_name: props.student.first_name,
    student_code: props.student.student_code,
    department: props.student.department,
    faculty: props.student.faculty,
    address: props.student.address,
    phone: props.student.phone,
    note: props.student.note,
});

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cài đặt tài khoản</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- <h1>{{ student }}</h1> -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- <UpdateStudentForm class="max-w-xl" /> -->
                    <div class="max-w-xl">
                        <UpdateStudentForm :student="student" />
                    </div>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
