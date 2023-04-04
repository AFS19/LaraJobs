@props(['job'])
<x-card>
    <div class="flex">

        <img class="hidden h-24 mr-6 md:block"
            src="{{ $job->logo ? asset("storage/$job->logo") : asset('images/lJ-no-logo.png') }} " alt="" />
        <div>
            <h1 class="text-xl">
                <a href="/jobs/{{ $job->id }}">{{ $job->title }}</a>
            </h1>
            <div class="text-2xl font-bold mb-4">{{ $job->company }}</div>
            <x-job-tags :job="$job" />
            <div class="text-xl mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
            </div>
        </div>
    </div>
</x-card>
