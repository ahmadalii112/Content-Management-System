@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($tag) ? 'Edit Tag' : 'Create Tag'}}
        </div>
        <div class="card-body">
            <form method="POST" action="{{isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{isset($tag) ? $tag->name : old('name') }}"  required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{isset($tag) ? 'Update Tags': 'Add Tags'}}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
