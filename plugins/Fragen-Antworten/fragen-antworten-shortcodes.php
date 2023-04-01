<?php

// I got this basic information from this page:
// https://www.inkthemes.com/learn-how-to-create-shortcodes-in-wordpress-plugin-with-examples/
// remember the include in the startpage.php

// ------------------------------------------
// This function gets all Fragen with a specific tag
// ------------------------------------------
function fa_getQuestionswithtag($current_tag)
{
    $fa_tag_parameter = $current_tag["tag"];

    $fa_error ="Please provide a proper tag in the shortcode!";

    //TODO: proper check for validity of the tag parameter
    if (strlen($fa_tag_parameter)<>7)
    {
        $fa_output = "<div>" . $fa_error . "</div>";
        return $fa_output;
    }

    $tags="";
    // TODO: Diese get_tags-Funktion holt offenbar alle Tags und nicht die zum Post verlinkten! Hui.
    $current_tags = get_tags();
    foreach ( $current_tags as $current_tag )
    {
        $tags .= "the tag: " . $current_tag->name . " .. ";

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



// ------------------------------------------
// This function is just a test.
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