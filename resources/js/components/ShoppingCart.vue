<script setup lang="ts">
import { onMounted, onServerPrefetch, ref } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
defineExpose({ addToCart, removeFromCart })

interface ProductCart {
    id: number;
    image: string;
    name: string;
    price: number;
    quantity: number;
}

const pathCartLocalStorage: string = "cart_storage"
//const test: ProductCart[] = [{ id: 1, image: "", name: "name", price: 39, quantity: 2 }, { id: 2, image: "", name: "name", price: 39, quantity: 1 }, { id: 3, image: "", name: "name", price: 39, quantity: 4 }, { id: 4, image: "", name: "name", price: 39, quantity: 2 }];
//const cart = ref<ProductCart[]>(test);
const cart = ref<ProductCart[]>([]);
const open = ref(false)

onServerPrefetch(async () => {

})
onMounted(async () => {
    cart.value = getCartFromLocalStorage();
})


function addToCart(productToAdd: ProductCart): void {
    let foundProduct: ProductCart | undefined = cart.value.find(product => product.id === productToAdd.id);

    foundProduct ? foundProduct.quantity++ : cart.value.push(productToAdd);
    saveCartToLocalStorage();
}
function removeFromCart(idToRemove: number): void {
    let foundProduct: ProductCart | undefined = cart.value.find(product => product.id === idToRemove);
    if (foundProduct) {
        if (foundProduct.quantity > 1) {
            foundProduct.quantity--
        }
        else {
            let indexToRemove = cart.value.indexOf(foundProduct);
            cart.value.splice(indexToRemove, 1);
        }
        saveCartToLocalStorage();
    }
}
function getAmountItemsInCart(): number {
    return cart.value?.length ? cart.value.length : 0;
}
function saveCartToLocalStorage(): void {
    JSON.stringify(cart.value);
}
function getCartFromLocalStorage(): ProductCart[] {
    return JSON.parse(localStorage.getItem(pathCartLocalStorage) as string);
}
console.log(cart.value);
</script>
<template>
    <div>
        <button class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10"
            @click="open = true">
            <div class="relative py-2">
                <div class="t-0 absolute left-3">
                    <p class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-3 text-xs text-white">
                        {{ getAmountItemsInCart() }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="file: mt-4 h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </div>
        </button>
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to=""
                    leave="ease-in-out duration-500" leave-from="" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                            <TransitionChild as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="translate-x-full" enter-to="translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="translate-x-0" leave-to="translate-x-full">
                                <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                    <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl">
                                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                            <div class="flex items-start justify-between">
                                                <DialogTitle class="text-lg font-medium text-gray-900">Shopping cart
                                                </DialogTitle>
                                                <div class="ml-3 flex h-7 items-center">
                                                    <button type="button"
                                                        class="relative -m-2 p-2 text-gray-400 hover:text-gray-500"
                                                        @click="open = false">
                                                        <span class="absolute -inset-0.5"></span>
                                                        <span class="sr-only">Close panel</span>
                                                        X
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mt-8">
                                                <div class="flow-root">
                                                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                        <li v-for="product in cart" :key="product.id"
                                                            class="flex py-6">
                                                            <div
                                                                class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                                <img :src="'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg'" :alt="'product.imageAlt'"
                                                                    class="size-full object-cover" />
                                                            </div>

                                                            <div class="ml-4 flex flex-1 flex-col">
                                                                <div>
                                                                    <div
                                                                        class="flex justify-between text-base font-medium text-gray-900">
                                                                        <h3>
                                                                            <a :href="'#'">{{ product.name
                                                                            }}</a>
                                                                        </h3>
                                                                        <p class="ml-4">{{ product.price }}</p>
                                                                    </div>
                                                                    <p class="mt-1 text-sm text-gray-500">{{
                                                                        'product.color' }}</p>
                                                                </div>
                                                                <div
                                                                    class="flex flex-1 items-end justify-between text-sm">
                                                                    <p class="text-gray-500">Qty {{ product.quantity }}
                                                                    </p>

                                                                    <div class="flex">
                                                                        <button type="button"
                                                                            class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <p>Subtotal</p>
                                                <p>$262.00</p>
                                            </div>
                                            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at
                                                checkout.</p>
                                            <div class="mt-6">
                                                <a href="#"
                                                    class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-xs hover:bg-indigo-700">Checkout</a>
                                            </div>
                                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                                <p>
                                                    or{{ ' ' }}
                                                    <button type="button"
                                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                                        @click="open = false">
                                                        Continue Shopping
                                                        <span aria-hidden="true"> &rarr;</span>
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>