@extends('layouts.app')
@section('content')
    <section class="container px-4 mx-auto">
        <div>
            <h1 class="text-xl font-bold pt-3">Test Query Speed</h1>
            <div class="text-center mx-auto mt-3">
                <form method="post" class="flex " action="{{route('search')}}">
                    @csrf
                    <div>
                        <input class="p-2 rounded-md" type="search" name="search"
                               placeholder="please enter search key"/>
                        @if($errors->has('search'))
                            <div class="text-sm text-red-500">{{ $errors->first('search') }}</div>
                        @endif
                    </div>
                    <div>
                        <button class="border p-2 rounded-md text-sky-700 bg-amber-100" type="submit">Save</button>

                        <a href="{{route('truncate-result')}}"
                           class="px-6 inline-block py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-400 rounded-lg hover:bg-red-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                            Truncate Result
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <section class="grid md:grid-cols-4 mt-3 gap-4">
            @foreach($averages as $item)
                <x-card-avg :name="$item['name']" :avg="$item['avg']" :count="$item['count']" :min="$item['min']"
                            :max="$item['max']" :first_query="$item['first_query']"/>
            @endforeach
        </section>

        <h2 class="text-lg flex justify-between font-medium text-gray-800 dark:text-white mt-6">
            <p>Search Result</p>
            <p>
                total data for search =
                <small> {{number_format($total_row)}} row</small>
            </p>
        </h2>
        <div class="flex flex-col mt-1">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    id
                                </th>
                                <th scope="col"
                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    type
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Search Type
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Search Key
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Time
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Count
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Query
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach($results as $result)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->id}}</td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->type}}</td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->search_type}}</td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->search_key}}</td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->time}}ms</td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->count}}</td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">{{$result->query}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $results->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
