@extends("userPages.userPageMasterLayout")
@section('title') Closed Tickets @endsection
@push('customstyle')
<style>
.navdiv-active-create-ticket {
  background: #b93c38

} 
label{
    color:white;
}
</style>
  
@endpush


@section("usercontent")
<div style="margin:0 auto; width:60%; border:1px dotted grey; border-radius:10px;background: rgba(0, 0, 0, 0.7);" class="p-5 mb-5 mt-5">
    <form action="/create-ticket" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="text-center text-light">Raise a Ticket</h2><hr class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user["name"] }}" disabled>
            @error('name') <span class="text-danger my-3">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user["username"] }}" disabled>
            @error('username') <span class="text-danger my-3">{{ $message }}</span>  @enderror
          </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user["email"] }}" disabled>
          @error('email') <span class="text-danger my-3">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Select Department</label>
            <select class="form-select form-select" name="department_id" id="department_id">
              <option value="" selected>Select Department</option>
              @foreach ($departments as $department)
              <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
              @endforeach
           </select>
            @error('department_id') <span class="text-danger my-3">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" value="" >
            @error('subject') <span class="text-danger my-3">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Explain your issue</label>
            <textarea  class="form-control" id="description" name="description" id="" cols="30" rows="10"></textarea>
            @error('description') <span class="text-danger my-3">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="attachments" class="form-label">Attachments</label>
            <input class="form-control" type="file" id="attachments" multiple name="attachments[]">
          </div>
        <button type="submit" class="btn btn-danger">Submit</button>
      </form>
    </div>
@endsection
