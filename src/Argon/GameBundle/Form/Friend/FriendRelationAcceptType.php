<?php

namespace Argon\GameBundle\Form\Friend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FriendRelationAcceptType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'intention'  => 'friendlist_relation_accept',
        ));
    }
}