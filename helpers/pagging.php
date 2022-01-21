<?php

    function str_pagging($pageNum, $totalPage, $type = 'admin'){
        $type = $type == 'admin' ? 'search' : 'search-user';
        $strPagging = '';
        $pagePrev = $pageNum - 1;
        $strPagging = "<ul class='pagination'>";
        if ($pageNum > 1) {
            $pagePrev = $pageNum - 1;
            $strPagging .= "<li class='page-item'><a class='page-link' href = 'management/{$type}/{$pagePrev}'><<</a></li>";
        }
        for ($i = 1; $i <= $totalPage; $i++) {
            $active = "";
            if ($pageNum == $i) {
                $active = "active";
            }
            $strPagging .= "<li class='page-item'><a class='page-link {$active}' href = 'management/{$type}/{$i}'>$i</a></li>";
        }
        $pageNext = $pageNum + 1;
        if ($pageNum < $totalPage) {
            $pageNext = $pageNum + 1;
            $strPagging .= "<li class='page-item'><a class='page-link' href = 'management/{$type}/{$pageNext}'>>></a></li>";
        }
        $strPagging .= "</ul>";
        return $strPagging;
    }
?>