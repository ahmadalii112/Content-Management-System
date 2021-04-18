@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{route('posts.create')}}" class="btn btn-success mb-2">Add Posts </a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            @if($posts->count()>0)
                <table class="table table-hover">
                    <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>

                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="/storage/{{$post->image}}" width="80px" height="70px" alt="">

                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit',$post->category->id)}}">
                                    <!-- belongs to relation in Post Model -->
                                    {{$post->category->name}}
                                </a>
                            </td>
                            <td class="d-flex">
                                @if($post->trashed())
                                    <form action="{{route('restore-post',$post->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary ml-1">Restore</button>
                                    </form>
                                @else
                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-sm btn-outline-primary ml-1">Edit</a>
                                @endif

                                <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger ml-1">
                                        {{ $post->trashed() ? 'Delete':'Trash' }}
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @else
                No Posts Available Yet
            @endif
        </div>
    </div>
@endsection
