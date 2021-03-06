<?php

namespace Pendragon\Framework;

use Accolon\Route\AppRouter;
use Pendragon\Framework\Exceptions\PendragonException;
use Accolon\Izanami\Exceptions\FailQueryException;
use Accolon\Route\Request;

class Router extends AppRouter
{
    public function runMiddlewares(Request $request)
    {
        try {
            return parent::runMiddlewares($request);
        } catch (FailQueryException $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 404);
        } catch (PendragonException $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], $e->getCode());
        }
    }
}
