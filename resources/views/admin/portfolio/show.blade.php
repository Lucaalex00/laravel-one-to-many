@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white">
        <div class="py-2 container d-flex flex-column align-items-start justify-content-between gap-2">
            <div class="back_arrow_container">
                <a class="back_arrow p-1 my-3 text-decoration-none" href="{{ route('admin.portfolio.index') }}">
                    &leftarrow;</a>
            </div>
            <h2>PROJECT DETAILS :</h2>
        </div>
        @if (session('message'))
            <div class="alert alert-success w-50 my-3 mx-auto text-center">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif
    </header>
    <div class="container d-flex flex-column gap-2 my-4 text-light">
        <h3>Title: {{ $project->title }}</h3>
        <div>Slug: {{ $project->slug }}</div>

        <div class="container d-flex align-items-center gap-2 p-0 my-2">
            <img width="300" height="300" src="{{ asset('storage/' . $project->cover_image) }}"
                alt="Image of {{ $project->title }}">
            <a class="text-decoration-none text-warning" href="{{ $project->link }}">{{ $project->link }}</a>

        </div>
        <div class="container d-flex gap-2 p-0 my-2 align-items-center">
            <p class="w-25 h-25 overflow-auto bg-warning text-dark p-2 border border-dark rounded shadow text-center">
                {{ $project->content }}</p>
            <iframe class="border border-danger shadow" width="250" height="150" src="{{ $project->video }}"
                frameborder="0"></iframe>
        </div>
    </div>
@endsection
