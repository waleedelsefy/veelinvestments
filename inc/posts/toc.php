<?php
function generate_table_of_contents() {
    // Get the post content (supports all post types)
    $content = get_the_content();

    // Initialize an empty array to store headings
    $headings = [];

    // Regular expression pattern to match headings (h2-h6)
    $pattern = '/<h([2-6]).*?>(.*?)<\/h\1>/i';

    // Match headings in the content
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

    // Loop through matched headings
    foreach ($matches as $match) {
        $level = intval($match[1]); // Heading level (h2-h6)
        $text = strip_tags($match[2]); // Heading text

        // Add heading to the array
        $headings[] = [
            'level' => $level,
            'text' => $text,
        ];
    }

    // If there are no headings, return an empty string
    if (empty($headings)) {
        return '';
    }

    // Start building the table of contents
    $toc = '<div class="table-of-contents"><div class="head-table-of-contents"><p class="headline right">' . __('Table of Contents', 'veelinvestments') . '</p><button id="toggleToc">' . __('show', 'veelinvestments') . '</button></div><ul class="toc-list" style="display: none;">';

    // Loop through headings to build the table of contents
    foreach ($headings as $heading) {
        $level = $heading['level'];
        $text = $heading['text'];

        // Generate a unique ID for the heading
        $id = sanitize_title_with_dashes($text); // Generate a unique ID based on the heading text

        // Add opening list item tag for the current heading
        $toc .= '<li>';

        // Add link to the heading
        $toc .= '<a href="#' . $id . '">' . $text . '</a>';

        // Add closing list item tag for the current heading
        $toc .= '</li>';
    }

    // Close the unordered list
    $toc .= '</ul></div>';

    // Add JavaScript for toggling Table of Contents
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleButton = document.getElementById("toggleToc");
            var tocList = document.querySelector(".toc-list");
            toggleButton.addEventListener("click", function() {
                tocList.style.display = (tocList.style.display === "none") ? "block" : "none";
                toggleButton.textContent = (tocList.style.display === "none") ? "<?php echo __('show', 'veelinvestments')  ?>" : "<?php echo __('hide', 'veelinvestments')  ?>";
            });
        });
    </script>
    <?php

    return $toc;
}
