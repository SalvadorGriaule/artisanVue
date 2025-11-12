import { ref } from 'vue';
export class Cart {
    static #instance: Cart;
    productsCart = ref<ProductCart[]>([]);
    pathCartLocalStorage: string = 'cart_storage';

    private constructor() {
        this.productsCart.value = this.getCartFromLocalStorage();
    }

    public static get instance(): Cart {
        if (!Cart.#instance) {
            Cart.#instance = new Cart();
        }

        return Cart.#instance;
    }

    getCartFromLocalStorage() {
        console.log(localStorage.getItem(this.pathCartLocalStorage));
        if (localStorage.getItem(this.pathCartLocalStorage)) {
            return JSON.parse(
                localStorage.getItem(this.pathCartLocalStorage) as string,
            );
        }
        return [];
    }
    addToCart(productToAdd: ProductCart) {
        console.log(this.productsCart.value);
        let foundProduct: ProductCart | undefined =
            this.productsCart.value.find(
                (product) => product.id === productToAdd.id,
            );
        if (foundProduct) {
            foundProduct.quantity++;
        } else {
            productToAdd.quantity = 1;
            this.productsCart.value.push(productToAdd);
        }
        this.saveCartToLocalStorage();
    }
    removeFromCart(idToRemove: number): void {
        let foundProduct: ProductCart | undefined =
            this.productsCart?.value?.find(
                (product) => product.id === idToRemove,
            );
        if (foundProduct) {
            let indexToRemove = this.productsCart.value.indexOf(foundProduct);
            this.productsCart.value.splice(indexToRemove, 1);

            this.saveCartToLocalStorage();
        }
    }
    getAmountItemsInCart(): number {
        return this.productsCart?.value?.length
            ? this.productsCart.value.length
            : 0;
    }
    saveCartToLocalStorage(): void {
        localStorage.setItem(
            this.pathCartLocalStorage,
            JSON.stringify(this.productsCart.value),
        );
    }
}
export interface ProductCart {
    id: number;
    image_path: string;
    name: string;
    price: number;
    quantity: number;
}
