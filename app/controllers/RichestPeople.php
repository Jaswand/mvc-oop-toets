<?php

class RichestPeople extends Controller
{
    //properties
    private $RichestPeople;

    // Dit is de contructor van de controller
    public function __construct()
    {
        // Dit is de model van de controller
        $this->RichestPeople = $this->model('RichestPeopleModel');
    }


    public function index($land = 'Nederland', $age = 21)
    {
        $records = $this->RichestPeople->getRichestPeople();

        $rows = '';

        foreach ($records as $items)
        {
            $rows .= "<tr>
                        <td>$items->Id</td>
                        <td>$items->MyName</td>
                        <td>$items->Networth</td>
                        <td>$items->Age</td>
                        <td>$items->Company</td>
                        <td><a href='" . URLROOT . "/richestpeople/delete/$items->Id'>Delete</a></td>
                       </tr>"; 
        }
        
        // var_dump($records);
        $data = [
            'title' => 'De vijf rijkste mensen ter wereld',
            'rows' => $rows
        ];

        $this->view('richestpeople/index', $data);

    }

    public function update($id = null){
        // var_dump($id);exit();
        //var_dump($_SERVER);exit();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->countryModel->updateCountry($_POST);
        header("Location: " . URLROOT . "/richestpeople/index");
        } else {
            $row = $this->countryModel->getSingleCountry($id);
            $data = [
                'title' => '<h1>Update land</h1>',	
                'row' => $row
            ];
            $this->view("richestpeople/update", $data);
        }
        
    }

    public function delete($id){
        //echo $id;exit();
        $this->RichestPeople->deleteCountry($id);
        $data =[
            'deleteStatus' => "Record is met succesvol verwijderd"

        ];
        $this->view("richestpeople/delete", $data); 
        header("Refresh:2; url=" . URLROOT . "/richestpeople/index");
        } 

    public function create() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
           // var_dump($_POST);
           try {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $this->countryModel->createCountry($_POST);
             header("Location: " . URLROOT . "/richestpeople/index");
           } catch (PDOException $e) {
             echo "Het inserten van een record is niet gelukt.";
             header("Refresh:3; url=" . URLROOT . "/richestpeople/index");
           }

        

        } else {
        $data = [
            'title' => 'Voeg een nieuw land toe'
        ];
            $this->view('richestpeople/create', $data);
        }
    }
    

    public function test()
    {
        $data = [
            'title' => 'Ik ben slimmer dan Euer',
        ];
        $this->view('richestpeople/test', $data);
    }
}