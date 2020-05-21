<?php 


namespace App\DataPersister;

use App\Entity\Match;
use App\Entity\Stage;
use App\Entity\Tournament;
use App\Repository\StageRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class TournamentPersister implements DataPersisterInterface
{

    protected $em;
    protected $stageName = ["A","B","C","D" ,"E" ,"F" ,"G" ,"H" ,"I" ,"J" ,"K" ,"L" ,"M","N" ,"O" ,"P" ,"Q" ,"R" ,"S" ,"T","U" ,"V" ,"W" ,"X" ,"Y" ,"Z"];

    public function __construct(EntityManagerInterface $em, StageRepository $stageRepository)
    {
        $this->em = $em;
        $this->stageRepository = $stageRepository;
    }

    public function supports($data):bool
    {
        return $data instanceof Tournament;
    }

    public function persist($data)
    {
        if ($data->getType() == 'stageMulti') {
            
            $nb_playerByStage = $data->getPlayers()->count() / $data->getNbPoule();

            for ($i=0; $i < $data->getNbPoule(); $i++) { 
                
                for ($j=0; $j < $nb_playerByStage; $j++) { 
                
                    $stage = new Stage();

                    $nbplayer =  bindec(decbin($i) . decbin($j)); 
                    $stage
                        ->setPoint(0)
                        ->setTournament($data)
                        ->setPlayer($data->getPlayers()->get($nbplayer))
                        ->setGroups($this->stageName[$i]);

                    $this->em->persist($stage);
                    $this->em->flush();
                


                }
            }  
            
            for ($i=0; $i < $data->getNbPoule(); $i++) { 
                
                $stage = $this->stageRepository->findBy(['groups' => $this->stageName[$i], 'tournament' => $data ]);

                

                for ($j=0; $j <$nb_playerByStage ; $j++) { 

                    $playerJ = $stage[$j]->getPlayer()->getId();
                    
                    for ($k=0; $k < $nb_playerByStage; $k++) { 

                        $playerK = $stage[$k]->getPlayer()->getId();

                        if ($playerJ != $playerK) {
                            $match = new Match();
                            $match
                                ->setPlayer1($playerK)
                                ->setPlayer2($playerJ)
                                ->setPoint1(0)
                                ->setPoint2(0)
                                ->setType("stage_match")
                                ->setTournament($data);

                                $this->em->persist($match);
                                $this->em->flush(); 
                        }  
                    }
                }
            }
            
        }

        

        // $this->em->persist($data);
        // $this->em->flush();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
    
}
