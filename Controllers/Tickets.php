<?php

namespace Leantime\Plugins\Example\Controllers;

use Leantime\Core\Controller;
use Leantime\Core\IncomingRequest;
use Leantime\Core\Language;
use Leantime\Core\Template;
use Leantime\Domain\Tickets\Services\Tickets as TicketService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Example tickets controller.
 */
final class Tickets extends Controller
{
    /**
     * Constructor.
     */
    public function __construct(
        private readonly TicketService $ticketsService,
        IncomingRequest $incomingRequest,
        Template $tpl,
        Language $language
    ) {
        parent::__construct($incomingRequest, $tpl, $language);
    }

    /**
     * GET: /example/tickets/hest/a/b?name=Mikkel&number=87
     * ==>
     * $params: [
     *   'act' => 'example.tickets',
     *   'id' => 'hest',
     *   'request_parts' => 'a.b',
     *   'name' => 'Mikkel',
     *   'number' => '87',
     * ]
     *
     * @see \Leantime\Core\Frontcontroller::executeAction().
     *
     * @return Response
     */
    public function get(array $params): Response
    {
        if (isset($params['id'])) {
            $ticket = $this->ticketsService->getTicket($params['id']);
            if ($ticket) {
                $this->tpl->assign('ticket', $ticket);
                return $this->tpl->display('example.ticket');
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
        return $this->tpl->display('example.tickets');
    }
}
