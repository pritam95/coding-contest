<?php
   class First extends CI_Controller
    {

       //public $userid;
       public function firstPage()
        {
         // echo file_get_contents("test.c");
          $qstn=file_get_contents("test.c");
          $this->load->view("instruction.php",array("qstn"=>$qstn));
        }
      public function saveFile()
      {
        //echo $_POST['qstn'];
        //file_put_contents('test.c',$_FILES['program']['name']);
        $config['upload_path']='./uploads';
       // $config['allowed_types']='jpg|txt|text/plain|doc|text/x-csrc';
        $this->load->library('upload',$config);
      
      /* if( $this->upload->do_upload("program"))
         {
         $this->load->view("sucess.php");
         }
      else
        {
          $error = array('error' => $this->upload->display_errors());
          $this->load->view("error.html", $error);

        }*/
       /*  // $newfile = tmpfile();
      // fwrite($_FILES['program'],'test.c');
        $newfile=$_FILES['program'];
        $var_str = var_export($newfile, true);*/
     //  file_put_contents('test.c',fopen('$_FILES['program']['name']','r'));
       //copy($newfile,'test.c');
     //  echo "cd uploads && cp ". $_FILES['program']['name'] ." test.c ";
     
       /* */
        $prgmMime=$_FILES['program']['type'];//MIME type of uploaded file
        $prgmName=$_FILES['program']['name'];//uploaded file name
        //echo '<script type="text/javascript">alert("'.$prgmName.'")</script>';
        $prgmExtension = pathinfo($prgmName, PATHINFO_EXTENSION);//extension of uploaded file
        $this->load->helper('cookie');
        $correct=0;
        if($prgmExtension=="c")
        { 
           //echo "USER iD:".$_COOKIE["user"];
           shell_exec("cd users && cd ".$_COOKIE['user']." && cd questions && cd ".$_POST['qstn']." && cat ".$_FILES['program']['tmp_name']." > test.c");
           shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && gcc test.c');
           //shell_exec('cd questions && cd '.$_POST['qstn'].' && gcc '.$_FILES['program']['tmp_name']);
           for($i=1;$i<=5;$i++)
           {
              shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && ./a.out < input'.$i.' > generatedoutput');
              if(shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && diff -q output'.$i.' generatedoutput'))
              {}
              else
              {
                $correct=$correct+1;
              }
           }
           echo "<script type='text/javascript'>alert('Filetype:".$prgmExtension."...Correct:".$correct." Out of 5')</script>";
           $lastValue=0;
           session_start();
          if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']]))
           {
           $lastValue=$_SESSION[$_COOKIE["user"].$_POST['qstn']];
           }
          if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']]))
           {
             if($correct > $_SESSION[$_COOKIE["user"].$_POST['qstn']])
             {
             $_SESSION[$_COOKIE["user"].$_POST['qstn']]=$correct;
             }
           }
           else
           {
             $_SESSION[$_COOKIE["user"].$_POST['qstn']]=$correct;
           }
     //   echo "old Cookie value:".$_COOKIE[$_POST['qstn']];
       //    setcookie($_POST['qstn'],$correct,time() + (86400 * 30),'/');
        //  echo "New cookie value For ".$_POST['qstn'].":".$_SESSION[$_COOKIE["user"].$_POST['qstn']];echo "lastvalue:".$lastValue;
           if($lastValue<=$_SESSION[$_COOKIE["user"].$_POST['qstn']])
           {
          $this->load->model("ContestModel","ContestModel",TRUE);
           $this->ContestModel->insertScore($_SESSION[$_COOKIE["user"].$_POST['qstn']]-$lastValue,$_COOKIE["user"]);
           }
           if($correct==5)
           {
            if( $this->upload->do_upload("program"))
            {
             // $this->load->view("sucess.php");//if output is correct then upload otherwise not
             $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
              $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));
              echo "<script type='text/javascript'>alert('SUCCESFULLY UPLOADED.....')</script>";
            }
           }
           else
           {
              $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
              $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));
           }
        }
        elseif($prgmExtension=="cpp")
        {
           shell_exec("cd users && cd ".$_COOKIE['user']." && cd questions && cd ".$_POST['qstn']." && cat ".$_FILES['program']['tmp_name']." > test.cpp");
           shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && g++ test.cpp');
           for($i=1;$i<=5;$i++)
           {
           shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && ./a.out < input'.$i.' > generatedoutput');
          
          if(shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && diff -q output'.$i.' generatedoutput'))
          {}
          else
          {
            $correct=$correct+1;
          }
          }
         echo "<script type='text/javascript'>alert('Filetype:".$prgmExtension."...Correct:".$correct." Out of 5')</script>";
            $lastValue=0;session_start();
          if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']]))
           {
           $lastValue=$_SESSION[$_COOKIE["user"].$_POST['qstn']];
           }
          if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']]))
           {
             if($correct > $_SESSION[$_COOKIE["user"].$_POST['qstn']])
             {
             $_SESSION[$_COOKIE["user"].$_POST['qstn']]=$correct;
             }
           }
           else
           {
             $_SESSION[$_COOKIE["user"].$_POST['qstn']]=$correct;
           }
     //   echo "old Cookie value:".$_COOKIE[$_POST['qstn']];
       //    setcookie($_POST['qstn'],$correct,time() + (86400 * 30),'/');
         // echo "New cookie value For ".$_POST['qstn'].":".$_SESSION[$_COOKIE["user"].$_POST['qstn']];echo "lastvalue:".$lastValue;
           if($lastValue<=$_SESSION[$_COOKIE["user"].$_POST['qstn']])
           {
          $this->load->model("ContestModel","ContestModel",TRUE);
           $this->ContestModel->insertScore($_SESSION[$_COOKIE["user"].$_POST['qstn']]-$lastValue,$_COOKIE["user"]);
           }
        if($correct==5)
          {
            if( $this->upload->do_upload("program"))
            {
             // $this->load->view("sucess.php");//if output is correct then upload otherwise not
             $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
              $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));
              echo "<script type='text/javascript'>alert('SUCCESFULLY UPLOADED.....')</script>";
            }
          }
           else
           {
              $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
              $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));
           }
      }
        elseif($prgmExtension=="java")
        {
        //  echo file_get_contents($_FILES['program']['tmp_name']);
          /*echo pathinfo($_FILES['program']['name'], PATHINFO_FILENAME);
          shell_exec( "cd uploads && cat ".$_FILES['program']['tmp_name']." > test.java");
          shell_exec('cd$a=$this->db->query("SELECT score FROM details WHERE id=$id"); uploads && javac test.java');
          shell_exec('cd uploads && java  '.pathinfo($_FILES['program']['name'], PATHINFO_FILENAME).'  < input > generatedoutput');*/
          shell_exec("cd users && cd ".$_COOKIE['user']." && cd questions && cd ".$_POST['qstn']." && cat ".$_FILES['program']['tmp_name']." > test.java");
          shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && javac test.java');
          for($i=1;$i<=5;$i++)
          {
          shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && java  '.pathinfo($_FILES['program']['name'], PATHINFO_FILENAME).'  < input'.$i.' > generatedoutput');
          if(shell_exec('cd users && cd '.$_COOKIE["user"].' && cd questions && cd '.$_POST['qstn'].' && diff -q output'.$i.' generatedoutput'))
          {}
          else
          {
            $correct=$correct+1;
          }
          }
          echo "<script type='text/javascript'>alert('Filetype:".$prgmExtension."...Correct:".$correct." Out of 5')</script>";
             $lastValue=0;session_start();
          if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']]))
           {
           $lastValue= $_SESSION[$_COOKIE["user"].$_POST['qstn']];
           }
           if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']]))
           {
             if($correct > $_SESSION[$_COOKIE["user"].$_POST['qstn']])
             {
             $_SESSION[$_COOKIE["user"].$_POST['qstn']]=$correct;
             }
           }
           else
           {
             $_SESSION[$_COOKIE["user"].$_POST['qstn']]=$correct;
           }
         // echo "New cookie value For ".$_POST['qstn'].":".$_SESSION[$_COOKIE["user"].$_POST['qstn']];echo "lastvalue:".$lastValue;
           if($lastValue<=$_SESSION[$_COOKIE["user"].$_POST['qstn']])
           {
          $this->load->model("ContestModel","ContestModel",TRUE);
           $this->ContestModel->insertScore($_SESSION[$_COOKIE["user"].$_POST['qstn']]-$lastValue,$_COOKIE["user"]);
           }
          if($correct==5)
          {
            if( $this->upload->do_upload("program"))
            {
             // $this->load->view("sucess.php");//if output is correct then upload otherwise not
             $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
              $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));
              echo "<script type='text/javascript'>alert('SUCCESFULLY UPLOADED.......')</script>";
            }
          }
           else
           {
              $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
              $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));
           }
       }
       else
      {
               // echo '<script type="text/javascript">alert("'.$prgmExtension.'")</script>';
               // $this->upload->do_upload("program");
       echo '<script type="text/javascript">alert("NOT SUPPORTED FORMAT")</script>';
        $qstnd=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn"); 
        $this->load->view("upload.php",array("qstn"=>$qstnd,"qstnname"=>$_POST['qstn']));//echo "USER iD:".$_COOKIE["user"];
        
      }
       /* if(shell_exec('cd uploads && diff -q output generatedoutput'))
        {
          $this->load->view("error.html");
        }
        else
        {
          $this->load->view("output.php");
        }*/
      }
      public function registrationForm()
      {
        $this->load->view("registration.php");
      }
      public function doRegistration()
      {
        if($_POST['name']!=NULL && $_POST['email']!=NULL && $_POST['phone']!=NULL && $_POST['collage']!=NULL && is_numeric($_POST['phone']))
        {
          $this->load->model("ContestModel","ContestModel",TRUE);
          $ans=$this->ContestModel->insertDetails($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['collage']);
          if(is_null($ans))
            {
                echo "<script type='text/javascript'>alert('REGISTRATION FAILED.......')</script>";
                $this->load->view("registration.php");
            }
            else
            {
              $id=$ans[0]->ID;
              shell_exec("cd users && mkdir ".$id);
              shell_exec("chmod 777 -R users/ ".$id);
              shell_exec("cp -R questions users/".$id);
              shell_exec("chmod 777 -R users/ ".$id);
              echo "<script type='text/javascript'>alert('REGISTRATION DONE.......')</script>";
              $this->load->view("login.php");
            }
        }
        else
        {
           echo"<script type='text/javascript'>alert('NULL ENTRY OR NON NUMERIC PHONE NO')</script>";
           $this->load->helper('url');
           redirect('First/registrationForm','refresh');
        }
      }
      public function loginForm()
      {
        $this->load->view("login.php");
      }
      public function login()
      {
        if($_POST['phone']!=NULL && is_numeric($_POST['phone']))
        {
        $this->load->model("ContestModel","ContestModel",TRUE);
        $a=$this->ContestModel->checkLogin($_POST['phone']);//echo $a[0]->name."dad".$a[0]->id;
        $name=$a[0]->name;$id=$a[0]->id;
      //  session_start();
      //  echo gettype(convert_number_to_words($id));
      //  $_SESSION[$name]=$id;
   // echo "sd".$_SESSION[$name];//echo $userid;
     
      $this->load->view("instruction.php",array("a"=>$a));
        }
       else
       {
         echo "<script type='text/javascript'>alert('NULL OR NON NUMERIC ENTRY');</script>";
         $this->load->helper('url');
         redirect('First/loginForm','refresh');
       }
      }
      public function showQstn()
      {
        //echo "cd questions && cd ".$_POST['qstn']." && cat qstn ";
        $qstn=shell_exec("cd questions && cd ".$_POST['qstn']." && cat qstn");
        $this->load->view("upload.php",array("qstn"=>$qstn,"qstnname"=>$_POST['qstn']));
      
      }
      public function logOut()
      {
        session_start();
        session_unset();
        setcookie("user","",time()-3600,'/');
        echo "<script type='text/javascript'>alert('Sucessfully Logedout.........')</script>";
        $this->load->view("login.php");
      }
      public function scoreBoard()
      {
        $this->load->model("ContestModel","ContestModel",TRUE);
        $ans=$this->ContestModel->allData();
        $this->load->view("scoreboard.php",array("ans"=>$ans));
      } 
    }
?>