<?php
$model_3d_iframe = get_post_meta(get_the_ID(), 'model_3d_iframe', true);

if ($model_3d_iframe) {
  $thumbnail_url = get_template_directory_uri() . '/dist/img/modeling-simulation.png';
  ?>
  <div class="project-3d-model">
    <img id="model-3d-thumbnail" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" style="cursor: pointer; width: 100%;">
  </div>

  <div id="model-3d-modal" class="modal">
    <div class="modal-content">
      <span id="model-3d-close" class="modal-close">&times;</span>
      <?php
      echo $model_3d_iframe;
      ?>
    </div>
  </div>

  <style>
    #model-3d-thumbnail {
      height: 200px;
    }
    .project-3d-model {
      cursor: pointer;
      width: 100%;
      height: 200px;
      img {
        border-radius: 15px;

      }
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.9);
    }
    .modal-content {
      position: relative;
      margin: auto;
      padding: 0;
      width: 100%;
      max-width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .modal-content iframe {
      width: 80%;
      height: 80%;
      border: none;
    }
    .modal-close {
      position: absolute;
      top: 20px;
      right: 35px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      cursor: pointer;
    }
    .modal-close:hover,
    .modal-close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }
    @media screen and (max-width: 435px) {
      #model-3d-thumbnail {
        height: 100px;
      }

    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var thumbnail = document.getElementById('model-3d-thumbnail');
      var modal = document.getElementById('model-3d-modal');
      var closeBtn = document.getElementById('model-3d-close');

      thumbnail.addEventListener('click', function() {
        modal.style.display = 'block';
      });

      closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
      });

      window.addEventListener('click', function(event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    });
  </script>
  <?php
} else {
}
?>
