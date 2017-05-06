<?php
  public function createObjects(Request $request){


    $obj1= new objects;
    $obj1->setName("gnome shield");
    $obj1->setDescription("A small wooden shield that helps to prevent the less powerful attacks.");
    $obj1->setAttackBonus(0);
    $obj1->setLifeBonus(0);
    $obj1->setDefenseBonus(2);

    $obj2= new objects;
    $obj2->setName("bat wing");
    $obj2->setDescription("Seems a bit hairy, but it seems that eating it makes you more vigorous.");
    $obj2->setAttackBonus(0);
    $obj2->setLifeBonus(3);
    $obj2->setDefenseBonus(0);

    $obj3= new objects;
    $obj3->setName("orc mace");
    $obj3->setDescription("A heavy mace that we would not like to take on our heads.");
    $obj3->setAttackBonus(4);
    $obj3->setLifeBonus(0);
    $obj3->setDefenseBonus(0);

    $obj4= new objects;
    $obj4->setName("goblin helmet");
    $obj4->setDescription("You look really ridiculous with this thing on your head, but it probably protects you from a few attacks.");
    $obj4->setAttackBonus(0);
    $obj4->setLifeBonus(0);
    $obj4->setDefenseBonus(4);

    $obj5= new objects;
    $obj5->setName("werewolf claws");
    $obj5->setDescription("Long claws that inflict more damage.");
    $obj5->setAttackBonus(7);
    $obj5->setLifeBonus(0);
    $obj5->setDefenseBonus(0);

    $obj6= new objects;
    $obj6->setName("skeleton bone");
    $obj6->setDescription("A piece of bone harvested on a dead skeleton, you can try to use it as a weapon");
    $obj6->setAttackBonus(5);
    $obj6->setLifeBonus(0);
    $obj6->setDefenseBonus(0);

    $obj7= new objects;
    $obj7->setName("ghost dress");
    $obj7->setDescription("A large white sheet that look surprisingly resistant, but it is not very discreet.");
    $obj7->setAttackBonus(0);
    $obj7->setLifeBonus(0);
    $obj7->setDefenseBonus(8);

    $obj8= new objects;
    $obj8->setName("ghoule heart");
    $obj8->setDescription("This thing stinks and drips with blood, but it seems to make you more powerful.");
    $obj8->setAttackBonus(2);
    $obj8->setLifeBonus(2);
    $obj8->setDefenseBonus(2);

    $em = $this->getDoctrine()->getManager();
    $em->persist($obj1);
    $em->flush();
    $em->persist($obj2);
    $em->flush();
    $em->persist($obj3);
    $em->flush();
    $em->persist($obj4);
    $em->flush();
    $em->persist($obj5);
    $em->flush();
    $em->persist($obj6);
    $em->flush();
    $em->persist($obj7);
    $em->flush();
    $em->persist($obj8);
    $em->flush();
    
}
