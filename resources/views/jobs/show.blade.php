<x-layout>
    <a href="{{ route('jobs.index') }}" class="inline-block text-black hover:text-red-500 text-lg ml-4 mb-4"><i
            class="fa-solid fa-arrow-left"></i> Back
    </a>
    @include('partials._search')
    <div class="mx-24">
        <x-card class="">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="hidden w-48 mr-6 md:block rounded-lg mb-5"
                    src="{{ $job->logo ? asset("./storage/$job->logo") : asset('images/lJ-no-logo.png') }} "
                    alt="" />

                <h2 class="text-4xl mb-2">{{ $job->title }}</h2>
                <div class="text-xl font-bold mb-4">{{ $job->company }}</div>
                <x-job-tags :job="$job" />
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p class="text-sm text-justify">{{ $job->description }}</p>

                        <a href="mailto:{{ $job->email }}"
                            class="block  bg-red-500 text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $job->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</x-layout>
