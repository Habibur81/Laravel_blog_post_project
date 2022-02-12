<?php

    namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class deleteAdminScope implements Scope
    {

        public function apply( Builder $builder, Model $model )
        {
            if( Auth::check() && Auth::user()->is_admin ){

                $builder->withTrashed();
                // $builder->withoutGlobalScope('Illuminate\Database\Eloquent\SoftDeletingScope');
                //softdelete locaton setup kore o same kaj kora jai seta dekhano hoyeche
            }
        }

    }//global query scope for admin show the delete post
