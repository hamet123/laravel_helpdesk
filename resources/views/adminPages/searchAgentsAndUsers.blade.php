@extends('adminPages.adminPageMasterLayout')
@section('title')
    Search Users
@endsection
@php
    use App\Models\Department;
    use App\Models\Status;
    use App\Models\User;
@endphp
@push('customstyle')
    <style>
        .searchAgentsAndUsers {
            background: red;
        }
        <style>
        
        .card {
            background: rgba(0, 0, 0, 0.568);
            color: white;
        }

        hr {
            background: white;
            margin: 0;
            padding: 0;
        }

        .parentdiv {
            background: rgba(0, 0, 0, 0.568);
            color: white;
            padding: 50px;
        }

        hr {
            background: white;
        }
        table thead th {
            font-size:12px;
        }
    </style>
@endpush
@section('content')
<div class="container parentdiv">
   <div class="row">
       <div class="col-xl-12">
           <h5 class="text-white text-center">Search Agent/User</h5>
           <hr class="my-3">
           <form action="/search-user" method="POST">
               <div class="container">
                   <div class="row">
                       <div class="col-xl-12">
                           <div class="row d-flex justify-content-center align-items-center">
                               @csrf
                               <div class="col-xl-5">
                                   <input type="text" name="user_identifier" id="user_identifier" class="form-control"
                                       placeholder="Email-ID / Username / Full Name" style="display:inline-block">
                               </div>
                               @error('user_identifier')
                                   <span class="text-danger my-3">{{ $message }}</span>                                        
                               @enderror
                               <div class="col-xl-3 d-flex justify-content-start">
                                   <input type="submit" value="Search" class="btn btn-danger my-2"
                                       style="display:inline-block">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </form>
           <hr class="my-3">
          

           @if (isset($user))
           <div class="row">
               <div class="col-xl-12">
                   <div class="row d-flex justify-content-center mt-5">
                       <div class="col-xl-6">
                           <img src="{{ Storage::url($user['profile_pic_path']) }}" alt="" class="text-center my-5" style="border:1px solid grey; border-radius:50%; height:100px; width:100px; padding:10px;">
                           <h6>Full Name - {{ $user['name'] }}</h6>
                           <hr class="my-3">
                           <h6>Email-ID - {{ $user['email'] }}</h6>
                           <hr class="my-3">
                           <h6>Username - {{ $user['username'] }}</h6>
                           <hr class="my-3">
                           <h6>Role Assigned -  {{ $user['role'] }}</h6>
                           <hr class="my-3">
                           @if ($user['department_id']!==NULL)
                           <h6>Department Assigned - {{ Department::find($user['department_id'])['department'] }}</h6>
                           <hr class="my-3">
                           @endif
                       </div>
                   </div>
               </div>
           </div>                   
           @endif
       </div>
   </div>
</div>
@endsection
