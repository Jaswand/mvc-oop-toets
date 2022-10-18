<?php

class RichestPeopleModel extends Controller
{
    //properties
    private $RichestPeople;

    // Dit is de contructor van de controller
    public function __construct()
    {
        // Dit is de model van de controller
        $this->RichestPeople = $this->model('RichestPeople');
    }


    public function index($land = 'Nederland', $age = 21)
    {
        $records = $this->countryModel->getRichestPeople();

        $rows = '';

        foreach ($records as $items)
        {
            $rows .= "<tr>
                        <td>$items->id</td>
                        <td>$items->Naam</td>
                        <td>$items->Vermogen</td>
                        <td>$items->Leeftijd</td>
                        <td>$items->Bedrijf</td>
                        <td><a href='" . URLROOT . "/RichestPeople/delete/$items->id'>Delete</a></td>
                       </tr>"; 
        }
        
        // var_dump($records);
        $data = [
            'title' => 'Overzicht van alle landen',
            'rows' => $rows
        ];

        $this->view('RichestPeople/index', $data);

    }

    public function update($id = null){
        // var_dump($id);exit();
        //var_dump($_SERVER);exit();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->countryModel->updateCountry($_POST);
        header("Location: " . URLROOT . "/RichestPeopleModel/index");
        } else {
            $row = $this->countryModel->getSingleCountry($id);
            $data = [
                'title' => '<h1>Update land</h1>',	
                'row' => $row
            ];
            $this->view("RichestPeopleModel/update", $data);
        }
        
    }

    public function delete($id){
        //echo $id;exit();
        $this->countryModel->deleteCountry($id);
        $data =[
            'deleteStatus' => "Record is met succesvol verwijderd"

        ];
        $this->view("RichestPeopleModel/delete", $data); 
        header("Refresh:2; url=" . URLROOT . "/countries/index");
        } 

    public function create() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
           // var_dump($_POST);
           try {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $this->countryModel->createCountry($_POST);
             header("Location: " . URLROOT . "/RichestPeopleModel/index");
           } catch (PDOException $e) {
             echo "Het inserten van een record is niet gelukt.";
             header("Refresh:3; url=" . URLROOT . "/countries/index");
           }

        

        } else {
        $data = [
            'title' => 'Voeg een nieuw land toe'
        ];
            $this->view('RichestPeopleModel/create', $data);
        }
    }
    

    public function test()
    {
        $data = [
            'title' => 'Ik ben slimmer dan Euer',
        ];
        $this->view('RichestPeopleModel/test', $data);
    }
}