<?php


namespace App\Controller\NewDriverController;


use App\Entity\Drivers;
use App\Entity\Team;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class NewDriverController extends AbstractController
{
    /**
     * @Route("/newDriver", name="new_driver")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Team $team
     * @return int|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function newDriver(Request $request, EntityManagerInterface $em, ValidatorInterface $val)
    {

        $uploadedFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename =  $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
        $violations = $val->validate(
            $uploadedFile,
            new File([
                'maxSize' => '99k'
                
            ])
        );

        if($violations->count()>0)
        {
            echo "Nieodpowiedni plik";
        }

        ($uploadedFile->move(
            $destination,
            $newFilename
        ));
        $team = $this->getDoctrine()->getRepository(Team::class)->findOneBy(['id'=>1]);
        $driver = new Drivers();
        $driver->setName("ww")
        ->setSurname($newFilename)
        ->setNationality("Poland")
        ->setNumber(3)
        ->setTeam($team);
        $em->persist($driver);
        $em->flush();

        return $this->redirect("http://localhost:8080");

    }
}