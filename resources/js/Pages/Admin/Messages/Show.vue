<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import ConfirmModal from '@/Components/Admin/ConfirmModal.vue';
import { ref } from 'vue';

const props = defineProps({
    message: Object,
});

const showDeleteModal = ref(false);

function updateStatus(status) {
    router.patch(`/admin/messages/${props.message.id}/status`, { status });
}

function confirmDelete() {
    showDeleteModal.value = true;
}

function executeDelete() {
    router.delete(`/admin/messages/${props.message.id}`);
    showDeleteModal.value = false;
}
</script>

<template>
    <Head :title="`Message from ${message.name}`" />
    <TopBar title="Message Detail" />

    <div class="px-12 py-10 max-w-3xl space-y-8">
        <Link href="/admin/messages" class="inline-flex items-center gap-1 text-xs text-on-surface-muted hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Back to Messages
        </Link>

        <div class="bg-surface border border-outline p-8 space-y-6">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-surface-container flex items-center justify-center text-lg font-bold text-primary">
                        {{ message.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-lg text-on-surface font-medium">{{ message.name }}</h3>
                        <a :href="`mailto:${message.email}`" class="text-sm text-primary hover:underline">{{ message.email }}</a>
                    </div>
                </div>
                <span class="text-xs text-on-surface-muted">{{ new Date(message.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-outline">
                <div>
                    <p class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted mb-1">Event Date</p>
                    <p class="text-sm text-on-surface">{{ message.event_date ? new Date(message.event_date).toLocaleDateString() : '—' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted mb-1">Event Venue</p>
                    <p class="text-sm text-on-surface">{{ message.event_venue || message.event_type || '—' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted mb-1">Referral Source</p>
                    <p class="text-sm text-on-surface">{{ message.referral_source || '—' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted mb-1">Status</p>
                    <p class="text-sm text-on-surface capitalize">{{ message.status }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-outline">
                <p class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted mb-3">Vision / Message</p>
                <p class="text-sm text-on-surface-variant leading-relaxed whitespace-pre-wrap">{{ message.vision || 'No message provided.' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a
                :href="`mailto:${message.email}`"
                class="px-6 py-2.5 bg-primary text-black text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors"
            >
                Reply via Email
            </a>
            <button
                @click="updateStatus('starred')"
                class="px-4 py-2.5 border border-outline text-on-surface-variant text-xs font-bold uppercase tracking-widest hover:text-primary hover:border-primary/20 transition-colors"
            >
                <span class="material-symbols-outlined text-sm align-middle mr-1">star</span>Star
            </button>
            <button
                @click="updateStatus('archived')"
                class="px-4 py-2.5 border border-outline text-on-surface-variant text-xs font-bold uppercase tracking-widest hover:text-primary hover:border-primary/20 transition-colors"
            >
                Archive
            </button>
            <button
                @click="confirmDelete"
                class="px-4 py-2.5 border border-outline text-error/70 text-xs font-bold uppercase tracking-widest hover:text-error hover:border-error/20 transition-colors ml-auto"
            >
                Delete
            </button>
        </div>
    </div>

    <ConfirmModal
        :show="showDeleteModal"
        title="Delete Message"
        message="Are you sure you want to delete this message? This action cannot be undone."
        @confirm="executeDelete"
        @cancel="showDeleteModal = false"
    />
</template>
