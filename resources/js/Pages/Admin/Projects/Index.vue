<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import ConfirmModal from '@/Components/Admin/ConfirmModal.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    projects: Object,
    filters: Object,
});

const search = ref(props.filters.search ?? '');
const category = ref(props.filters.category ?? '');
const showDeleteModal = ref(false);
const deleteTargetId = ref(null);

const categories = ['Wedding', 'Event', 'Editorial', 'Commercial', 'Creative'];

let debounceTimer;
watch([search, category], () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        router.get('/admin/projects', {
            search: search.value || undefined,
            category: category.value || undefined,
        }, { preserveState: true, replace: true });
    }, 300);
});

function confirmDelete(id) {
    deleteTargetId.value = id;
    showDeleteModal.value = true;
}

function executeDelete() {
    router.delete(`/admin/projects/${deleteTargetId.value}`);
    showDeleteModal.value = false;
    deleteTargetId.value = null;
}
</script>

<template>
    <Head title="Portfolio Management" />
    <TopBar title="Portfolio" />

    <div class="px-12 py-10 space-y-8">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative flex-1 max-w-xs">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-muted text-lg">search</span>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search projects..."
                        class="w-full bg-surface border border-outline text-on-surface text-sm pl-10 pr-4 py-2.5 focus:border-primary focus:ring-0 placeholder-on-surface-muted"
                    />
                </div>
                <select
                    v-model="category"
                    class="bg-surface border border-outline text-on-surface text-sm px-4 py-2.5 focus:border-primary focus:ring-0"
                >
                    <option value="">All Categories</option>
                    <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
                </select>
            </div>
            <Link href="/admin/projects/create" class="flex items-center space-x-2 px-5 py-2.5 bg-primary text-white text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>Add Project</span>
            </Link>
        </div>

        <div class="bg-surface border border-outline">
            <table v-if="projects.data.length" class="w-full text-left">
                <thead class="bg-surface-container">
                    <tr class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted">
                        <th class="px-6 py-4">Project</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <tr v-for="project in projects.data" :key="project.id" class="hover:bg-surface-container transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-9 bg-surface-container overflow-hidden flex-shrink-0">
                                    <img v-if="project.cover_image" :src="project.cover_image" class="w-full h-full object-cover" />
                                </div>
                                <span class="text-sm text-on-surface font-medium">{{ project.title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-on-surface-variant uppercase tracking-wider">{{ project.category }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="text-[10px] font-bold uppercase px-2 py-1"
                                :class="project.is_published ? 'bg-success/10 text-success' : 'bg-surface-container text-on-surface-variant'"
                            >
                                {{ project.is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span v-if="project.is_featured" class="material-symbols-outlined text-primary text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <Link :href="`/admin/projects/${project.id}/edit`" class="inline-block text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </Link>
                            <button @click="confirmDelete(project.id)" class="text-on-surface-variant hover:text-error transition-colors">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-else class="px-6 py-10 text-center text-on-surface-muted text-sm">No projects found</p>
        </div>

        <div v-if="projects.last_page > 1" class="flex items-center justify-center gap-2">
            <Link
                v-for="link in projects.links"
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
        title="Delete Project"
        message="Are you sure you want to delete this project? This action cannot be undone."
        @confirm="executeDelete"
        @cancel="showDeleteModal = false"
    />
</template>
