<?php

namespace App\Forms;

use App\Gender;
use App\SecretQuestion;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {	
		$genders=array();
		foreach(Gender::all() as $gender)
		$genders[$gender->id]=$gender->gender;
		
		$secretQuestions=array();
		foreach(SecretQuestion::all() as $question)
		$secretQuestions[$question->id]=$question->text;
		
        $this
            ->add('username', 'text',['rules'=>'required|min:3|max:45'])
            ->add('password', 'repeated',['type' => 'password',
                'first_options' => ['rules'=>['required','min:8','max:45','regex:/^[A-Z][A-Za-z0-9@#$%^&+=]+$/','same:password_confirmation']],
                'second_options' => ['rules'=>'required|min:8|max:45'], ])
            ->add('email','text',['rules'=>'required|email|max:45'])
            ->add('secret_question' , 'select',['choices'=>$secretQuestions,'selected'=>1,'empty_value'=>'Select Secret Question'])
            ->add('secret_answer','text',['rules'=>'required|min:3|max:50'])
            ->add('date_of_birth','date',['rules'=>'required'])
            ->add('gender','select',['choices'=>$genders,'selected'=>1,'empty_value' => 'Select Gender','rules'=>'required'])
            ->add('picture','file',['rules'=>'image'])
            ->add('submit', 'submit', ['label' => 'Create User'])
            ->add('clear', 'reset', ['label' => 'Clear']);
    }
}
