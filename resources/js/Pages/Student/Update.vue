<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
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
        <h1>{{ student }}</h1>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- <h1>{{ student }}</h1> -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- <UpdateStudentForm class="max-w-xl" /> -->
                    <div class="max-w-xl">
                        <UpdateStudentForm :student="student" />
                        <!-- <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Thông tin sinh viên</h2>
                    
                                <p class="mt-1 text-sm text-gray-600">
                                    Cập nhật thông tin sinh viên
                                </p>
                            </header>
                    
                            <form @submit.prevent="form.put(route('student.update',{id: props.student.id}))" class="mt-6 space-y-6">
                                <div>
                                    <InputLabel for="last_name" value="Họ" />
                    
                                    <TextInput
                                        id="last_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.last_name"
                                        required
                                        autofocus
                                        autocomplete="last_name"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.last_name" />
                                </div>
                    
                                <div>
                                    <InputLabel for="first_name" value="Tên" />
                    
                                    <TextInput
                                        id="first_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.first_name"
                                        required
                                        autofocus
                                        autocomplete="first_name"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.first_name" />
                                </div>
                    
                                <div>
                                    <InputLabel for="student_code" value="Mã số sinh viên" />
                    
                                    <TextInput
                                        id="student_code"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.student_code"
                                        autofocus
                                        autocomplete="student_code"
                                        disabled
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.student_code" />
                                </div>
                    
                                <div>
                                    <InputLabel for="department" value="Khoa" />
                    
                                    <TextInput
                                        id="department"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.department"
                                        required
                                        autofocus
                                        autocomplete="department"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.department" />
                                </div>
                    
                                <div>
                                    <InputLabel for="faculty" value="Bộ Môn" />
                    
                                    <TextInput
                                        id="faculty"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.faculty"
                                        required
                                        autofocus
                                        autocomplete="faculty"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.faculty" />
                                </div>
                    
                                <div>
                                    <InputLabel for="address" value="Địa chỉ" />
                    
                                    <TextInput
                                        id="address"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.address"
                                        required
                                        autofocus
                                        autocomplete="address"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.address" />
                                </div>
                    
                                <div>
                                    <InputLabel for="phone" value="Số điện thoại" />
                    
                                    <TextInput
                                        id="phone"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.phone"
                                        required
                                        autofocus
                                        autocomplete="phone"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.phone" />
                                </div>
                    
                                <div>
                                    <InputLabel for="note" value="Ghi chú" />
                    
                                    <TextInput
                                        id="note"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.note"
                                        autofocus
                                        autocomplete="note"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.note" />
                                </div>
                    
                    
                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                    
                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                    </Transition>
                                </div>
                            </form>
                        </section> -->
                    </div>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
