<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import ConfirmModal from '@/Components/Admin/ConfirmModal.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    messages: Object,
    filters: Object,
    unreadCount: Number,
});

const search = ref(props.filters.search ?? '');
const status = ref(props.filters.status ?? '');
const showDeleteModal = ref(false);
const deleteTargetId = ref(null);

const statusOptions = [
    { label: 'All', value: '' },
    { label: 'Unread', value: 'unread' },
    { label: 'Read', value: 'read' },
    { label: 'Starred', value: 'starred' },
    { label: 'Archived', value: 'archived' },
];

const statusColors = {
    unread: 'bg-secondary',
    read: 'bg-primary',
    starred: 'bg-yellow-400',
    archived: 'bg-on-surface-muted',
};

let debounceTimer;
watch([search, status], () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        router.get('/admin/messages', {
            search: search.value || undefined,
            status: status.value || undefined,
        }, { preserveState: true, replace: true });
    }, 300);
});

function confirmDelete(id) {
    deleteTargetId.value = id;
    showDeleteModal.value = true;
}

function executeDelete() {
    router.delete(`/admin/messages/${deleteTargetId.value}`);
    showDeleteModal.value = false;
    deleteTargetId.value = null;
}
</script>

<template>
    <Head title="Messages" />
    <TopBar title="Messages" />

    <div class="px-12 py-10 space-y-8">
        <div class="flex items-center gap-4">
            <div class="relative flex-1 max-w-xs">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-muted text-lg">search</span>
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search by name or email..."
                    class="w-full bg-surface border border-outline text-on-surface text-sm pl-10 pr-4 py-2.5 focus:border-primary focus:ring-0 placeholder-on-surface-muted"
                />
            </div>
            <div class="flex gap-1">
                <button
                    v-for="opt in statusOptions"
                    :key="opt.value"
                    @click="status = opt.value"
                    class="px-3 py-1.5 text-[10px] font-sans uppercase tracking-widest transition-colors"
                    :class="status === opt.value ? 'bg-primary text-white' : 'text-on-surface-muted hover:text-on-surface'"
                >
                    {{ opt.label }}
                </button>
            </div>
        </div>

        <div class="space-y-3">
            <template v-if="messages.data.length">
                <Link
                    v-for="msg in messages.data"
                    :key="msg.id"
                    :href="`/admin/messages/${msg.id}`"
                    class="flex items-center justify-between p-5 bg-surface border border-outline hover:border-primary/20 transition-colors"
                >
                    <div class="flex items-center space-x-4 flex-1 min-w-0">
                        <div class="w-10 h-10 bg-surface-container flex items-center justify-center text-xs font-bold text-primary flex-shrink-0">
                            {{ msg.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <span class="inline-block w-2 h-2 rounded-full flex-shrink-0" :class="statusColors[msg.status]"></span>
                                <p class="text-sm text-on-surface font-medium truncate">{{ msg.name }}</p>
                            </div>
                            <p class="text-xs text-on-surface-muted truncate">{{ msg.email }}</p>
                        </div>
                        <div class="hidden md:block text-xs text-on-surface-muted uppercase tracking-wider px-4">{{ msg.event_type ?? '—' }}</div>
                        <p class="text-xs text-on-surface-muted truncate max-w-xs hidden lg:block">{{ msg.vision ?? '' }}</p>
                    </div>
                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                        <span class="text-[10px] text-on-surface-muted">{{ msg.created_at }}</span>
                        <button
                            @click.prevent="confirmDelete(msg.id)"
                            class="text-on-surface-muted hover:text-error transition-colors"
                        >
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </div>
                </Link>
            </template>
            <p v-else class="py-10 text-center text-on-surface-muted text-sm">No messages found</p>
        </div>

        <div v-if="messages.last_page > 1" class="flex items-center justify-center gap-2">
            <Link
                v-for="link in messages.links"
                :key="link.label"
                :href="link.url"
                class="px-3 py-1.5 text-xs"
                :class="link.active ? 'bg-primary text-white' : link.url ? 'text-on-surface-variant hover:text-primary' : 'text-on-surface-muted pointer-events-none'"
                v-html="link.label"
            />
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
