@extends('layouts.admin')

@section('content')
    <div class="container p-2">
        <form action="{{ route('admin.portfolio.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- IN THIS CASE, I DON'T MAKE A COVER_IMAGE FIELD ON MY DB --}}
            <div class="mb-3 text-light">
                <label for="link" class="form-label">cover_image</label>
                <input type="file" value="{{ old('cover_image', $project->cover_image) }}"
                    class="form-control  @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image"
                    aria-describedby="helpId" placeholder="Type a cover_image" />
                <small id="cover_imageId" class="form-text text-muted">Type a cover_image</small>
            </div>

            {{-- Title --}}
            <div class="mb-3 text-light">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title', $project->title) }}" id="title" aria-describedby="helpId"
                    placeholder="Type a title" />
                <small id="titleId" class="form-text text-muted">Type a Title</small>
            </div>
            @error('title')
                <h4 class="text-danger ">{{ $message }}</h4>
            @enderror

            {{-- Slug --}}
            <div class="mb-3 text-light">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" value="{{ old('slug', $project->slug) }}"
                    class="form-control  @error('title') is-invalid @enderror" name="slug" id="slug"
                    aria-describedby="helpId" placeholder="Type a slug" />
                <small id="slugId" class="form-text text-muted">Type a Slug</small>
            </div>
            @error('slug')
                <h4 class="text-danger ">{{ $message }}</h4>
            @enderror

            {{-- Content --}}
            <div class="mb-3 text-light">
                <label for="content" class="form-label">Content</label>
                <input type="text" value="{{ old('content', $project->content) }}"
                    class="form-control @error('title') is-invalid @enderror" name="content" id="content"
                    aria-describedby="helpId" placeholder="Type a content" />
                <small id="contentId" class="form-text text-muted">Type a Content</small>
            </div>
            @error('content')
                <h4 class="text-danger ">{{ $message }}</h4>
            @enderror

            {{-- Link --}}
            <div class="mb-3 text-light">
                <label for="link" class="form-label">Link</label>
                <input type="text" value="{{ old('link', $project->link) }}"
                    class="form-control  @error('title') is-invalid @enderror" name="link" id="link"
                    aria-describedby="helpId" placeholder="Type a Link" />
                <small id="linkId" class="form-text text-muted">Type a Link</small>
            </div>
            @error('link')
                <h4 class="text-danger ">{{ $message }}</h4>
            @enderror

            {{-- SUBMIT --}}
            <button class="btn btn-secondary" type="submit">EDIT</button>
        </form>
    </div>
@endsection
