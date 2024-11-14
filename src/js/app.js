document.addEventListener('DOMContentLoaded', () => {
    // --------------------------
    // NavBar JavaScript Code
    // --------------------------
    const dropDownIcon = document.getElementById('drop-down-icon');
    const dropDownItems = document.getElementById('mobile-drop-down');
    const closeIcons = document.getElementById('close-menu');

    if (dropDownIcon && dropDownItems && closeIcons) {
        dropDownIcon.addEventListener('click', function() {
            if (dropDownItems.style.display === 'none') {
                dropDownItems.style.display = 'flex';
            } else {
                dropDownItems.style.display = 'none';
            }
        });

        closeIcons.addEventListener('click', function() {
            if (dropDownItems.style.display === 'flex') {
                dropDownItems.style.display = 'none';
            }
        });
    }

    // --------------------------
    // Hero JavaScript Code
    // --------------------------
    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: "smooth"
        });
    }

    // --------------------------
    // Blogs JavaScript Code
    // --------------------------
    const carouselBlogs = document.querySelector('.carousel-blogs');
    if (carouselBlogs) {
        const nextBtnBlogs = document.getElementById('nextBtn-blogs');
        const prevBtnBlogs = document.getElementById('prevBtn-blogs');
        const totalOriginalCardsBlogs = 12;
        const visibleCardsBlogs = 8;
        const cardWidthBlogs = 340;
        let currentIndexBlogs = visibleCardsBlogs;

        // Clone first and last few items for infinite scroll
        for (let i = 0; i < visibleCardsBlogs; i++) {
            const clone = carouselBlogs.children[i].cloneNode(true);
            carouselBlogs.appendChild(clone);
        }

        for (let i = totalOriginalCardsBlogs - visibleCardsBlogs; i < totalOriginalCardsBlogs; i++) {
            const clone = carouselBlogs.children[i].cloneNode(true);
            carouselBlogs.insertBefore(clone, carouselBlogs.firstChild);
        }

        const totalCardsBlogs = carouselBlogs.children.length;
        carouselBlogs.style.transform = `translateX(-${currentIndexBlogs * cardWidthBlogs}px)`;

        let isTransitioningBlogs = false;

        if (nextBtnBlogs && prevBtnBlogs) {
            nextBtnBlogs.addEventListener('click', () => {
                if (isTransitioningBlogs) return;
                isTransitioningBlogs = true;
                currentIndexBlogs++;
                updateCarouselBlogs();
            });

            prevBtnBlogs.addEventListener('click', () => {
                if (isTransitioningBlogs) return;
                isTransitioningBlogs = true;
                currentIndexBlogs--;
                updateCarouselBlogs();
            });
        }

        carouselBlogs.addEventListener('transitionend', () => {
            isTransitioningBlogs = false;
            if (currentIndexBlogs >= totalOriginalCardsBlogs + visibleCardsBlogs) {
                currentIndexBlogs = visibleCardsBlogs;
                carouselBlogs.style.transition = 'none';
                carouselBlogs.style.transform = `translateX(-${currentIndexBlogs * cardWidthBlogs}px)`;
                carouselBlogs.offsetHeight; // Trigger reflow
                carouselBlogs.style.transition = 'transform 0.5s ease-in-out';
            }

            if (currentIndexBlogs < visibleCardsBlogs) {
                currentIndexBlogs = totalOriginalCardsBlogs + visibleCardsBlogs - 1;
                carouselBlogs.style.transition = 'none';
                carouselBlogs.style.transform = `translateX(-${currentIndexBlogs * cardWidthBlogs}px)`;
                carouselBlogs.offsetHeight;
                carouselBlogs.style.transition = 'transform 0.5s ease-in-out';
            }
        });

        function updateCarouselBlogs() {
            carouselBlogs.style.transform = `translateX(-${currentIndexBlogs * cardWidthBlogs}px)`;
        }
    }

    // --------------------------
    // Developers JavaScript Code
    // --------------------------
    const carouselDevelopment = document.querySelector('.carousel-development');
    if (carouselDevelopment) {
        const nextBtnDevelopment = document.getElementById('nextBtn-development');
        const prevBtnDevelopment = document.getElementById('prevBtn-development');
        const totalOriginalCardsDevelopment = 21;
        const visibleCardsDevelopment = 8;
        const cardWidthDevelopment = 165;
        let currentIndexDevelopment = visibleCardsDevelopment;

        for (let i = 0; i < visibleCardsDevelopment; i++) {
            const clone = carouselDevelopment.children[i].cloneNode(true);
            carouselDevelopment.appendChild(clone);
        }

        for (let i = totalOriginalCardsDevelopment - visibleCardsDevelopment; i < totalOriginalCardsDevelopment; i++) {
            const clone = carouselDevelopment.children[i].cloneNode(true);
            carouselDevelopment.insertBefore(clone, carouselDevelopment.firstChild);
        }

        const totalCardsDevelopment = carouselDevelopment.children.length;
        carouselDevelopment.style.transform = `translateX(-${currentIndexDevelopment * cardWidthDevelopment}px)`;

        let isTransitioningDevelopment = false;

        if (nextBtnDevelopment && prevBtnDevelopment) {
            nextBtnDevelopment.addEventListener('click', () => {
                if (isTransitioningDevelopment) return;
                isTransitioningDevelopment = true;
                currentIndexDevelopment++;
                updateCarouselDevelopment();
            });

            prevBtnDevelopment.addEventListener('click', () => {
                if (isTransitioningDevelopment) return;
                isTransitioningDevelopment = true;
                currentIndexDevelopment--;
                updateCarouselDevelopment();
            });
        }

        carouselDevelopment.addEventListener('transitionend', () => {
            isTransitioningDevelopment = false;
            if (currentIndexDevelopment >= totalOriginalCardsDevelopment + visibleCardsDevelopment) {
                currentIndexDevelopment = visibleCardsDevelopment;
                carouselDevelopment.style.transition = 'none';
                carouselDevelopment.style.transform = `translateX(-${currentIndexDevelopment * cardWidthDevelopment}px)`;
                carouselDevelopment.offsetHeight;
                carouselDevelopment.style.transition = 'transform 0.5s ease-in-out';
            }

            if (currentIndexDevelopment < visibleCardsDevelopment) {
                currentIndexDevelopment = totalOriginalCardsDevelopment + visibleCardsDevelopment - 1;
                carouselDevelopment.style.transition = 'none';
                carouselDevelopment.style.transform = `translateX(-${currentIndexDevelopment * cardWidthDevelopment}px)`;
                carouselDevelopment.offsetHeight;
                carouselDevelopment.style.transition = 'transform 0.5s ease-in-out';
            }
        });

        function updateCarouselDevelopment() {
            carouselDevelopment.style.transform = `translateX(-${currentIndexDevelopment * cardWidthDevelopment}px)`;
        }
    }

    // --------------------------
    // Feedback JavaScript Code
    // --------------------------
    const blogs = document.querySelectorAll('.blog');

    if (blogs.length > 0) {
        let currentBlogIndex = 0;
        blogs[currentBlogIndex].classList.add('active');

        function showBlog(index) {
            blogs.forEach(blog => blog.classList.remove('active'));
            blogs[index].classList.add('active');
        }

        const nextBtnFeedback = document.getElementById('nextBtn-feedback');
        const prevBtnFeedback = document.getElementById('prevBtn-feedback');

        if (nextBtnFeedback && prevBtnFeedback) {
            nextBtnFeedback.addEventListener('click', function() {
                currentBlogIndex = (currentBlogIndex + 1) % blogs.length;
                showBlog(currentBlogIndex);
            });

            prevBtnFeedback.addEventListener('click', function() {
                currentBlogIndex = (currentBlogIndex - 1 + blogs.length) % blogs.length;
                showBlog(currentBlogIndex);
            });
        }
    }

    // --------------------------
    // Modern Projects JavaScript Code
    // --------------------------
    const carouselModernProjects = document.querySelector('.carousel-modern-projects');
    if (carouselModernProjects) {
        const nextBtnModernProjects = document.getElementById('nextBtn-modern-projects');
        const prevBtnModernProjects = document.getElementById('prevBtn-modern-projects');
        const totalOriginalCardsModernProjects = 12;
        const visibleCardsModernProjects = 8;
        const cardWidthModernProjects = 340;
        let currentIndexModernProjects = visibleCardsModernProjects;

        for (let i = 0; i < visibleCardsModernProjects; i++) {
            const clone = carouselModernProjects.children[i].cloneNode(true);
            carouselModernProjects.appendChild(clone);
        }
        for (let i = totalOriginalCardsModernProjects - visibleCardsModernProjects; i < totalOriginalCardsModernProjects; i++) {
            const clone = carouselModernProjects.children[i].cloneNode(true);
            carouselModernProjects.insertBefore(clone, carouselModernProjects.firstChild);
        }

        const totalCardsModernProjects = carouselModernProjects.children.length;
        carouselModernProjects.style.transform = `translateX(-${currentIndexModernProjects * cardWidthModernProjects}px)`;

        let isTransitioningModernProjects = false;

        if (nextBtnModernProjects && prevBtnModernProjects) {
            nextBtnModernProjects.addEventListener('click', () => {
                if (isTransitioningModernProjects) return;
                isTransitioningModernProjects = true;
                currentIndexModernProjects++;
                updateCarouselModernProjects();
            });

            prevBtnModernProjects.addEventListener('click', () => {
                if (isTransitioningModernProjects) return;
                isTransitioningModernProjects = true;
                currentIndexModernProjects--;
                updateCarouselModernProjects();
            });
        }

        carouselModernProjects.addEventListener('transitionend', () => {
            isTransitioningModernProjects = false;
            if (currentIndexModernProjects >= totalOriginalCardsModernProjects + visibleCardsModernProjects) {
                currentIndexModernProjects = visibleCardsModernProjects;
                carouselModernProjects.style.transition = 'none';
                carouselModernProjects.style.transform = `translateX(-${currentIndexModernProjects * cardWidthModernProjects}px)`;
                carouselModernProjects.offsetHeight;
                carouselModernProjects.style.transition = 'transform 0.5s ease-in-out';
            }

            if (currentIndexModernProjects < visibleCardsModernProjects) {
                currentIndexModernProjects = totalOriginalCardsModernProjects + visibleCardsModernProjects - 1;
                carouselModernProjects.style.transition = 'none';
                carouselModernProjects.style.transform = `translateX(-${currentIndexModernProjects * cardWidthModernProjects}px)`;
                carouselModernProjects.offsetHeight;
                carouselModernProjects.style.transition = 'transform 0.5s ease-in-out';
            }
        });

        function updateCarouselModernProjects() {
            carouselModernProjects.style.transform = `translateX(-${currentIndexModernProjects * cardWidthModernProjects}px)`;
        }
    }

    // --------------------------
    // Top Cities JavaScript Code
    // --------------------------
    const carouselTopCities = document.querySelector('.carousel-top-cities');
    if (carouselTopCities) {
        const nextBtnTopCities = document.getElementById('nextBtn-top-cities');
        const prevBtnTopCities = document.getElementById('prevBtn-top-cities');
        const totalOriginalCardsTopCities = 12;
        const visibleCardsTopCities = 8;
        const cardWidthTopCities = 340;
        let currentIndexTopCities = visibleCardsTopCities;

        for (let i = 0; i < visibleCardsTopCities; i++) {
            const clone = carouselTopCities.children[i].cloneNode(true);
            carouselTopCities.appendChild(clone);
        }

        for (let i = totalOriginalCardsTopCities - visibleCardsTopCities; i < totalOriginalCardsTopCities; i++) {
            const clone = carouselTopCities.children[i].cloneNode(true);
            carouselTopCities.insertBefore(clone, carouselTopCities.firstChild);
        }

        const totalCardsTopCities = carouselTopCities.children.length;
        carouselTopCities.style.transform = `translateX(-${currentIndexTopCities * cardWidthTopCities}px)`;

        let isTransitioningTopCities = false;

        if (nextBtnTopCities && prevBtnTopCities) {
            nextBtnTopCities.addEventListener('click', () => {
                if (isTransitioningTopCities) return;
                isTransitioningTopCities = true;
                currentIndexTopCities++;
                updateCarouselTopCities();
            });

            prevBtnTopCities.addEventListener('click', () => {
                if (isTransitioningTopCities) return;
                isTransitioningTopCities = true;
                currentIndexTopCities--;
                updateCarouselTopCities();
            });
        }

        carouselTopCities.addEventListener('transitionend', () => {
            isTransitioningTopCities = false;
            if (currentIndexTopCities >= totalOriginalCardsTopCities + visibleCardsTopCities) {
                currentIndexTopCities = visibleCardsTopCities;
                carouselTopCities.style.transition = 'none';
                carouselTopCities.style.transform = `translateX(-${currentIndexTopCities * cardWidthTopCities}px)`;
                carouselTopCities.offsetHeight;
                carouselTopCities.style.transition = 'transform 0.5s ease-in-out';
            }

            if (currentIndexTopCities < visibleCardsTopCities) {
                currentIndexTopCities = totalOriginalCardsTopCities + visibleCardsTopCities - 1;
                carouselTopCities.style.transition = 'none';
                carouselTopCities.style.transform = `translateX(-${currentIndexTopCities * cardWidthTopCities}px)`;
                carouselTopCities.offsetHeight;
                carouselTopCities.style.transition = 'transform 0.5s ease-in-out';
            }
        });

        function updateCarouselTopCities() {
            carouselTopCities.style.transform = `translateX(-${currentIndexTopCities * cardWidthTopCities}px)`;
        }
    }

    // --------------------------
    // Footer JavaScript Code
    // --------------------------
    const arrowForLinks = document.getElementById('arrow-for-links');
    const arrowForContactUs = document.getElementById('arrow-for-contact-us');
    const linkMenus = document.getElementById('links-menu');
    const contactUsMenus = document.getElementById('contact-us-menu');

    if (arrowForLinks && linkMenus) {
        arrowForLinks.addEventListener('click', () => {
            arrowForLinks.classList.toggle('active');
            linkMenus.classList.toggle('active');
            if (arrowForLinks.classList.contains('active')) {
                arrowForLinks.style.transform = 'rotate(180deg)';
            } else {
                arrowForLinks.style.transform = 'rotate(0deg)';
            }
        });
    }

    if (arrowForContactUs && contactUsMenus) {
        arrowForContactUs.addEventListener('click', () => {
            arrowForContactUs.classList.toggle('active');
            contactUsMenus.classList.toggle('active');
            if (arrowForContactUs.classList.contains('active')) {
                arrowForContactUs.style.transform = 'rotate(180deg)';
            } else {
                arrowForContactUs.style.transform = 'rotate(0deg)';
            }
        });
    }

    // --------------------------
    // WhatsApp and Phone Icons JavaScript Code
    // --------------------------
    const stickyElements = document.querySelector('.contact-side-bar');
    if (stickyElements) {
        window.addEventListener('scroll', () => {
            const scrollHeight = 600;

            if (window.scrollY >= scrollHeight) {
                stickyElements.style.display = 'flex';
            } else {
                stickyElements.style.display = 'none';
            }
        });
    }
    // --------------------------
    // Zoom Meeting Form JavaScript Code
    // --------------------------
    function generateDaysForNextMonth() {
        const dayListContainer = document.getElementById('day-list');
        if (!dayListContainer) return; // Exit if the element doesn't exist

        dayListContainer.innerHTML = '';

        const today = new Date();
        const endDate = new Date(today);
        endDate.setMonth(today.getMonth() + 1);
        let currentDate = new Date(today);

        while (currentDate <= endDate) {
            const dayItem = document.createElement('div');
            dayItem.className = 'day-item';
            dayItem.textContent = `${currentDate.getDate()} - ${currentDate.toLocaleDateString('default', { month: 'long' })} - ${currentDate.getFullYear()}`;
            dayListContainer.appendChild(dayItem);
            currentDate.setDate(currentDate.getDate() + 1);
        }
    }
    generateDaysForNextMonth();

    document.querySelectorAll('path').forEach(item => {
        item.style.cursor= 'pointer';
    });
});
