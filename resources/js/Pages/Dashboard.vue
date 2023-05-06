<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head} from '@inertiajs/vue3';
import { Link, usePage } from '@inertiajs/vue3';
import UploadReport from '../Pages/Student/UploadReport.vue';
import SetMark from '../Pages/Teacher/SetMark.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trang chủ</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div v-if="usePage().props.auth.user.student_id == null" class="p-6 text-gray-900">Mời bạn nhập thông tin sinh viên <Link :href="route('student.create')" class="text-blue-600">Click here</Link></div>
                    <UploadReport />
                    <SetMark />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
