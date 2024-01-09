@extends('adminPages.adminPageMasterLayout')
@section('title') Manage Agents @endsection
@push('customstyle')
   <style>
     .manageAgents {
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
               <h2 class="text-center text-white">Create Agent</h2>
               <hr class="mb-5">
               <form action="/create-agent" method="POST">
                  @csrf
                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                     </div>
                     @error('email')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                     </div>
                     @error('username')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="mb-3">
                        <label for="department" class="form-label">Select Department</label>
                        <input type="text" name="department" id="department" class="form-control" value="{{ old('department') }}" required>
                     </div>
                     @error('department')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="mb-3">
                        <label for="password" class="form-label">Create a Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                     </div>
                     @error('password')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password_confirmation" name="password" id="password_confirmation" class="form-control" required>
                     </div>
                     @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <button type="submit" class="btn btn-danger">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection