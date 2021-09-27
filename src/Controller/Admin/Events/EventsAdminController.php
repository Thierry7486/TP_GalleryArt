<?php

namespace App\Controller\Admin\Events;

use App\Entity\Event;
use App\Form\EventType;
use App\Services\FormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EventsAdminController extends AbstractController
{
	private $formHandler;

	public function __construct(FormHandler $formHandler){
		$this->formHandler = $formHandler;
	}

	public function listAction() {

		$events = $this->getDoctrine()->getRepository(Event::class)->findAll();
		return $this->render('admin/events/list.html.twig', ['events'=>$events]);
	}

	public function newAction(Request $request) {
		$event = new Event();
		$form = $this->createForm(EventType::class, $event);

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
		$this->formHandler->handleForm($form, $event);
		return $this->redirectToRoute('dashboard_list_events');
		}
		return $this->render('admin/events/form.html.twig', ['event_form' => $form->createView()]);
	}

	public function updateAction($id, Request $request) {
		$event = $this->getDoctrine()->getRepository(Event::class)->find($id);
		$form = $this->createForm(EventType::class, $event);

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
		$this->formHandler->handleForm($form, $event);
		return $this->redirectToRoute('dashboard_list_events');
		}
		return $this->render('admin/events/form.html.twig', ['event_form' => $form->createView()]);

	}

	public function deleteAction($id) {
		$event = $this->getDoctrine()->getRepository(Event::class)->find($id);
		$manager = $this->getDoctrine()->getManager();
		$manager->remove($event);
		$manager->flush();
		return $this->redirectToRoute('dashboard_list_events');
	}

}