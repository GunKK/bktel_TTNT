<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';


const form = useForm({
    email: null,
    last_name: null,
    first_name: null,
    teacher_code: null,
    department: null,
    faculty: null,
    address: null,
    phone: null,
    note: null,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Tạo giảng viên</h2>

            <p class="mt-1 text-sm text-gray-600">
                Cập nhật thông tin giảng viên
            </p>
        </header>

        <form @submit.prevent="form.post(route('teacher.store'))" class="mt-6 space-y-6">

            <div>
                <InputLabel for="last_name" value="Email" />

                <TextInput
                    id="email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

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
                <InputLabel for="teacher_code" value="Mã số cán bộ" />

                <TextInput
                    id="teacher_code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.teacher_code"
                    required
                    autofocus
                    autocomplete="teacher_code"
                />

                <InputError class="mt-2" :message="form.errors.teacher_code" />
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
    </section>
</template>
