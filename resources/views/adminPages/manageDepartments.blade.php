@extends('adminPages.adminPageMasterLayout')
@section('title') Manage Departments @endsection
@push('customstyle')
   <style>
      .table{
         color:white;
      }
     .manageDepartments {
        background: red;
    }
    label{
      color:white;
    }
    hr{
      background:white;
    }
    .listdiv, .creatediv{
      background:rgba(0,0,0,0.5);
      padding:50px;
    }
   </style>
@endpush
@section('content')
<div class="container">
   

   @if (!(Session::get('editDepartment')))
   <div class="row creatediv d-flex justify-content-center mb-5 mt-3">
      <div class="col-md-8">
         <div>
            <h2 class="text-center text-white">Create Department</h2>
            <hr class="mb-5">
            <form action="/create-department" method="POST">
               @csrf
                  <div class="mb-3">
                     <label for="department" class="form-label">Department</label>
                     <input type="text" name="department" id="department" class="form-control" value="{{ old('department') }}" required>
                  </div>
                  @error('department')
                     <span class="text-danger my-3" style="display:block">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-danger">Create</button>
            </form>
         </div>
      </div>
   </div>
   @endif

   
  

   @if (Session::get('editDepartment') && isset($changeDepartment))
   <div class="row creatediv d-flex justify-content-center mb-5 mt-3">
      <div class="col-md-8">
         <div>
            <h2 class="text-center text-white">Edit Department</h2>
            <hr class="mb-5">
            <form action="/edit-department" method="POST">
               @csrf
               <input type="hidden" name="id" value="{{ $changeDepartment['id'] }}">
                  <div class="mb-3">
                     <label for="department" class="form-label">Department</label>
                     <input type="text" name="department" id="department" class="form-control" value="{{ $changeDepartment['department'] }}" required>
                  </div>
                  @error('department')
                     <span class="text-danger my-3" style="display:block">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-success">Update</button>
            </form>
         </div>
      </div>
   </div>
   @endif

   <div class="row listdiv my-5">
      <div class="col-md-12">
         <div>
            <h2 class="text-white text-center">List of Departments</h2>
            <hr>
            <table class="table table-responsive mt-5">
               <thead>
                  <tr>
                     <th scope="col">Serial Number</th>
                     <th scope="col">Department</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($departments as $department)
                     <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $department->department }}</td>
                        <td>
                           <a href="/edit-department/{{ $department->id }}" class="btn btn-primary">Edit</a>
                           <a href="/delete-department/{{ $department->id }}" class="btn btn-danger">Delete</a>
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="5" class="text-center">No Department found</td>
                    </tr>
                  @endforelse
               </tbody>
            </table>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection