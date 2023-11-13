<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import Chat from "@/Pages/Chats/Chat.vue";

// defineProps(['chats']);
defineProps({
    chats: Object
});

const form = useForm({
    message: ''
})
</script>

<template>
    <AppLayout title="Chats">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('chats.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Chat</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Chat
                    v-for="chat in chats"
                    :key="chat.id"
                    :chat="chat"
                />
            </div>
        </div>
<!--        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">-->
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">-->
<!--                    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">-->
<!--                        <form @submit.prevent="form.post(route('chats.store'), { onSucess: () => form.reset() })">-->
<!--                            <textarea-->
<!--                                v-model="form.message"-->
<!--                                placeholder="What's on your mind?"-->
<!--                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"-->
<!--                            ></textarea>-->
<!--                            <InputError :message="form.errors.message" class="mt-2" />-->
<!--                            <PrimaryButton class="mt-4">Chat</PrimaryButton>-->
<!--                        </form>-->

<!--                        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">-->
<!--                            <Chat-->
<!--                                v-for="chat in chats"-->
<!--                                :key="chat.id"-->
<!--                                :chat="chat"-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </AppLayout>
</template>
