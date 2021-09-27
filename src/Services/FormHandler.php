<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class FormHandler
{
	private $em;
	public function __construct(EntityManagerInterface $em){
		$this->em = $em;
	}
	
	public function handleForm($form, $entity)
	{
		$entity = $form->getData();
		$this->em->persist($entity);
		$this->em->flush();
	}
}