@props(['headline'])

<div class="flex ml-6 mt-8">
    <div class="flex flex-col">
        <div class="flex items-end">
            <div class="headline-title text-purple-400"></div>
            <h2 class="text-left text-black text-base lg:text-xl font-bold border-t-2 border-purple-400 ml-2 pr-2">
                {{ $slot }}
            </h2>
        </div>
        <div class="border border-purple-400 px-4"></div>
    </div>
</div>

<style>
    .headline-title:before {
        content: "\f058";
        font-family: "Font Awesome 5 Free";
        font-size: 1.5rem;
    }
</style>