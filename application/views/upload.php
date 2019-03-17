<?php 
    $this->load->helper('cookie');
        //echo $_COOKIE["user"];
     if(session_status()==PHP_SESSION_ACTIVE)
        {
            //echo "active";
        }
     else
        {
            session_start();
        }
    if(!isset($_SESSION[$_COOKIE["user"]."time"]))
        {        
            $_SESSION[$_COOKIE["user"]."time"]=time()+3600;
        }
?>
<html>
   <head>
        <title></title>
        <link rel="stylesheet" href="../../static/CSS/inside1.css"/>
        <script type="text/javascript">
            // Update the count down every 1 second
            var x = setInterval(function() 
                {
                    // Find the distance between now an the count down date
                    var distance =parseInt(<?php 
                    echo $_SESSION[$_COOKIE["user"]."time"];?>)- Math.floor(Date.now() / 1000);
                    //alert( Math.floor(Date.now() / 1000));
                    // Time calculations for days, hours, minutes and seconds
                    var hours = Math.floor(distance/3600);
                    var minutes = Math.floor((distance-hours*3600)/60);
                    var seconds = Math.floor(distance-hours*3600-minutes*60);
                    // Display the result in the element with id="demo"
                    document.getElementById("timer").innerHTML =hours+"h "+minutes+"m "+seconds+"s ";
                    // If the count down is finished, write some text 
                    if(parseInt(distance) < 0) 
                        {
                            clearInterval(x);
                            document.getElementById("timer").innerHTML="TIMEOUT";
                            document.getElementById("logout").submit(); // Submitting form
                        }
                }, 1000);
        </script>
    </head>
    <body>
        <div class="topbardiv">
            <center><?php echo $qstnname?></center>    
        </div>
        <div class="verticaldiv"></div>
        <div class="qstnsdiv">
        <center><h2>PROBLEMS</h2></center>
        <ul>
            <li>
                <form action="showQstn" method="POST">
                    <input class="qstnbarinput" type="submit" name="qstn" value="Array"/>
                </form>
            </li>
            <li>
                <form action="showQstn" method="POST">
                    <input class="qstnbarinput" type="submit" name="qstn" value="FindDigit"/>
                </form>
            </li>
        </ul>
        <center>
        <form action="scoreBoard" method="POST">
            <input class="qstnbarinput" type="submit" value="SCOREBOARD"/>
        </form>
        <form action="logOut"  id="logout" method="POST">
            <input class="qstnbarinput"  type="submit" value="LOGOUT" STYLE="color:red"/>
        </form>
        <label id="timer"style="color:white;background-color:black;font-size:20px">TIME</label>
        </center>
        </div>
        <div class="fullqstndiv">
            <?php echo $qstn;?>
            <h3>CORRECT <?php // echo session_status();
                if(session_status()==PHP_SESSION_ACTIVE)
                    {
                        //echo "active";
                    }
                else
                    {
                        session_start();
                    }
                if(isset($_SESSION[$_COOKIE["user"].$_POST['qstn']])) 
                    {echo $_SESSION[$_COOKIE["user"].$_POST['qstn']];} 
                else 
                    {echo "0";}
                ?> OUT OF 5
            </h3>
            <form name="upload"action="saveFile"  method="POST" enctype="multipart/form-data">
                <input type="file" name="program"/>
                <br/>
                <center><h3>SUBMIT QUESTION:</h3><input class="qstnbarinput" type="submit" name="qstn" value="<?php echo $qstnname ?>" style="color:green"/></center>
            </form>
            <?php //echo "cok".$_COOKIE["user"]."cok";?>
        </div>  
   </body>
</html>

