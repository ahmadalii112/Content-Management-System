@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($category) ? 'Edit Sub-Category' : 'Create Sub-Category'}}
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{isset($category) ? route('subcategories.update',$category->id) : route('subcategories.store')}}">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="category" class="form-control " name="category">
                                <option value="">Select...</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Subcategory') }}</label>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="subcategory" value="" required
                                   autocomplete="subcategory" autofocus>

                            @error('subcategory')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            Add Subcategory
                            {{--                            {{isset($category) ? 'Add Sub-Category': 'Add Sub-Category'}}--}}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
