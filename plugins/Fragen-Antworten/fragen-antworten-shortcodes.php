<?php

// I got this basic information from this page:
// https://www.inkthemes.com/learn-how-to-create-shortcodes-in-wordpress-plugin-with-examples/
// remember the include in the startpage.php

// ------------------------------------------
// This function gets an archive of all existing posts. Limited with some exceptions.
// ------------------------------------------
function fa_tester()
{
    $tags="";
    $current_tags = get_tags();
    foreach ( $current_tags as $current_tag )
    {
        $tags .= $current_tag->name . " .. ";

        // if (strlen($current_tag->name) == 7)
        // {
        //     $current_week = $current_tag;
        // }
                
    }

    $fa_output = "<div>";
    $fa_output .= 'test_12 für die Woche:' . $tags;
    $fa_output .= "</div>";
    return $fa_output;
}

?>