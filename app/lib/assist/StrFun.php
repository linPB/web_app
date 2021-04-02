<?php
/**
 * Func : 助手 字符串相关
 * Create By Lpb
 * Date: 2021/3/12 0012
 * Time: 16:12
 */

namespace app\lib\assist;


trait StrFun
{
    /**
     * 分页获取分页url 参数
     * @return string
     */
    public function getUrlPattern(): string
    {
        $str = '?page_num=(:num)';
        foreach ( session('url.params') as $key => $value ) {
            if ( $key == 'page_num' ) {
                continue;
            } else {
                if (!empty($value)) $str .= "&$key=$value";
            }
        }
        return $str;
    }
}