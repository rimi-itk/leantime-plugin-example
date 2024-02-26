<?php

namespace Leantime\Plugins\Itk\Controllers;

use Leantime\Core\Controller;
use Leantime\Core\IncomingRequest;
use Leantime\Core\Language;
use Leantime\Core\Template;
use Leantime\Domain\Tickets\Services\Tickets as TicketService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class Todos extends Controller {
    public function __construct(
        private readonly TicketService $ticketsService,
        IncomingRequest $incomingRequest,
        Template $tpl,
        Language $language
    ) {
        parent::__construct($incomingRequest,$tpl,$language);
    }
    public function get(array $params) : Response {
        /**
         * GET: /itk/todos
         */
        if (isset($params['id'])) {
            $ticket = $this->ticketsService->getTicket($params['id']);
            if ($ticket) {
                return new JsonResponse($ticket);
            }
            // @TODO How to throw a not found exception?
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }

        $userId = $_SESSION['userdata']["id"] ?? '';
        $criteria = [
            'currentUser' => $userId
        ];
        // $criteria = $this->ticketsService->prepareTicketSearchArray($criteria);
        // $tickets = $this->ticketsService->getAll($criteria);
        $tickets = $this->ticketsService->getAllOpenUserTickets($userId);

        return new JsonResponse($tickets);
    }
}
