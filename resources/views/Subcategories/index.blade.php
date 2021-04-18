@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{route('subcategories.create')}}" class="btn btn-success mb-2">Add Sub-Category </a>
    </div>
<div class="card card-default">
    <div class="card-header">Sub-Category</div>
     <div class="card-body">
         @if($subcategories->count()>0)
             <table class="table table-hover">
                 <thead>
                 <th>Sub Category</th>
                 <th>Category</th>
                 <th>Action</th>

                 </thead>
                 <tbody>
                 @foreach($subcategories as $category)
                     <tr>
                         <td>{{$category->subcategory}}</td>
                         <td>
                             {{$category->category->name}}

                         </td>
                         <td><a href="{{route('subcategories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                             <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
                         </td>
                     </tr>
                 @endforeach
                 </tbody>
             </table>
         @else
             No Sub Categories Available Yet
         @endif
         <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
             <div class="modal-dialog" role="document">
                 <form action="" method="post" id="deleteSubCategoryForm">
                     @csrf
                     @method('delete')
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="deleteModalLabel">Delete Sub-Category</h5>
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
@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteSubCategoryForm')
            form.action = '/subcategories/' + id
            console.log('deleting.',form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
