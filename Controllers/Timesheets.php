<?php

namespace Leantime\Plugins\Itk\Controllers;

use Leantime\Core\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class Timesheets extends Controller
{
    public function get(array $params): Response
    {
        /**
         * GET: /itk/timesheets/hest/a/b?name=Mikkel&number=87
         * ==>
         * $params: [
         *   'act' => 'itk.timesheets',
         *   'id' => 'hest',
         *   'request_parts' => 'a.b',
         *   'name' => 'Mikkel',
         *   'number' => '87',
         * ]
         *
         * @see \Leantime\Core\Frontcontroller::executeAction().
         */
        return new JsonResponse([__METHOD__, __FILE__, $params]);
    }
}
