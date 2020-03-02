<?php


namespace App\Controller\NewDriverController;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class NewDriverController extends AbstractController
{
    /**
     * @Route("/newDriver", name="new_driver")
     * @param Request $request
     * @return void
     */
    public function newDriver(Request $request)
    {
        $uploadedFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename =  $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
        $obj = dd($uploadedFile->move(
            $destination,
            $newFilename
        ));
        return $obj;
    }
}