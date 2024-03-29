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
    .createStatus, .updateStatus, .showStatus {
      background:rgba(0,0,0,0.5);
      padding:50px;
    }
    
   </style>
@endpush
@section('content')

<div class="container">
   <div class="row d-flex justify-content-center mb-5 mt-3">
      <div class="col-md-12">
         @if(!(Session::get('editStatus')))
         <div class="createStatus">
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
         <style>
            body{
                background: url('/images/bgg.jpg');
            }
        </style>
         <div class="updateStatus">
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
      <div class="col-md-12 showStatus">
         <div class="table-responsive">
            <h2 class="text-white text-center">List of Ticket Statuses</h2>
            <hr>
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col">Serial</th>
                     <th scope="col">Status</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php
                        $serialNumber = ($statuses->currentPage() - 1) * $statuses->perPage();
                    @endphp
                  @forelse ($statuses as $status)
                  @php
                     $serialNumber++;
                  @endphp
                  <tr>
                     <th scope="row">{{ $serialNumber }}</th>
                     <td>{{ $status->status_name }}</td>
                     <td>
                        <a href="/edit-ticket-status/{{ $status->id }}" class="btn btn-success">Edit</a>
                        <a href="/delete-ticket-status/{{ $status->id }}" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="5" class="text-center">No Status found</td>
                 </tr>
                  @endforelse
               </tbody>
            </table>
            <div class="text-center" id="pagination">
               {{ $statuses->links('pagination::bootstrap-5') }}
           </div>
         </div>
      </div>
   </div>
</div>
@endsection