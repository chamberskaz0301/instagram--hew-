<?php

    //関数名：hsc
    //関数の内容:引数で与えられた文字列をサニタイズ（無害化）した文字列を返す
    //引数:$str サニタイズしたい文字列
    //戻り値:htmlspecialcharファンクションでサニタイズした文字列

    function hsc($str){

        //二行で書くパターン
        $ret = htmlspecialchars($str, ENT_QUOTES);
        return $ret;

        //1行で書くパターン
        return htmlspecialchars($str, ENT_QUOTES);
    } 


?>