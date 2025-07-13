<template>
    <Head title="Books" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Books</h2>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between mb-4">
                    <div v-if="$page.props.auth.user.permissions.includes('book.create')">
                    <Link href="/books/create" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Add Book
                    </Link>
                    </div>
                    <input
                        v-model="form.search"
                        @keyup.enter="applySearch"
                        type="text"
                        placeholder="Search title or author"
                        class="border rounded px-3 py-2 w-1/3"
                    />
                </div>

                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left">Year</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="book in books.data" :key="book.id" class="border-b dark:border-gray-600">
                        <td class="px-6 py-4">{{ book.id }}</td>
                        <td class="px-6 py-4">{{ book.title }}</td>
                        <td class="px-6 py-4">{{ book.author }}</td>
                        <td class="px-6 py-4">{{ book.year }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <div v-if="$page.props.auth.user.permissions.includes('book.update')">
                            <Link
                                :href="route('books.edit', book.id)"
                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded"
                            >Edit</Link>
                            </div>
                            <div v-if="$page.props.auth.user.permissions.includes('book.delete')">
                            <button
                                @click="deleteBook(book.id)"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                            >Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="books.data.length === 0">
                        <td colspan="5" class="text-center py-4">No books found.</td>
                    </tr>
                    </tbody>
                </table>

                <div class="mt-4">
                    <Pagination :links="books.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Pagination from '@/Components/Pagination.vue'

// Destructure props to get books and filters
const props = defineProps({
    books: Object,
    filters: Object
})

// Initialize form with search default from props
const form = useForm({
    search: props?.filters?.search || ''
})

const deleteBook = (id) => {
    if (confirm('Are you sure you want to delete this book?')) {
        form.delete(route('books.destroy', id), {
            onSuccess: () => form.reset(),
            preserveScroll: true
        })
    }
}

console.log(props);

const applySearch = () => {
    form.get(route('books.index'), { search: form.search }, { preserveState: true, replace: true,
        only: ['books']})
}
</script>
