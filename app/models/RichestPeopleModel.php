<?php   
/**
 * Dit is de model van de controller
 */

class RichestPeopleModel
{
    //properties
    private $db;
    // Dit is een contsructor van de country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getRichestPeople()
    {
        $this->db->query('SELECT * FROM richestpeople');
        return $this->db->resultSet();
    }

    public function getSingleCountry($id)
    {
        $this->db->query('SELECT * FROM richestpeople WHERE id = :id');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateCountry($post)
    {
        $this->db->query("UPDATE richestpeople
                            SET MyName = :myname,
                                Networth = :Networth,
                                Age = :age,
                                Company = :company
                            WHERE id = :id");

        $this->db->bind(':id', $post['id'], PDO::PARAM_INT);
        $this->db->bind(':myname', $post['myname'], PDO::PARAM_STR);
        $this->db->bind(':networth', $post['networth'], PDO::PARAM_STR);
        $this->db->bind(':age', $post['age'], PDO::PARAM_STR);
        $this->db->bind(':company', $post['company'], PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function deleteCountry($id) {
        $this->db->query("DELETE FROM richestpeople WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function createCountry($post) {
        $this->db->query("INSERT INTO richestpeople (id, MyName, Networth, Age, Company) 
                          VALUES (:myname, :networth, :age, :company)");
    
        $this->db->bind(':id', NULL, PDO::PARAM_INT);
        $this->db->bind(':name', $post['name'], PDO::PARAM_STR);
        $this->db->bind(':capitalcity', $post['capitalcity'], PDO::PARAM_STR);
        $this->db->bind(':continent', $post['continent'], PDO::PARAM_STR);
        $this->db->bind(':population', $post['population'], PDO::PARAM_INT); 

        return $this->db->execute();
    }
}




?>