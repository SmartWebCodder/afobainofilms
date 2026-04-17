<script setup>
import { Head, Link } from '@inertiajs/vue3';
import TopBar from '@/Components/Admin/TopBar.vue';

const props = defineProps({
    stats: Object,
    recentMessages: Array,
});

const statCards = [
    { label: 'Total Projects', icon: 'video_camera_back', key: 'totalProjects' },
    { label: 'Published', icon: 'visibility', key: 'publishedProjects' },
    { label: 'Messages', icon: 'chat_bubble', key: 'totalMessages' },
    { label: 'Unread', icon: 'mark_email_unread', key: 'unreadMessages' },
];

const statusColors = {
    unread: 'bg-secondary',
    read: 'bg-primary',
    starred: 'bg-yellow-400',
    archived: 'bg-white/20',
};
</script>

<template>
    <Head title="Dashboard" />
    <TopBar title="Welcome back, <span class='text-primary not-italic font-bold'>Admin</span>" subtitle="Overview of your digital cinema studio" />

    <div class="px-12 py-10 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div
                v-for="card in statCards"
                :key="card.key"
                class="bg-[#1c1b1b] p-6 border border-white/5 hover:border-primary/20 transition-colors"
            >
                <span class="material-symbols-outlined text-primary text-3xl mb-4 block">{{ card.icon }}</span>
                <p class="text-[10px] font-sans uppercase tracking-widest text-white/40">{{ card.label }}</p>
                <h3 class="text-3xl font-headline mt-1 text-white">{{ stats[card.key] ?? 0 }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-headline text-white italic">Recent Inquiries</h3>
                    <Link href="/admin/messages" class="text-[10px] font-sans uppercase tracking-widest text-primary border-b border-primary/20 pb-1">
                        View All
                    </Link>
                </div>

                <div class="bg-[#1c1b1b] border border-white/5">
                    <table v-if="recentMessages.length" class="w-full text-left">
                        <thead class="bg-white/5">
                            <tr class="text-[10px] font-sans uppercase tracking-widest text-white/40">
                                <th class="px-6 py-4">Sender</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <tr v-for="msg in recentMessages" :key="msg.id" class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-white/10 flex items-center justify-center text-[10px] font-bold text-primary">
                                            {{ msg.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2) }}
                                        </div>
                                        <div class="text-xs">
                                            <p class="font-bold text-white uppercase">{{ msg.name }}</p>
                                            <p class="text-white/40">{{ msg.email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs text-white/50 uppercase tracking-wider">{{ msg.event_type ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block w-2 h-2 rounded-full mr-2" :class="statusColors[msg.status]"></span>
                                    <span class="text-[10px] font-bold uppercase text-white">{{ msg.status }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <Link :href="`/admin/messages/${msg.id}`" class="text-primary hover:text-primary-light transition-colors">
                                        <span class="material-symbols-outlined text-lg">open_in_new</span>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p v-else class="px-6 py-10 text-center text-white/30 text-sm">No messages yet</p>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-headline text-white italic">Quick Actions</h3>
                <div class="space-y-4">
                    <Link href="/admin/projects/create" class="block w-full bg-[#1c1b1b] p-6 border border-white/5 text-left hover:border-primary/20 transition-colors group">
                        <span class="material-symbols-outlined text-primary text-3xl block mb-3">add_photo_alternate</span>
                        <p class="text-xs font-sans uppercase tracking-widest text-white font-bold">New Project</p>
                        <p class="text-[10px] text-white/40 mt-1">Add to portfolio</p>
                    </Link>
                    <Link href="/admin/messages" class="block w-full bg-[#1c1b1b] p-6 border border-white/5 text-left hover:border-primary/20 transition-colors group">
                        <span class="material-symbols-outlined text-primary text-3xl block mb-3">inbox</span>
                        <p class="text-xs font-sans uppercase tracking-widest text-white font-bold">View Messages</p>
                        <p class="text-[10px] text-white/40 mt-1">Check inquiries</p>
                    </Link>
                    <Link href="/admin/settings" class="block w-full bg-[#1c1b1b] p-6 border border-white/5 text-left hover:border-primary/20 transition-colors group">
                        <span class="material-symbols-outlined text-primary text-3xl block mb-3">tune</span>
                        <p class="text-xs font-sans uppercase tracking-widest text-white font-bold">Site Settings</p>
                        <p class="text-[10px] text-white/40 mt-1">Manage your brand</p>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
