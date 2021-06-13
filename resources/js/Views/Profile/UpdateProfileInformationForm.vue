<template>
    <action-section>
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #content>
            <form @submit.prevent="updateProfileInformation">
                <div class="lg:grid lg:grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview">

                        <div class="flex items-center">
                            <div v-show="! photoPreview">
                                <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                            </div>

                            <div class="mt-2" v-show="photoPreview">
                                <span class="block rounded-full w-20 h-20"
                                    :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <div class="ml-4">
                                <div class="flex items-center">
                                    <app-button type="button" mode="secondary" @click.prevent="selectNewPhoto">
                                        Change
                                    </app-button>

                                    <app-button class="ml-4" type="button" mode="secondary" @click.prevent="deletePhoto" v-if="user.profile_photo_path">
                                        Remove
                                    </app-button>
                                </div>

                                <app-input-error :message="form.errors.photo" class="mt-2"></app-input-error>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-8">
                        <app-input type="text" v-model="form.name" :error="form.errors.name" label="Full name" placeholder="Johnathan Doeford"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="text" v-model="form.username" :error="form.errors.username" label="Username" placeholder="JohnDoe"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="email" v-model="form.email" :error="form.errors.email" label="Email address" placeholder="john.doe@example.com"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="tel" v-model="form.phone" :error="form.errors.phone" label="Phone number" placeholder="07xxxxxxxx"></app-input>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <action-message :on="form.recentlySuccessful" class="mr-4">
                        Changes saved. <span class="ml-1">&check;</span>
                    </action-message>

                    <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                        Save changes <span class="ml-1">&rarr;</span>
                    </app-button>
                </div>
            </form>
        </template>
    </action-section>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppInput from '@/Views/Components/Inputs/Input';
import AppInputError from '@/Views/Components/Inputs/InputError';
import AppButton from '@/Views/Components/Buttons/Button';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';

export default {
    props: ['user'],

    components: {
        ActionSection,
        AppInput,
        AppInputError,
        AppButton,
        ActionMessage
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.user.name,
                username: this.user.username,
                email: this.user.email,
                phone: this.user.phone,
                photo: null
            }),

            photoPreview: null,
        }
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(this.route('user.update'), {
                errorBag: 'updateProfileInformation',
                preserveScroll: true,
                onSuccess: () => (this.clearPhotoFileInput()),
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const photo = this.$refs.photo.files[0];

            if (! photo) return;

            const reader = new FileReader();

            reader.onload = event => this.photoPreview = event.target.result;

            reader.readAsDataURL(photo);
        },

        deletePhoto() {
            this.$inertia.delete(this.route('user-photo.destroy'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.photoPreview = null;
                    this.clearPhotoFileInput();
                }
            });
        },

        clearPhotoFileInput() {
            if (this.$refs.photo?.value) {
                this.$refs.photo.value = null;
            }
        },
    }
}
</script>
