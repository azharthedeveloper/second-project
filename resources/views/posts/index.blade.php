@extends('layouts.base')

@section('title', 'Posts')

@section('content')

    <style>
        .posts-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            color: #1a1a2e;
        }

        .top-actions {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .toolbar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.2rem;
        }

        .search-input {
            padding: 0.45rem 0.8rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.9rem;
            width: 280px;
            outline: none;
        }

        .search-input:focus {
            border-color: #4f46e5;
        }

        .btn {
            padding: 0.45rem 1rem;
            border-radius: 6px;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #4f46e5;
            color: #fff;
        }

        .btn-primary:hover {
            background: #4338ca;
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
            color: #fff;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-sm {
            padding: 0.3rem 0.7rem;
            font-size: 0.8rem;
        }

        .table-wrapper {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        thead {
            background: #f8fafc;
        }

        thead th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #f1f5f9;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody td {
            padding: 0.75rem 1rem;
            color: #334155;
            vertical-align: middle;
        }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-published {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-draft {
            background: #fef9c3;
            color: #ca8a04;
        }

        .badge-archived {
            background: #f1f5f9;
            color: #64748b;
        }

        .badge-type {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            background: #ede9fe;
            color: #6d28d9;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 0.4rem;
        }

        .table-footer {
            padding: 0.75rem 1rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>

    <div class="posts-container">

        <h1 class="page-title">All Posts</h1>

        {{-- Create & Delete Buttons --}}
        <div class="top-actions">
            <a href="{{ route('posts-create') }}" class="btn btn-primary">+ Create Post</a>
            <a href="" class="btn btn-danger">Trash</a>
        </div>

        {{-- Search Bar --}}
        <div class="toolbar">
            <form method="GET" action="{{ route('posts-index') }}" style="display:flex; gap:0.5rem;">
                <input type="text" name="search" class="search-input" placeholder="Search"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        {{-- Table --}}
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Likes</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                {{ $post->id }}
                                @if ($post->image_path)
                                <img src="{{ asset('storage/'. $post->image_path) }}" alt="ALT" width="70" height="45">                                    
                                @endif
                            </td>
                            <td>{{ $post->title }}</td>
                            <td><span class="badge-type">{{ $post->post_type }}</span></td>
                            <td>
                                <span class="badge badge-{{ $post->status }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td>{{ number_format($post->views) }}</td>
                            <td>{{ number_format($post->likes) }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('posts-edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('posts-delete', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginationDiv">
                {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>

@endsection
