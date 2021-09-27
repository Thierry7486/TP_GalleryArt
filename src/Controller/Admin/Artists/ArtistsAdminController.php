<?php

namespace App\Controller\Admin\Artists;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Services\FormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArtistsAdminController extends AbstractController
{
	private $formHandler;

	public function __construct(FormHandler $formHandler){
		$this->formHandler = $formHandler;
	}

	public function listAction() {

		$artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();
		return $this->render('admin/artists/list.html.twig', ['artists'=>$artists]);
	}

	public function newAction(Request $request) {
		$artist = new Artist();
		$form = $this->createForm(ArtistType::class, $artist);

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
		$this->formHandler->handleForm($form, $artist);
		return $this->redirectToRoute('dashboard_list_artists');
		}
		return $this->render('admin/artists/form.html.twig', ['artist_form' => $form->createView()]);
	}

	public function updateAction($id, Request $request) {
		$artist = $this->getDoctrine()->getRepository(Artist::class)->find($id);
		$form = $this->createForm(ArtistType::class, $artist);

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
		$this->formHandler->handleForm($form, $artist);
		return $this->redirectToRoute('dashboard_list_artists');
		}
		return $this->render('admin/artists/form.html.twig', ['artist_form' => $form->createView()]);

	}

	public function deleteAction($id) {
		$artist = $this->getDoctrine()->getRepository(Artist::class)->find($id);
		$manager = $this->getDoctrine()->getManager();
		$manager->remove($artist);
		$manager->flush();
		return $this->redirectToRoute('dashboard_list_artists');
	}

}