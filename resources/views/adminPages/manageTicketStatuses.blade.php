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
   </style>
@endpush
@section('content')
<div class="container">
   <div class="row d-flex justify-content-center mb-5 mt-3">
      <div class="col-md-8">
         <div>
            <h2 class="text-center text-white">Create Ticket Status</h2>
            <hr class="mb-5">
            <form action="/create-ticket-status" method="POST">
               @csrf
                  <div class="mb-3">
                     <label for="status" class="form-label">Status</label>
                     <input type="text" name="status" id="status" class="form-control" value="{{ old('status') }}" required>
                  </div>
                  @error('status')
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-danger">Create</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection