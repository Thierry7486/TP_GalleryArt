<?php

namespace App\Controller\Admin\PieceArt;

use App\Entity\PieceOfArt;
use App\Form\PieceArtType;
use App\Services\FormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PieceArtAdminController extends AbstractController
{
	private $formHandler;

	public function __construct(FormHandler $formHandler){
		$this->formHandler = $formHandler;
	}

	public function listAction() {

		$pieceArts = $this->getDoctrine()->getRepository(PieceOfArt::class)->findAll();
		return $this->render('admin/pieceArt/list.html.twig', ['pieceArts'=>$pieceArts]);
	}

	public function newAction(Request $request) {
		$pieceArt = new PieceOfArt();
		$form = $this->createForm(PieceArtType::class, $pieceArt);

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
		$this->formHandler->handleForm($form, $pieceArt);
		return $this->redirectToRoute('dashboard_list_pieceArt');
		}
		return $this->render('admin/pieceArt/form.html.twig', ['pieceArt_form' => $form->createView()]);
	}

	public function updateAction($id, Request $request) {
		$pieceArt = $this->getDoctrine()->getRepository(PieceOfArt::class)->find($id);
		$form = $this->createForm(PieceArtType::class, $pieceArt);

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
		$this->formHandler->handleForm($form, $pieceArt);
		return $this->redirectToRoute('dashboard_list_pieceArt');
		}
		return $this->render('admin/pieceArt/form.html.twig', ['pieceArt_form' => $form->createView()]);

	}

	public function deleteAction($id) {
		$pieceArt = $this->getDoctrine()->getRepository(PieceOfArt::class)->find($id);
		$manager = $this->getDoctrine()->getManager();
		$manager->remove($pieceArt);
		$manager->flush();
		return $this->redirectToRoute('dashboard_list_pieceArt');
	}

}