  <div class="contactForm">
    <div class="contactFormImg col-4 desktopOnly tabletOnly">
      <img src="<?php echo esc_url(get_template_directory_uri() .'/src/img/formimg.png'); ?>">
    </div>
    <div class="flex-column contactFormBox col-8 contactFormGap">
    <div class="flex-column contactFormHeading">
      <h2 >تحتاج إلى مساعدة عقارية؟</h2>
      <p>املأ بياناتك و سوف يقوم خبير عقارى بالاتصال بك فى اقرب وقت</p>
    </div>
    <div class="contactFormBoxInputs contactFormGap">
      <form class="flex-row contactFormGap">
  <div class="flex-column contactFormGap">
    <input type="text" placeholder="الاسم" id="name" name="name" required>
    <select id="options" name="options">
      <option value="option1">الموقع المفضل</option>
      <option value="option2">Option 2</option>
      <option value="option3">Option 3</option>
    </select>
    <input placeholder="رقم الهاتف" type="number" id="phone" name="phone" required>
  </div>
  <div class="flex-column contactFormGap">
    <textarea  placeholder="رسالتك" id="message" name="message" rows="4" cols="50" required></textarea>
    <button class="submitButton" type="submit">ارسال</button>
  </div>
      </form>
    </div>
    </div>
  </div>
