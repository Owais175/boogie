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
<!-- Bootstrap 5 JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

{{-- <script>
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
</script> --}}

{{-- <script>
    // Your existing JavaScript code here
    document.addEventListener("DOMContentLoaded", function() {
        // console.log(315)
        // ... [all your existing JavaScript code] ...
        
        // Make sure Bootstrap JS is loaded for the modal to work
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            // This is already in your code where you show the modal
            // new bootstrap.Modal(document.getElementById("imageEditorModal")).show();
            
            // The close button will work automatically because:
            // 1. It has `data-bs-dismiss="modal"` attribute
            // 2. Bootstrap's JavaScript is loaded
        } else {
            console.error("Bootstrap JS is not loaded. Modal close button won't work.");
        }
    });
</script> --}}

<script>
document.addEventListener("DOMContentLoaded", function() {
    let canvas = document.getElementById("imageCanvas");
    if (!canvas) return;

    let ctx = canvas.getContext("2d");
    let userImage = new Image();
    
    // Template images with their own properties
    const templates = [
        {
            name: "sunglasses",
            img: new Image(),
            x: 100,
            y: 100,
            width: 150,
            height: 150,
            rotation: 0,
            active: true,
            controlsVisible: true
        },
        {
            name: "thumbsUp",
            img: new Image(),
            x: 200,
            y: 200,
            width: 150,
            height: 150,
            rotation: 0,
            active: true,
            controlsVisible: true
        }
    ];
    
    // Load template images
    templates[0].img.src = "{{ asset('assets/images/sunglasses.png') }}";
    templates[1].img.src = "{{ asset('assets/images/thumbs.png') }}";
    
    let isDragging = false;
    let isResizing = false;
    let isRotating = false;
    let currentTemplate = null;
    let resizeHandleIndex = -1;
    let offsetX, offsetY;
    let rotationHandleDistance = 40;
    let displayScale = 1;
    let displayOffsetX = 0;
    let displayOffsetY = 0;

    canvas.width = 500;
    canvas.height = 500;

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

    const resizeHandles = [
        { x: 0, y: 0, cursor: 'nw-resize' },
        { x: 0.5, y: 0, cursor: 'n-resize' },
        { x: 1, y: 0, cursor: 'ne-resize' },
        { x: 1, y: 0.5, cursor: 'e-resize' },
        { x: 1, y: 1, cursor: 'se-resize' },
        { x: 0.5, y: 1, cursor: 's-resize' },
        { x: 0, y: 1, cursor: 'sw-resize' },
        { x: 0, y: 0.5, cursor: 'w-resize' }
    ];
    const handleSize = 8;

    function drawCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        displayScale = Math.min(canvas.width / userImage.width, canvas.height / userImage.height);
        let imgWidth = userImage.width * displayScale;
        let imgHeight = userImage.height * displayScale;
        displayOffsetX = (canvas.width - imgWidth) / 2;
        displayOffsetY = (canvas.height - imgHeight) / 2;

        ctx.drawImage(userImage, displayOffsetX, displayOffsetY, imgWidth, imgHeight);

        // Draw all active templates
        templates.forEach(template => {
            if (template.active && template.img.complete) {
                ctx.save();
                const centerX = template.x + template.width / 2;
                const centerY = template.y + template.height / 2;
                ctx.translate(centerX, centerY);
                ctx.rotate(template.rotation);
                ctx.drawImage(
                    template.img,
                    -template.width / 2,
                    -template.height / 2,
                    template.width,
                    template.height
                );
                ctx.restore();

                if (template.controlsVisible) {
                    drawHandles(template);
                }
            }
        });
    }

    function drawHandles(template) {
        ctx.save();
        ctx.strokeStyle = '#ffffff';
        ctx.lineWidth = 2;
        ctx.fillStyle = '#4285f4';

        const centerX = template.x + template.width / 2;
        const centerY = template.y + template.height / 2;

        // Draw bounding box
        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(template.rotation);
        ctx.strokeRect(-template.width / 2, -template.height / 2, template.width, template.height);
        ctx.restore();

        // Draw resize handles
        resizeHandles.forEach(handle => {
            const handleX = template.x + (handle.x * template.width);
            const handleY = template.y + (handle.y * template.height);
            const rotatedHandle = rotatePoint(handleX, handleY, centerX, centerY, template.rotation);
            
            ctx.fillRect(rotatedHandle.x - handleSize/2, rotatedHandle.y - handleSize/2, handleSize, handleSize);
            ctx.strokeRect(rotatedHandle.x - handleSize/2, rotatedHandle.y - handleSize/2, handleSize, handleSize);
        });

        // Draw rotation handle
        const rotationHandleX = centerX;
        const rotationHandleY = centerY - rotationHandleDistance;
        const rotatedHandle = rotatePoint(rotationHandleX, rotationHandleY, centerX, centerY, template.rotation);

        ctx.beginPath();
        ctx.arc(rotatedHandle.x, rotatedHandle.y, handleSize, 0, Math.PI * 2);
        ctx.fillStyle = '#ff5722';
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

    function rotatePoint(x, y, cx, cy, angle) {
        const cos = Math.cos(angle);
        const sin = Math.sin(angle);
        const nx = (cos * (x - cx)) - (sin * (y - cy)) + cx;
        const ny = (sin * (x - cx)) + (cos * (y - cy)) + cy;
        return { x: nx, y: ny };
    }

    function getHandleAtPosition(x, y) {
        for (let i = 0; i < templates.length; i++) {
            const template = templates[i];
            if (template.active && template.controlsVisible && template.img.complete) {
                const centerX = template.x + template.width / 2;
                const centerY = template.y + template.height / 2;
                
                // Check rotation handle first
                const rotationHandleX = centerX;
                const rotationHandleY = centerY - rotationHandleDistance;
                const rotatedHandle = rotatePoint(rotationHandleX, rotationHandleY, centerX, centerY, template.rotation);
                
                if (Math.hypot(x - rotatedHandle.x, y - rotatedHandle.y) <= handleSize) {
                    return { type: 'rotation', template: template };
                }

                // Check resize handles
                for (let j = 0; j < resizeHandles.length; j++) {
                    const handle = resizeHandles[j];
                    const handleX = template.x + (handle.x * template.width);
                    const handleY = template.y + (handle.y * template.height);
                    const rotatedHandle = rotatePoint(handleX, handleY, centerX, centerY, template.rotation);

                    if (Math.abs(x - rotatedHandle.x) <= handleSize && Math.abs(y - rotatedHandle.y) <= handleSize) {
                        return { type: 'resize', index: j, template: template };
                    }
                }

                // Check if inside the template (for dragging)
                const relX = x - centerX;
                const relY = y - centerY;
                const unrotatedX = Math.cos(-template.rotation) * relX - Math.sin(-template.rotation) * relY;
                const unrotatedY = Math.sin(-template.rotation) * relX + Math.cos(-template.rotation) * relY;

                if (Math.abs(unrotatedX) <= template.width/2 && Math.abs(unrotatedY) <= template.height/2) {
                    return { type: 'drag', template: template };
                }
            }
        }
        return null;
    }

    function isPointInAnyTemplate(x, y) {
        for (let i = 0; i < templates.length; i++) {
            const template = templates[i];
            if (template.active && template.img.complete) {
                const centerX = template.x + template.width / 2;
                const centerY = template.y + template.height / 2;
                const relX = x - centerX;
                const relY = y - centerY;
                const unrotatedX = Math.cos(-template.rotation) * relX - Math.sin(-template.rotation) * relY;
                const unrotatedY = Math.sin(-template.rotation) * relX + Math.cos(-template.rotation) * relY;

                if (Math.abs(unrotatedX) <= template.width/2 && Math.abs(unrotatedY) <= template.height/2) {
                    return template;
                }
            }
        }
        return null;
    }

    function resizeTemplate(template, handleIndex, mouseX, mouseY) {
        const centerX = template.x + template.width / 2;
        const centerY = template.y + template.height / 2;
        const relX = mouseX - centerX;
        const relY = mouseY - centerY;
        const unrotatedX = Math.cos(-template.rotation) * relX - Math.sin(-template.rotation) * relY;
        const unrotatedY = Math.sin(-template.rotation) * relX + Math.cos(-template.rotation) * relY;
        const unrotatedMouseX = unrotatedX + centerX;
        const unrotatedMouseY = unrotatedY + centerY;

        const startWidth = template.width;
        const startHeight = template.height;
        const startX = template.x;
        const startY = template.y;

        switch (handleIndex) {
            case 0: // top-left
                template.width = startWidth + (startX - unrotatedMouseX);
                template.height = startHeight + (startY - unrotatedMouseY);
                if (template.width > 10) template.x = unrotatedMouseX;
                if (template.height > 10) template.y = unrotatedMouseY;
                break;
            case 1: // top-middle
                template.height = startHeight + (startY - unrotatedMouseY);
                if (template.height > 10) template.y = unrotatedMouseY;
                break;
            case 2: // top-right
                template.width = unrotatedMouseX - startX;
                template.height = startHeight + (startY - unrotatedMouseY);
                if (template.height > 10) template.y = unrotatedMouseY;
                break;
            case 3: // right-middle
                template.width = unrotatedMouseX - startX;
                break;
            case 4: // bottom-right
                template.width = unrotatedMouseX - startX;
                template.height = unrotatedMouseY - startY;
                break;
            case 5: // bottom-middle
                template.height = unrotatedMouseY - startY;
                break;
            case 6: // bottom-left
                template.width = startWidth + (startX - unrotatedMouseX);
                template.height = unrotatedMouseY - startY;
                if (template.width > 10) template.x = unrotatedMouseX;
                break;
            case 7: // left-middle
                template.width = startWidth + (startX - unrotatedMouseX);
                if (template.width > 10) template.x = unrotatedMouseX;
                break;
        }

        // Maintain aspect ratio if shift key is pressed
        if (event.shiftKey) {
            const aspectRatio = startWidth / startHeight;
            if (handleIndex === 0 || handleIndex === 2 || handleIndex === 4 || handleIndex === 6) {
                template.height = template.width / aspectRatio;
                if (handleIndex === 0 || handleIndex === 6) {
                    template.y = startY + (startHeight - template.height);
                }
            }
        }

        // Minimum size constraints
        if (template.width < 10) template.width = 10;
        if (template.height < 10) template.height = 10;
    }

    function rotateTemplate(template, mouseX, mouseY) {
        const centerX = template.x + template.width / 2;
        const centerY = template.y + template.height / 2;
        const dx = mouseX - centerX;
        const dy = mouseY - centerY;
        template.rotation = Math.atan2(dy, dx) + Math.PI/2;
    }

    canvas.addEventListener("mousedown", (e) => {
        const mouseX = e.offsetX;
        const mouseY = e.offsetY;
        const handle = getHandleAtPosition(mouseX, mouseY);

        if (handle) {
            currentTemplate = handle.template;
            
            if (handle.type === 'rotation') {
                isRotating = true;
            } else if (handle.type === 'resize') {
                isResizing = true;
                resizeHandleIndex = handle.index;
            } else if (handle.type === 'drag') {
                isDragging = true;
                offsetX = mouseX - currentTemplate.x;
                offsetY = mouseY - currentTemplate.y;
            }
        } else {
            // Check if clicked on any template (without controls visible)
            const clickedTemplate = isPointInAnyTemplate(mouseX, mouseY);
            if (clickedTemplate) {
                // Hide controls for all other templates
                templates.forEach(t => t.controlsVisible = false);
                // Show controls for clicked template
                clickedTemplate.controlsVisible = true;
                currentTemplate = clickedTemplate;
                isDragging = true;
                offsetX = mouseX - currentTemplate.x;
                offsetY = mouseY - currentTemplate.y;
                drawCanvas();
            } else {
                // Clicked outside - hide all controls
                let controlsChanged = false;
                templates.forEach(template => {
                    if (template.controlsVisible) {
                        template.controlsVisible = false;
                        controlsChanged = true;
                    }
                });
                if (controlsChanged) {
                    currentTemplate = null;
                    drawCanvas();
                }
            }
        }

        e.preventDefault();
    });

    canvas.addEventListener("mousemove", (e) => {
        const mouseX = e.offsetX;
        const mouseY = e.offsetY;

        if (!isDragging && !isResizing && !isRotating) {
            const handle = getHandleAtPosition(mouseX, mouseY);
            if (handle?.type === 'rotation') {
                canvas.style.cursor = 'grab';
            } else if (handle?.type === 'resize') {
                canvas.style.cursor = resizeHandles[handle.index].cursor;
            } else if (handle?.type === 'drag') {
                canvas.style.cursor = 'move';
            } else {
                // Check if mouse is over any template (without controls)
                const overTemplate = isPointInAnyTemplate(mouseX, mouseY);
                canvas.style.cursor = overTemplate ? 'pointer' : 'default';
            }
        }

        if (isRotating && currentTemplate) {
            rotateTemplate(currentTemplate, mouseX, mouseY);
            drawCanvas();
        } else if (isResizing && currentTemplate) {
            resizeTemplate(currentTemplate, resizeHandleIndex, mouseX, mouseY);
            drawCanvas();
        } else if (isDragging && currentTemplate) {
            currentTemplate.x = mouseX - offsetX;
            currentTemplate.y = mouseY - offsetY;
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

        tempCanvas.width = userImage.width;
        tempCanvas.height = userImage.height;
        tempCtx.drawImage(userImage, 0, 0, userImage.width, userImage.height);

        // Draw all active templates
        templates.forEach(template => {
            if (template.active && template.img.complete) {
                const originalCenterX = (template.x + template.width/2 - displayOffsetX) / displayScale;
                const originalCenterY = (template.y + template.height/2 - displayOffsetY) / displayScale;
                const originalWidth = template.width / displayScale;
                const originalHeight = template.height / displayScale;

                tempCtx.save();
                tempCtx.translate(originalCenterX, originalCenterY);
                tempCtx.rotate(template.rotation);
                tempCtx.drawImage(
                    template.img,
                    -originalWidth / 2,
                    -originalHeight / 2,
                    originalWidth,
                    originalHeight
                );
                tempCtx.restore();
            }
        });

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
