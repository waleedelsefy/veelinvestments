<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <link rel="stylesheet" href="../../src/style/css/fifth-settlement/new-projects.css">
</head>
<body>

<div class="newProjectSection">
  <div class="veelBlog">
    <div class="veelCursors">
      <div class="box"><button class="right-arrow" id="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.25314 19.1219C6.08229 18.951 6.08229 18.674 6.25314 18.5031L14.2563 10.5L6.25314 2.49686C6.08229 2.326 6.08229 2.049 6.25314 1.87814C6.424 1.70729 6.70101 1.70729 6.87186 1.87814L15.1844 10.1906C15.3552 10.3615 15.3552 10.6385 15.1844 10.8094L6.87186 19.1219C6.701 19.2927 6.424 19.2927 6.25314 19.1219Z" fill="white"/>
      </svg></button>
      </div>
      <div class="lc">
        <button class="left-arrow" id="left-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7469 1.87814C14.9177 2.049 14.9177 2.32601 14.7469 2.49686L6.74372 10.5L14.7469 18.5031C14.9177 18.674 14.9177 18.951 14.7469 19.1219C14.576 19.2927 14.299 19.2927 14.1281 19.1219L5.81564 10.8094C5.64478 10.6385 5.64478 10.3615 5.81564 10.1906L14.1281 1.87814C14.299 1.70729 14.576 1.70729 14.7469 1.87814Z" fill="white"/>
          </svg>
        </button>
      </div>
    </div>

    <div class="newCompoundsHeader">
      <div class="rectangle"></div>
      <h2>المشاريع الجديدة </h2>
    </div>

      <div class="subHeadingParagraph">
        <p>ابحث في مجموعة من ارقى العقارات بأفضل الأسعار</p>
      </div>


    <div class="cityImgGallery" id="veelcityImageGallery">


      <div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div><div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div><div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div><div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div><div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div><div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div><div class="image">
        <div class="img">
          <div class="rectangle1"></div>
        </div>
        <div class="imgContent">

          <h4> اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى
          </p>
        </div>
      </div>

      <div class="image">
        <div class="img">
          <div class="rectangle2"></div>
        </div>
        <div class="imgContent">
          <h4>اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى</p>
        </div>
      </div>

      <div class="image">
        <div class="img">
          <div class="rectangle3"></div>
        </div>
        <div class="imgContent">
          <h4>اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى</p>
        </div>
      </div>

      <div class="image">
        <div class="img">
          <div class="rectangle4"></div>
        </div>
        <div class="imgContent">

          <h4>اسم المشروع</h4>
          <p>نيو جيرسى للتطوير العقارى</p>
        </div>
      </div>

  </div>
</div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const veelcityImageGallery = document.getElementById('veelcityImageGallery');
    const rightArrow = document.getElementById('right-arrow');
    const leftArrow = document.getElementById('left-arrow');

    rightArrow.addEventListener('click', function() {
      veelcityImageGallery.scrollBy({ left: 300, behavior: 'smooth' }); // Adjust 200 to your desired scroll amount
    });

    leftArrow.addEventListener('click', function() {
      veelcityImageGallery.scrollBy({ left: -300, behavior: 'smooth' }); // Adjust 200 to your desired scroll amount
    });
  });

</script>
</body>
</html>
