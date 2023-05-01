<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
  csv_import: null,
})

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Import danh sách sinh viên</h2>
        
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('import_student.store'))" class="mt-6 space-y-6">
                        <div>
    
                            <input type="file" @input="form.csv_import = $event.target.files[0]" />
                        </div>
                        
                        <div>
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                        </div>
    
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-1">Upload/Import</button>
    
                    </form>     
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
