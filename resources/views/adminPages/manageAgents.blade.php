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
    .table{
      color:white;
    }
    .agentForm, .listagents{
      background:rgba(0,0,0,0.5);
      padding:50px;
    }
   </style>
@endpush
@section('content')
   <div class="container">
      @if (!(Session::get('editAgent')))
      <div class="row d-flex justify-content-center mb-5 mt-3">
         <div class="col-md-12">
            <div class="agentForm">
               <h2 class="text-center text-white">Create Agent</h2>
               <hr class="mb-5">
               <form action="/create-agent" method="POST">
                  @csrf
                  <div class="mb-3">
                     <label for="name" class="form-label">Full Name</label>
                     <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                  </div>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
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
                        
                           <select class="form-select form-select" name="department" id="department">
                              <option value="" selected>Select Department</option>
                              @foreach ($departments as $department)
                              <option value="{{ $department['department'] }}">{{ $department['department'] }}</option>
                              @endforeach
                           </select>
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
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                     </div>
                     @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <button type="submit" class="btn btn-danger">Submit</button>
               </form>
            </div>
         </div>
      </div>
      @endif


      @if (Session::get('editAgent') && isset($agentDetails))
      <div class="row d-flex  justify-content-center mb-5 mt-3">
         <div class="col-md-12">
            <div class="agentForm">
               <h2 class="text-center text-white">Edit Agent</h2>
               <hr class="mb-5">
               <form action="/edit-agent" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $agentDetails['id'] }}">
                  <div class="mb-3">
                     <label for="name" class="form-label">Full Name</label>
                     <input type="text" name="name" id="name" class="form-control" value="{{ $agentDetails['name'] }}" required>
                  </div>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $agentDetails['email'] }}" disabled>
                     </div>
                     @error('email')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ $agentDetails['username'] }}" disabled>
                     </div>
                     @error('username')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="mb-3">
                        <label for="department" class="form-label">Select Department</label>
                        
                           <select class="form-select form-select" name="department" id="department">
                              <option value="{{ $agentDetails['department'] }}" selected>{{ $agentDetails['department'] }}</option>
                              @foreach ($departments as $department)
                              <option value="{{ $department['department'] }}">{{ $department['department'] }}</option>
                              @endforeach
                           </select>
                     </div>
                     @error('department')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <button type="submit" class="btn btn-success">Update</button>
               </form>
            </div>
         </div>
      </div>
      @endif
      

      <div class="row my-5">
         <div class="col-md-12 table-responsive listagents">
            <h2 class="text-white text-center">List of Agents</h2>
            <hr>
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col">Serial Number</th>
                     <th scope="col">Full Name</th>
                     <th scope="col">Email</th>
                     <th scope="col">Username</th>
                     <th scope="col">Department</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($agents as $agent)
                  <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $agent['name'] }}</td>
                     <td>{{ $agent['email'] }}</td>
                     <td>{{ $agent['username'] }}</td>
                     <td>{{ $agent['department'] }}</td>
                     <td style="min-width:200px;">
                        <a href="/edit-agent/{{ $agent['id'] }}" class="btn btn-primary">Edit</a>
                        <a href="/delete-agent/{{ $agent['id'] }}" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="5" class="text-center">No Agent found</td>
                 </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection