<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Link, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


import { reactive } from 'vue';

const data = reactive({
    subjects: [],
    q: null
});

const handelSubmit  = async () => {
    clearResults();
    try {
        const response = await axios.post('/api/search',{
            q: data.q
        });

        if(response.data.length != 0 ) {
            console.log(response.data)
            data.subjects = response.data
        } else {
            data.message = "Không tìm thấy môn học nào"
            console.log("Không tìm thấy môn học nào")
        }
    } catch(error) {
        console.log(error)
    }
};

const clearResults = () => {
    data.subjects = [];
    data.message = '';
}

const form = useForm({
    teacher_to_subjects_id: null,
    title: null,
    file: null,
})

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
                    <div v-if="usePage().props.auth.user.student_id != null" class="p-6 text-gray-900">
                        
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
                                    placeholder="Search teacher..." 
                                    required
                                    v-model="data.q"
                                />
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded ml-1">Search</button>
                        </form>

                        <InputError v-if="data.message" class="mt-2" :message="data.message" />

                        <form @submit.prevent="form.post(route('upload_report'))" class="mt-6 space-y-6">

                            <div v-for="subject in data.subjects">
                                <InputLabel 
                                    :id="subject.id" 
                                    :value="`${subject.code} ${subject.name} - Giảng viên giảng dạy: ${subject.last_name} ${subject.first_name} ${subject.semester} Năm học ${subject.year}`" 
                                />
                
                                <TextInput
                                    :key="subject.id"
                                    id="id"
                                    type="radio"
                                    class="mt-1"
                                    :value="subject.id"
                                    v-model="form.teacher_to_subjects_id"
                                />
                            </div>

                            <div>
                                <InputLabel for="title" value="Tên file nộp" />
                
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                    required
                                    autofocus
                                    autocomplete="title"
                                />

                                
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div>
    
                                <input type="file" @input="form.file = $event.target.files[0]" />
                            </div>
                            
                            <div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>
                
                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                
                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </div>
                    <div v-else-if="usePage().props.auth.user.student_id == null" class="p-6 text-gray-900">Mời bạn nhập thông tin sinh viên <Link :href="route('student.create')" class="text-blue-600">Click here</Link></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
