<x-layout>
    <x-card class="mx-48 my-16 p-8">
        <header>
            <h1 class="text-5xl text-center font-thin mb-9 uppercase">
                Manage Jobs
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @if ($jobs)
                    @foreach ($jobs as $job)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="show.html">
                                    {{ $job->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    Edit</a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="text-center">
                        <p class="text-red-600 font-extrabold">No Jobs Found,
                            <a href="{{ route('jobs.create') }}">
                                <span class="text-emerald-500 text-current">Post an job</span>
                            </a>
                        </p>
                    </div>
                @endif

            </tbody>
        </table>
    </x-card>
</x-layout>
