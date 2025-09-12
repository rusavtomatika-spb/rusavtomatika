<?php
global $extra_openGraph;
if (isset($extra_openGraph) and $extra_openGraph != ''){
    foreach ($extra_openGraph as $paramName => $paramValue) {
        switch ($paramName) {
            case "openGraph_image":
                echo "<meta property='og:image' content='" . $paramValue . "'/>" ;
                echo '
                        ';
                echo "<link rel='image_src' href='" . $paramValue . "'>";
                echo '
                        ';
                break;
            case "openGraph_title":
                echo "<meta property='og:title' content='" . $paramValue . "'/>" ;
                echo '
                        ';
                break;
            case "openGraph_description":
                echo "<meta property='og:description' content='" . $paramValue . "'/>" ;
                echo '
                        ';
                break;
            case "openGraph_siteName":
                echo "<meta property='og:site_name' content='" . $paramValue . "'/>";
                echo '
                        ';
                break;
        }
    }
}

