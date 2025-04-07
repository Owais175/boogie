@extends('layouts.main')

@section('css')
<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 650px;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px #333;
        height: 500px;
    }
    
    .modal-content {
        text-align: center;
    }
    
    .close {
        float: right;   
        cursor: pointer;
        font-size: 20px;
    }
    
    /* 3D Slider Styles */
    .card-carousel {
        position: relative;
        width: 300px;
        height: 300px;
        perspective: 1000px;
    }
    
    .inner-carousel {
        width: 100%;
        height: 100%;
        position: absolute;
        transform-style: preserve-3d;
        transition: transform 1s;
    }
    
    .inner-carousel div {
        position: absolute;
        width: 250px;
        height: 250px;
        backface-visibility: hidden;
        background-size: cover;
    }
    
    .card-carousel {
        position: relative;
        margin: 0 auto 0 auto;
        padding: 0;
        max-width: 220px;
        max-width: 100%;
        height: 450px;
        perspective: 650px;
        perspective-origin: top;
    
        .button-spin {
            position: absolute;
            top: 50%;
            border: 0 none;
            background-color: transparent;
            cursor: pointer;
            font-family: "Open Sans";
            font-weight: 800;
            padding: 10px 16px;
            text-shadow: 1px 1px 4px rgba(0, 54, 90, 0.5);
            display: none;
    
    
    
            &:hover {
                box-shadow: 0px 4px 4px 4px rgba(0, 54, 90, 0.15);
            }
    
            &:active {
                box-shadow: none;
            }
        }
    
        .button-spin.counterclockwise {
            left: 0;
            z-index: 1;
        }
    
        .button-spin.clockwise {
            right: 0;
        }
    
        .inner-carousel {
            position: relative;
            width: 225px;
            margin: 0 auto;
            top: 80px;
            transform-style: preserve-3d;
            /* border: 1px solid blue; */
            left: -100px !important;
    
            >div {
                position: absolute;
                margin: 0 auto;
                padding: 20px;
                width: 330px;
                height: 300px;
                opacity: 1;
                background-color: #fff;
                color: #000;
                border-radius: 10px;
                transition: all 0.5s ease-out;
                z-index: 1;
                box-shadow: 0px 10px 10px 10px rgba(0, 54, 90, 0.15);
    
    
                &:after {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border-radius: 10px;
                    opacity: 1;
                    /* background-color: #ddd; */
                    z-index: 1;
                }
    
                &.counterclockwise:after,
                &.clockwise:after {
                    opacity: 0.4;
                    cursor: pointer;
                }
    
                &.front:after {
                    content: none;
                }
    
                &.front {
                    background-color: #1c9577;
                    background-image: radial-gradient(circle 200px at center right,
                            #2aba96,
                            #1c9577);
                    color: #fff;
    
                    a {
                        box-shadow: 0px 5px 5px 5px rgba(0, 54, 90, 0.15);
    
                        &:hover,
                        &:focus {
                            border: 2px solid #48cfad;
                            padding: 5px 0;
                        }
    
                        &:active {
                            box-shadow: none;
                        }
                    }
                }
    
                a {
                    position: absolute;
                    text-align: center;
                    bottom: 30px;
                    display: block;
                    width: 180px;
                    border: 1px solid #c9c9c9;
                    border-radius: 16px;
                    padding: 6px 0;
                    font-size: 12px;
                    font-weight: 500;
                    color: #000;
                    text-decoration: none;
                    background-color: #fff;
                    box-shadow: 0px 5px 8px 3px rgba(0, 54, 90, 0.1);
                }
            }
        }
    }
    
    
    div#uploadModal .dropify-wrapper {
        height: 350px !important;
    }
</style>
@endsection

@section('content')
<h2>Meme Generator</h2>  

<canvas id="faceCanvas" style="display: none;"></canvas>
<img id="previewImage" style="display: none;" />
<section class="meme-generator">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="meme-generator-form">
                    <!-- 3D Card Carousel -->
                    <div class="card-carousel">
                        <button class="button-spin counterclockwise">&lt;</button>
                        <div class="inner-carousel" id="slider">
                            <!-- Images will be loaded dynamically -->
                        </div>
                        <button class="button-spin clockwise">&gt;</button>
                    </div>

                    <!-- Image Upload Modal -->
                    <button id="openModal" class="btn btn-success mt-3">Add Image</button>

                    <div id="uploadModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Upload Image</h2>
                            {{-- <input type="file" id="imageUpload" name="image" class="form-control mt-3"
                                accept="image/*"> --}}
                            <input name="image" id="imageUpload" type="file" class="dropify form-control mt-3" data-height="100"
                                accept="image/*" />
                            <button id="uploadBtn" class="btn btn-primary mt-2">Upload Image</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    $('.dropify').dropify();
</script>
<script>
    const sunglasses = new Image();
    sunglasses.src = "{{ asset('assets/images/sunglasses.png') }}";

    async function detectFaceWithSunglasses(imageSrc) {
        const img = document.getElementById("previewImage");
        const canvas = document.getElementById("faceCanvas");
        const ctx = canvas.getContext("2d");

        img.src = imageSrc;
        await new Promise(resolve => img.onload = resolve);

        canvas.width = img.width;
        canvas.height = img.height;

        const model = await blazeface.load();
        const predictions = await model.estimateFaces(img, false);

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        if (predictions.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'No face or eyes were detected. Try a clearer photo.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
            });
            throw new Error("No face detected"); // Prevent upload if needed
        }

        predictions.forEach(pred => {
            const [leftEye, rightEye] = pred.landmarks;

            const eyeCenterX = (leftEye[0] + rightEye[0]) / 2;
            const eyeCenterY = (leftEye[1] + rightEye[1]) / 2;
            const eyeDistance = Math.hypot(rightEye[0] - leftEye[0], rightEye[1] - leftEye[1]);

            const width = eyeDistance * 2;
            const height = width * (sunglasses.height / sunglasses.width);
            const angle = Math.atan2(rightEye[1] - leftEye[1], rightEye[0] - leftEye[0]);

            ctx.save();
            ctx.translate(eyeCenterX, eyeCenterY);
            ctx.rotate(angle);
            ctx.drawImage(sunglasses, -width / 2, -height / 2, width, height);
            ctx.restore();
        });

        return canvas.toDataURL(); // base64 image
    }

    document.addEventListener("DOMContentLoaded", function() {
        let modal = document.getElementById("uploadModal");
        let openModalBtn = document.getElementById("openModal");
        let closeModalBtn = document.querySelector(".close");
        let uploadBtn = document.getElementById("uploadBtn");
        let imageUpload = document.getElementById("imageUpload");
        let slider = document.getElementById("slider");

        let rotate_int = 0;
        let autoplayInterval;

        // **Open Modal**
        openModalBtn.onclick = function() {
            modal.style.display = "block";
        };

        // **Close Modal**
        closeModalBtn.onclick = function() {
            modal.style.display = "none";
        };

        // **Upload Image**
        uploadBtn.onclick = function () {
            let file = imageUpload.files[0];

            if (!file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Image',
                    text: 'Please select an image before uploading!'
                });
                return;
            }

            const reader = new FileReader();
            reader.onload = async function (e) {
                try {
                    // Show loader
                    document.getElementById("loaderOverlay").style.display = "flex";

                    const base64Image = await detectFaceWithSunglasses(e.target.result);

                    const formData = new FormData();
                    formData.append("image", base64Image);

                    fetch("{{ route('upload.image') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let imgDiv = document.createElement("div");
                        imgDiv.style.backgroundImage = `url(${data.path})`;
                        slider.appendChild(imgDiv);

                        imageUpload.value = null;
                        modal.style.display = "none";
                        initCarousel();

                        // Hide loader
                        document.getElementById("loaderOverlay").style.display = "none";

                        // Reload page
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        document.getElementById("loaderOverlay").style.display = "none";
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: 'Something went wrong while uploading the image.'
                        });
                    });
                } catch (error) {
                    console.error("Face detection error:", error);
                    document.getElementById("loaderOverlay").style.display = "none";
                    // SweetAlert already shown in detectFaceWithSunglasses
                }
            };

            reader.readAsDataURL(file);
        };

        // **Load Images on Page Load**
       const staticImages = [
            "{{ asset('assets/images/slider1.png') }}",
            "{{ asset('assets/images/slider2.png') }}",
            "{{ asset('assets/images/slider3.png') }}"
        ];
        
        // Add static images first
        staticImages.forEach(path => {
            let imgDiv = document.createElement("div");
            imgDiv.style.backgroundImage = `url('${encodeURI(path)}')`;
            slider.appendChild(imgDiv);
        });
        
        // Fetch dynamic images next
        fetch("{{ route('get.images') }}")
            .then(response => response.json())
            .then(images => {
                images.forEach(path => {
                    let imgDiv = document.createElement("div");
                    imgDiv.style.backgroundImage = `url('${encodeURI(path)}')`;
                    slider.appendChild(imgDiv);
                });
        
                initCarousel();
                startAutoplay(); // Now this is defined globally
            })
            .catch(error => console.error("Error:", error));

        // **3D Carousel Functions**
        function initCarousel() {
            let cards = slider.querySelectorAll("div");
            let size = cards.length;
            let panelSize = slider.clientWidth;
            let translateZ = Math.round(panelSize / 2 / Math.tan(Math.PI / size)) * 1.7;

            slider.style.transform = "rotateY(0deg) translateZ(-" + translateZ + "px)";

            function animateSlider() {
                let rotateY = (360 / size) * rotate_int;
                for (let i = 0; i < size; i++) {
                    let z = rotate_int * (360 / size) + i * (360 / size);
                    cards[i].style.transform = `rotateY(${z}deg) translateZ(${translateZ}px) rotateY(${-z}deg)`;
                }
            }

            slider.addEventListener("mouseenter", stopAutoplay); // Stop on hover
            slider.addEventListener("mouseleave", startAutoplay); // Resume on leave

            animateSlider(); // Initial render
        }

        // **Autoplay Functions**
        function startAutoplay() {
            autoplayInterval = setInterval(() => {
                rotate_int += 1;
                initCarousel(); // Re-initialize each step (ensures animation stays fresh)
            }, 1000);
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }
    });
</script>
@endsection
