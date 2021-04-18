@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{route('categories.create')}}" class="btn btn-success mb-2">Add Category </a>
    </div>
<div class="card card-default">
    <div class="card-header ">Categories</div>
     <div class="card-body">
         @if($categories->count()>0)
             <table class="table table-hover">
                 <thead>
                 <th>Name</th>
                 <th>Post Count</th>
                 <th>Sub Category Count</th>
                 <th>Action</th>

                 </thead>
                 <tbody>
                 @foreach($categories as $category)
                     <tr>
                         <td>{{$category->name}}</td>
                         <td>{{$category->post->count()}}</td>
                         <td>{{$category->subcat->count()}}</td>
                         <td class="d-flex">
                             <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                             <button class="btn btn-danger btn-sm btn-sm ml-1" onclick="handleDelete({{$category->id}})">Delete</button>
                         </td>
                     </tr>
                 @endforeach
                 </tbody>
             </table>
         @else
             No Categories Available Yet
         @endif
         <!--For Delete box-->
         <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
             <div class="modal-dialog" role="document">
                 <form action="" method="post" id="deleteCategoryForm">
                     @csrf
                     @method('delete')
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <p>Are you sure to  Delete this ?.</p>
                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-danger">Yes, Please</button>
                             <button type="button" class="btn btn-warning" data-dismiss="modal">No, Go Back</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
</div>
@endsection
<!--FOr Delete scripts-->

@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/' + id  // for delete in route list 'category/{category}'
            console.log('deleting.',form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
