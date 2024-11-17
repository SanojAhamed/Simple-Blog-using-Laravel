<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Posts' }}
            </h2>
            <a href="{{ route('posts.create') }}" style="background-color: black; color: white;"
                class="px-4 py-2 rounded-md">Add</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Title</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Creat
                                </th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Update
                                </th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($posts as $post)
                                <tr>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $post->title }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $post->created_at }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $post->updated_at }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        <div class="flex py-4 px-(-6) space-x-8">
                                            <a href="{{ route('posts.show', $post->id) }}"
                                                style="background-color: black; color: white; padding: 8px 16px; border-radius: 4px;"
                                                class="hover:bg-gray-800">Show</a>
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                style="background-color: black; color: white; padding: 8px 16px; border-radius: 4px;"
                                                class="hover:bg-gray-800">Edit</a>
                                            <form method="post" action="{{ route('posts.destroy', $post->id) }}"
                                                class="inline">
                                                @csrf
                                                @method('delete')
                                                <button
                                                    style="background-color: black; color: white; padding: 8px 16px; border-radius: 4px;"
                                                    class="hover:bg-gray-800">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="text-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        No data can be displayed.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
