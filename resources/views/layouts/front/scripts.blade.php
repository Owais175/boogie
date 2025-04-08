<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://unpkg.com/fullpage.js/dist/fullpage.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface"></script>

<!-- Dropify JS -->
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<!--<script src="js/lax.js"></script>-->

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>
    // $(document).ready(function() {
    //     var targetSection = $('#imgunset');
    //     var added = false;

    //     $(window).scroll(function() {
    //         var scrollPos = $(window).scrollTop();
    //         var windowHeight = $(window).height();
    //         var sectionTop = targetSection.offset().top;
    //         var sectionBottom = sectionTop + targetSection.outerHeight();

    //         if (scrollPos + windowHeight >= sectionBottom && !added) {
    //             targetSection.addClass('active');
    //             added = true;
    //             console.log('Class added');
    //         } else if (scrollPos + windowHeight < sectionBottom && added) {
    //             targetSection.removeClass('active');
    //             added = false;
    //             console.log('Class added');
    //         }
    //     });
    // });

    // $(document).ready(function() {
    //     var targetSelectors = ['#imgunset', '.hidden-ticker', '.hidden-tokenomics',
    //         '.hidden-roadmap'
    //     ];

    //     $(window).scroll(function() {
    //         var scrollPos = $(window).scrollTop();
    //         var windowHeight = $(window).height();

    //         targetSelectors.forEach(function(selector) {
    //             $(selector).each(function() {
    //                 var section = $(this);
    //                 var sectionTop = section.offset().top;
    //                 var sectionBottom = sectionTop + section.outerHeight();

    //                 if (scrollPos + windowHeight >= sectionBottom && !section.hasClass(
    //                         'active')) {
    //                     section.addClass('active');
    //                     console.log('Class added to:', selector);
    //                 } else if (scrollPos + windowHeight < sectionBottom && section
    //                     .hasClass('active')) {
    //                     section.removeClass('active');
    //                     console.log('Class removed from:', selector);
    //                 }
    //             });
    //         });
    //     });
    // });

    $(document).ready(function() {
        var targetSelectors = ['#imgunset', '.product-list'];

        $(window).scroll(function() {
            var scrollPos = $(window).scrollTop();
            var windowHeight = $(window).height();

            targetSelectors.forEach(function(selector) {
                $(selector).each(function() {
                    var section = $(this);
                    var sectionTop = section.offset().top;
                    var sectionBottom = sectionTop + section.outerHeight();

                    // Check if the section is fully visible in viewport
                    if (scrollPos >= sectionTop - (windowHeight / 2) &&
                        scrollPos <= sectionBottom - (windowHeight / 2) &&
                        !section.hasClass('active')) {

                        section.addClass('active');
                        console.log('Class added to:', selector);
                    }
                });
            });
        });
    });
</script>

<script>
    var btn = $('#bottomtotop');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 500) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '500');
    });
</script>
<script>
    function formpush() {
        document.getElementById('img_push').submit();
    }
</script>

<script>
    (function() {
        const uploadInput = document.getElementById('uploadImage');
        if (!uploadInput) return; // Now this return is valid, inside a function

        uploadInput.addEventListener('change', function(event) {
            let previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = "";

            let files = Array.from(event.target.files);
            let dataTransfer = new DataTransfer();

            files.forEach((file, index) => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let previewDiv = document.createElement('div');
                    previewDiv.style.position = "relative";
                    previewDiv.style.display = "inline-block";
                    previewDiv.style.marginRight = "10px";

                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = "230px";
                    img.style.height = "120px";
                    img.style.objectFit = "cover";
                    img.style.border = "1px solid #ccc";
                    img.style.borderRadius = "5px";

                    let removeBtn = document.createElement('button');
                    removeBtn.innerHTML = "✖";
                    removeBtn.style.position = "absolute";
                    removeBtn.style.top = "5px";
                    removeBtn.style.right = "5px";
                    removeBtn.style.background = "white";
                    removeBtn.style.color = "white";
                    removeBtn.style.border = "none";
                    removeBtn.style.cursor = "pointer";
                    removeBtn.style.borderRadius = "50%";
                    removeBtn.style.width = "26px";
                    removeBtn.style.height = "26px";
                    removeBtn.style.fontSize = "12px";

                    removeBtn.addEventListener("click", function() {
                        previewDiv.remove();
                        files.splice(index, 1);
                        dataTransfer.items.clear();
                        files.forEach(f => dataTransfer.items.add(f));
                        uploadInput.files = dataTransfer.files;
                    });

                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer.appendChild(previewDiv);
                };
                reader.readAsDataURL(file);
                dataTransfer.items.add(file);
            });

            uploadInput.files = dataTransfer.files;
        });
    })();
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let canvas = document.getElementById("imageCanvas");
        if (!canvas) return;

        let ctx = canvas.getContext("2d");
        let userImage = new Image();
        let templateImage = new Image();
        let isDragging = false;
        let isResizing = false;
        let isRotating = false;
        let resizeHandleIndex = -1;
        let templateX = 50, templateY = 50;
        let templateWidth = 150, templateHeight = 150;
        let offsetX, offsetY;
        let rotationAngle = 0;
        let rotationHandleDistance = 40;
        let showControls = false; // Flag to control visibility of handles

        // Variables to track scaling and positioning
        let displayScale = 1;
        let displayOffsetX = 0;
        let displayOffsetY = 0;

        canvas.width = 500;
        canvas.height = 500;

        // Set template image source
        templateImage.src = "{{ asset('assets/images/sunglasses.png') }}";

        document.getElementById("uploadImage")?.addEventListener("change", function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    userImage.onload = () => {
                        drawCanvas();
                        new bootstrap.Modal(document.getElementById("imageEditorModal")).show();
                    };
                    userImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Resize handles positions (8 handles around the image)
        const resizeHandles = [
            { x: 0, y: 0, cursor: 'nw-resize' },    // top-left
            { x: 0.5, y: 0, cursor: 'n-resize' },   // top-middle
            { x: 1, y: 0, cursor: 'ne-resize' },     // top-right
            { x: 1, y: 0.5, cursor: 'e-resize' },    // right-middle
            { x: 1, y: 1, cursor: 'se-resize' },    // bottom-right
            { x: 0.5, y: 1, cursor: 's-resize' },    // bottom-middle
            { x: 0, y: 1, cursor: 'sw-resize' },     // bottom-left
            { x: 0, y: 0.5, cursor: 'w-resize' }     // left-middle
        ];
        const handleSize = 8;

        function drawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Calculate scaling to fit image in canvas
            displayScale = Math.min(canvas.width / userImage.width, canvas.height / userImage.height);
            let imgWidth = userImage.width * displayScale;
            let imgHeight = userImage.height * displayScale;
            displayOffsetX = (canvas.width - imgWidth) / 2;
            displayOffsetY = (canvas.height - imgHeight) / 2;

            // Draw main image centered
            ctx.drawImage(userImage, displayOffsetX, displayOffsetY, imgWidth, imgHeight);

            // Save the context state before transformations
            ctx.save();

            // Move to the center of the template image
            const centerX = templateX + templateWidth / 2;
            const centerY = templateY + templateHeight / 2;
            ctx.translate(centerX, centerY);

            // Apply rotation
            ctx.rotate(rotationAngle);

            // Draw the template image centered around the rotation point
            ctx.drawImage(
                templateImage,
                -templateWidth / 2,
                -templateHeight / 2,
                templateWidth,
                templateHeight
            );

            // Restore the context state
            ctx.restore();

            // Draw resize handles and rotation handle if controls are visible
            if (showControls) {
                drawHandles();
            }
        }

        function drawHandles() {
            ctx.save();
            ctx.strokeStyle = '#ffffff';
            ctx.lineWidth = 2;
            ctx.fillStyle = '#4285f4';

            // Calculate center of template image
            const centerX = templateX + templateWidth / 2;
            const centerY = templateY + templateHeight / 2;

            // Draw a border around the template image (accounting for rotation)
            ctx.save();
            ctx.translate(centerX, centerY);
            ctx.rotate(rotationAngle);
            ctx.strokeRect(-templateWidth / 2, -templateHeight / 2, templateWidth, templateHeight);
            ctx.restore();

            // Draw resize handles
            resizeHandles.forEach(handle => {
                // Calculate handle position accounting for rotation
                const handleX = templateX + (handle.x * templateWidth);
                const handleY = templateY + (handle.y * templateHeight);

                // Transform handle position based on rotation
                const rotatedHandle = rotatePoint(handleX, handleY, centerX, centerY, rotationAngle);

                ctx.fillRect(rotatedHandle.x - handleSize/2, rotatedHandle.y - handleSize/2, handleSize, handleSize);
                ctx.strokeRect(rotatedHandle.x - handleSize/2, rotatedHandle.y - handleSize/2, handleSize, handleSize);
            });

            // Draw rotation handle (above the image)
            const rotationHandleX = centerX;
            const rotationHandleY = centerY - rotationHandleDistance;
            const rotatedHandle = rotatePoint(rotationHandleX, rotationHandleY, centerX, centerY, rotationAngle);

            ctx.beginPath();
            ctx.arc(rotatedHandle.x, rotatedHandle.y, handleSize, 0, Math.PI * 2);
            ctx.fillStyle = '#ff5722'; // Orange color for rotation handle
            ctx.fill();
            ctx.stroke();

            // Draw line from center to rotation handle
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.lineTo(rotatedHandle.x, rotatedHandle.y);
            ctx.strokeStyle = '#ffffff';
            ctx.stroke();

            ctx.restore();
        }

        // Helper function to rotate a point around another point
        function rotatePoint(x, y, cx, cy, angle) {
            const cos = Math.cos(angle);
            const sin = Math.sin(angle);
            const nx = (cos * (x - cx)) - (sin * (y - cy)) + cx;
            const ny = (sin * (x - cx)) + (cos * (y - cy)) + cy;
            return { x: nx, y: ny };
        }

        function getHandleAtPosition(x, y) {
            if (!showControls) return null;

            const centerX = templateX + templateWidth / 2;
            const centerY = templateY + templateHeight / 2;

            // Rotation handle position (before rotation)
            const rotationHandleX = centerX;
            const rotationHandleY = centerY - rotationHandleDistance;

            // Rotated position of rotation handle
            const rotatedHandle = rotatePoint(rotationHandleX, rotationHandleY, centerX, centerY, rotationAngle);

            // Check if mouse is on rotation handle
            if (Math.hypot(x - rotatedHandle.x, y - rotatedHandle.y) <= handleSize) {
                return 'rotation';
            }

            // Then check resize handles
            for (let i = 0; i < resizeHandles.length; i++) {
                const handle = resizeHandles[i];
                const handleX = templateX + (handle.x * templateWidth);
                const handleY = templateY + (handle.y * templateHeight);

                // Rotated position of resize handle
                const rotatedHandle = rotatePoint(handleX, handleY, centerX, centerY, rotationAngle);

                if (Math.abs(x - rotatedHandle.x) <= handleSize && Math.abs(y - rotatedHandle.y) <= handleSize) {
                    return i;
                }
            }

            // Finally check if inside the image (for dragging)
            const relX = x - centerX;
            const relY = y - centerY;

            // Rotate the point back to check against unrotated rectangle
            const unrotatedX = Math.cos(-rotationAngle) * relX - Math.sin(-rotationAngle) * relY;
            const unrotatedY = Math.sin(-rotationAngle) * relX + Math.cos(-rotationAngle) * relY;

            if (Math.abs(unrotatedX) <= templateWidth/2 && Math.abs(unrotatedY) <= templateHeight/2) {
                return 'drag';
            }

            return null;
        }

        function isPointInImage(x, y) {
            const centerX = templateX + templateWidth / 2;
            const centerY = templateY + templateHeight / 2;

            const relX = x - centerX;
            const relY = y - centerY;

            // Rotate the point back to check against unrotated rectangle
            const unrotatedX = Math.cos(-rotationAngle) * relX - Math.sin(-rotationAngle) * relY;
            const unrotatedY = Math.sin(-rotationAngle) * relX + Math.cos(-rotationAngle) * relY;

            return Math.abs(unrotatedX) <= templateWidth/2 && Math.abs(unrotatedY) <= templateHeight/2;
        }

        function resizeTemplate(handleIndex, mouseX, mouseY) {
            const centerX = templateX + templateWidth / 2;
            const centerY = templateY + templateHeight / 2;

            // Rotate mouse coordinates back to unrotated space
            const relX = mouseX - centerX;
            const relY = mouseY - centerY;
            const unrotatedX = Math.cos(-rotationAngle) * relX - Math.sin(-rotationAngle) * relY;
            const unrotatedY = Math.sin(-rotationAngle) * relX + Math.cos(-rotationAngle) * relY;
            const unrotatedMouseX = unrotatedX + centerX;
            const unrotatedMouseY = unrotatedY + centerY;

            const startWidth = templateWidth;
            const startHeight = templateHeight;
            const startX = templateX;
            const startY = templateY;

            switch (handleIndex) {
                case 0: // top-left
                    templateWidth = startWidth + (startX - unrotatedMouseX);
                    templateHeight = startHeight + (startY - unrotatedMouseY);
                    if (templateWidth > 10) templateX = unrotatedMouseX;
                    if (templateHeight > 10) templateY = unrotatedMouseY;
                    break;
                case 1: // top-middle
                    templateHeight = startHeight + (startY - unrotatedMouseY);
                    if (templateHeight > 10) templateY = unrotatedMouseY;
                    break;
                case 2: // top-right
                    templateWidth = unrotatedMouseX - startX;
                    templateHeight = startHeight + (startY - unrotatedMouseY);
                    if (templateHeight > 10) templateY = unrotatedMouseY;
                    break;
                case 3: // right-middle
                    templateWidth = unrotatedMouseX - startX;
                    break;
                case 4: // bottom-right
                    templateWidth = unrotatedMouseX - startX;
                    templateHeight = unrotatedMouseY - startY;
                    break;
                case 5: // bottom-middle
                    templateHeight = unrotatedMouseY - startY;
                    break;
                case 6: // bottom-left
                    templateWidth = startWidth + (startX - unrotatedMouseX);
                    templateHeight = unrotatedMouseY - startY;
                    if (templateWidth > 10) templateX = unrotatedMouseX;
                    break;
                case 7: // left-middle
                    templateWidth = startWidth + (startX - unrotatedMouseX);
                    if (templateWidth > 10) templateX = unrotatedMouseX;
                    break;
            }

            // Maintain aspect ratio if shift key is pressed
            if (event.shiftKey) {
                const aspectRatio = startWidth / startHeight;
                if (handleIndex === 0 || handleIndex === 2 || handleIndex === 4 || handleIndex === 6) {
                    // Corner handles
                    templateHeight = templateWidth / aspectRatio;
                    if (handleIndex === 0 || handleIndex === 6) {
                        templateY = startY + (startHeight - templateHeight);
                    }
                }
            }

            // Minimum size constraint
            if (templateWidth < 10) templateWidth = 10;
            if (templateHeight < 10) templateHeight = 10;
        }

        function rotateTemplate(mouseX, mouseY) {
            const centerX = templateX + templateWidth / 2;
            const centerY = templateY + templateHeight / 2;

            // Calculate angle between center and mouse position
            const dx = mouseX - centerX;
            const dy = mouseY - centerY;
            rotationAngle = Math.atan2(dy, dx) + Math.PI/2; // +90° so handle is at top
        }

        canvas.addEventListener("mousedown", (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;

            // Check if we're clicking on the image or its handles
            const handle = showControls ? getHandleAtPosition(mouseX, mouseY) : null;
            const isInsideImage = isPointInImage(mouseX, mouseY);

            if (handle === 'rotation') {
                isRotating = true;
                e.preventDefault();
                e.stopPropagation();
                return;
            } else if (typeof handle === 'number') {
                isResizing = true;
                resizeHandleIndex = handle;
                e.preventDefault();
                e.stopPropagation();
                return;
            } else if (isInsideImage) {
                // Clicked on the image - show controls if they weren't visible
                if (!showControls) {
                    showControls = true;
                    drawCanvas();
                }
                isDragging = true;
                offsetX = mouseX - templateX;
                offsetY = mouseY - templateY;
                canvas.style.cursor = 'move';
            } else {
                // Clicked outside - hide controls if they were visible
                if (showControls) {
                    showControls = false;
                    drawCanvas();
                }
            }
        });

        canvas.addEventListener("mousemove", (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;

            // Update cursor style when hovering over handles or image
            if (!isDragging && !isResizing && !isRotating) {
                if (showControls) {
                    const handle = getHandleAtPosition(mouseX, mouseY);

                    if (handle === 'rotation') {
                        canvas.style.cursor = 'grab';
                    } else if (typeof handle === 'number') {
                        canvas.style.cursor = resizeHandles[handle].cursor;
                    } else if (handle === 'drag') {
                        canvas.style.cursor = 'move';
                    } else {
                        canvas.style.cursor = 'default';
                    }
                } else if (isPointInImage(mouseX, mouseY)) {
                    canvas.style.cursor = 'pointer';
                } else {
                    canvas.style.cursor = 'default';
                }
            }

            if (isRotating) {
                rotateTemplate(mouseX, mouseY);
                drawCanvas();
            } else if (isResizing) {
                resizeTemplate(resizeHandleIndex, mouseX, mouseY);
                drawCanvas();
            } else if (isDragging) {
                templateX = mouseX - offsetX;
                templateY = mouseY - offsetY;
                drawCanvas();
            }
        });

        ["mouseup", "mouseleave", "mouseout"].forEach(eventType => {
            canvas.addEventListener(eventType, () => {
                isDragging = false;
                isResizing = false;
                isRotating = false;
                resizeHandleIndex = -1;
                canvas.style.cursor = 'default';
            });
        });

        window.downloadImage = function() {
            let link = document.createElement("a");
            let tempCanvas = document.createElement("canvas");
            let tempCtx = tempCanvas.getContext("2d");

            // Use original image dimensions
            tempCanvas.width = userImage.width;
            tempCanvas.height = userImage.height;

            // Draw original image
            tempCtx.drawImage(userImage, 0, 0, userImage.width, userImage.height);

            // Calculate template position in original image coordinates
            const originalCenterX = (templateX + templateWidth/2 - displayOffsetX) / displayScale;
            const originalCenterY = (templateY + templateHeight/2 - displayOffsetY) / displayScale;
            const originalWidth = templateWidth / displayScale;
            const originalHeight = templateHeight / displayScale;

            // Save context and apply transformations
            tempCtx.save();
            tempCtx.translate(originalCenterX, originalCenterY);
            tempCtx.rotate(rotationAngle);

            // Draw the template image centered around the rotation point
            tempCtx.drawImage(
                templateImage,
                -originalWidth / 2,
                -originalHeight / 2,
                originalWidth,
                originalHeight
            );

            // Restore context
            tempCtx.restore();

            link.download = "edited_image.png";
            link.href = tempCanvas.toDataURL();
            link.click();
        };
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Create a new IntersectionObserver instance
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                } else {
                    entry.target.classList.remove('in-view');
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of the section is in view
        });

        // Select the section element
        const section = document.getElementById('animated-sec');

        // Only observe if section exists
        if (section) {
            observer.observe(section);
        }
    });
</script>


<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 30,
        freeMode: false,
        // autoplay: {
        //     delay: 2500,
        //     disableOnInteraction: true,
        // },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 0,
            slideShadows: true,
        },
        // pagination: {
        //     el: ".swiper-pagination",
        // },
        on: {
            slideChange: function() {
                setTimeout(() => {
                    let nextSlide = document.querySelector('.swiper-slide-next');
                    if (nextSlide) {
                        const meme_img = nextSlide.querySelector('img');
                        if (meme_img) {
                            templateImage.src = "assets/images/Gecko-hoodie-and-glasses.png";
                        }
                    }
                }, 100);
            }
        }

    });
    // ✅ Stop Swiper autoplay when clicking the label
    document.addEventListener("DOMContentLoaded", function() {
        const stopBtn = document.querySelector(".stop_slider");
        if (stopBtn) {
            stopBtn.addEventListener("click", function() {
                if (typeof swiper !== "undefined" && swiper.autoplay) {
                    swiper.autoplay.stop(); // 🛑 Stop autoplay
                }
            });
        }
    });

    // ✅ Restart Swiper autoplay when modal is closed
    document.addEventListener("DOMContentLoaded", function() {
        const modalEl = document.getElementById("imageEditorModal");

        if (modalEl) {
            modalEl.addEventListener("hidden.bs.modal", function() {
                if (typeof swiper !== "undefined" && swiper.autoplay) {
                    swiper.autoplay.start(); // ▶ Restart autoplay
                }
            });
        }
    });
</script>

<script>
    jQuery('.parent-marquee').owlCarousel({
        center: true,
        items: 8,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoWidth: true,
        autoplay: true,
        slideTransition: 'linear',
        autoplayTimeout: 1500,
        autoplaySpeed: 1500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 8
            },
            1000: {
                items: 8
            }
        }
    });
</script>

<script>
    jQuery('.parent-marquee-2').owlCarousel({
        center: true,
        items: 6,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoWidth: true,
        autoplay: true,
        slideTransition: 'linear',
        autoplayTimeout: 1500,
        autoplaySpeed: 1500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 3,
                margin: 10,
                center: false,
                // autoWidth: false,
                // autoWidth: false,

            },
            600: {
                items: 3,
                margin: 10,
                center: false,
                // autoWidth: false,

                // autoWidth: false,

            },
            1000: {
                items: 6
            },
        }
    });

    jQuery('.parent-marquee-3').owlCarousel({
        center: true,
        items: 6,
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        autoplay: true,
        slideTransition: 'linear',
        autoplayTimeout: 3000,
        autoplaySpeed: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 8
            },
            1199: {
                items: 8
            },
            1440: {
                items: 8
            }
        }
    });
</script>

<script>
    function copyToClipboard() {
        var text = document.getElementById("copyText").innerText;
        var tempInput = document.createElement("textarea");
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        $(document).ready(function() {
            $('.checkimg').css('display', 'none');
            $('.checkedimg').css('display', 'block');
        });
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.stage-toggie-ces');

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5,
            }
        );

        sections.forEach((section) => {
            observer.observe(section);
        });
    });
</script>
