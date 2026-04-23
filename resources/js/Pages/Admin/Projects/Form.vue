<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import { ref, computed, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
    project: { type: Object, default: null },
});

const isEditing = computed(() => !!props.project);

function detectMediaType(project) {
    if (!project) return 'image';
    if (project.youtube_url) return 'youtube';
    if (project.video_url) return 'video';
    return 'image';
}

const mediaType = ref(detectMediaType(props.project));

const form = useForm({
    title: props.project?.title ?? '',
    category: props.project?.category ?? '',
    description: props.project?.description ?? '',
    cover_image: props.project?.cover_image ?? '',
    gallery: props.project?.gallery ?? [],
    youtube_url: props.project?.youtube_url ?? '',
    video_url: props.project?.video_url ?? '',
    tags: props.project?.tags ?? [],
    is_featured: props.project?.is_featured ?? false,
    is_published: props.project?.is_published ?? false,
});

const categories = ['Weddings', 'Events', 'Editorial', 'Commercial', 'Showreel', 'Creative'];

const tagInput = computed({
    get: () => (form.tags ?? []).join(', '),
    set: (val) => { form.tags = val.split(',').map(t => t.trim()).filter(Boolean); },
});

watch(mediaType, (type) => {
    if (type === 'image') { form.youtube_url = ''; form.video_url = ''; }
    else if (type === 'video') { form.youtube_url = ''; }
    else if (type === 'youtube') { form.video_url = ''; }
});

const imageUploading = ref(false);
const imageProgress = ref(0);

function onCoverImageSelect(event) {
    const file = event.target.files?.[0];
    if (!file) return;
    imageUploading.value = true;
    imageProgress.value = 0;
    const fd = new FormData();
    fd.append('image', file);
    axios.post('/admin/media/image', fd, {
        headers: { 'Content-Type': 'multipart/form-data' },
        onUploadProgress: (e) => { imageProgress.value = Math.round((e.loaded * 100) / (e.total || 1)); },
    })
    .then((res) => { form.cover_image = res.data.url; })
    .catch((err) => { alert(err.response?.data?.message || 'Image upload failed.'); })
    .finally(() => { imageUploading.value = false; imageProgress.value = 0; });
}

const galleryUploading = ref(false);

function onGalleryImagesSelect(event) {
    const files = event.target.files;
    if (!files?.length) return;
    galleryUploading.value = true;
    const uploads = Array.from(files).map((file) => {
        const fd = new FormData();
        fd.append('image', file);
        return axios.post('/admin/media/image', fd, {
            headers: { 'Content-Type': 'multipart/form-data' },
        }).then(res => res.data.url);
    });
    Promise.all(uploads)
        .then((urls) => { form.gallery = [...(form.gallery || []), ...urls]; })
        .catch(() => alert('One or more gallery images failed to upload.'))
        .finally(() => { galleryUploading.value = false; });
}

function removeGalleryImage(index) { form.gallery.splice(index, 1); }

const videoUploading = ref(false);
const videoProgress = ref(0);
const videoStatus = ref('');

function onVideoSelect(event) {
    const file = event.target.files?.[0];
    if (!file) return;
    videoUploading.value = true;
    videoProgress.value = 0;
    videoStatus.value = 'Compressing & uploading\u2026';
    const fd = new FormData();
    fd.append('video', file);
    axios.post('/admin/media/video', fd, {
        headers: { 'Content-Type': 'multipart/form-data' },
        timeout: 600000,
        onUploadProgress: (e) => {
            videoProgress.value = Math.round((e.loaded * 100) / (e.total || 1));
            if (videoProgress.value >= 100) { videoStatus.value = 'Processing on server\u2026 this may take a few minutes'; }
        },
    })
    .then((res) => {
        form.video_url = res.data.url;
        if (!form.cover_image && res.data.thumbnail) { form.cover_image = res.data.thumbnail; }
        videoStatus.value = '';
    })
    .catch((err) => {
        alert(err.response?.data?.error || err.response?.data?.message || 'Video upload failed.');
        videoStatus.value = '';
    })
    .finally(() => { videoUploading.value = false; videoProgress.value = 0; });
}

function submit() {
    if (isEditing.value) { form.put(`/admin/projects/${props.project.id}`); }
    else { form.post('/admin/projects'); }
}
</script>

<template>
    <Head :title="isEditing ? 'Edit Project' : 'New Project'" />
    <TopBar :title="isEditing ? 'Edit Project' : 'New Project'" />

    <form @submit.prevent="submit" class="px-4 sm:px-6 lg:px-12 py-6 sm:py-10 max-w-3xl space-y-8">
        <div class="bg-surface border border-outline p-4 sm:p-8 space-y-6">

            <!-- Title -->
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Title</label>
                <input v-model="form.title" type="text" class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0" />
                <p v-if="form.errors.title" class="text-error text-xs mt-1">{{ form.errors.title }}</p>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Category</label>
                <select v-model="form.category" class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0">
                    <option value="" disabled>Select category</option>
                    <option v-for="cat in categories" :key="cat" :value="cat" class="bg-surface">{{ cat }}</option>
                </select>
                <p v-if="form.errors.category" class="text-error text-xs mt-1">{{ form.errors.category }}</p>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Description</label>
                <textarea v-model="form.description" rows="4" class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 resize-none"></textarea>
            </div>

            <!-- Media Type Selector -->
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Media Type</label>
                <div class="flex flex-wrap gap-2">
                    <button v-for="opt in [{ value: 'image', label: 'Image Upload', icon: 'image' }, { value: 'video', label: 'Video Upload', icon: 'videocam' }, { value: 'youtube', label: 'YouTube', icon: 'smart_display' }]" :key="opt.value" type="button" class="flex items-center gap-2 px-4 py-2.5 text-xs uppercase tracking-widest border transition-colors cursor-pointer" :class="mediaType === opt.value ? 'border-primary bg-primary/10 text-primary' : 'border-outline text-on-surface-variant hover:border-primary/50'" @click="mediaType = opt.value">
                        <span class="material-symbols-outlined text-base">{{ opt.icon }}</span>
                        {{ opt.label }}
                    </button>
                </div>
            </div>

            <!-- IMAGE UPLOAD SECTION -->
            <template v-if="mediaType === 'image'">
                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Cover Image</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 px-5 py-2.5 border border-dashed border-outline text-on-surface-variant text-xs uppercase tracking-widest hover:border-primary hover:text-primary transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-base">cloud_upload</span>
                            {{ imageUploading ? 'Uploading\u2026' : 'Choose Image' }}
                            <input type="file" accept="image/*" class="hidden" @change="onCoverImageSelect" :disabled="imageUploading" />
                        </label>
                        <div v-if="imageUploading" class="flex-1">
                            <div class="h-1 bg-outline/30 rounded overflow-hidden">
                                <div class="h-full bg-primary transition-all duration-300" :style="{ width: imageProgress + '%' }"></div>
                            </div>
                        </div>
                    </div>
                    <div v-if="form.cover_image" class="mt-3 w-40 h-28 bg-surface-container overflow-hidden relative group">
                        <img :src="form.cover_image" class="w-full h-full object-cover" />
                        <button type="button" @click="form.cover_image = ''" class="absolute top-1 right-1 w-6 h-6 bg-black/60 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                    <p v-if="form.errors.cover_image" class="text-error text-xs mt-1">{{ form.errors.cover_image }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Gallery Images</label>
                    <label class="inline-flex items-center gap-2 px-5 py-2.5 border border-dashed border-outline text-on-surface-variant text-xs uppercase tracking-widest hover:border-primary hover:text-primary transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-base">add_photo_alternate</span>
                        {{ galleryUploading ? 'Uploading\u2026' : 'Add Images' }}
                        <input type="file" accept="image/*" multiple class="hidden" @change="onGalleryImagesSelect" :disabled="galleryUploading" />
                    </label>
                    <div v-if="form.gallery?.length" class="mt-3 flex flex-wrap gap-2">
                        <div v-for="(url, i) in form.gallery" :key="i" class="w-20 h-16 bg-surface-container overflow-hidden relative group">
                            <img :src="url" class="w-full h-full object-cover" />
                            <button type="button" @click="removeGalleryImage(i)" class="absolute inset-0 bg-black/50 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <!-- VIDEO UPLOAD SECTION -->
            <template v-if="mediaType === 'video'">
                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Cover Thumbnail <span class="normal-case tracking-normal text-on-surface-muted">(auto-generated from video, or upload custom)</span></label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 px-5 py-2.5 border border-dashed border-outline text-on-surface-variant text-xs uppercase tracking-widest hover:border-primary hover:text-primary transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-base">cloud_upload</span>
                            {{ imageUploading ? 'Uploading\u2026' : 'Custom Thumbnail' }}
                            <input type="file" accept="image/*" class="hidden" @change="onCoverImageSelect" :disabled="imageUploading" />
                        </label>
                    </div>
                    <div v-if="form.cover_image" class="mt-3 w-40 h-28 bg-surface-container overflow-hidden relative group">
                        <img :src="form.cover_image" class="w-full h-full object-cover" />
                        <button type="button" @click="form.cover_image = ''" class="absolute top-1 right-1 w-6 h-6 bg-black/60 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Video File</label>
                    <label class="flex items-center gap-2 px-5 py-2.5 border border-dashed border-outline text-on-surface-variant text-xs uppercase tracking-widest hover:border-primary hover:text-primary transition-colors cursor-pointer w-fit">
                        <span class="material-symbols-outlined text-base">video_call</span>
                        {{ videoUploading ? 'Processing\u2026' : 'Choose Video' }}
                        <input type="file" accept="video/mp4,video/mov,video/avi,video/webm" class="hidden" @change="onVideoSelect" :disabled="videoUploading" />
                    </label>
                    <div v-if="videoUploading" class="mt-3 space-y-1">
                        <div class="h-1.5 bg-outline/30 rounded overflow-hidden">
                            <div class="h-full bg-primary transition-all duration-300" :style="{ width: videoProgress + '%' }"></div>
                        </div>
                        <p class="text-xs text-on-surface-variant">{{ videoStatus }}</p>
                    </div>
                    <div v-if="form.video_url && !videoUploading" class="mt-3 flex items-center gap-3 p-3 bg-surface-dim border border-outline/50">
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-on-surface truncate">Video uploaded</p>
                            <p class="text-[10px] text-on-surface-variant truncate">{{ form.video_url }}</p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- YOUTUBE SECTION -->
            <template v-if="mediaType === 'youtube'">
                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Cover Thumbnail</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 px-5 py-2.5 border border-dashed border-outline text-on-surface-variant text-xs uppercase tracking-widest hover:border-primary hover:text-primary transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-base">cloud_upload</span>
                            {{ imageUploading ? 'Uploading\u2026' : 'Choose Image' }}
                            <input type="file" accept="image/*" class="hidden" @change="onCoverImageSelect" :disabled="imageUploading" />
                        </label>
                    </div>
                    <div v-if="form.cover_image" class="mt-3 w-40 h-28 bg-surface-container overflow-hidden relative group">
                        <img :src="form.cover_image" class="w-full h-full object-cover" />
                        <button type="button" @click="form.cover_image = ''" class="absolute top-1 right-1 w-6 h-6 bg-black/60 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">YouTube URL</label>
                    <input v-model="form.youtube_url" type="url" placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-on-surface-muted" />
                    <p v-if="form.errors.youtube_url" class="text-error text-xs mt-1">{{ form.errors.youtube_url }}</p>
                </div>
            </template>

            <!-- Tags -->
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Tags (comma-separated)</label>
                <input v-model="tagInput" type="text" placeholder="wedding, outdoor, luxury" class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-on-surface-muted" />
            </div>

            <!-- Published / Featured -->
            <div class="flex items-center gap-8 pt-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input v-model="form.is_published" type="checkbox" class="bg-transparent border-outline text-primary focus:ring-primary/50 rounded" />
                    <span class="text-xs text-on-surface-variant">Published</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input v-model="form.is_featured" type="checkbox" class="bg-transparent border-outline text-primary focus:ring-primary/50 rounded" />
                    <span class="text-xs text-on-surface-variant">Featured</span>
                </label>
            </div>
        </div>

        <!-- Submit / Cancel -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
            <button type="submit" :disabled="form.processing || imageUploading || videoUploading" class="px-8 py-3 bg-primary text-black text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors disabled:opacity-50">
                {{ form.processing ? 'Saving\u2026' : (isEditing ? 'Update Project' : 'Create Project') }}
            </button>
            <Link href="/admin/projects" class="px-8 py-3 border border-outline text-on-surface-variant text-xs font-bold uppercase tracking-widest hover:text-on-surface transition-colors text-center">
                Cancel
            </Link>
        </div>
    </form>
</template>
