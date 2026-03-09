@extends('layouts.base')

@section('title', 'Update Post')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

        * {
            box-sizing: border-box;
        }

        .form-page {
            font-family: 'DM Sans', sans-serif;
            padding: 2rem 1.5rem;
            max-width: 780px;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: color 0.2s;
        }

        .form-header .back-link:hover {
            color: #4f46e5;
        }

        .form-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }

        /* Card */
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        .form-body {
            padding: 1.8rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.4rem;
        }

        /* Field Groups */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .field-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            letter-spacing: 0.01em;
        }

        .field-group label span.required {
            color: #ef4444;
            margin-left: 2px;
        }

        /* Text / Textarea inputs */
        .input-text,
        .input-textarea {
            width: 100%;
            padding: 0.55rem 0.85rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: #1e293b;
            background: #fafafa;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .input-text:focus,
        .input-textarea:focus {
            border-color: #4f46e5;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.08);
        }

        .input-textarea {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6;
        }

        /* Select */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #94a3b8;
            pointer-events: none;
        }

        .input-select {
            width: 100%;
            padding: 0.55rem 2.2rem 0.55rem 0.85rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: #1e293b;
            background: #fafafa;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .input-select:focus {
            border-color: #4f46e5;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.08);
        }

        /* Divider */
        .form-divider {
            border: none;
            border-top: 1px solid #f1f5f9;
            margin: 0.2rem 0;
        }

        /* Two Column */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.4rem;
        }

        @media (max-width: 560px) {
            .two-col {
                grid-template-columns: 1fr;
            }
        }

        /* ─── Status Radio Buttons ─── */
        .radio-group {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .radio-option {
            position: relative;
        }

        .radio-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-option label {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.9rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.18s;
            background: #fafafa;
            color: #64748b;
            user-select: none;
        }

        .radio-option label .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.4;
            transition: opacity 0.18s;
        }

        /* Draft */
        .radio-option input[value="draft"]:checked+label {
            border-color: #f59e0b;
            background: #fef9c3;
            color: #92400e;
        }

        .radio-option input[value="draft"]:checked+label .dot {
            opacity: 1;
            background: #f59e0b;
        }

        /* Published */
        .radio-option input[value="published"]:checked+label {
            border-color: #22c55e;
            background: #dcfce7;
            color: #15803d;
        }

        .radio-option input[value="published"]:checked+label .dot {
            opacity: 1;
            background: #22c55e;
        }

        /* Archived */
        .radio-option input[value="archived"]:checked+label {
            border-color: #94a3b8;
            background: #f1f5f9;
            color: #475569;
        }

        .radio-option input[value="archived"]:checked+label .dot {
            opacity: 1;
            background: #94a3b8;
        }

        .radio-option label:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #334155;
        }

        /* ─── Image Upload ─── */
        .image-upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            position: relative;
        }

        .image-upload-area:hover {
            border-color: #4f46e5;
            background: #f5f3ff;
        }

        .image-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon {
            font-size: 2rem;
            margin-bottom: 0.4rem;
            line-height: 1;
        }

        .upload-text {
            font-size: 0.85rem;
            color: #64748b;
        }

        .upload-text strong {
            color: #4f46e5;
        }

        .upload-hint {
            font-size: 0.76rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        /* ─── Form Footer ─── */
        .form-footer {
            padding: 1.2rem 2rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 0.6rem;
        }

        .btn {
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.18s;
        }

        .btn-ghost {
            background: transparent;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
        }

        .btn-ghost:hover {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-primary {
            background: #4f46e5;
            color: #fff;
        }

        .btn-primary:hover {
            background: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        /* Error messages */
        .field-error {
            font-size: 0.78rem;
            color: #ef4444;
            margin-top: 0.2rem;
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        /* Image */
        .current-image-wrapper {
            margin-top: 0.75rem;
            display: inline-block;
            position: relative;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
        }

        .current-image-wrapper img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 9px;
        }

        .current-image-label {
            font-size: 0.76rem;
            color: #94a3b8;
            margin-bottom: 0.35rem;
        }
    </style>

    <div class="form-page">

        <div class="form-header">
            <a href="{{ route('posts-index') }}" class="back-link">
                ← Back to Posts
            </a>
            <h1>Update Post</h1>
        </div>

        <div class="form-card">
            <form action="{{ route('posts-update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-body">

                    {{-- Title --}}
                    <div class="field-group">
                        <label for="title">Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title"
                            class="input-text {{ $errors->has('title') ? 'input-error' : '' }}"
                            placeholder="Enter post title..." value="{{ $post->title }}">
                        @error('title')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="field-group">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea id="description" name="description"
                            class="input-textarea {{ $errors->has('description') ? 'input-error' : '' }}"
                            placeholder="Write your post content here...">{{ $post->description }}</textarea>
                        @error('description')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="form-divider">

                    {{-- Post Type & Status in two columns --}}
                    <div class="two-col">

                        {{-- Post Type --}}
                        <div class="field-group">
                            <label for="post_type">Post Type <span class="required">*</span></label>
                            <div class="select-wrapper">
                                <select id="post_type" name="post_type"
                                    class="input-select {{ $errors->has('post_type') ? 'input-error' : '' }}">
                                    @foreach ($types_drp as $type)
                                        <option value="{{ $type }}"
                                            {{ $post->post_type === $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('post_type')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="field-group">
                            <label>Status <span class="required">*</span></label>
                            <div class="radio-group">
                                @foreach ($status_drp as $status)
                                    <div class="radio-option">
                                        <input type="radio" id="status_{{ $status }}" name="status"
                                            value="{{ $status }}" {{ $post->status === $status ? 'checked' : '' }}>
                                        <label for="status_{{ $status }}">
                                            <span class="dot"></span>
                                            {{ ucfirst($status) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('status')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="two-col">

                        <div class="field-group">
                            <label for="views">Views <span class="required">*</span></label>
                            <input type="number" id="views" name="views"
                                class="input-text {{ $errors->has('views') ? 'input-error' : '' }}"
                                placeholder="Enter post views..." value="{{ $post->views }}">
                            @error('views')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="likes">Likes <span class="required">*</span></label>
                            <input type="number" id="likes" name="likes"
                                class="input-text {{ $errors->has('likes') ? 'input-error' : '' }}"
                                placeholder="Enter post likes..." value="{{ $post->likes }}">
                            @error('likes')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <hr class="form-divider">

                    {{-- Image Upload --}}
                    <div class="field-group">
                        <label>Featured Image <span style="color:#94a3b8; font-weight:400;">(optional)</span></label>

                        @if ($post->image_path)
                            <p class="current-image-label">Current image:</p>
                            <div class="current-image-wrapper">
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Current featured image">
                            </div>
                        @endif

                        <div class="image-upload-area" id="upload-area">
                            <input type="file" name="image_path" id="image_input"
                                accept="image/jpeg,image/png,image/webp,image/gif">
                            <div class="upload-icon">🖼️</div>
                            <div class="upload-text">
                                <strong>Click to upload</strong> or drag & drop
                            </div>
                            <div class="upload-hint">JPG, PNG, WEBP, GIF — max 2MB</div>
                        </div>

                        @error('image_path')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>{{-- /form-body --}}

                <div class="form-footer">
                    <a href="{{ route('posts-index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        ✚ Update
                    </button>
                </div>

            </form>
        </div>

    </div>

@endsection
