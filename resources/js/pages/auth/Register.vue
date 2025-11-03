<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const isClient = ref(true);
</script>

<template>
    <AuthBase
        title="Create an account"
        description="Enter your details below to create your account"
    >
        <Head title="Register" />
        <nav>
            <button
                class="w-1/2 rounded-t-xl border border-slate-300 bg-gradient-to-b from-slate-300 to-white p-2"
                :class="{ active: isClient }"
                @click="isClient = true"
                type="button"
            >
                Acheteur</button
            ><button
                class="w-1/2 rounded-t-xl border border-slate-300 bg-gradient-to-b from-slate-300 to-white p-2"
                @click="isClient = false"
            >
                Vendeur
            </button>
        </nav>
        <div>
            <Form
                v-bind="store.form()"
                :reset-on-success="['password', 'password_confirmation']"
                v-slot="{ errors, processing }"
                class="client flex flex-col gap-6"
                v-show="isClient"
            >
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            name="name"
                            placeholder="Full name"
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            :tabindex="2"
                            autocomplete="email"
                            name="email"
                            placeholder="email@example.com"
                        />
                        <InputError :message="errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="adress">Address</Label>
                        <Input
                            id="adress"
                            type="text"
                            required
                            :tabindex="3"
                            autocomplete="address"
                            name="address"
                            placeholder="3 rue Azerty 50000 Azer"
                        />
                        <InputError :message="errors.address" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="phone">Phone number</Label>
                        <Input
                            id="phone"
                            type="tel"
                            required
                            :tabindex="4"
                            autocomplete="tel"
                            name="phone"
                            placeholder="+33123456789"
                        />
                        <InputError :message="errors.phone" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="5"
                            autocomplete="new-password"
                            name="password"
                            placeholder="Password"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation"
                            >Confirm password</Label
                        >
                        <Input
                            id="password_confirmation"
                            type="password"
                            required
                            :tabindex="6"
                            autocomplete="new-password"
                            name="password_confirmation"
                            placeholder="Confirm password"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>
                    <div>
                        <Input
                            id="role"
                            name="role"
                            value="user"
                            v-show="false"
                        />
                    </div>

                    <Button
                        type="submit"
                        class="mt-2 w-full"
                        tabindex="6"
                        :disabled="processing"
                        data-test="register-user-button"
                    >
                        <Spinner v-if="processing" />
                        Create account
                    </Button>
                </div>

                <div class="text-center text-sm text-muted-foreground">
                    Already have an account?
                    <TextLink
                        :href="login()"
                        class="underline underline-offset-4"
                        :tabindex="6"
                        >Log in</TextLink
                    >
                </div>
            </Form>
            <Form
                v-bind="store.form()"
                :reset-on-success="['password', 'password_confirmation']"
                v-slot="{ errors, processing }"
                class="seller flex flex-col gap-6"
                v-show="!isClient"
            >
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Name Société</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            name="name"
                            placeholder="Full name"
                        />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="siret">N° SIRET</Label>
                        <Input
                            id="siret"
                            type="number"
                            required
                            autofocus
                            :tabindex="2"
                            name="siret"
                            placeholder="N° SIRET"
                        />
                        <InputError :message="errors.siret" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            :tabindex="3"
                            autocomplete="email"
                            name="email"
                            placeholder="email@example.com"
                        />
                        <InputError :message="errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="adress">Address</Label>
                        <Input
                            id="adress"
                            type="text"
                            required
                            :tabindex="4"
                            autocomplete="address"
                            name="address"
                            placeholder="3 rue Azerty 50000 Azer"
                        />
                        <InputError :message="errors.address" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="phone">Phone number</Label>
                        <Input
                            id="phone"
                            type="tel"
                            required
                            :tabindex="5"
                            autocomplete="tel"
                            name="phone"
                            placeholder="+33123456789"
                        />
                        <InputError :message="errors.phone" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="6"
                            autocomplete="new-password"
                            name="password"
                            placeholder="Password"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation"
                            >Confirm password</Label
                        >
                        <Input
                            id="password_confirmation"
                            type="password"
                            required
                            :tabindex="7"
                            autocomplete="new-password"
                            name="password_confirmation"
                            placeholder="Confirm password"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>
                    <div>
                        <Input
                            id="role"
                            name="role"
                            value="seller"
                            v-show="false"
                        />
                    </div>
                    <Button
                        type="submit"
                        class="mt-2 w-full"
                        tabindex="7"
                        :disabled="processing"
                        data-test="register-user-button"
                    >
                        <Spinner v-if="processing" />
                        Create account
                    </Button>
                </div>

                <div class="text-center text-sm text-muted-foreground">
                    Already have an account?
                    <TextLink
                        :href="login()"
                        class="underline underline-offset-4"
                        :tabindex="6"
                        >Log in</TextLink
                    >
                </div>
            </Form>
        </div>
    </AuthBase>
</template>
