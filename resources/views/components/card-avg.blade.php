@props(['name','avg','count','min','max','first_query'])
<div
    class="block rounded-lg bg-white p-2 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
    <div class="flex justify-between">
        <h5
            class="text-xl font-medium first-letter:uppercase leading-tight text-neutral-800 dark:text-neutral-50">
            {{$name}}
        </h5>
    </div>
    <div class="flex justify-between gap-4">
        <p class="text-base text-neutral-600 dark:text-neutral-200">
            <span>Avg : </span>
            <span class="text-sky-700">{{$avg}}</span>
            <span class="text-sm">ms</span>
        </p>
        <p class="text-base text-neutral-600 dark:text-neutral-200">
            <span>Count : </span>
            <span class="text-sky-700">{{$count}}</span>
            <span class="text-sm">ms</span>
        </p>
    </div>
    <div class="flex justify-between gap-4">
        <p class="text-base text-neutral-600 dark:text-neutral-200">
            <span>Min : </span>
            <span class="text-sky-700">{{$min}}</span>
            <span class="text-sm">ms</span>
        </p>
        <p class="text-base text-neutral-600 dark:text-neutral-200">
            <span>Max : </span>
            <span class="text-sky-700">{{$max}}</span>
            <span class="text-sm">ms</span>
        </p>
    </div>
    <div class="flex border-t pt-1 mt-1 justify-between gap-4">
        <div class="text-base max-w-[300px] text flex flex-wrap text-neutral-600 dark:text-neutral-200">
            <label class="text-sky-700">
                <span class="text-black">Query : </span>
                {{$first_query}}
            </label>
        </div>
    </div>
</div>
