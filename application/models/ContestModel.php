<?php
    class ContestModel extends CI_MODEL
    {
        public $id;
        public $name;
        public $email;
        public $phone;
        public $collage;
        public function insertDetails($name,$email,$phone,$collage)
        {
            $this->name=$name;
            $this->email=$email;
            $this->phone=$phone;
            $this->collage=$collage;
            $this->db->insert("details",array
            (
                "name"=>$this->name,
                "email"=>$this->email,
                "phone"=>$this->phone,
                "collage"=>$this->collage
            ));
            $a=$this->db->query("SELECT MAX(id) 'ID' FROM details");
            $b=$a->result();
            return $b;
            //$this->load->helper('url');
            //redirect('First/registrationForm','refresh');

        }
        public function checkLogin($phone)
        {    
             $this->phone=$phone;
             $a=$this->db->query("SELECT name,id FROM details WHERE phone=$this->phone");
             $b=$a->result();
             if($b)
             {
                 echo  "<script type='text/javascript'>alert('WELCOME:". $b[0]->name."')</script>"; 
                 $this->load->helper('cookie');  
                 setcookie("user",$b[0]->id,time() + (86400 * 30),'/');// echo "<script type='text/javascript'>alert('cok".$_COOKIE['user']."cok')</script>)";
                 return $b;
             }
             else
             {
                 echo "<script type='text/javascript'>alert('NOT REGISTERED.REGISTER FIRST.............');</script>";
                 $this->load->helper('url');
                 redirect('First/registrationForm','refresh');
             }

        }
        public function insertScore($score,$id)
        {
            $a=$this->db->query("SELECT score FROM details WHERE id=$id");
            $b=$a->result();
            $lastscore=$b[0]->score;
            $this->db->query("UPDATE details SET score=$lastscore+$score WHERE id=$id");
            
        }
        public function allData()
        {
            $query=$this->db->query("SELECT * FROM details ORDER BY score desc");
            $result=$query->result();
            return $result;
        }
    }