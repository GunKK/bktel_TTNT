<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;


const form = useForm({
  teacher_id: null,
  subject_id: null,
  semester: null,
  year: null,
})

const props = defineProps({
    teachers: Object,
    subjects: Object,
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Lịch giảng dạy</h2>

            <p class="mt-1 text-sm text-gray-600">
                Tạo mới lịch giảng dạy <small>Vui lòng điền form sau</small>
            </p>
        </header>

        <form @submit.prevent="form.post(route('teacherToSubjects.store'))" class="mt-6 space-y-6">

            <div>
                <InputLabel for="subject" value="Tên môn học" />

                <TextInput
                    id="subject"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.subject_id"
                    required
                    autofocus
                    autocomplete="subject"
                    list="subject_input"
                />
                <datalist id="subject_input">
                    <option  
                        v-for="subject in subjects"
                        :value="subject.id"
                    >
                        {{ subject.code }} - {{ subject.name }}
                    </option>
                </datalist>

                <InputError class="mt-2" :message="form.errors.subject_id" />
            </div>

            <div>
                <InputLabel for="teacher" value="Tên môn học" />

                <TextInput
                    id="teacher"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.teacher_id"
                    required
                    autofocus
                    autocomplete="subject"
                    list="teacher_input"
                />
                <datalist id="teacher_input">
                    <option  
                        v-for="teacher in teachers"
                        :value="teacher.id"
                    >
                        {{ teacher.teacher_code }} - {{ teacher.first_name }} {{ teacher.last_name }}
                    </option>
                </datalist>

                <InputError class="mt-2" :message="form.errors.teacher" />
            </div>

            <div>
                <InputLabel for="semester" value="Học kì" />

                <select id="semester" v-model="form.semester" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="HK1">Học kì 1</option>
                    <option value="HK2">Học kì 2</option>
                    <option value="HK3">Học kì 3</option>
                </select>

                <InputError class="mt-2" :message="form.errors.semester" />
            </div>

            <div>
                <InputLabel for="year" value="Năm học" />

                <select id="semester" v-model="form.year" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>

                <InputError class="mt-2" :message="form.errors.year" />
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
