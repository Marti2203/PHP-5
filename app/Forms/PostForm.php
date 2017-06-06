<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Tag;

class PostForm extends Form
{
    public function buildForm()
    {	
        $this
        ->add('title','text',['rules'=>'required|max:60'])
        ->add('text','textarea',['rules'=>'required|max:500'])
		->add('tags', 'collection', [
                'type' => 'text',
                'property' => 'name',
                'prototype' => true,            // Should prototype be generated. Default: true
                'prototype_name' => '__NAME__', // Value used for replacing when generating new elements from prototype, default: __NAME__
                'options' => [
					'rules'=>'max:45',
                    'label' => 'Tag',
                    'attr' => ['class' => 'tag']
                ]
            ])
        ->add('submit', 'submit', ['label' => 'Create Post'])
        ->add('clear', 'reset', ['label' => 'Clear']);
    }
}
