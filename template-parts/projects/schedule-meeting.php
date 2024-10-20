<div class="schedule-meeting">
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="siteform" id="formSingle">
        <input type="hidden" name="action" value="contact_form">
        <input type="hidden" name="formName" value="<?php _e('Meeting Form', 'realestate'); ?>">
        <input type="hidden" name="PageTitle" value="<?php _e('Schools', 'realestate'); ?>">
        <input type="hidden" name="pageURL" value="<?php echo esc_url(get_permalink()); ?>">

        <div class="input-box">
            <label for="full-name"><?php _e('Full Name', 'realestate'); ?></label>
            <input name="User_Name" placeholder="<?php _e('Full Name', 'realestate'); ?>" class="form-bg User_Name" aria-label="<?php _e('Your Name', 'realestate'); ?>" required>
        </div>

        <div class="input-box">
            <label for="your-phone"><?php _e('Phone Number', 'realestate'); ?></label>
            <input name="User_Phone" class="form-bg User_Phone" placeholder="<?php _e('Phone Number', 'realestate'); ?>" aria-label="<?php _e('Contact Phone', 'realestate'); ?>" required>
        </div>

        <div class="form-inside-title"><?php _e('Choose the date', 'realestate'); ?></div>
        <ul class="radio-box">
            <?php
            for ($i = 0; $i < 7; $i++) {
                $future_date = strtotime("+$i days");
                $day_name = date_i18n('l', $future_date);
                $date_value = date_i18n('d-m-Y', $future_date);
                $day_month = date_i18n('d F', $future_date);

                echo '
                <li>
                    <input type="radio" id="date-value-' . $i . '" name="pick-date" value="' . esc_attr($date_value) . '" class="hidden peer">
                    <label style="display:block" for="date-value-' . $i . '">
                        <span style="display:block" class="w-full">' . esc_html($day_name) . '</span>
                        <span style="display:block" class="w-full">' . esc_html($day_month) . '</span>
                    </label>
                </li>';
            }
            ?>
        </ul>

        <div class="input-box">
            <label for="fav-time"><?php _e('Choose the time', 'realestate'); ?></label>
            <select name="fav-time" style="direction: ltr;" aria-label="<?php _e('Select time', 'realestate'); ?>" class="search-select form-bg" id="fav-time">
                <option value="10:00 AM"><?php _e('10:00 AM', 'realestate'); ?></option>
                <option value="11:00 AM"><?php _e('11:00 AM', 'realestate'); ?></option>
                <option value="12:00 PM"><?php _e('12:00 PM', 'realestate'); ?></option>
                <option value="1:00 PM"><?php _e('1:00 PM', 'realestate'); ?></option>
                <option value="2:00 PM"><?php _e('2:00 PM', 'realestate'); ?></option>
                <option value="3:00 PM"><?php _e('3:00 PM', 'realestate'); ?></option>
                <option value="4:00 PM"><?php _e('4:00 PM', 'realestate'); ?></option>
                <option value="5:00 PM"><?php _e('5:00 PM', 'realestate'); ?></option>
                <option value="6:00 PM"><?php _e('6:00 PM', 'realestate'); ?></option>
                <option value="7:00 PM"><?php _e('7:00 PM', 'realestate'); ?></option>
                <option value="8:00 PM"><?php _e('8:00 PM', 'realestate'); ?></option>
                <option value="9:00 PM"><?php _e('9:00 PM', 'realestate'); ?></option>
                <option value="10:00 PM"><?php _e('10:00 PM', 'realestate'); ?></option>
                <option value="11:00 PM"><?php _e('11:00 PM', 'realestate'); ?></option>
                <option value="12:00 PM"><?php _e('12:00 PM', 'realestate'); ?></option>
            </select>
        </div>

        <input id="formSingleButton" type="submit" value="<?php _e('Appointment Confirmation', 'realestate'); ?>" class="submit">
    </form>
</div>
