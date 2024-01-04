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
    border-right:1px solid white;
    display: flex;
      justify-content: center;
      align-items: center;
}

/* Profile picture background styling  */
#fileInputWrapper {
      position: relative;
      width: 200px;
      height: 200px;
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
<div class="container parentdiv">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                              </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection