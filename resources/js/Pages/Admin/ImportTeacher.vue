<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trang quản trị</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Import danh sách giảng viên</h2>
        

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('import.store'))" class="mt-6 space-y-6">
                        <div>
                            <input type="file" class="form-control">
                        </div>
                   
                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                        </div>
                    </form>     
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
