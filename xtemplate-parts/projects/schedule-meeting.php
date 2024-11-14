<div class="schedule-meeting">
  <div>
    <h3>حدد موعد اجتماع زووم</h3>
    <p>املأ بياناتك لتحديد موعد للاجابة علي الاستفسار الخاص بكم</p>
  </div>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="siteform" id="formSingle">
        <input type="hidden" name="action" value="contact_form">
        <input type="hidden" name="formName" value="<?php _e('Meeting Form', 'veelinvestments'); ?>">
        <input type="hidden" name="PageTitle" value="<?php _e('Schools', 'veelinvestments'); ?>">
        <input type="hidden" name="pageURL" value="<?php echo esc_url(get_permalink()); ?>">

        <div class="input-box">
            <input name="User_Name" placeholder="<?php _e('Full Name', 'veelinvestments'); ?>" class="form-bg User_Name" aria-label="<?php _e('Your Name', 'veelinvestments'); ?>" required>
        </div>

        <div class="input-box">
            <input name="User_Phone" class="form-bg User_Phone" placeholder="<?php _e('Phone Number', 'veelinvestments'); ?>" aria-label="<?php _e('Contact Phone', 'veelinvestments'); ?>" required>
        </div>

        <div class="form-inside-title"><?php _e('Choose the date', 'veelinvestments'); ?></div>
        <ul class="radio-box ">
            <?php
            for ($i = 0; $i < 7; $i++) {
                $future_date = strtotime("+$i days");
                $day_name = date_i18n('l', $future_date);
                $date_value = date_i18n('d-m-Y', $future_date);
                $day_month = date_i18n('d F', $future_date);

                echo '
                <li class="schedule-meeting-day">
                    <input type="radio" id="date-value-' . $i . '" name="pick-date" value="' . esc_attr($date_value) . '" class="hidden peer">
                    <label style="display:block" for="date-value-' . $i . '">
                        <span style="display:block" class=" w-full">' . esc_html($day_name) . '</span>
                        <span style="display:block" class="w-full">' . esc_html($day_month) . '</span>
                    </label>
                </li>';
            }
            ?>
        </ul>

        <div class="input-box">
            <label for="fav-time"><?php _e('Choose the time', 'veelinvestments'); ?></label>
            <select name="fav-time" style="direction: ltr;" aria-label="<?php _e('Select time', 'veelinvestments'); ?>" class="search-select form-bg" id="fav-time">
                <option value="10:00 AM"><?php _e('10:00 AM', 'veelinvestments'); ?></option>
                <option value="11:00 AM"><?php _e('11:00 AM', 'veelinvestments'); ?></option>
                <option value="12:00 PM"><?php _e('12:00 PM', 'veelinvestments'); ?></option>
                <option value="1:00 PM"><?php _e('1:00 PM', 'veelinvestments'); ?></option>
                <option value="2:00 PM"><?php _e('2:00 PM', 'veelinvestments'); ?></option>
                <option value="3:00 PM"><?php _e('3:00 PM', 'veelinvestments'); ?></option>
                <option value="4:00 PM"><?php _e('4:00 PM', 'veelinvestments'); ?></option>
                <option value="5:00 PM"><?php _e('5:00 PM', 'veelinvestments'); ?></option>
                <option value="6:00 PM"><?php _e('6:00 PM', 'veelinvestments'); ?></option>
                <option value="7:00 PM"><?php _e('7:00 PM', 'veelinvestments'); ?></option>
                <option value="8:00 PM"><?php _e('8:00 PM', 'veelinvestments'); ?></option>
                <option value="9:00 PM"><?php _e('9:00 PM', 'veelinvestments'); ?></option>
                <option value="10:00 PM"><?php _e('10:00 PM', 'veelinvestments'); ?></option>
                <option value="11:00 PM"><?php _e('11:00 PM', 'veelinvestments'); ?></option>
                <option value="12:00 PM"><?php _e('12:00 PM', 'veelinvestments'); ?></option>
            </select>
        </div>

        <input id="formSingleButton" type="submit" value="<?php _e('Send', 'veelinvestments'); ?>" class="submit">
    </form>
</div>
<style>
  li.schedule-meeting-day {
    display: flex;
    width: 90px;
    height: 100px;
    padding: 10px 12px;
    justify-content: center;
    align-items: flex-start;
    gap: 273px;
    flex-shrink: 0;
  }
  select#fav-time {
    text-align: right;
  }
  .schedule-meeting {
    margin: 10px 0;
    width: 96%;
    color: #FFF;
    text-align: right;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 21px;
    border-radius: 12px;
    background: #231F20;
    padding: 10px 25px;
  }
  .schedule-meeting form{display: flex; flex-wrap: wrap;padding:10px; justify-content: space-between}

  .schedule-meeting .form-inside-title{font-weight: bold; font-size: 0.9rem;margin-bottom: 5px; padding-right: 5px}

  .schedule-meeting .input-box{width:98%;margin:0 1%}

  .schedule-meeting .input-box label{font-size: 0.9rem;margin-bottom: 5px; font-weight: bold}

  .schedule-meeting .form-bg,.schedule-meeting .comment{width:100%;padding-right:15px;height:40px;line-height:38px;color:#233F5A;display:block;font-family:"Cairo";font-size:0.85rem;margin-bottom:15px;border:1px solid #C0C0C0;font-weight: bold;background-color: #FFFFFF;border-radius: 10px}

  .schedule-meeting .comment{height:100px;}

  .schedule-meeting .search-select{appearance: none;

    -moz-appearance: none;

    -webkit-appearance: none;

    background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");

    background-position: 2%;

    background-repeat: no-repeat;

    color: rgba(35,63,90,0.7);}

  .schedule-meeting .form-bg::placeholder,.schedule-meeting .comment::placeholder{opacity:.5; }

  .schedule-meeting .submit{
    display: flex;
    width: 100%;
    height: 42px;
    padding: 12px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    color: #FFFFFF;
    flex-shrink: 0;
    border-radius: 5px;
    background: #D1B671;
  }

  .schedule-meeting .submit:hover{cursor:pointer;background-color: #B3CB63}



  /*radio*/

  .schedule-meeting .radio-box{

    display: flex; overflow-x: auto;width:100%;list-style-type: none;padding-right: 0; margin-bottom: 15px

  }



  .schedule-meeting  .radio-box [type="radio"]{display: none}

  .schedule-meeting  .radio-box label{display: flex; justify-content: space-between; align-items: center;text-align: center; padding:5px 10px; width:100%; background-color: #F9F9F9; color: #70777E; font-size: 0.9rem; border-radius: 10px; cursor: pointer; border:2px solid #DADADA;transition: 0.2s;}

  .schedule-meeting  .radio-box label:hover, .schedule-meeting  .radio-box input:checked ~ label{background-color: #EDF5F6;border-color:#00B0C4; color: #00B0C4}



</style>
