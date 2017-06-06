<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CommentForm extends Form
{
    public function buildForm()
    {
        $this
        ->add('text','textarea',['rules'=>'required|max:200'])
        ->add('name','text',['rules'=>'required|max:45'])
        ->add('email','text',['rules'=>'email|max:45'])        
        ->add('submit', 'submit', ['label' => 'Create comment'])
        ->add('clear', 'reset', ['label' => 'Clear']);;
    }
}
