<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({datas: Object});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <button class="font-semibold text-lg mb-3 mr-auto text-gray-800 leading-tight bg-green-300 rounded px-3 py-2">Download</button>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-black ">
                        <thead class="text-xs text-gray-700 uppercase bg-white ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Card ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    PIC
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Door
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Access at
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="(data, index) in datas">
                                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                                    {{ index+1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{data.card_id}}
                                </td>
                                <td class="px-6 py-4">
                                    {{data.nama_card}}
                                </td>
                                <td class="px-6 py-4">
                                    {{data.nama_door}}
                                </td>
                                <td class="px-6 py-4">
                                    {{data.created_at}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
