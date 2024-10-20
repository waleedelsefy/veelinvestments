<?php
$stored_facilities = get_post_meta(get_the_ID(), '_project_facilities', true);
$stored_facilities = maybe_unserialize($stored_facilities);

$facilities = [
    'water_games' => __('Water Games', 'veelinvestments'),
    'security' => __('Security', 'veelinvestments'),
    'sports_clubs' => __('Sports Clubs', 'veelinvestments'),
    'electronic_gates' => __('Electronic Gates', 'veelinvestments'),
    'car_garages' => __('Car Garages', 'veelinvestments'),
    'maintenance_cleaning' => __('Maintenance and Cleaning', 'veelinvestments'),
    'internet_networks' => __('Internet Networks', 'veelinvestments'),
    'cafes_restaurants' => __('Cafes and Restaurants', 'veelinvestments'),
    'kids_area' => __('Kids Area', 'veelinvestments'),
    'shopping_center' => __('Shopping Center', 'veelinvestments'),
    'green_spaces' => __('Green Spaces', 'veelinvestments'),
    'cycling_lanes' => __('Cycling Lanes', 'veelinvestments'),
    'power_generators' => __('Power Generators', 'veelinvestments'),
];

if ($stored_facilities && is_array($stored_facilities)) {
    echo '<div class="facility-content-box">';
    echo '<div class="project-facilities">';
    foreach ($stored_facilities as $facility_key) {
        echo '<div class="facility-box">';
        echo '<div class="facility-img">';

        switch ($facility_key) {
            case 'water_games':
                echo '<i class="fa-solid fa-water"></i>';
                break;
            case 'security':
                echo '<i class="fa-duotone fa-user-secret"></i>';
                break;
            case 'sports_clubs':
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  <path d="M9.80114 15.1671H6.20115C2.90781 15.1671 1.50781 13.7605 1.50781 10.4738V7.48047C1.50781 7.20714 1.73448 6.98047 2.00781 6.98047C2.28115 6.98047 2.50781 7.20714 2.50781 7.48047V10.4738C2.50781 13.2005 3.47448 14.1671 6.20115 14.1671H9.79448C12.5211 14.1671 13.4878 13.2005 13.4878 10.4738V7.48047C13.4878 7.20714 13.7145 6.98047 13.9878 6.98047C14.2611 6.98047 14.4878 7.20714 14.4878 7.48047V10.4738C14.4945 13.7605 13.0878 15.1671 9.80114 15.1671Z" fill="#707070"/>
  <path d="M7.99935 8.49986C7.26602 8.49986 6.59935 8.21319 6.12602 7.68652C5.65268 7.15986 5.43268 6.47319 5.50602 5.73986L5.95268 1.28652C5.97935 1.03319 6.19268 0.833191 6.45268 0.833191H9.56602C9.82602 0.833191 10.0394 1.02652 10.066 1.28652L10.5127 5.73986C10.586 6.47319 10.366 7.15986 9.89268 7.68652C9.39935 8.21319 8.73268 8.49986 7.99935 8.49986ZM6.89935 1.83319L6.49935 5.83986C6.45268 6.28652 6.58602 6.70652 6.86602 7.01319C7.43268 7.63986 8.56602 7.63986 9.13268 7.01319C9.41268 6.69986 9.54602 6.27986 9.49935 5.83986L9.09935 1.83319H6.89935Z" fill="#707070"/>
  <path d="M12.2054 8.49986C10.8521 8.49986 9.6454 7.40652 9.5054 6.05986L9.03874 1.38652C9.0254 1.24652 9.07207 1.10652 9.1654 0.999858C9.25874 0.893191 9.39207 0.833191 9.53874 0.833191H11.5721C13.5321 0.833191 14.4454 1.65319 14.7187 3.66652L14.9054 5.51986C14.9854 6.30652 14.7454 7.05319 14.2321 7.61986C13.7187 8.18652 12.9987 8.49986 12.2054 8.49986ZM10.0921 1.83319L10.5054 5.95986C10.5921 6.79319 11.3654 7.49986 12.2054 7.49986C12.7121 7.49986 13.1654 7.30652 13.4921 6.95319C13.8121 6.59986 13.9587 6.12652 13.9121 5.61986L13.7254 3.78652C13.5187 2.27986 13.0321 1.83319 11.5721 1.83319H10.0921ZM3.7594 8.49986C2.96607 8.49986 2.24607 8.18652 1.73274 7.61986C1.2194 7.05319 0.979404 6.30652 1.0594 5.51986L1.2394 3.68652C1.5194 1.65319 2.43274 0.833191 4.39274 0.833191H6.42607C6.56607 0.833191 6.6994 0.893191 6.7994 0.999858C6.8994 1.10652 6.9394 1.24652 6.92607 1.38652L6.4594 6.05986C6.3194 7.40652 5.11274 8.49986 3.7594 8.49986ZM4.39274 1.83319C2.93274 1.83319 2.44607 2.27319 2.23274 3.79986L2.05274 5.61986C1.9994 6.12652 2.15274 6.59986 2.47274 6.95319C2.79274 7.30652 3.24607 7.49986 3.7594 7.49986C4.5994 7.49986 5.3794 6.79319 5.4594 5.95986L5.87274 1.83319H4.39274ZM9.66674 15.1665H6.3334C6.06007 15.1665 5.8334 14.9399 5.8334 14.6665V12.9999C5.8334 11.5999 6.60007 10.8332 8.00007 10.8332C9.40007 10.8332 10.1667 11.5999 10.1667 12.9999V14.6665C10.1667 14.9399 9.94007 15.1665 9.66674 15.1665ZM6.8334 14.1665H9.16674V12.9999C9.16674 12.1599 8.84007 11.8332 8.00007 11.8332C7.16007 11.8332 6.8334 12.1599 6.8334 12.9999V14.1665Z" fill="#707070"/>
</svg>';
                break;
            case 'electronic_gates':
                echo '<i class="fa-solid fa-door-open"></i>';
                break;
            case 'car_garages':
                echo '<i class="fa-solid fa-cars"></i>';
                break;
            case 'maintenance_cleaning':
                echo '<i class="fa-solid fa-shower"></i>';
                break;
            case 'internet_networks':
                echo '<i class="fa-solid fa-globe"></i>';
                break;
            case 'cafes_restaurants':
                echo '<i class="fa-solid fa-fork-knife"></i>';
                break;
            case 'kids_area':
                echo '<i class="fa-solid fa-family-pants"></i>';
                break;
            case 'shopping_center':
                echo '<i class="fa-solid fa-cart-shopping"></i>';
                break;
            case 'green_spaces':
                echo '<i class="fa-solid fa-leafy-green"></i>';
                break;
            case 'cycling_lanes':
                echo '<i class="fa-solid fa-person-biking-mountain"></i>';
                break;
            case 'power_generators':
                echo '<i class="fa-solid fa-plug"></i>';
                break;
            default:
                echo '';
                break;
        }

        echo '</div>';
        echo '<div class="facility-txt">' . esc_html($facilities[$facility_key] ?? '') . '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}
?>
