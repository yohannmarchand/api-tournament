<?php 


namespace App\DataPersister;

use App\Entity\Stage;
use App\Entity\Tournament;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class TournamentPersister implements DataPersisterInterface
{

    protected $em;
    protected $stageName = ["A","B","C","D" ,"E" ,"F" ,"G" ,"H" ,"I" ,"J" ,"K" ,"L" ,"M","N" ,"O" ,"P" ,"Q" ,"R" ,"S" ,"T","U" ,"V" ,"W" ,"X" ,"Y" ,"Z"];

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($data):bool
    {
        return $data instanceof Tournament;
    }

    public function persist($data)
    {
        if ($data->getType() == 'stage') {
            
            $nb_playerByStage = $data->getPlayers()->count() / $data->getNbPoule();

            for ($i=0; $i < $data->getNbPoule(); $i++) { 
                
                for ($j=0; $j <= $nb_playerByStage; $j++) { 
                
                    $stage = new Stage();
    
                    $stage
                        ->setPoint(0)
                        ->setTournament($data)
                        ->setPlayer($data->getPlayers()->get($i))
                        ->setGroups($this->stageName[$i]);

                    $this->em->persist($stage);
                    $this->em->flush();
                }
            }   
        }

        

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
    
}
