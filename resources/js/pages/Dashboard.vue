<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, Document } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

defineProps<{
    documents: Document[];
}>();

const form = useForm<{ document: File | null }>({
    document: null,
});

function onFileChange(event: Event) {
    const target = event.target as HTMLInputElement | null;
    form.document = target?.files?.[0] ?? null;
}

function submit() {
    form.post('/documents');
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <form class="flex items-start gap-4" @submit.prevent="submit">
                <Input type="file" @change="onFileChange" class="max-w-sm" />
                <Button type="submit">Submit</Button>
            </form>
            <div class="flex gap-4">
                <Card v-for="document in documents" :key="document.id">
                    {{ document.name }}
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
