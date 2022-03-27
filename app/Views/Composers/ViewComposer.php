<?php


namespace App\Views\Composers;


use App\Models\Kategori;
use Illuminate\View\View;

class ViewComposer
{
    public function compose(View $view)
    {
        $categories = Kategori::withoutPedagang()->get();

        $view->with('categories', $categories);
    }
}
