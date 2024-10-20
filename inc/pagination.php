<?php
function veel_pagination($total_pages, $current_page = 1) {
    if ($total_pages <= 1) {
        return;
    }

    $html = '<div class="pagination-table"><div class="pagination"><ul>';

    $base_url = get_pagenum_link(1);

    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $prev_link = ($prev_page == 1) ? $base_url : trailingslashit($base_url) . 'page/' . $prev_page . '/';
        $html .= '<li class="btn prev"><a class="btnnumb" href="' . esc_url($prev_link) . '"><i class="fas fa-angle-right"></i> ' . __('Prev', 'veelinvestments') . '</a></li>';
    }

    $range = 2;
    $min_page = max(1, $current_page - $range);
    $max_page = min($total_pages, $current_page + $range);

    for ($i = $min_page; $i <= $max_page; $i++) {
        $page_link = ($i == 1) ? $base_url : trailingslashit($base_url) . 'page/' . $i . '/';
        if ($i == $current_page) {
            $html .= '<li class="numb active"><a class="numbActive" href="' . esc_url($page_link) . '">' . $i . '</a></li>';
        } else {
            $html .= '<li class="numb"><a class="numbnunActive" href="' . esc_url($page_link) . '">' . $i . '</a></li>';
        }
    }

    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $next_link = trailingslashit($base_url) . 'page/' . $next_page . '/';
        $html .= '<li class="btn next"><a class="btnnumb" href="' . esc_url($next_link) . '">' . __('Next', 'veelinvestments') . ' <i class="fas fa-angle-left"></i></a></li>';
    }

    $html .= '</ul></div></div>';

    echo $html;
}
