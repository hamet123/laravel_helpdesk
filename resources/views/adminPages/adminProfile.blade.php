@extends('adminPages.adminPageMasterLayout')
@section('title') Admin Profile @endsection
@push('customstyle')
   <style>
     .adminProfile {
        background: red;
    }
    
.parentdiv{
    background:rgba(0,0,0,0.5);
    padding:40px;
    height:auto;
    min-height:auto;
    
}
.firsthalfdiv{
    border:1px solid rgb(160, 160, 160);
    border-radius:10px;
    padding-top:20px;
    padding-bottom:20px;
    display: flex;
      justify-content: center;
      align-items: center;
}

/* Profile picture background styling  */

#fileInputWrapper, #fileInputWrapper2 {
      position: relative;
      width: 100px;
      height: 100px;
      overflow: hidden;
      border-radius: 50%;
      background: url('https://www.shutterstock.com/image-vector/vector-flat-illustration-grayscale-avatar-600nw-2264922221.jpg') center/cover no-repeat;
      cursor: crosshair;
      display: flex;
      justify-content: center;
      align-items: center;
      color: black;
      font-size: 16px;
      font-weight: bold;
      /* background-size: fill; */
      object-fit: cover;
    }


    #fileInput, #fileInput2 {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: crosshair;
    }
    .uploadPicText {
        
        font-weight:900;
    }
    hr{
        background:white;
    }
    /* end of profile picture styling  */
    .address, .contact{
        font-size:10px;
        color:white;
        display:block;
    }
    .socialIcons{
        color:white;
        font-size:40px;
    }
    .socialIcons:hover{
        transform: scale(1.2);
        transition: 0.3s ease;
    }
    .address, .contact{
        
        font-weight: bold;
    }
    .addressTitle, .contactTitle, .socialTitle{
        font-size: 18px;
        color:#38e126;
        font-weight: bold;
    }
    label{
        color:white;
    }
   </style>
@endpush
@section('content')
@php
if($userDetails==NULL){
    $userDetails = [
        'user_id'=> NULL,
        'phone'=>"",
        'address'=>"",
        'facebook'=>"",
        'twitter'=>"",
        'instagram'=>"",
        'youtube'=>"",
    ];
}
@endphp
<div class="container parentdiv mt-2">
<div class="row">
    <div class="col-md-4 firsthalfdiv">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    @if ($user['profile_pic_path'] == NULL)
                    <form action="/upload-admin-profile-pic" method="POST" enctype="multipart/form-data" files="true">
                        @csrf
                        <label for="fileInput2" id="fileInputWrapper2">
                            <input type="file" id="fileInput2" name="file" accept="image/*">
                        </label>
                        <input type="submit" value="Upload" style="margin-top:20px; margin-left:10px;" class="btn btn-success">
                      </form>
                    @else
                    <form action="/upload-admin-profile-pic" method="POST" enctype="multipart/form-data" files="true">
                        @csrf
                        <label for="fileInput" id="fileInputWrapper">
                            <input type="file" id="fileInput" name="file" accept="image/*">
                    <img src="{{ Storage::url($user['profile_pic_path']) }}" style="height:100px;width:100px;border-radius:50%" alt="">

                        </label>
                        <input type="submit" value="Change Pic" style="margin-top:20px; margin-left:-10px;" class="btn btn-success">
                      </form>
                    @endif
                 

                </div>
                <hr class="my-4">
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="contact">
                        <p class="contactTitle">Address</p>
                        <p class="contact">{{ $userDetails['address'] }}</p>

                    </div>
                </div>
                <hr class="my-3"> 

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="address">
                        <p class="addressTitle">Contact Details</p>
                        <p class="address">Phone Number :  {{ $userDetails['phone'] }}</p>
                        <p class="address">Email : {{ $user['email'] }}</p>

                    </div>
                </div>
                <hr class="my-3"> 
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p class="socialTitle">Social Network</p>
                    <div class="container">
                       
                        <div class="row">
                            
                            <div class="col-md-3">
                                <a href="{{ $userDetails['facebook'] }}"> <i class="socialIcons fa-brands fa-square-facebook"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ $userDetails['twitter'] }}"><i class="socialIcons fa-brands fa-square-x-twitter"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ $userDetails['youtube'] }}"><i class="socialIcons fa-brands fa-youtube"></i></a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ $userDetails['instagram'] }}"><i class="socialIcons fa-brands fa-square-instagram"></i></a>

                            </div>
                        </div>
                        
                    </div>
                   </div> 
            </div>

        </div>
    </div>




    
    <div class="col-md-8 secondhalfdiv">
        <div class="container">
            <h4 class="text-white">Edit Profile</h4>
            <hr>
            @if ($userDetails['user_id']!==NULL)
            <form action="/update-admin-profile" method="POST">
            @else
            <form action="/edit-admin-profile" method="POST">
            @endif 
                @csrf
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user['name'] }}">
                        </div>
                        @error('name')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" id="role" value="{{ $user['role'] }}" disabled>
                        </div>
                        @error('role')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ $userDetails['phone'] }}">
                        </div>
                        @error('phone')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook Profile URL</label>
                            <input type="text" name="facebook" class="form-control" id="facebook" value="{{ $userDetails['facebook'] }}">
                        </div>
                        @error('facebook')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter Profile URL</label>
                            <input type="text" name="twitter" class="form-control" id="twitter" value="{{ $userDetails['twitter'] }}">
                        </div>
                        @error('twitter')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        @if ($userDetails['user_id']!==NULL)
                        <input type="submit" value="Update" class="btn btn-success mt-2">
                        @else
                        <input type="submit" value="Save" class="btn btn-success mt-2">
                        @endif                            
                    </div>
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}" disabled>
                        </div>
                        @error('email')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="usernameme" value="{{ $user['username'] }}" disabled>
                        </div>
                        @error('username')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="1" id="address">{{ $userDetails['address'] }}</textarea>
                        </div>
                        @error('address')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <label for="youtube" class="form-label">Youtube Channel URL</label>
                            <input type="text" name="youtube" class="form-control" id="youtube" value="{{ $userDetails['youtube'] }}">
                        </div>
                        @error('youtube')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram Profile URL</label>
                            <input type="text" name="instagram" class="form-control" id="instagram" value="{{ $userDetails['instagram'] }}">
                        </div>
                        @error('instagram')
                            <span class="text-danger my-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>

                <form action="/change-admin-password" method="POST">
                @csrf

                    <h5 class="text-white  mt-5 mb-2">Change Your Password</h5>
                    <hr>
                    <div class="row" style="padding;20px;">
                        <div class="col-md-4">
                            <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Enter Current Password">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter New Password">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm New Password">
                        </div>
                        <div class="col-md-4 my-3">
                            <input type="submit" value="Change Password" class="btn btn-success">
                        </div>
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                        @error('wrongCurrentPassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <hr>
                    </div>
                </form>
        </div>
    </div>
    
    
</div>
</div>
@endsection