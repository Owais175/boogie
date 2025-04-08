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

        #draggableSunglasses {
            transform-origin: center center;
        }

        .resize-handle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: white;
            border: 1px solid black;
            z-index: 10;
            cursor: nwse-resize;
        }

        .resize-handle.tl {
            top: -5px;
            left: -5px;
            cursor: nwse-resize;
        }

        .resize-handle.tm {
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            cursor: ns-resize;
        }

        .resize-handle.tr {
            top: -5px;
            right: -5px;
            cursor: nesw-resize;
        }

        .resize-handle.mr {
            top: 50%;
            right: -5px;
            transform: translateY(-50%);
            cursor: ew-resize;
        }

        .resize-handle.br {
            bottom: -5px;
            right: -5px;
            cursor: nwse-resize;
        }

        .resize-handle.bm {
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            cursor: ns-resize;
        }

        .resize-handle.bl {
            bottom: -5px;
            left: -5px;
            cursor: nesw-resize;
        }

        .resize-handle.ml {
            top: 50%;
            left: -5px;
            transform: translateY(-50%);
            cursor: ew-resize;
        }

        .preview-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #9dcef8;
        }

        #previewContainer {
            position: relative;
            width: 400px;
            height: 400px;
            border: 3px solid #040303;
            margin-top: 20px;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <h2>Meme Generator</h2>

    <canvas id="faceCanvas" style="display: none"></canvas>
    <section class="meme-generator">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="meme-generator-form">
                        <!-- 3D Card Carousel -->
                        <div class="card-carousel">
                            <button class="button-spin counterclockwise">
                                </button>
                                    <div class="inner-carousel" id="slider">
                                        <!-- Images will be loaded dynamically -->
                                    </div>
                                    <button class="button-spin clockwise">></button>
                        </div>

                        <!-- Image Upload -->
                        <input type="file" id="imageUpload" accept="image/*" class="mt-3">

                        <!-- Centering the preview container on the page -->
                        <div class="preview-container">
                            <div id="previewContainer">
                                <img id="previewImage"
                                    style="width: 100%; height: 100%; object-fit: contain; display: none;" >
                                <div id="sunglassesWrapper" style="position: absolute; display: none;">
                                    <img id="draggableSunglasses" src="{{ asset('assets/images/sunglasses.png') }}"
                                        style="width: 100px; height: auto; position: absolute; cursor: move;" />
                                    <!-- Resize Handles -->
                                    <div class="resize-handle tl"></div>
                                    <div class="resize-handle tm"></div>
                                    <div class="resize-handle tr"></div>
                                    <div class="resize-handle mr"></div>
                                    <div class="resize-handle br"></div>
                                    <div class="resize-handle bm"></div>
                                    <div class="resize-handle bl"></div>
                                    <div class="resize-handle ml"></div>
                                    <!-- Rotation Handle -->
                                    <div id="rotateHandle"
                                        style="position:absolute; width: 15px; height: 15px; background: #f00; border-radius: 50%; cursor: grab; top: -25px; left: 50%; transform: translateX(-50%);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Button -->
                        <button id="uploadBtn" class="mt-3" style="display: none;">Upload Image</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const imageUpload = document.getElementById("imageUpload");
            const slider = document.getElementById("slider");
            const previewImage = document.getElementById("previewImage");
            const sunglassesWrapper = document.getElementById("sunglassesWrapper");
            const draggableSunglasses = document.getElementById("draggableSunglasses");
            const uploadBtn = document.getElementById("uploadBtn");
            const previewContainer = document.getElementById("previewContainer");
            const canvas = document.getElementById("faceCanvas");
            const ctx = canvas.getContext("2d");
            const rotateHandle = document.getElementById("rotateHandle");

            let rotate_int = 0;
            let angle = 0;
            let isRotating = false;
            let startAngle;
            let autoplayInterval;

            // Helper for mouse angle
            function getAngle(cx, cy, ex, ey) {
                return Math.atan2(ey - cy, ex - cx);
            }

            // Dragging sunglasses
            function makeElementDraggable(wrapper) {
                wrapper.onmousedown = null;
                let offsetX, offsetY;

                wrapper.addEventListener("mousedown", function(e) {
                    if (e.target.classList.contains("resize-handle") || e.target.id === "rotateHandle")
                        return;

                    e.preventDefault();
                    offsetX = e.clientX - wrapper.offsetLeft;
                    offsetY = e.clientY - wrapper.offsetTop;

                    function drag(e) {
                        let x = e.clientX - offsetX;
                        let y = e.clientY - offsetY;
                        x = Math.max(0, Math.min(x, previewContainer.clientWidth - wrapper.offsetWidth));
                        y = Math.max(0, Math.min(y, previewContainer.clientHeight - wrapper.offsetHeight));
                        wrapper.style.left = x + "px";
                        wrapper.style.top = y + "px";
                    }

                    function stopDrag() {
                        document.removeEventListener("mousemove", drag);
                        document.removeEventListener("mouseup", stopDrag);
                    }

                    document.addEventListener("mousemove", drag);
                    document.addEventListener("mouseup", stopDrag);
                });
            }

            // Resize functionality
            function makeResizable(wrapper) {
                const handles = wrapper.querySelectorAll(".resize-handle");

                handles.forEach(handle => {
                    handle.addEventListener("mousedown", function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const startX = e.clientX;
                        const startY = e.clientY;

                        const startWidth = draggableSunglasses.offsetWidth;
                        const startHeight = draggableSunglasses.offsetHeight;

                        const startLeft = wrapper.offsetLeft;
                        const startTop = wrapper.offsetTop;

                        function resize(e) {
                            let dx = e.clientX - startX;
                            let dy = e.clientY - startY;

                            let newWidth = startWidth,
                                newHeight = startHeight;
                            let newLeft = startLeft,
                                newTop = startTop;

                            switch (handle.classList[1]) {
                                case "tl":
                                    newWidth -= dx;
                                    newHeight -= dy;
                                    newLeft += dx;
                                    newTop += dy;
                                    break;
                                case "tm":
                                    newHeight -= dy;
                                    newTop += dy;
                                    break;
                                case "tr":
                                    newWidth += dx;
                                    newHeight -= dy;
                                    newTop += dy;
                                    break;
                                case "mr":
                                    newWidth += dx;
                                    break;
                                case "br":
                                    newWidth += dx;
                                    newHeight += dy;
                                    break;
                                case "bm":
                                    newHeight += dy;
                                    break;
                                case "bl":
                                    newWidth -= dx;
                                    newHeight += dy;
                                    newLeft += dx;
                                    break;
                                case "ml":
                                    newWidth -= dx;
                                    newLeft += dx;
                                    break;
                            }

                            if (newWidth > 20 && newHeight > 20) {
                                wrapper.style.width = newWidth + "px";
                                wrapper.style.height = newHeight + "px";
                                draggableSunglasses.style.width = "100%";
                                draggableSunglasses.style.height = "100%";
                            }

                            wrapper.style.left = newLeft + "px";
                            wrapper.style.top = newTop + "px";
                        }

                        function stopResize() {
                            document.removeEventListener("mousemove", resize);
                            document.removeEventListener("mouseup", stopResize);
                        }

                        document.addEventListener("mousemove", resize);
                        document.addEventListener("mouseup", stopResize);
                    });
                });
            }

            // Rotation
            rotateHandle.addEventListener("mousedown", function(e) {
                e.preventDefault();
                const rect = sunglassesWrapper.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const start = getAngle(centerX, centerY, e.clientX, e.clientY);
                const startRotation = angle;

                function rotateMove(e) {
                    const current = getAngle(centerX, centerY, e.clientX, e.clientY);
                    angle = startRotation + (current - start);
                    sunglassesWrapper.style.transform = `rotate(${angle}deg)`;
                }

                function stopRotate() {
                    document.removeEventListener("mousemove", rotateMove);
                    document.removeEventListener("mouseup", stopRotate);
                }

                document.addEventListener("mousemove", rotateMove);
                document.addEventListener("mouseup", stopRotate);
            });

            // Upload Image and Preview
            imageUpload.addEventListener("change", function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = "block";
                        sunglassesWrapper.style.display = "block";
                        sunglassesWrapper.style.left = "50px";
                        sunglassesWrapper.style.top = "50px";
                        sunglassesWrapper.style.width = "100px";
                        sunglassesWrapper.style.height = "50px";
                        sunglassesWrapper.style.transform = "rotate(0rad)";
                        angle = 0;
                        uploadBtn.style.display = "block";

                        makeElementDraggable(sunglassesWrapper);
                        makeResizable(sunglassesWrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Upload Image and Download
            uploadBtn.addEventListener("click", async function () {
                // Set canvas dimensions based on the image size
                canvas.width = previewImage.naturalWidth;
                canvas.height = previewImage.naturalHeight;

                // Draw the preview image on the canvas
                ctx.drawImage(previewImage, 0, 0, canvas.width, canvas.height);

                // Calculate sunglasses position and size relative to the image
                const containerRect = previewContainer.getBoundingClientRect();
                const sungRect = sunglassesWrapper.getBoundingClientRect();
                const scaleX = previewImage.naturalWidth / previewImage.width;
                const scaleY = previewImage.naturalHeight / previewImage.height;

                const sungX = (sungRect.left - containerRect.left) * scaleX;
                const sungY = (sungRect.top - containerRect.top) * scaleY;
                const sungW = sungRect.width * scaleX;
                const sungH = sungRect.height * scaleY;

                // Load the sunglasses image
                const sunglasses = new Image();
                sunglasses.src = draggableSunglasses.src;
                await new Promise(resolve => sunglasses.onload = resolve);

                // Draw the sunglasses on the canvas
                ctx.save();
                ctx.translate(sungX + sungW / 2, sungY + sungH / 2);
                ctx.rotate(angle);
                ctx.drawImage(sunglasses, -sungW / 2, -sungH / 2, sungW, sungH);
                ctx.restore();

                // Convert the canvas to a base64 image
                const base64Image = canvas.toDataURL();

                // Create a temporary link element to trigger the download
                const link = document.createElement("a");
                link.href = base64Image;
                link.download = "image_with_sunglasses.png";  // Specify the download filename

                // Trigger the download
                link.click();

                // Hide preview elements
                previewImage.style.display = "none";
                sunglassesWrapper.style.display = "none";
                uploadBtn.style.display = "none";
                imageUpload.value = null;
            });

            // Hide options when clicking outside sunglasses wrapper
            document.addEventListener('click', function(e) {
                if (!sunglassesWrapper.contains(e.target) && sunglassesWrapper.style.display !== "none") {
                    const resizeHandles = sunglassesWrapper.querySelectorAll('.resize-handle');
                    const rotateHandle = sunglassesWrapper.querySelector('#rotateHandle');
                    resizeHandles.forEach(handle => handle.style.display = 'none');
                    rotateHandle.style.display = 'none';
                }
            });

            // Show options when sunglassesWrapper is clicked
            sunglassesWrapper.addEventListener('click', function(e) {
                const resizeHandles = sunglassesWrapper.querySelectorAll('.resize-handle');
                const rotateHandle = sunglassesWrapper.querySelector('#rotateHandle');
                resizeHandles.forEach(handle => handle.style.display = 'block');
                rotateHandle.style.display = 'block';
                e.stopPropagation(); // Prevent the click from propagating to the document
            });
            // Load Static and Uploaded Images
            const staticImages = [
                "{{ asset('assets/images/slider1.png') }}",
                "{{ asset('assets/images/slider2.png') }}",
                "{{ asset('assets/images/slider3.png') }}"
            ];

            staticImages.forEach(path => {
                let imgDiv = document.createElement("div");
                imgDiv.style.backgroundImage = `url('${encodeURI(path)}')`;
                slider.appendChild(imgDiv);
            });

            fetch("{{ route('get.images') }}")
                .then(response => response.json())
                .then(images => {
                    images.forEach(path => {
                        let imgDiv = document.createElement("div");
                        imgDiv.style.backgroundImage = `url('${encodeURI(path)}')`;
                        slider.appendChild(imgDiv);
                    });

                    initCarousel();
                    startAutoplay();
                });

            // Carousel Functions
            function initCarousel() {
                let cards = slider.querySelectorAll("div");
                let size = cards.length;
                let panelSize = slider.clientWidth;
                let translateZ = Math.round(panelSize / 2 / Math.tan(Math.PI / size)) * 1.7;

                slider.style.transform = "rotateY(0deg) translateZ(-" + translateZ + "px)";

                // Loop through each card and position sunglasses if available
                cards.forEach(card => {
                    let sunglassesData = card.getAttribute("data-sunglasses");
                    if (sunglassesData) {
                        sunglassesData = JSON.parse(sunglassesData);

                        // If using background-image, apply sunglasses to the background directly
                        let backgroundImage = card.style.backgroundImage;
                        if (backgroundImage) {
                            // Do not apply sunglasses directly to an img tag, use card's background image
                            // You may need to adjust based on how you're rendering the image (background-image or img tag)
                            card.style.backgroundImage =
                            `${backgroundImage} url(${sunglassesData.path})`; // adjust path accordingly
                        } else {
                            // For img tag inside the card, handle sunglasses
                            const img = card.querySelector("img");
                            if (img) {
                                img.style.transform = `rotate(${sunglassesData.angle}rad)`;
                                img.style.left = `${sunglassesData.x}px`;
                                img.style.top = `${sunglassesData.y}px`;
                                img.style.width = `${sunglassesData.width}px`;
                                img.style.height = `${sunglassesData.height}px`;
                            } else {
                                console.warn("No image element found in card");
                            }
                        }
                    }
                });

                function animateSlider() {
                    let rotateY = (360 / size) * rotate_int;
                    for (let i = 0; i < size; i++) {
                        let z = rotate_int * (360 / size) + i * (360 / size);
                        cards[i].style.transform = `rotateY(${z}deg) translateZ(${translateZ}px) rotateY(${-z}deg)`;
                    }
                }

                slider.addEventListener("mouseenter", stopAutoplay);
                slider.addEventListener("mouseleave", startAutoplay);

                animateSlider();
            }

            function startAutoplay() {
                autoplayInterval = setInterval(() => {
                    rotate_int += 1;
                    initCarousel();
                }, 1000);
            }

            function stopAutoplay() {
                clearInterval(autoplayInterval);
            }
        });
    </script>
@endsection
