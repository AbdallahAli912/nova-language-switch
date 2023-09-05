<?php

namespace Badinansoft\LanguageSwitch\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

class LanguageController
{

    public function __invoke(string $lang): JsonResponse
    {
        $languages = config('nova-language-switch.supported-languages');
        if (array_key_exists($lang, $languages)) {
            $key = auth()->guard(config('nova.guard'))->id().'.locale';
            if(is_null(session('locale')))
            {
                session([$key => $lang]);
            }
            app()->setLocale(session($key));
        }
        return response()->json(['status' => 'success']);
    }

}
