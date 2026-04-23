<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import ConfirmModal from '@/Components/Admin/ConfirmModal.vue';
import { ref } from 'vue';

const props = defineProps({
    testimonials: Object,
});

const showDeleteModal = ref(false);
const deleteTargetId = ref(null);

function confirmDelete(id) {
    deleteTargetId.value = id;
    showDeleteModal.value = true;
}

function executeDelete() {
    router.delete(`/admin/testimonials/${deleteTargetId.value}`);
    showDeleteModal.value = false;
    deleteTargetId.value = null;
}
</script>

<template>
    <Head title="Testimonials" />
    <TopBar title="Testimonials" />

    <div class="px-4 sm:px-6 lg:px-12 py-6 sm:py-10 space-y-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <p class="text-sm text-on-surface-variant">{{ testimonials.total }} testimonial{{ testimonials.total !== 1 ? 's' : '' }}</p>
            <Link href="/admin/testimonials/create" class="flex items-center space-x-2 px-5 py-2.5 bg-primary text-white text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>Add Testimonial</span>
            </Link>
        </div>

        <div class="bg-surface border border-outline overflow-x-auto">
            <table v-if="testimonials.data.length" class="w-full text-left min-w-[720px]">
                <thead class="bg-surface-container">
                    <tr class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted">
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Quote</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Order</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <tr v-for="t in testimonials.data" :key="t.id" class="hover:bg-surface-container transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm text-on-surface font-medium">{{ t.client_name }}</p>
                            <p v-if="t.location" class="text-xs text-on-surface-muted">{{ t.location }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant max-w-md truncate">{{ t.quote }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="text-[10px] font-bold uppercase px-2 py-1"
                                :class="t.is_active ? 'bg-success/10 text-success' : 'bg-surface-container text-on-surface-variant'"
                            >
                                {{ t.is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant">{{ t.sort_order }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <Link :href="`/admin/testimonials/${t.id}/edit`" class="inline-block text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </Link>
                            <button @click="confirmDelete(t.id)" class="text-on-surface-variant hover:text-error transition-colors">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-else class="px-6 py-10 text-center text-on-surface-muted text-sm">No testimonials yet</p>
        </div>

        <div v-if="testimonials.last_page > 1" class="flex items-center justify-center gap-2">
            <Link
                v-for="link in testimonials.links"
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
        title="Delete Testimonial"
        message="Are you sure you want to delete this testimonial? This action cannot be undone."
        @confirm="executeDelete"
        @cancel="showDeleteModal = false"
    />
</template>
