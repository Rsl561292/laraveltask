@extends('.modules.admin.layouts.main')

@php
    $listButton = [
        [
            'btnType' => 'create',
            'classBtnType' => 'btn-primary',
            'nameRoute' => 'articles.create',
            'btnTitle' => 'Add New Article'
        ]
    ];
@endphp

@section('titlePage', 'Articles')


@section('content')

    @if(count($articles) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Upduted</th>
                        <th>Published</th>
                        <th class="th-actions"><a href="{{ route('articles.index') }}">Refresh</a></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $indexRow = 1;
                    @endphp
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $indexRow++ }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->getStatusName() }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->updated_at }}</td>
                            <td>{{ $article->published_at }}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary" href="{{ route('site.article', ['id' => $article->id]) }}" target="_blank">
                                    <i class="fa fa-external-link fa-fw" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-warning" href="{{ route('articles.edit', ['id' => $article->id]) }}">
                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-danger" href="{{ route('articles.destroy', ['id' => $article->id]) }}"
                                   onclick="
                                        event.preventDefault();
                                        if(confirm('Are you want really delete this article?')) {
                                            document.getElementById('destroy-form').submit();
                                        }
                                   ">
                                    <i class="fa fa-trash fa-fw" aria-hidden="true"></i>
                                </a>
                                <form id="destroy-form" action="{{ route('articles.destroy', ['id' => $article->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete"/>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $articles->links() }}
    @else
        <center><h4>You did not write anyone article.</h4></center>
    @endif
@endsection
