@extends('.modules.admin.layouts.main')

@php
    $listButton = [];
@endphp

@section('titlePage', 'Create article')


@section('content')

    <div class="row">
        <div class="col-md-8">
            <form class="needs-validation" novalidate="" action="{{ route('articles.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title your article" value="{{ old('title') }}">
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="category_id">Category:</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="{{ null }}">Not selected</option>
                            @foreach($categories as $key => $value)
                                @if($key == old('category_id'))
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="status">Status:</label>

                        @php
                        $listStatus = \App\Article::getStatusList();
                        @endphp

                        <select class="form-control" id="status" name="status">
                            <option value="{{ null }}" selected>Not select</option>
                            @foreach($listStatus as $key => $val)
                                @if($key == old('status'))
                                    <option value="{{ $key }}" selected>{{ $val }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content">Text article</label>
                    <textarea class="form-control" id="content" name="content" placeholder="Text article"  rows="3">{{ old('content') }}</textarea>
                </div>

                <hr class="mb-4">
                <div class="line-btn">
                    <button class="btn btn-success" type="submit">Save</button>
                    <a class="btn btn-danger" href="{{ route('articles.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
