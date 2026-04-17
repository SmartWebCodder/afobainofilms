<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import { ref } from 'vue';

const props = defineProps({
    settings: Object,
    user: Object,
});

const activeTab = ref('site');

const siteForm = useForm({ ...props.settings });

const profileForm = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
});

function saveSite() {
    siteForm.put('/admin/settings/site');
}

function saveProfile() {
    profileForm.put('/admin/settings/profile', {
        onSuccess: () => {
            profileForm.password = '';
            profileForm.password_confirmation = '';
        },
    });
}

const siteFields = [
    { key: 'site_title', label: 'Site Title', type: 'text' },
    { key: 'tagline', label: 'Tagline', type: 'text' },
    { key: 'logo_url', label: 'Logo URL', type: 'text' },
    { key: 'contact_email', label: 'Contact Email', type: 'email' },
    { key: 'whatsapp_number', label: 'WhatsApp Number', type: 'text' },
    { key: 'instagram_url', label: 'Instagram URL', type: 'url' },
    { key: 'youtube_url', label: 'YouTube URL', type: 'url' },
    { key: 'tiktok_url', label: 'TikTok URL', type: 'url' },
    { key: 'facebook_url', label: 'Facebook URL', type: 'url' },
];
</script>

<template>
    <Head title="Settings" />
    <TopBar title="Settings" />

    <div class="px-12 py-10 max-w-3xl space-y-8">
        <div class="flex gap-1 border-b border-white/5 pb-px">
            <button
                @click="activeTab = 'site'"
                class="px-4 py-2.5 text-xs font-sans uppercase tracking-widest transition-colors border-b-2 -mb-px"
                :class="activeTab === 'site' ? 'border-primary text-primary' : 'border-transparent text-white/40 hover:text-white'"
            >
                Site Settings
            </button>
            <button
                @click="activeTab = 'profile'"
                class="px-4 py-2.5 text-xs font-sans uppercase tracking-widest transition-colors border-b-2 -mb-px"
                :class="activeTab === 'profile' ? 'border-primary text-primary' : 'border-transparent text-white/40 hover:text-white'"
            >
                Profile
            </button>
        </div>

        <form v-if="activeTab === 'site'" @submit.prevent="saveSite" class="space-y-8">
            <div class="bg-[#1c1b1b] border border-white/5 p-8 space-y-6">
                <div v-for="field in siteFields" :key="field.key">
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">{{ field.label }}</label>
                    <input
                        v-model="siteForm[field.key]"
                        :type="field.type"
                        class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-white/20"
                    />
                    <p v-if="siteForm.errors[field.key]" class="text-error text-xs mt-1">{{ siteForm.errors[field.key] }}</p>
                </div>
            </div>

            <button
                type="submit"
                :disabled="siteForm.processing"
                class="px-8 py-3 bg-primary text-black text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors disabled:opacity-50"
            >
                {{ siteForm.processing ? 'Saving...' : 'Save Settings' }}
            </button>
        </form>

        <form v-if="activeTab === 'profile'" @submit.prevent="saveProfile" class="space-y-8">
            <div class="bg-[#1c1b1b] border border-white/5 p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Name</label>
                    <input
                        v-model="profileForm.name"
                        type="text"
                        class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0"
                    />
                    <p v-if="profileForm.errors.name" class="text-error text-xs mt-1">{{ profileForm.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Email</label>
                    <input
                        v-model="profileForm.email"
                        type="email"
                        class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0"
                    />
                    <p v-if="profileForm.errors.email" class="text-error text-xs mt-1">{{ profileForm.errors.email }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">New Password (leave blank to keep current)</label>
                    <input
                        v-model="profileForm.password"
                        type="password"
                        class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0"
                    />
                    <p v-if="profileForm.errors.password" class="text-error text-xs mt-1">{{ profileForm.errors.password }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Confirm Password</label>
                    <input
                        v-model="profileForm.password_confirmation"
                        type="password"
                        class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0"
                    />
                </div>
            </div>

            <button
                type="submit"
                :disabled="profileForm.processing"
                class="px-8 py-3 bg-primary text-black text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors disabled:opacity-50"
            >
                {{ profileForm.processing ? 'Saving...' : 'Update Profile' }}
            </button>
        </form>
    </div>
</template>
