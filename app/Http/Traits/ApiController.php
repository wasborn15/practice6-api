<?php
namespace App\Http\Traits;

use Illuminate\Support\Str;

/**
 * Trait ApiController
 *
 * APIコントローラーで使用するメソッドをまとめたトレイト
 *
 * @package App\Traits
 */
trait ApiController
{
    /**
     * 配列のキーを再帰的にキャメルケースに変更する
     *
     * @param $array
     * @return array
     */
    protected function camelizeRecursive($array): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results[Str::camel($key)] = $this->camelizeRecursive($value);
            } else {
                $results[Str::camel($key)] = $value;
            }
        }
        return $results;
    }

    /**
     * 配列のキーを再帰的にスネークケースに変更する
     *
     * @param $array
     * @return array
     */
    protected function underscoreRecursive($array): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results[Str::snake($key)] = $this->underscoreRecursive($value);
            } else {
                $results[Str::snake($key)] = $value;
            }
        }
        return $results;
    }
}
