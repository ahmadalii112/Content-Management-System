@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{route('tags.create')}}" class="btn btn-success mb-2">Add Tags </a>
    </div>
<div class="card card-default">
    <div class="card-header">Tags</div>
     <div class="card-body">
         @if($tags->count()>0)
             <table class="table table-hover">
                 <thead>
                 <th>Name</th>
                 <th>Post Count</th>
                 <th>Action</th>

                 </thead>
                 <tbody>
                 @foreach($tags as $tag)
                     <tr>
                         <td>{{$tag->name}}</td>
                         <td>{{$tag->posts->count()}}</td>
                         <td><a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm">Edit</a>
                             <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
                         </td>
                     </tr>
                 @endforeach
                 </tbody>
             </table>
         @else
             No Tags Available Yet
         @endif
         <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
             <div class="modal-dialog" role="document">
                 <form action="" method="post" id="deleteTagForm">
                     @csrf
                     @method('delete')
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="deleteModalLabel">Delete Tags</h5>
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
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            console.log('deleting.',form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
