<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Eloquent;

use App\Domain\Shared\Criteria\Criteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class EloquentCriteriaConverter
{
    public static function convert(Criteria $criteria, Model $model): Builder
    {
        // return $qb = DB::connection($model->getConnectionName())->table($model->getTable());

        $users = DB::table('users')
            ->select('id', 'email')
            ->get();
dd($users);
        // dd($model->getTable());
//        if (null !== $criteria->limit()) {
//            $model->take($criteria->limit());
//        }

        // if (null !== $criteria->offset()) {
        //     $model->skip($criteria->offset());
        // }

        // return $model->take(null)->skip($criteria->offset());

        // TODO create an infrastructure class to convert criteria to eloquent query
        /*if (
            count($criteria->filters()) > 0 or
            false === $criteria->order()->isNone() or
            null !== $criteria->offset() or
            null !== $criteria->limit()
        ) {
            $order = $criteria->order();

            if ($order->orderType()->value() === 'none') {
                $eloquentUsers = $this->model
                    ->take($criteria->limit())
                    ->skip($criteria->offset())
                    ->get();
            } else {
                $eloquentUsers = $this->model
                    ->orderBy(
                        $order->orderBy()->value(),
                        $order->orderType()->value()
                    )
                    ->take($criteria->limit())
                    ->skip($criteria->offset())
                    ->get();
            }

        } else {
            $eloquentUsers = $this->model->all();
        }*/
    }
}
