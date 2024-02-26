<?php

namespace Leantime\Plugins\Itk\Controllers;

use Leantime\Core\Controller;
use Leantime\Core\IncomingRequest;
use Leantime\Core\Language;
use Leantime\Core\Template;
use Leantime\Domain\Tickets\Services\Tickets as TicketService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class Tickets extends Controller
{
    public function __construct(
        private readonly TicketService $ticketsService,
        IncomingRequest $incomingRequest,
        Template $tpl,
        Language $language
    ) {
        parent::__construct($incomingRequest, $tpl, $language);
    }

    public function get(array $params): Response
    {
        /**
         * GET: /itk/todos
         */
        if (isset($params['id'])) {
            $ticket = $this->ticketsService->getTicket($params['id']);
            if ($ticket) {
                $this->tpl->assign('ticket', $ticket);
                return $this->tpl->display('itk.ticket');
            }
        }

        $userId = $_SESSION['userdata']["id"] ?? '';
        $criteria = [
            'currentUser' => $userId,
        ];
        // $criteria = $this->ticketsService->prepareTicketSearchArray($criteria);
        // $tickets = $this->ticketsService->getAll($criteria);
        $tickets = $this->ticketsService->getAllOpenUserTickets($userId);

        $this->tpl->assign('tickets', $tickets);
        return $this->tpl->display('itk.tickets');
    }
}
