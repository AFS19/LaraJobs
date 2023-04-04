@if(session()->has('message')) 
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="fixed top-1 left-1/3 bg-red-500 text-white font-bold px-24 rounded-lg py-3">
    <p>{{session('message')}}</p>
</div>
@endif