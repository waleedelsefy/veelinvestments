<div class="hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.15), #000000), url('<?php echo esc_url(get_template_directory_uri() . '/src/img/herobackground.webp'); ?>');">
<div class="hero-main-container">
    <!--    <div class="separator"></div>-->
    <div class="hero-first-section">
        <div class="hero-heading">
            <h1>ابحث عن منزلك</h1>
        </div>
        <div class="hero-subtitle">
            <p>ابحث في مجموعة من ارقى العقارات بأفضل الأسعار</p>
        </div>
        <div class="hero-form">
            <form>
                <div class="hero-form-input">
                    <input type="text" name=""  placeholder="البحث بالكمبوند، الموقع، المطور العقاري">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.16659 2.08337C5.083 2.08337 2.58325 4.58312 2.58325 7.66671C2.58325 10.7503 5.083 13.25 8.16659 13.25C11.2502 13.25 13.7499 10.7503 13.7499 7.66671C13.7499 4.58312 11.2502 2.08337 8.16659 2.08337ZM1.08325 7.66671C1.08325 3.75469 4.25457 0.583374 8.16659 0.583374C12.0786 0.583374 15.2499 3.75469 15.2499 7.66671C15.2499 11.5787 12.0786 14.75 8.16659 14.75C4.25457 14.75 1.08325 11.5787 1.08325 7.66671Z" fill="#081945"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3029 12.803C13.5958 12.5102 14.0707 12.5102 14.3636 12.803L15.6969 14.1364C15.9898 14.4293 15.9898 14.9041 15.6969 15.197C15.404 15.4899 14.9291 15.4899 14.6363 15.197L13.3029 13.8637C13.01 13.5708 13.01 13.0959 13.3029 12.803Z" fill="#081945"/>
                    </svg>
                </div>
                <select name="" class="hero-form-option">
                    <option>انواع الوحدات</option>
                    <option>السعر 1</option>
                    <option>السعر 2</option>
                </select>
                <select name="" class="hero-form-option">
                    <option>غرف نوم</option>
                    <option>السعر 1</option>
                    <option>السعر 2</option>
                </select>
                <select name="" class="hero-form-option">
                    <option>السعر</option>
                    <option>السعر 1</option>
                    <option>السعر 2</option>
                </select>
                <div class="button">
                    <button class="hero-form-button">بحث</button>
                </div>
            </form>
        </div>
    </div>
    <div class="hero-second-section">
        <div class="hero-second-social">
          <?php get_template_part('template-parts/global/social'); ?>

        </div>
        <div class="hero-second-down-button" onclick="scrollToButtom()" >
            <svg  xmlns="http://www.w3.org/2000/svg" width="15" height="19" viewBox="0 0 15 19" fill="none">
                <path d="M14.1117 12.5552L12.9367 11.4781L8.27832 15.7406V0.333008H6.61165V15.7406L1.96165 11.4705L0.77832 12.5552L7.44499 18.6663L14.1117 12.5552Z" fill="white"/>
            </svg>
        </div>
    </div>
</div>
</div>
<script>
    function scrollToButtom(){
        window.scrollTo({
            top:document.body.scrollHeight,
            behavior:"smooth"
        });
    }
</script>
