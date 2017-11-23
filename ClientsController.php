<?php
// src/AppBundle/Controller/ClientsController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientsController extends Controller
{

    private $titles = ['mr','ms','mrs','master'];
    
    private $client_data = [
        ['id' => 0,
         'title' => 'mr',
         'name' => 'Kaviyarasan',
         'last_name' => 'S',
         'address' => 'New Colony',
         'zipcode' => '600015',
         'city' => 'Chennai',
         'state' => 'Tamilnadu',
         'email' => 'kaviyarasans14@gmail.com'],
         ['id' => 1,
         'title' => 'mr',
         'name' => 'Sathish',
         'last_name' => 'M',
         'address' => 'Old Colony',
         'zipcode' => '600044',
         'city' => 'Chennai',
         'state' => 'Tamilnadu',
         'email' => 'sathis.personalis@gmail.com'],
         ['id' => 2,
         'title' => 'ms',
         'name' => 'Priya',
         'last_name' => 'S',
         'zipcode' => '600014',
         'city' => 'Chennai',
         'state' => 'Tamilnadu',
         'address' => '1st main Road,New Colony',
         'email' => 'priya1998@gmail.com'],
         ['id' => 3,
         'title' => 'ms',
         'name' => 'Madhu',
         'last_name' => 'S',
         'zipcode' => '600018',
         'city' => 'Chennai',
         'state' => 'Tamilnadu',
         'address' => '2nd Main Road',
         'email' => 'madhu@dacamsys.com']
    ];

    /**
     * @Route("guests",name="index_clients")
     */
    public function showIndex()
    {
        $data = [];
        $data["customer"] = $this->client_data;
        return $this->render('clients/index.html.twig',$data);
                                
    }

    /**
     * @Route("guests/modify/{id_client}",name="modify_clients")
     */
    public function showDetails(Request $request,$id_client)
    {

        $data = []; 
        $data["customer"] = $this->client_data;
        $data["titles"] = $this->titles;
        $data["mode"] = "modify";
        $data["form"] = [];
        

        $form = $this -> createFormBuilder()
                      -> add ('name')
                      -> add ('title')
                      -> add ('last_name')
                      -> add ('address')
                      -> add ('city')
                      -> add ('state')
                      -> add ('zipcode')
                      -> add ('email')
                      -> getForm()
        ;

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $form_data = $form->getData();
            $data["form"] = $form_data; 
        } else {
            $client_data = $this->client_data[$id_client];
            $data["form"] = $client_data;
        }
        return $this->render('clients/form.html.twig',$data);

    }

    /**
     * @Route("guests/new_guest",name="new_clients")
     */
    public function showNew()
    {
        $data = [];
        $data["titles"] = $this->titles;
        $data["form"] = [];
        $data["mode"] = "new";
        $data["form"]['title'] = '';
        return $this->render('clients/form.html.twig',$data);
    }

}