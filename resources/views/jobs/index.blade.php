<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-32">
            @if (count($jobs) === 0)
                <p class="text-4xl font-bold text-red-500 text-center m-10">No jobs found</p>
            @else
                @foreach ($jobs as $job)
                    <x-job-card :job="$job"/>
                @endforeach
            @endif
    </div>
    <div class="flex justify-center mt-6 p-4">
        {{$jobs->links()}}
    </div>
</x-layout>