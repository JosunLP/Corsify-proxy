<?php

namespace webapp_php_sample_class;

class GalleryBuilder
{
    public static function GalleryGenerator($path)
    {
        $images = array_diff(scandir($path), DEFAULT_FILE_FILTER);
        echo "<div class='gallery'>";
        foreach ($images as $value) {
            print("<a href='https://fontawesome.com/' target='_blank'><img src='" . $path . $value . "' class='gallery-item' ></a>");
        }
        echo '</div>';
    }

}



