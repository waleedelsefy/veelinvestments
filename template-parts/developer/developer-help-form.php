<body>
<div class="formWithCTA">
  <form class="smallForm">
    <h2>تحتاج إلى مساعدة عقارية؟</h2>
    <h4>املأ بياناتك و سوف يقوم خبير عقارى بالاتصال بك فى اقرب وقت</h4>

    <input class="smallFormInput" type="text"   placeholder="الاسم" required>

    <select class="smallFormDropDown" id="dropdown" name="options" required>
      <option >الموقع المفضل</option>
      <option >Option 2</option>
      <option >Option 3</option>
    </select>

    <input class="smallFormInput" type="text"  placeholder="رقم الهاتف" >

    <textarea class="smallFormMessage" id="message" placeholder="رسالتك" name="message" rows="4" required></textarea>

    <button class="smallFormButton" type="submit">ارسال</button>

    <div class="smallFormLogo">
      <img src="<?php echo get_template_directory_uri(); ?>/src/img/veel-logo.webp">
    </div>
  </form>

  <?php get_template_part('template-parts/global/phone-whatsapp-zoom-cta'); ?>
</div>
</body>
