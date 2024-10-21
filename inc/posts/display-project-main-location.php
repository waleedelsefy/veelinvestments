<?php

function display_project_main_location()
{
    $post_id = get_the_ID();
    $post_type = get_post_type($post_id);
    $location ='';
  $author_id = get_post_field('post_author', $post_id);
  $author_name = get_the_author_meta('display_name', $author_id);

    if ($post_type == 'projects') {
        $city_terms = get_the_terms($post_id, 'city');
        if ($city_terms && !is_wp_error($city_terms)) {
            $location = $city_terms[0]->name;
        }
    }

    $publish_date = get_the_date('Y/m/d g:i A');

  echo '
<div class="project-main-location">
    <div class="col-main-location-write">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
            <path d="M14.8712 0C14.4874 0 14.1035 0.153875 13.8107 0.461329L12.0001 2.36201L15.7501 6.29868L17.5607 4.39801C18.1464 3.7831 18.1464 2.78623 17.5607 2.17132L15.9318 0.461329C15.6389 0.153875 15.255 0 14.8712 0ZM10.5001 3.93668L1.69484 13.1802C1.69484 13.1802 2.38317 13.1154 2.63967 13.3847C2.89617 13.654 2.68502 15.416 3.00002 15.7467C3.31503 16.0774 4.98296 15.8446 5.22221 16.0958C5.46146 16.3469 5.44487 17.1169 5.44487 17.1169L14.2501 7.87336L10.5001 3.93668ZM0.750006 15.7467L0.0424808 17.8504C0.0146667 17.9334 0.000307379 18.0207 0 18.1087C0 18.3175 0.0790182 18.5178 0.219672 18.6654C0.360325 18.8131 0.551092 18.8961 0.750006 18.8961C0.833835 18.8957 0.91702 18.8807 0.996101 18.8515C0.998548 18.8504 1.00099 18.8494 1.00343 18.8484L1.02247 18.8422L1.02686 18.8392L3.00002 18.1087L1.87501 16.9277L0.750006 15.7467Z" fill="black"/>
        </svg>
        ' . esc_html($author_name) . '
    </div>
    <div class="col-main-location-time">
        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.2723 0C4.59734 0 0 4.60723 0 10.2822C0 15.9572 4.59734 20.5645 10.2723 20.5645C15.9572 20.5645 20.5645 15.9572 20.5645 10.2822C20.5645 4.60723 15.9572 0 10.2723 0ZM10.2822 18.508C5.73926 18.508 2.05645 14.8252 2.05645 10.2822C2.05645 5.73926 5.73926 2.05645 10.2822 2.05645C14.8252 2.05645 18.508 5.73926 18.508 10.2822C18.508 14.8252 14.8252 18.508 10.2822 18.508Z" fill="#20201E"/>
            <path d="M10.7962 5.14062H9.25391V11.31L14.6521 14.5479L15.4232 13.2824L10.7962 10.5388V5.14062Z" fill="#20201E"/>
        </svg>
        <time datetime="' . esc_attr(get_the_date('c')) . '" itemprop="datePublished">' . esc_html($publish_date) . '</time>
    </div>
</div>';

}
