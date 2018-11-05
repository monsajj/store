<?php
/**
 * Created by PhpStorm.
 * User: monsajj
 * Date: 05.11.18
 * Time: 18:08
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class LocalesComposer
{
    public function compose(View $view)
    {
        $locales = array_diff(scandir(base_path() . '/resources/lang'), array('..', '.'));
        $view->with('locales', $locales);
    }
}
