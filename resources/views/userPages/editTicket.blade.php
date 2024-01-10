@extends("Layouts.masterLayout")
@section('title') Ticket - {{ $ticket['subject'] }} @endsection
@push('customstyle')
<style>
   
</style>
@endpush
@section('content')
<div style="margin:0 auto; width:60%; border:1px dotted grey; border-radius:10px;background: rgba(0, 0, 0, 0.7);" class="text-white p-5 mb-5 mt-5">
    <form action="/edit-ticket" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="text-center text-light">Edit Ticket</h2><hr class="mb-4">
        <input type="hidden" name="id" value="{{ $ticket['id'] }}">
        <div class="mb-1">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user["name"] }}" disabled>
            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
          </div>
          <div class="mb-1">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user["username"] }}" disabled>
            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
          </div>
        <div class="mb-1">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user["email"] }}" disabled>
          <span class="text-danger">@error('email') {{ $message }} @enderror</span>
        </div>
        <div class="mb-1">
            <label for="select_department" class="form-label">Select Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ $ticket['department'] }}" >
            <span class="text-danger">@error('department') {{ $message }} @enderror</span>
        </div>
        <div class="mb-1">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{ $ticket['subject'] }}" >
            <span class="text-danger">@error('subject') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Explain your issue</label>
            <textarea  class="form-control" id="description" name="description" id="" cols="30" rows="10">{{ $ticket['description'] }}</textarea>
            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
          </div>
          <div class="">
            <h4 class="text-light">Uploaded Files</h4>
           @foreach ($attachments as $attachment )
            <a class="text-danger" href="{{ Storage::url($attachment['path']) }}">Attachment {{ $loop->iteration }}</a>
           @endforeach
          </div>
          <div class="mb-3 mt-3">
            <label for="attachments" class="form-label">Upload Addtional Files</label>
            <input class="form-control" type="file" id="attachments" multiple name="attachments[]">
          </div>
        <button type="submit" class="btn btn-danger">Submit</button>
      </form>
    </div>
@endsection