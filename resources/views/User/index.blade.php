@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
            @if($users->count()>0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>

                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="http://placehold.it/50x50" style="border-radius: 50%" alt="">

                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{ route('users.make-admin',$user->id)}}" method="post">
                                        @csrf

                                        <button type="submit" class="btn btn-primary btn-sm">Make Admin</button>
                                    </form>
                                @endif
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
