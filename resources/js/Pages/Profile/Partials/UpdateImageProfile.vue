<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import UserLogo from '@/Components/UserLogo.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
    profile_images: user.profile_images
});
</script>
<template>
    <form @submit.prevent="form.post(route('profile.update_img'))">
        <div class="mb-5">
            <InputLabel for="img_profile" value="Ảnh đại diện" />
            
            <div v-if="user.profile_images != null">
                <img 
                    :src="'/storage/app/public/profiles/'+ user.id +'/' + user.profile_images"
                    v-bind:alt="user.profile_images" 
                    class="w-full" 
                />
            </div>
            
            <div v-else class="w-28">
                <UserLogo />
            </div>
    
            <input id="profile_images" type="file" @input="form.profile_images = $event.target.files[0]" />
            <InputError class="mt-2" :message="form.errors.profile_images" />
        </div>
        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
    
            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
        </div>
    </form>
</template>