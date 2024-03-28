@extends('layouts.app')

@section('content')
    <div name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </div>

    <div class="container px-4 mx-auto dark:bg-gray-800">
        <a href="{{ url('/preferences') }}" class="text-indigo-500 dark:text-white">Change Preferences</a>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($errors)
                        @foreach ($errors as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif

                    @if (!empty($newsArticles))
                        @foreach ($newsArticles as $article)
                            <div class="max-w-md m-8 mx-auto overflow-hidden bg-white shadow-md rounded-xl md:max-w-2xl dark:bg-gray-700">
                                <div class="md:flex">
                                    <div class="md:flex-shrink-0">
                                        <img class="object-cover w-full h-48 md:w-48" src="{{ $article['urlToImage'] }}" alt="Article Image">
                                    </div>
                                    <div class="p-8">
                                        <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase dark:text-white">{{ $article['source']['name'] }}</div>
                                        <a href="{{ url('/article/' . md5($article['id'])) }}" class="block mt-1 text-lg font-medium leading-tight text-black hover:underline dark:text-white">{{ $article['title'] }}</a>
                                        <p class="mt-2 text-gray-500 dark:text-gray-300">{{ $article['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
