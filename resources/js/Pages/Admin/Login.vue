<script setup>
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post('/admin/login', {
        onFinish: () => form.reset('password'),
    });
}
</script>

<template>
    <Head title="Admin Login" />
    <div class="min-h-screen bg-surface-dim flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-headline tracking-tighter text-primary">AFOBAINO FILMS</h1>
                <p class="text-sm text-on-surface-muted mt-2">Admin Panel</p>
            </div>

            <form @submit.prevent="submit" class="bg-surface border border-outline p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-on-surface-muted"
                        placeholder="admin@afobaino.com"
                    />
                    <p v-if="form.errors.email" class="text-error text-xs mt-1">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-sans uppercase tracking-widest text-on-surface-variant mb-2">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full bg-transparent border-0 border-b border-outline text-on-surface px-0 py-3 text-sm focus:border-primary focus:ring-0 placeholder-on-surface-muted"
                        placeholder="••••••••"
                    />
                    <p v-if="form.errors.password" class="text-error text-xs mt-1">{{ form.errors.password }}</p>
                </div>

                <label class="flex items-center space-x-2 cursor-pointer">
                    <input v-model="form.remember" type="checkbox" class="bg-transparent border-outline text-primary focus:ring-primary/50 rounded" />
                    <span class="text-xs text-on-surface-variant">Remember me</span>
                </label>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-primary text-white text-xs font-bold uppercase tracking-widest py-4 hover:bg-primary-light transition-colors disabled:opacity-50"
                >
                    <span v-if="form.processing">Signing in...</span>
                    <span v-else>Sign In</span>
                </button>
            </form>
        </div>
    </div>
</template>
