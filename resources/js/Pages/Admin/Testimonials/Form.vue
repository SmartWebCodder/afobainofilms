<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';
import { computed } from 'vue';

const props = defineProps({
    testimonial: { type: Object, default: null },
});

const isEditing = computed(() => !!props.testimonial);

const form = useForm({
    client_name: props.testimonial?.client_name ?? '',
    location: props.testimonial?.location ?? '',
    quote: props.testimonial?.quote ?? '',
    sort_order: props.testimonial?.sort_order ?? 0,
    is_active: props.testimonial?.is_active ?? true,
});

function submit() {
    if (isEditing.value) {
        form.put(`/admin/testimonials/${props.testimonial.id}`);
    } else {
        form.post('/admin/testimonials');
    }
}
</script>

<template>
    <Head :title="isEditing ? 'Edit Testimonial' : 'New Testimonial'" />
    <TopBar :title="isEditing ? 'Edit Testimonial' : 'New Testimonial'" />

    <form @submit.prevent="submit" class="px-4 sm:px-6 lg:px-12 py-6 sm:py-10 max-w-3xl space-y-8">
        <div class="bg-surface border border-outline p-4 sm:p-8 space-y-6">
            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Client Name</label>
                <input
                    v-model="form.client_name"
                    type="text"
                    class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0"
                />
                <p v-if="form.errors.client_name" class="text-error text-xs mt-1">{{ form.errors.client_name }}</p>
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Location</label>
                <input
                    v-model="form.location"
                    type="text"
                    placeholder="e.g. Lake Como, September 2023"
                    class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-on-surface-muted"
                />
            </div>

            <div>
                <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Quote</label>
                <textarea
                    v-model="form.quote"
                    rows="4"
                    class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 resize-none"
                ></textarea>
                <p v-if="form.errors.quote" class="text-error text-xs mt-1">{{ form.errors.quote }}</p>
            </div>

            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Sort Order</label>
                    <input
                        v-model.number="form.sort_order"
                        type="number"
                        class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0"
                    />
                </div>
                <div class="flex items-end pb-3">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input v-model="form.is_active" type="checkbox" class="bg-transparent border-outline text-primary focus:ring-primary/50 rounded" />
                        <span class="text-xs text-on-surface-variant">Active</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
            <button
                type="submit"
                :disabled="form.processing"
                class="px-8 py-3 bg-primary text-white text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors disabled:opacity-50"
            >
                {{ form.processing ? 'Saving...' : (isEditing ? 'Update Testimonial' : 'Create Testimonial') }}
            </button>
            <Link href="/admin/testimonials" class="px-8 py-3 border border-outline text-on-surface-variant text-xs font-bold uppercase tracking-widest hover:text-on-surface transition-colors text-center">
                Cancel
            </Link>
        </div>
    </form>
</template>
