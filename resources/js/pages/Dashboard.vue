<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';
import axios from 'axios';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const sendFlag = ref(false);
const sendMail = () => {
    sendFlag.value = true;
    axios.post('/send-mail')
        .then(response => {
            console.log('Mail sent successfully:', response.data);
        })
        .catch(error => {
            console.error('Error sending mail:', error);
        })
        .finally(() => {
            sendFlag.value = false;
        });
}
</script>

<template>
    <Head title="Dashboard" />
    <div v-if="sendFlag" class="absolute z-10 h-[100%] w-[100%] bg-black opacity-50 text-white flex items-center justify-center text-3xl">送信中...</div>
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border flex items-center justify-center"
            >
                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow-lg shadow-gray-400 border-gray-300 border-b-[10px] active:border-b-[0px] active:shadow-none"
                    @click="sendMail()">
                    みんなにメール送信
                </button>
                <!-- <PlaceholderPattern /> -->
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
        </div>
        <div
            class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
        >
            <PlaceholderPattern />
        </div>
    </div>
</template>
