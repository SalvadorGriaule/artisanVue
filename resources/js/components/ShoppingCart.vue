<script setup lang="ts">
import { onMounted, onServerPrefetch, ref } from 'vue';
import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
    DialogTrigger,
} from 'reka-ui'
defineExpose({ addToCart, removeFromCart })

interface ProductCart {
    id: number;
    image: string;
    name: string;
    price: number;
    quantity: number;
}

const pathCartLocalStorage: string = "cart_storage"
const test: ProductCart[] = [{ id: 1,image:"",name:"name",price:39, quantity: 2 }, { id: 2,image:"",name:"name",price:39,  quantity: 1 }, { id: 3,image:"",name:"name",price:39,  quantity: 4 }, { id: 4,image:"",name:"name",price:39,  quantity: 2 }];
///const cart = ref<ProductCart[]>(test);
const cart = ref<ProductCart[]>([]);

onServerPrefetch(async () => {

})
onMounted(async () => {
    cart.value = getCartFromLocalStorage();
})


function addToCart(productToAdd: ProductCart): void {
    let foundProduct: ProductCart | undefined = cart.value.find(product => product.id === productToAdd.id);

    foundProduct ? foundProduct.quantity++ : cart.value.push(productToAdd);
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

    <DialogRoot>
        <DialogTrigger>
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
        </DialogTrigger>
        <DialogPortal>
            <DialogOverlay class="bg-blackA9 data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
            <DialogContent
                class="data-[state=open]:animate-contentShow fixed top-[10%] left-[80%] rounded-[6px] bg-black p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]">
                <DialogTitle class="text-mauve12 mb-10 text-[17px] font-semibold">
                    Shopping Cart
                </DialogTitle>
                <DialogDescription class="text-mauve11 mt-[10px] mb-5 text-sm leading-normal">
                </DialogDescription>
                <div v-if="getAmountItemsInCart() > 0">
                    <div v-for="item in cart" class="mb-5">
                        <p>Product Name</p>
                        <img src="https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg" alt="" class="w-xs">
                        <div class="flex flex-row justify-evenly">

                            <button type="button" @click="removeFromCart(item.id)"
                                class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                </svg>
                                <span class="sr-only">Icon description</span>
                            </button>
                            <span class="m-auto">{{ item.quantity }}</span>
                            <button type="button" @click="addToCart(item)"
                                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                </svg>
                                <span class="sr-only">Icon description</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-[25px] flex justify-end">
                    <DialogClose as-child>
                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 18 21">
                                <path
                                    d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                            </svg>
                            Buy now
                        </button>
                    </DialogClose>
                </div>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>