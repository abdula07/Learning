<?php

namespace app\common\helpers;

class Url extends \yii\helpers\Url
{
    public static function SetParam(string $url, array $params): string
    {
        if (empty($params)) {
            return $url;
        }
        $url = explode('?', $url);
        $currentParams = [];
        if (count($url) != 1) {
            $url[1] = explode('&', $url[1]);
            foreach ($url[1] as $part) {
                $part = explode('=', $part);
                if (count($part) != 2) {
                    continue;
                }
                $currentParams[$part[0]] = $part[1];
            }
        }
        $url = $url[0];
        foreach ($params as $k => $v) {
            if (is_null($v) && isset($currentParams[$k])) {
                unset($currentParams[$k]);
                continue;
            }
            $currentParams[$k] = $v;
        }
        if (empty($currentParams)) {
            return $url;
        }
        foreach ($currentParams as $k => $v) {
            $currentParams[$k] = "{$k}={$v}";
        }
        return $url . '?' . implode('&', $currentParams);
    }
}