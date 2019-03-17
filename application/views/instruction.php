
<html>
   <head>
        <link rel="stylesheet" href="../../static/CSS/inside1.css"/>
   </head>
   <body>
        <div class="topbardiv">
            <center><?php echo "Instructions";?></center>    
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
        <!--<form action="scoreBoard" method="POST">
            <input class="qstnbarinput" type="submit" value="SCOREBOARD"/>
        </form>-->
        <form action="logOut" method="POST">
            <input class="qstnbarinput" type="submit" value="LOGOUT" STYLE="color:red"/>
        </form>
        </center>
    </div>
    <div class="fullqstndiv">
        <p>Place Youe Instructions Here.............</p>
    </div>
   </body>
</html>
