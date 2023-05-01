<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;


const form = useForm({
  name: null,
  code: null,
  note: null
})
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Môn Học</h2>

            <p class="mt-1 text-sm text-gray-600">
                Tạo mới môn học <small>Vùi lòng điền form sau</small>
            </p>
        </header>

        <form @submit.prevent="form.post(route('subject.store'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Tên môn học" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="code" value="Mã số môn học" />

                <TextInput
                    id="code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code"
                    required
                    autofocus
                    autocomplete="code"
                />

                <InputError class="mt-2" :message="form.errors.code" />
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
