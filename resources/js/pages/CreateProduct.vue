<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import {Form, Head } from '@inertiajs/vue3';
import { Label } from '@/components/ui/label';
import Input from '@/components/ui/input/Input.vue';
import { ref } from 'vue';
import {store} from "@/actions/App/Http/Controllers/ProductController"
import FileUploader from '@/components/FileUploader.vue';
const isClient = ref(true);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>

    <Head title="Création de produit" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <Form v-bind="store.post()"
                v-slot="{ errors, processing }" class="client flex flex-col gap-6" v-show="isClient">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" name="name"
                            placeholder="Nom du Produit" />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="description">description</Label>
                        <textarea class="border h-48 p-2" placeholder="Descritpion" name="descritpion"></textarea>
                    </div>
                   
                    <div class="grid gap-2">
                        <Label for="Price">Price</Label>
                        <Input id="price" type="number" required :tabindex="4" name="price"
                            placeholder="0" />
                        <InputError :message="errors.phone" />
                    </div>

                    <FileUploader :type='["image"]' />

                    <Button type="submit" class="mt-2 w-full" tabindex="" :disabled="processing"
                        data-test="register-user-button">
                        <Spinner v-if="processing" />
                        Create product
                    </Button>
                </div>
            </Form>
        </div>
    </AppLayout>
</template>