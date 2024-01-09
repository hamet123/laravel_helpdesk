@extends('adminPages.adminPageMasterLayout')
@section('title') Manage Departments @endsection
@push('customstyle')
   <style>
     .manageDepartments {
        background: red;
    }
    label{
      color:white;
    }
    hr{
      background:white;
    }
   </style>
@endpush
@section('content')
<div class="container">
   <div class="row d-flex justify-content-center mb-5 mt-3">
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
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-danger">Create</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection