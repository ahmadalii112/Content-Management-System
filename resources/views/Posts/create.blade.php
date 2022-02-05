@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            {{isset($post) ? 'Edit Posts' : 'Create Posts'}}
        </div>
        <div class="card-body">
            <form method="POST" action="{{isset($post) ?route('posts.update',$post->id) :route('posts.store') }}"
                  enctype="multipart/form-data">
            @csrf
            <!-- Title-->
                @if(isset($post))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{isset($post) ? $post->title : old('title') }}"
                              {{-- value="old('title',($post) ? $post->title : '')" --}}
                               required
                               autocomplete="name" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <!-- Description-->
                <div class="form-group row">
                    <label for="description"
                           class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                <textarea id="description" type="text"
                          class="form-control @error('description') is-invalid @enderror"
                          name="description" cols="5" rows="5" required autocomplete="description"
                          autofocus>{{isset($post) ? $post->description : ''}}</textarea>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>
                <!-- Content-->
                <div class="form-group row">
                    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                    <div class="col-md-6">
                        <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content: ''}}">
                        <trix-editor input="content"></trix-editor>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>
                <!-- Published At-->
                <div class="form-group row">
                    <label for="published_at"
                           class="col-md-4 col-form-label text-md-right">{{ __('PublishedAt') }}</label>

                    <div class="col-md-6">
                        <input id="published_at" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="published_at" value="{{isset($post) ? $post->published_at: old('published_at')}}"
                               required autocomplete="published_at"
                               autofocus>

                        @error('published_at')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <!-- Image-->
                @if(isset($post))
                    <div class="form-group">
                        <img src="/storage/{{$post->image}}" width="100%" alt="">
                    </div>
                @endif

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                    <div class="col-md-6">
                        <img src="http://placehold.it/150x150" id="preview" class="img-thumbnail ml-5" alt="preview"
                             style="border-radius: 50%; width: 150px;height: 150px ">

                        <input id="image" type="file" accept="image/*" onchange="showPreview(event);"
                               class="form-control @error('image') is-invalid @enderror"
                               name="image" value="{{old('image') }}" required autocomplete="name" autofocus>

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror

                    </div>

                </div>
                <!-- Image Preview Scripts-->
                <script>
                    function showPreview(event) {

                        if (event.target.files.length > 0) {
                            var src = URL.createObjectURL(event.target.files[0]);

                            var preview = document.getElementById("preview");

                            preview.src = src;


                            preview.style.display = "block";

                        }

                    }
                </script>


                <!-- Category-->
                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                    <div class="col-md-6">
                        <select id="category" class="form-control " name="category">
                            <option value="">Select...</option>
                            @foreach($categories as $category)

                                <option value="{{$category->id}}" @if (old('category') == $category->id) selected="selected" @endif 
                                        @if(isset($post))
                                        @if($category->id == $post->category_id)
                                        selected
                                        @endif
                                        @endif
                                >
                                    {{$category->name}}</option>
                            @endforeach
                        </select>

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <!-- SUB Category-->
                    <div class="form-group row">
                        <label for="category"
                               class="col-md-4 col-form-label text-md-right">{{ __('Sub-Category') }}</label>

                        <div class="col-md-6">
                            <select id="sub_category" class="form-control " name="subcategory">
                                <option value="">Select</option>

                            </select>

                            @error('subcategory')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                    </div>

            <!--                -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--                <script>
                    $(document).ready(function () {
                        $('#sub_category_name').on('change', function () {
                            let id = $(this).val();
                            $('#sub_category').empty();
                            $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
                            $.ajax({
                                type: 'GET',
                                url: 'GetSubCatAgainstMainCatEdit/' + id,
                                success: function (response) {
                                    var response = JSON.parse(response);
                                    console.log(response);
                                    $('#sub_category').empty();
                                    $('#sub_category').append(`<option value="0" disabled selected>Select Sub Category</option>`);
                                    response.forEach(element => {
                                        $('#sub_category').append(`<option value="${element['id']}">${element['subcategory']}</option>`);
                                    });
                                }
                            });
                        });
                    });
                </script>-->
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('select[name="category"]').on('change', function(){
                            var category = $(this).val();
                            if(category) {
                                $.ajax({
                                    url: "{{  url('/get/subcategory/') }}/"+category,
                                    type:"GET",
                                    dataType:"json",
                                    success:function(data) {
                                        $("#sub_category").empty();
                                        $.each(data,function(key,value){
                                            $("#sub_category").append('<option value="'+value.id+'">'+value.subcategory+'</option>');
                                        });
                                    },

                                });
                            } else {
                                alert('danger');
                            }
                        });
                    });
                </script>


                <!-- Tags-->
                @if($tags->count()>0)
                    <div class="form-group row">
                        <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                        <div class="col-md-6">
                            <select id="tags" class="form-control tags-selector " name="tags[]" multiple>

                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}"
                                            @if(isset($post))
                                            @if($post->hasTag($tag->id))
                                            selected
                                            @endif
                                            @endif
                                    >
                                        {{$tag->name}}</option>
                                @endforeach

                            </select>

                            @error('tags')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
            @endif
            <!-- Button-->
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{isset($post) ? 'Update Post' : 'Add Post'}}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<!--Scripts of TRIX Editor-->
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <!--Date FlatPicker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
        $(document).ready(function () {
            $('.tags-selector').select2();
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
