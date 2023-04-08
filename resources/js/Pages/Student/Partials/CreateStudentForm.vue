<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
    last_name: user.last_name,
    first_name: user.first_name,
    student_code: user.student_code,
    department: user.department,
    faculty: user.faculty_code,
    address: user.address,
    phone: user.phone,
    note: user.note,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Thông tin sinh viên</h2>

            <p class="mt-1 text-sm text-gray-600">
                Cập nhật thông tin sinh viên
            </p>
        </header>

        <form @submit.prevent="form.post(route('student.store'))" class="mt-6 space-y-6">
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
                    required
                    autofocus
                    autocomplete="student_code"
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
    </section>
</template>
