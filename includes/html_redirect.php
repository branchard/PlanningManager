<?php
    function html_redirect($redirect_page_path)
    {
        $result = '<meta http-equiv="refresh" content="0; url='.$redirect_page_path.'" />';
        return $result;
    }
?>