<?php 

namespace App\Controller;

use App\Controller\AdminController as MyAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;


class AuditController extends MyAdminController
{
	protected function prePersistEntity($entity)
	{
		$entity->setStatut(0);
		parent::prePersistEntity($entity);
	}

	/**
     * @Route(path = "/admin/audit/ajax", name = "audit_ajax")
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function ajaxAction(/*$entity, $id,*/ Request $request) {
		if (!$request->isXmlHttpRequest()) {
            throw new HttpException(406);
        }

	    return new Response('ok');
	}
}