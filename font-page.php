<?php
get_header();

// Get section settings
$sections_order = get_post_meta(get_the_ID(), '_homepage_sections_order', true);
$sections_visibility = get_post_meta(get_the_ID(), '_homepage_sections_visibility', true);

// Default sections if none are saved
$default_sections = ['hero', 'checklist', 'case-studies', 'team', 'contact', 'clients', 'reviews'];
$sections_order = $sections_order ?: $default_sections;
$sections_visibility = $sections_visibility ?: array_fill_keys($default_sections, true);

// Render sections
foreach ($sections_order as $section) {
    if (!empty($sections_visibility[$section])) {
        get_template_part('template-parts/' . $section);
    }
}

get_footer();
?>
