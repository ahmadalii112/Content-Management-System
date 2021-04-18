@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($category) ? 'Edit Category' : 'Create Category'}}
        </div>
        <div class="card-body">
            <form method="POST" action="{{isset($category) ? route('categories.update',$category->id) : route('categories.store')}}">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{isset($category) ? $category->name : old('name') }}"  required autocomplete="name" autofocus>

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
                            {{isset($category) ? 'Update Category': 'Add Category'}}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
