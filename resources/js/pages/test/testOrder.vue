<script setup lang="ts">
import { useTemplateRef } from 'vue';

const name = useTemplateRef("name");
const product_id = useTemplateRef("product_id")

const click = () => {
    const inArr = [{ name: name.value?.value, product_id: product_id.value?.value }];
    
    let form = new FormData();
    form.append("row",JSON.stringify(inArr));
}

</script>
<template>
    <form action="/createOrder" method="post">
        <input ref="name" type="text" name="quantité" placeholder="name" />
        <input ref="product_id" type="text" name="product_id" placeholder="product_id"/>
        <button type="submit">Create Order</button>
    </form>
</template>