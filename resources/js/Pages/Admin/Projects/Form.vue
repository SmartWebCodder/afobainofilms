<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import { computed } from 'vue';

const props = defineProps({
    project: { type: Object, default: null },
});

const isEditing = computed(() => !!props.project);

const form = useForm({
    title: props.project?.title ?? '',
    category: props.project?.category ?? '',
    description: props.project?.description ?? '',
    cover_image: props.project?.cover_image ?? '',
    gallery: props.project?.gallery ?? [],
    youtube_url: props.project?.youtube_url ?? '',
    tags: props.project?.tags ?? [],
    is_featured: props.project?.is_featured ?? false,
    is_published: props.project?.is_published ?? false,
});

const categories = ['Wedding', 'Event', 'Editorial', 'Commercial', 'Creative'];

const tagInput = computed({
    get: () => (form.tags ?? []).join(', '),
    set: (val) => { form.tags = val.split(',').map(t => t.trim()).filter(Boolean); },
});

function submit() {
    if (isEditing.value) {
        form.put(`/admin/projects/${props.project.id}`);
    } else {
        form.post('/admin/projects');
    }
}
</script>

<template>
    <Head :title="isEditing ? 'Edit Project' : 'New Project'" />
    <TopBar :title="isEditing ? 'Edit Project' : 'New Project'" />

    <form @submit.prevent="submit" class="px-12 py-10 max-w-3xl space-y-8">
        <div class="bg-[#1c1b1b] border border-white/5 p-8 space-y-6">
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Title</label>
                <input
                    v-model="form.title"
                    type="text"
                    class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0"
                />
                <p v-if="form.errors.title" class="text-error text-xs mt-1">{{ form.errors.title }}</p>
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Category</label>
                <select
                    v-model="form.category"
                    class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0"
                >
                    <option value="" disabled>Select category</option>
                    <option v-for="cat in categories" :key="cat" :value="cat" class="bg-[#1c1b1b]">{{ cat }}</option>
                </select>
                <p v-if="form.errors.category" class="text-error text-xs mt-1">{{ form.errors.category }}</p>
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Description</label>
                <textarea
                    v-model="form.description"
                    rows="4"
                    class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0 resize-none"
                ></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Cover Image URL</label>
                <input
                    v-model="form.cover_image"
                    type="text"
                    placeholder="https://..."
                    class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-white/20"
                />
                <div v-if="form.cover_image" class="mt-3 w-32 h-24 bg-white/5 overflow-hidden">
                    <img :src="form.cover_image" class="w-full h-full object-cover" />
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">YouTube URL</label>
                <input
                    v-model="form.youtube_url"
                    type="text"
                    placeholder="https://youtube.com/..."
                    class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-white/20"
                />
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-white/50 mb-2">Tags (comma-separated)</label>
                <input
                    v-model="tagInput"
                    type="text"
                    placeholder="wedding, outdoor, luxury"
                    class="w-full bg-transparent border-0 border-b border-white/10 text-white px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-white/20"
                />
            </div>

            <div class="flex items-center gap-8 pt-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input v-model="form.is_published" type="checkbox" class="bg-transparent border-white/20 text-primary focus:ring-primary/50 rounded" />
                    <span class="text-xs text-white/60">Published</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input v-model="form.is_featured" type="checkbox" class="bg-transparent border-white/20 text-primary focus:ring-primary/50 rounded" />
                    <span class="text-xs text-white/60">Featured</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button
                type="submit"
                :disabled="form.processing"
                class="px-8 py-3 bg-primary text-black text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors disabled:opacity-50"
            >
                {{ form.processing ? 'Saving...' : (isEditing ? 'Update Project' : 'Create Project') }}
            </button>
            <Link href="/admin/projects" class="px-8 py-3 border border-white/10 text-white/50 text-xs font-bold uppercase tracking-widest hover:text-white transition-colors">
                Cancel
            </Link>
        </div>
    </form>
</template>
