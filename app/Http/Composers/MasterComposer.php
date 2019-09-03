<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Models\Habitat;


class MasterComposer {

    public function compose(View $view)
    {

        $habitat = Habitat::getLastHabitat(3);
        $result['habitat'] = $habitat;

        $view->with('global', $result);
    }

}
