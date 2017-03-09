<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item as FractalItem;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function transform($data, $transformer)
    {

        $fractal = new Manager();
        if ($data instanceof Collection) {
            $resource = new FractalCollection($data, $transformer);
        } else {
            $resource = new FractalItem($data, $transformer);
        }

        return $fractal->createData($resource)->toArray();


    }
}
