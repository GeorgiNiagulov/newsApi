@extends('layouts.app')

@section('content')
    <div class="container px-4 mx-auto dark:bg-gray-800">
        <div class="max-w-md m-8 mx-auto overflow-hidden bg-white shadow-md rounded-xl md:max-w-2xl dark:bg-gray-700">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="object-cover w-full h-48 md:w-48" src="{{ $article['urlToImage'] }}" alt="Article Image">
                </div>
                <div class="p-8">
                    <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase dark:text-white">{{ $article['source']['name'] }}</div>
                    <h1 class="block mt-1 text-lg font-medium leading-tight text-black dark:text-white">{{ $article['title'] }}</h1>
                    <p class="mt-2 text-gray-500 dark:text-gray-300">{{ $article['content'] }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
