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

<!--<script src="js/lax.js"></script>-->

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
    document.getElementById('uploadImage').addEventListener('change', function(event) {
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
                    document.getElementById('uploadImage').files = dataTransfer
                        .files;
                });

                previewDiv.appendChild(img);
                previewDiv.appendChild(removeBtn);
                previewContainer.appendChild(previewDiv);
            };
            reader.readAsDataURL(file);
            dataTransfer.items.add(file);
        });

        document.getElementById('uploadImage').files = dataTransfer.files;
    });
</script>
<script>
    let canvas = document.getElementById("imageCanvas");
    let ctx = canvas.getContext("2d");
    let userImage = new Image();
    let templateImage = new Image();
    let isDragging = false;
    let offsetX, offsetY, templateX = 50,
        templateY = 50;
    let templateWidth = 150,
        templateHeight = 150;

    canvas.width = 500;
    canvas.height = 500;

    document.getElementById("uploadImage").addEventListener("change", function(event) {
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

    function drawCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        let scale = Math.min(canvas.width / userImage.width, canvas.height / userImage.height);
        let imgWidth = userImage.width * scale;
        let imgHeight = userImage.height * scale;
        let imgX = (canvas.width - imgWidth) / 2;
        let imgY = (canvas.height - imgHeight) / 2;

        ctx.drawImage(userImage, imgX, imgY, imgWidth, imgHeight);

        ctx.drawImage(templateImage, templateX, templateY, templateWidth, templateHeight);
    }

    canvas.addEventListener("mousedown", (e) => {
        let mouseX = e.offsetX;
        let mouseY = e.offsetY;

        if (mouseX >= templateX && mouseX <= templateX + templateWidth &&
            mouseY >= templateY && mouseY <= templateY + templateHeight) {
            isDragging = true;
            offsetX = mouseX - templateX;
            offsetY = mouseY - templateY;
        }
    });

    canvas.addEventListener("mousemove", (e) => {
        if (isDragging) {
            templateX = e.offsetX - offsetX;
            templateY = e.offsetY - offsetY;
            drawCanvas();
        }
    });

    canvas.addEventListener("mouseup", () => {
        isDragging = false;
    });
    canvas.addEventListener("mouseleave", () => {
        isDragging = false;
    });
    canvas.addEventListener("mouseout", () => {
        isDragging = false;
    });

    function downloadImage() {
        let link = document.createElement("a");

        let tempCanvas = document.createElement("canvas");
        let tempCtx = tempCanvas.getContext("2d");
        tempCanvas.width = userImage.width;
        tempCanvas.height = userImage.height;

        tempCtx.drawImage(userImage, 0, 0, userImage.width, userImage.height);

        let pngScale = userImage.width / canvas.width;
        tempCtx.drawImage(templateImage, templateX * pngScale, templateY * pngScale, templateWidth * pngScale,
            templateHeight * pngScale);

        link.download = "edited_image.png";
        link.href = tempCanvas.toDataURL();
        link.click();
    }
</script>

<script>
    // Create a new IntersectionObserver instance
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            // Check if the section is in the viewport
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

    // Start observing the section
    observer.observe(section);
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
                            templateImage.src = meme_img.src;
                        }
                    }
                }, 100);
            }
        }

    });
    // ✅ Stop Swiper autoplay when clicking the label
    document.querySelector(".stop_slider").addEventListener("click", function() {
        swiper.autoplay.stop(); // 🛑 Stop autoplay
    });

    // ✅ Restart Swiper autoplay when modal is closed
    document.getElementById("imageEditorModal").addEventListener("hidden.bs.modal", function() {
        swiper.autoplay.start(); // ▶ Restart autoplay
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
    // Wait for the DOM to be fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the video, button, and icons
        const video = document.getElementById('dancingVideo');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const playIcon = document.getElementById('playIcon');
        const pauseIcon = document.getElementById('pauseIcon');

        // Add a click event listener to the video to toggle play/pause
        video.addEventListener('click', function() {
            togglePlayPause();
        });

        // Add a click event listener to the button to toggle play/pause
        playPauseBtn.addEventListener('click', function() {
            togglePlayPause();
        });

        // Update button icons and visibility when the video starts playing
        video.addEventListener('play', function() {
            playIcon.style.display = 'none'; // Hide the play icon
            pauseIcon.style.display = 'block'; // Show the pause icon
            hideButton(); // Hide the button after 2 seconds
        });

        // Update button icons and visibility when the video is paused
        video.addEventListener('pause', function() {
            pauseIcon.style.display = 'none'; // Hide the pause icon
            playIcon.style.display = 'block'; // Show the play icon
            // hideButton(); // Hide the button after 2 seconds
        });

        // Show the button when hovering over the video
        video.addEventListener('mouseenter', function() {
            playPauseBtn.classList.remove('hidden'); // Remove the 'hidden' class
        });

        // Hide the button when not hovering over the video (if the video is playing)
        video.addEventListener('mouseleave', function() {
            if (!video.paused) { // Check if the video is playing
                playPauseBtn.classList.add('hidden'); // Add the 'hidden' class
            }
        });

        // Function to toggle between play and pause
        function togglePlayPause() {
            if (video.paused) { // If the video is paused
                video.play(); // Play the video
            } else { // If the video is playing
                video.pause(); // Pause the video
            }
        }

        // Function to hide the button after 2 seconds
        // function hideButton() {
        //     setTimeout(() => { // Delay execution by 2 seconds
        //         if (!video.paused) { // Check if the video is still playing
        //             playPauseBtn.classList.add('hidden'); // Hide the button
        //         }
        //     }, 2000); // 2000 milliseconds = 2 seconds
        // }
    });
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
