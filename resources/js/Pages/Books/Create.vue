<template>
    <Head title="Add Book" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">Add New Book</h2>
                <Link href="/books" class="text-blue-600 hover:underline">Back to Books</Link>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
                <form @submit.prevent="submit">
                    <div class="space-y-4">

                        <div>
                            <label class="block text-sm font-medium">Title</label>
                            <input
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full border px-3 py-2 rounded"
                            />
                            <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Author</label>
                            <input
                                v-model="form.author"
                                type="text"
                                class="mt-1 block w-full border px-3 py-2 rounded"
                            />
                            <p v-if="form.errors.author" class="mt-1 text-sm text-red-600">{{ form.errors.author }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Year</label>
                            <input
                                v-model="form.year"
                                type="number"
                                class="mt-1 block w-full border px-3 py-2 rounded"
                            />
                            <p v-if="form.errors.year" class="mt-1 text-sm text-red-600">{{ form.errors.year }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Description</label>
                            <textarea
                                v-model="form.description"
                                rows="4"
                                class="mt-1 block w-full border px-3 py-2 rounded"
                            />
                            <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Cover Image</label>
                            <input
                                @change="e => form.cover = e.target.files[0]"
                                type="file"
                                accept="image/*"
                                class="mt-1 block w-full"
                            />
                            <p v-if="form.errors.cover" class="mt-1 text-sm text-red-600">{{ form.errors.cover }}</p>
                        </div>

                        <div class="pt-4">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Saving…</span>
                                <span v-else>Save Book</span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
    title: '',
    author: '',
    year: '',
    description: '',
    cover: null
})

function submit() {
    form.post(route('books.store'), {
        onSuccess: () => form.reset(),
        preserveScroll: true
    })
}
</script>
