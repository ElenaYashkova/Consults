<?php
function model_getAllTagsByClass($f_name,$tag_name,$class_name):array {
    $html = file_get_contents($f_name);
    $tagname = $tag_name;
    $classname = $class_name;
    $regpat = '/<body.*?>.*?<\/body>/s';
    preg_match($regpat, $html, $res);
    $tag_rex = '/<\/?'.$tagname.'[^<>]*>/';
    $tag_o_rex = '/<'.$tagname.'[^<>]*>/';
    preg_match_all($tag_rex, $res[0], $tags);
    $tag_cl_rex = '/<'.$tagname .'[^<>]*? class="'.$classname .'".*?>/';
    $index = 0;
    $i = 0;
    $n = false;
    $arr = [];
    foreach ($tags[0] as $tag){
        if($n==true){
            if(preg_match($tag_o_rex,$tag)) $i++;
            else $i--;
        }
        if(preg_match($tag_cl_rex,$tag)){
            $n=true;
            $i++;
            $start=strpos($res[0],$tag,$index);
        }
        $index=strpos($res[0],$tag,$index)+strlen($tag);
        if($n==true && $i==0){
            $arr[]=substr($res[0],$start,($index-$start));
            $n=false;
        }
    }
    return $arr;
}
//print_r(allTagsByClass("x.html","div","b"));