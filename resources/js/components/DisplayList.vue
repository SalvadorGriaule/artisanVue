<script setup lang="ts">
import axios from "axios";
import { Ref, ref, watchEffect, toValue } from "vue";
import { Link } from "@inertiajs/vue3";
import { destroy, edit } from "@/actions/App/Http/Controllers/ProductController";
import { Cart } from '@/lib/cart';

const useFetch = (url: string, method: "get" | "post" | "delete" | "put" = "get") => {
    const data: Ref<any> = ref(null);
    const error: Ref<unknown | null> = ref(null);

    watchEffect(async () => {
        data.value = null;
        error.value = null;

        const urlValue = toValue(url);

        try {
            const res = await fetch(urlValue, { mode: 'cors', credentials: 'same-origin', method: method });
            data.value = await res.json();
        } catch (e) {
            error.value = e
        }
    })

    return { data, error }
}

const deleteProd = async (id: string) => {
    if (id) {
        const del = await axios.delete(destroy(id).url);
        if (del.data.result) document.querySelector(`#prod-${id}`)?.remove();
    }
}

const props = defineProps<{ url: string, mode: "read" | "edit" }>()

let product = useFetch(props.url)

</script>

<template>
    <div class="flex flex-wrap">
        <div v-for="value in product.data.value" class="w-[47.5%] m-2 p-2 dark:text-white border dark:border-white rounded-xl dark:bg-linear-to-br dark:from-stone-900 dark:to-stone-800" :id="'prod-' + value.id">
            <div>
                <div v-if="mode == 'edit'" class="flex space-x-2">
                    <button @click="deleteProd(value.id)"
                        class="bg-red-600 p-2 rounded-2xl text-red-200 hover:bg-red-200 hover:text-red-600 duration-50">delete</button>
                    <Link :href="edit(value.id)"><button class="p-2 rounded-2xl bg-sky-400">édit</button></Link>
                </div>
                <div class="flex justify-between mb-2 ">
                    <h3 class="text-2xl">{{ value.name }}</h3>
                    <p>{{ new Date(value.created_at).toLocaleDateString("fr-FR", {
                        day: "numeric", weekday: "short", month:
                            "long"
                    }) }}
                    </p>
                </div>
                <div class="flex p-1 space-x-2">
                    <div class="w-1/4">
                        <img :src="value.image_path" alt="">
                    </div>
                    <div>
                        <p>{{ value.descritpion }}</p>
                        <p>{{ value.price }} €</p>
                    </div>
                    <button @click="Cart.instance.addToCart(value)">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
</template>