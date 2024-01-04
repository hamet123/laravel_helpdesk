@extends("userPages.userPageMasterLayout")
@section('title') My Profile @endsection
@push('customstyle')
<style>
.navdiv-active-my-profile {
    background: #b93c38

} 
.parentdiv{
    background:rgba(0,0,0,0.7);
    border-radius:10px;
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
#fileInputWrapper {
      position: relative;
      width: 150px;
      height: 150px;
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

    #fileInput {
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


@section('usercontent')
<div class="container parentdiv mt-5">
    <div class="row">
        <div class="col-md-4 firsthalfdiv">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="" alt="">
                      <form action="/upload-profile-pic" method="POST" enctype="multipart/form-data">
                        <label for="fileInput" id="fileInputWrapper">
                            <span class="text-danger uploadPicText" style="display:none;">Upload</span>
                            <input type="file" id="fileInput" accept="image/*">
                          </label>
                      </form>
                    </div>
                    <hr class="my-4">
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="contact">
                            <p class="contactTitle">Address</p>
                            <p class="contact">Set No. 2, Type-3, Block M-1, Housing Board Colony, Mehli, Shimla 171009</p>
                        </div>
                    </div>
                    <hr class="my-3"> 

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="address">
                            <p class="addressTitle">Contact Details</p>
                            <p class="address">Phone Number : </p>
                            <p class="address">Email : </p>
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
                                    <i class="socialIcons fa-brands fa-square-facebook"></i>
                                </div>
                                <div class="col-md-3">
                                    <i class="socialIcons fa-brands fa-square-x-twitter"></i>
                                </div>
                                <div class="col-md-3">
                                    <i class="socialIcons fa-brands fa-youtube"></i>
                                </div>
                                <div class="col-md-3">
                                    <i class="socialIcons fa-brands fa-square-instagram"></i>
                                </div>
                            </div>
                            
                        </div>
                       </div> 
                </div>

            </div>
        </div>




        
        <div class="col-md-8 secondhalfdiv">
            <div class="container">
                <form action="/edit-profile" method="POST">
                    <div class="row my-5">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" name="role" class="form-control" id="role">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone">
                            </div>
                            <input type="submit" value="Save" class="btn btn-success">
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="usernameme">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Address</label>
                                <textarea name="Address" class="form-control" rows="1" id="address"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

                    <div class="row">
                        <div class="row my-1">
                            <div class="col-md-12 p-3" style="border-radius:10px; border-bottom:1px solid rgb(173, 173, 173);">
                                <ul class="d-flex p-0 justify-content-around align-items-center" style="list-style:none;">
                                <li class="text-white">Total Tickets Raised : 23</li>
                                <li class="text-white">Pending Tickets : 8</li>
                                <li class="text-white">Closed Tickets : 0</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <form action="/change-password" method="POST">
                        <h5 class="text-white  mt-5 mb-2">Change Your Password</h5>
                        <div class="row" style="border-radius:10px; border:1px solid rgb(173, 173, 173); padding:20px;">
                            <div class="col-md-4">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter New Password">
                            </div>
                            <div class="col-md-4">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm New Password">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Change Password" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                
            </div>
        </div>
    </div>
</div>
@endsection