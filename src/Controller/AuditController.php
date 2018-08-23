<?php 

namespace App\Controller;

use App\Controller\AdminController as MyAdminController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Entity\AuditItem;
use App\Form\AuditItemType;

class AuditController extends MyAdminController
{
	protected function prePersistEntity($entity)
	{
		$entity->setStatut(0);

		parent::prePersistEntity($entity);

		//Génération de auditItems
		foreach($entity->getMagasin()->getRayonsMagasins() as $rayonsMagasin){
			foreach($rayonsMagasin->getZones() as $zone){
				foreach($zone->getItems() as $item){
					$auditItem = new AuditItem();
					$auditItem->setStatut(0);
					$auditItem->setAudit($entity);
					$auditItem->setItem($item);
					$auditItem->setZone($zone);
					$auditItem->setRayonsMagasin($rayonsMagasin);
					$this->em->persist($auditItem);
				}
			}
		}
		$this->em->flush();
	}

	/**
     * @Route(path = "/admin/audit/change_statut_item", name = "audit_change_statut_item")
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function changeStatutItemAction(Request $request) {
		if (!$request->isXmlHttpRequest()) {
            throw new HttpException(406);
        }

        $data = $request->request->all();
		$id = $data['id'];
		$statut = $data['statut'];

		$audit_item = $this->getDoctrine()->getRepository(AuditItem::class)->find($id);
		$audit_item->setStatut($statut);
		$this->getDoctrine()->getManager()->flush();

	    return new Response("ok");
	}

	/**
     * @Route(path = "/admin/audit/item_form", name = "audit_item_form")
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function getItemFormAction(Request $request) {
		if (!$request->isXmlHttpRequest()) {
            throw new HttpException(406);
        }

        $data = $request->request->all();
		$id = $data['id'];

		$audit_item = $this->getDoctrine()->getRepository(AuditItem::class)->find($id);
		$form = $this->createForm(AuditItemType::class, $audit_item);

	    //return new Response($form);
	    return $this->render('form/audit_item.html.twig', array(
	        'form' => $form->createView(),
	    ));
	}
}