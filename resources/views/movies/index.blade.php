@extends('layouts.app')

@section('title', 'Movies List')

@section('content')


    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h2 class="mb-0">My Movie List</h2>
        @auth
            <a href="{{ route('movies.create') }}" class="btn btn-primary">+ Add Movie</a>
        @endauth

    </div>

    <form method="GET" action="{{ route('movies.index') }}" class="row g-2 mb-3">
        <div class="col-12 col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title">
        </div>

        <div class="col-6 col-md-2">
            <select name="genre_id" class="form-select">
                <option value="">All genres</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}"
                        @selected(request('genre_id') == $genre->id)>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6 col-md-2">
            <select name="is_blockbuster" class="form-select">
                <option value="">Any</option>
                <option value="1" @selected(request('is_blockbuster') === '1')>Yes</option>
                <option value="0" @selected(request('is_blockbuster') === '0')>No</option>
            </select>
        </div>

        <div class="col-12 col-md-2">
            <select name="sort" class="form-select">
                <option value="title"  @selected(request('sort', 'title') === 'title')>Sort by title</option>
                <option value="year"   @selected(request('sort') === 'year')>Sort by year</option>
                <option value="rating" @selected(request('sort') === 'rating')>Sort by rating</option>
            </select>
        </div>

        <div class="col-12 col-md-2 d-flex gap-2">
            <button class="btn btn-primary flex-fill">Apply</button>
            <a href="{{ route('movies.index') }}" class="btn btn-danger flex-fill">Clear</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th class="d-none d-md-table-cell">Rating</th>
                    <th class="d-none d-sm-table-cell">Year</th>
                    <th class="d-none d-lg-table-cell">Blockbuster</th>
                    <th class="d-none d-lg-table-cell">Director</th>
                    @auth
                        <th>Actions</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
            @forelse ($movies as $movie)
                <tr @if($movie->year >= 2020) class="table-warning" @endif>
                    <td>{{ $movies->firstItem() + $loop->index }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->genre->name }}</td>
                    <td class="d-none d-md-table-cell">{{ $movie->rating }}</td>
                    <td class="d-none d-sm-table-cell">
                        {{ $movie->year }}
                        @if($movie->year >= 2020)
                            <span class="badge bg-warning text-dark">Latest</span>
                        @endif
                    </td>
                    <td class="d-none d-lg-table-cell">{{ $movie->is_blockbuster ? 'Yes' : 'No' }}</td>
                    <td class="d-none d-lg-table-cell">{{ $movie->director }}</td>
                    @auth
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                                    onsubmit="return confirm('Delete this movie?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    @endauth

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-danger">No movies available!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

{{ $movies->links() }}

@endsection
