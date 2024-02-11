@extends('Layouts.masterLayout')
@section('title')
    Home
@endsection
@push('customscripts')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush
<style>
    .parentdivhome {
        margin-bottom: 100px;
    }
    hr{
        background: white !important;
        
    }

    .highlight:hover{
        background:#b70b0bb5 !important;
    }

    /* slider style starts here */
    .slider-container {
            width:100%;
            margin: auto;
            overflow: hidden;
            position: relative;
            padding:50px;
            background-color: rgba(0,0,0, 0.6); /* Transparent background */
            border-radius:10px;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .video-container {
            flex: 0 0 25%; /* Display 4 videos at a time */
            padding: 10px;
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 24px;
            color: #333;
            background-color: transparent;
            border: none;
        }

        .nav-btn-left {
            left: 10px;
            color:white;
        }

        .nav-btn-right {
            right: 10px;
            color:white;

        }
    /* slider style ends here */

    /* accordian style starts here  */
    .accordion-container {
            background-color: rgba(0, 0, 0, 0.6); /* Transparent background */
            max-width: 600px;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            color:white;
        }

        .accordion {
            display: flex;
            flex-direction: column;
        }

        .faq {
            border-bottom: 1px solid #c3c3c3;
            padding: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .faq-content p {
            margin: 0;
        }

        .plus-sign {
            font-size: 20px;
            margin-left: 10px;
        }

        .faq:hover {
            background-color: #bb3030; /* Dark green hover color */
        }
    /* accordian style ends here */

</style>
@section('content')
    <div class="container parentdivhome">
        <div class="row mt-5 p-5 d-flex align-items-center" style="background:rgba(0,0,0,0.6); border-radius:10px;">
            <div class="col-md-7">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="title">
                                <h2 style="font-weight:bold;" class="text-white">Welcome to iDesk</h2>
                            </div>

                            <div class="description">
                                <p class="text-white" style="text-align:justify">
                                    iDesk is a powerful online helpdesk management system designed to streamline and enhance
                                    your
                                    customer support experience.
                                    Efficiently manage helpdesk tickets, access a comprehensive knowledgebase, and benefit
                                    from
                                    instructive video tutorials - all in one centralized platform.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-5 d-flex justify-content-end">
                <lottie-player src="{{ asset('/js/helpdesk.json') }}" background="Transparent" speed="1" direction="1"
                    mode="normal" autoplay loop>
                </lottie-player>
                {{-- <img src="{{ asset('/images/desk.png') }}" alt="" class="img-fluid"> --}}
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-xl-3 col-md-6 p-3">
                <div class="highlight p-3" style="background:rgba(0,0,0,0.6); border-radius:10px;">
                    <div class="row d-flex justify-content-center">
                        <img src="{{ asset('/images/efficient.png') }}" alt="" style="height:100px;width:130px;">
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <h5 class="text-white text-center">Efficiency</h5>
                    </div>
                    <hr class="my-1">
                    <div class="row">
                        <p class="text-white text-center">Streamline support processes for faster resolution</p>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 p-3">
                <div class="highlight p-3" style="background:rgba(0,0,0,0.6); border-radius:10px;">
                    <div class="row d-flex justify-content-center">
                        <img src="{{ asset('/images/access.png') }}" alt="" style="height:100px;width:130px;">
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <h5 class="text-white text-center">Accessibility</h5>
                    </div>
                    <hr class="my-1">
                    <div class="row">
                        <p class="text-white text-center">Ensure easy access to support resources and services</p>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-6 p-3">
                <div class="highlight p-3" style="background:rgba(0,0,0,0.6); border-radius:10px;">
                    <div class="row d-flex justify-content-center">
                        <img src="{{ asset('/images/responsive.png') }}" alt="" style="height:100px;width:130px;">
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <h5 class="text-white text-center">Responsive</h5>
                    </div>
                    <hr class="my-1">
                    <div class="row">
                        <p class="text-white text-center">Quick and timely resolution to support requests</p>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-6 p-3">
                <div class="highlight p-3" style="background:rgba(0,0,0,0.6); border-radius:10px;">
                    <div class="row d-flex justify-content-center">
                        <img src="{{ asset('/images/kbb.png') }}" alt="" style="height:100px;width:130px;">
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <h5 class="text-white text-center">Knowledge Base</h5>
                    </div>
                    <hr class="my-1">
                    <div class="row">
                        <p class="text-white text-center">Centralized repository for easy access to information</p>
                    </div>
                </div>
            </div>


        </div>

        <div class="row mt-5">
            <div class="slider-container">
                <h3 class="text-white text-center mb-5">Video Tutorials</h3>
                <div class="slider">
                    <div class="video-container">
                        <iframe width="100%" height="200" style="border-radius:10px;" src="https://www.youtube.com/embed/GVGtGUyHsIg?si=g8Qch9awg0vK4xPP" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-container">
                        <iframe width="100%" height="200" style="border-radius:10px;" src="https://www.youtube.com/embed/KZW588NMSP0?si=-Y1tEGKabZIz547L" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-container">
                        <iframe width="100%" height="200" style="border-radius:10px;" src="https://www.youtube.com/embed/4oLXU1AILFs?si=JKEHm9QX1cfrvenV" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-container">
                        <iframe width="100%" height="200" style="border-radius:10px;" src="https://www.youtube.com/embed/wvDJm0DHaFI?si=i4Pytqlw67KlwKmg" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-container">
                        <iframe width="100%" height="200" style="border-radius:10px;" src="https://www.youtube.com/embed/XZLPUfXoBL4?si=bwaZ64aRA791x16l" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-container">
                        <iframe width="100%" height="200" style="border-radius:10px;" src="https://www.youtube.com/embed/Q4Bt3ZBnMbE?si=u0v8CPbfzt7W168_" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <button class="nav-btn nav-btn-left mt-5" onclick="prevSlide()">❮</button>
                <button class="nav-btn nav-btn-right mt-5" onclick="nextSlide()">❯</button>
            </div>
        </div>

        <div class="row mt-5">
            
                <div class="accordion-container p-5">
                    <h3 class="text-white text-center">Frequently Asked Questions</h3>
                    <hr class="mb-5">
                    <div class="accordion">
                        <div class="faq my-2">
                            <span>How do I submit a support ticket?</span>
                            <span class="plus-sign">+</span>
                        </div>
                        <div class="faq-content">
                            <p>To submit a support ticket, log in to your account and navigate to the "Submit Ticket" section. Provide a detailed description of your issue, and our support team will assist you promptly.</p>
                        </div>
                
                        <div class="faq my-2">
                            <span>Can I track the status of my submitted tickets?</span>
                            <span class="plus-sign">+</span>
                        </div>
                        <div class="faq-content">
                            <p>Yes, you can easily track the status of your submitted tickets by logging into your account and checking the "My Tickets" section. Here, you'll find real-time updates on the progress of your requests.</p>
                        </div>
                
                        <div class="faq my-2">
                            <span>What information should I include when submitting a ticket?</span>
                            <span class="plus-sign">+</span>
                        </div>
                        <div class="faq-content">
                            <p>When submitting a ticket, please include a clear and detailed description of the issue, along with any relevant screenshots or error messages. Providing specific information helps our support team diagnose and resolve problems more efficiently.</p>
                        </div>
                
                        <div class="faq my-2">
                            <span>Is there a knowledgebase available for self-help?</span>
                            <span class="plus-sign">+</span>
                        </div>
                        <div class="faq-content">
                            <p>Absolutely! Our helpdesk system features a comprehensive knowledgebase that includes tutorial videos, articles and FAQs to assist you in resolving common issues on your own. Explore the knowledgebase to find answers to frequently asked questions.</p>
                        </div>
                
                        <div class="faq my-2">
                            <span>Can I attach files or screenshots to my support ticket?</span>
                            <span class="plus-sign">+</span>
                        </div>
                        <div class="faq-content">
                            <p>Yes, you can attach files, screenshots, or any relevant documents when submitting a support ticket. This helps our support team better understand and diagnose the issue, leading to faster and more accurate resolutions. Simply use the file attachment option in the ticket submission form.</p>
                        </div>
                    </div>
                </div>
            
        </div>


    </div>

    <script>
        let currentIndex = 0;
        const totalVideos = 6;
        const slider = document.querySelector('.slider');
        const videoWidth = document.querySelector('.video-container').offsetWidth;
    
        function updateSlider() {
            slider.style.transform = `translateX(${-currentIndex * videoWidth}px)`;
        }
    
        function nextSlide() {
            if (currentIndex < totalVideos - 4) {
                currentIndex++;
                updateSlider();
            }
        }
    
        function prevSlide() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        }
    </script>
    <script>
        document.querySelectorAll('.faq').forEach(function (faq) {
            faq.addEventListener('click', function () {
                this.classList.toggle('active');
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });
    </script>
@endsection
