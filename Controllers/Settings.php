<?php

namespace Leantime\Plugins\Example\Controllers;

use Faker\Factory;
use Leantime\Core\Controller;
use Leantime\Core\Frontcontroller;
use Leantime\Domain\Auth\Models\Roles;
use Leantime\Domain\Auth\Services\Auth;
use Leantime\Plugins\TicketTemplate\Repository\TicketTemplateRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Settings Controller for Example plugin
 *
 * @package    leantime
 * @subpackage plugins
 */
class Settings extends Controller
{
    public const NO_DEFAULT_TRANSLATION_KEY = 'tickettemplate.settings.no_default';

    /**
     * Get method.
     *
     * @return Response
     */
    public function get(): Response
    {
        $faker = Factory::create();

        $this->tpl->assign('randomText', $faker->realText());

        return $this->tpl->display('example.settings');
    }

    /**
     * Post method.
     *
     * @param array $params
     *
     * @return RedirectResponse
     */
    public function post(array $params): RedirectResponse
    {
        Auth::authOrRedirect([Roles::$owner, Roles::$admin], true);

        $ticketTemplateRepository = app()->make(TicketTemplateRepository::class);
        $projects = $ticketTemplateRepository->getAllAvailableProjects();

        // We should receive a param per project.
        // Also note that the default 'max_input_vars' is 1000,
        // hence this will fail if more than 1000 projects exists.
        if (count($projects) != count($params)) {
            $this->tpl->setNotification($this->language->__('tickettemplate.settings.failed_message'), 'error');
        } else {
            // Do the updating if change detected.
            foreach ($projects as $project) {
                $projectId = $project['projectId'];
                $compareValue = $params[$projectId] === self::NO_DEFAULT_TRANSLATION_KEY ? null : $params[$projectId];
                if ($project['templateId'] != $compareValue) {
                    $ticketTemplateRepository->handleTemplateProjectRelation($compareValue, $projectId);
                }
            }

            $this->tpl->setNotification($this->language->__('tickettemplate.settings.success_message'), 'success');
        }

        return Frontcontroller::redirect(BASE_URL . '/TicketTemplate/settings');
    }
}
