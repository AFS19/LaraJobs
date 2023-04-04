@props(['job'])
<ul class="flex max-sm:flex-col max-sm:gap-2 max-sm:px-10 ">
    @foreach (explode(',', $job->tags) as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>