@extends('layouts.app')
@section('title', $author->name)

@section('content')

    <!-- Author -->
    <div class="flex gap-4 items-center mb-10 text-white p-10 bg-cover"
        style="background-image: url('{{ asset('assets/img/bg-profile.png') }}');">
        <img src="{{ asset('storage/' . $author->avatar) }}" alt="profile" class="rounded-full max-w-28 ">
        <div class="">
            <p class="font-bold text-lg">{{ $author->name }}</p>
            <p>{{ $author->bio }}</p>
        </div>
    </div>

    <!-- Berita -->
    <div class=" flex flex-col gap-5 px-4 lg:px-14">
        <!-- Berita -->
        <div class="flex flex-col px-14 mt-10 ">
            <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
                <div class="font-bold text-2xl text-center md:text-left">
                    <p>Berita Dari Author</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-1 gap-10 lg:grid-cols-4">
                @foreach ($author->news as $news)
                    <a href="{{ route('news.show', $news->slug) }}">
                        <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
                            style="height: 100%;">
                            <div
                                class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                                {{ $news->newsCategory->name }}</div>
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt=""
                                class="w-full rounded-xl mb-3" style="height: 200px; object-fit: cover;">
                            <p class="font-bold text-base mb-1">
                                {{ $news->title }}</p>
                            </p>
                            <p class="text-slate-400">{{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endsection
