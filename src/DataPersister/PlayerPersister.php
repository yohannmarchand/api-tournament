<?php 


namespace App\DataPersister;

use App\Entity\Player;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;


class PlayerPersister implements DataPersisterInterface
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function supports($data):bool
    {
        return $data instanceof Player;
    }

    public function persist($data)
    {
        $slugify = new Slugify();   
        $data->setSlug($slugify->slugify($data->getName()));

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
