@extends('adminPages.adminPageMasterLayout')
@section('title') Manage Statuses @endsection
@push('customstyle')
   <style>
     .manageTicketStatuses {
        background: red;
    }
    label{
      color:white;
    }
    hr{
      background:white;
    }
    .table{
      color:white;
    }
    
   </style>
@endpush
@section('content')
@php
   if(isset($statusDetails)){
      $statusDetails['status_name']= "";
   }
@endphp
<div class="container">
   <div class="row d-flex justify-content-center mb-5 mt-3">
      <div class="col-md-8">
         @if(!(Session::get('editStatus')))
         <div>
            <h2 class="text-center text-white">Create Ticket Status</h2>
            <hr class="mb-5">
            <form action="/create-ticket-status" method="POST">
               @csrf
                  <div class="mb-3">
                     <label for="status_name" class="form-label">Status</label>
                     <input type="text" name="status_name" id="create_status_name" class="form-control" value="{{ old('status') }}" required>
                  </div>
                  @error('status_name')
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-danger">Create</button>
            </form>
         </div>
         @endif

         @if (Session::get('editStatus') && isset($statusDetails))
         <div>
            <h2 class="text-center text-white">Edit Ticket Status</h2>
            <hr class="mb-5">
            <form action="/edit-ticket-status" method="POST">
               @csrf
                  <input type="hidden" name="id" value="{{ $statusDetails['id'] }}">
                  <div class="mb-3">
                     <label for="status_name" class="form-label">Status</label>
                     <input type="text" name="status_name" id="edit_status_name" class="form-control" value="{{ $statusDetails['status_name'] }}" required>
                  </div>
                  @error('status_name')
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-success">Update</button>
            </form>
         </div>
         @endif

      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col">Serial</th>
                     <th scope="col">Status</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($statuses as $status)
                  <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $status->status_name }}</td>
                     <td>
                        <a href="/edit-ticket-status/{{ $status->id }}" class="btn btn-success">Edit</a>
                        <a href="/delete-ticket-status/{{ $status->id }}" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection