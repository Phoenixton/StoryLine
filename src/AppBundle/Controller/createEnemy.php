<?php    
    public function createEnemies(Request $request){
          $enemy1 = new enemy;
          $enemy1->setName("gnome");
          $enemy1->setHp(6);
          $enemy1->setAttack(10);
          $enemy1->setDefense(6);
          $enemy1->setReward(1);

          $enemy2 = new Enemy;
          $enemy2->setName("bat");
          $enemy2->setHp(14);
          $enemy2->setAttack(17);
          $enemy2->setDefense(2);
          $enemy2->setReward(2);
          
          $enemy3 = new Enemy;
          $enemy3->setName("orc");
          $enemy3->setHp(22);
          $enemy3->setAttack(21);
          $enemy3->setDefense(5);
          $enemy3->setReward(3);


          $enemy4 = new Enemy;
          $enemy4->setName("goblin");
          $enemy4->setHp(17);
          $enemy4->setAttack(20);
          $enemy4->setDefense(3);
          $enemy4->setReward(4);
          
          $enemy5 = new Enemy;
          $enemy5->setName("werewolf");
          $enemy5->setHp(34);
          $enemy5->setAttack(36);
          $enemy5->setDefense(10);
          $enemy5->setReward(5);

          $enemy6 = new Enemy;
          $enemy6->setName("skeleton");
          $enemy6->setHp(17);
          $enemy6->setAttack(21);
          $enemy6->setDefense(8);
          $enemy6->setReward(6);

          $enemy7 = new Enemy;
          $enemy7->setName("ghost");
          $enemy7->setHp(50);
          $enemy7->setAttack(20);
          $enemy7->setDefense(8);
          $enemy7->setReward(7);

          $enemy8 = new Enemy;
          $enemy8->setName("ghoule");
          $enemy8->setHp(60);
          $enemy8->setAttack(29);
          $enemy8->setDefense(5);
          $enemy8->setReward(8);          
          
          $em = $this->getDoctrine()->getManager();
          $em->persist($enemy1);
          $em->flush();
          $em->persist($enemy2);
          $em->flush();
          $em->persist($enemy3);
          $em->flush();
          $em->persist($enemy4);
          $em->flush();
          $em->persist($enemy5);
          $em->flush();
          $em->persist($enemy6);
          $em->flush();
          $em->persist($enemy7);
          $em->flush();
          $em->persist($enemy8);
          $em->flush();
}
