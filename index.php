<?php
$solversData = @fopen("solvers.md", "r");
if ($solversData) {
   $solvers = explode("\n", fread($solversData, filesize("solvers.md")));
}
function solvedOrNot($user){
    global $solvers;
    foreach($solvers as $letsfindout){
        if($user == $letsfindout) return 1;
    }
    return 0;
}
$members = array(
    array("udemy","Akash Hamal",solvedOrNot("udemy")),
    array("htb","Alex Dhital",solvedOrNot("htb")),
    array("h1","Ananda Dhakal",solvedOrNot("h1")),
    array("google","Anurag Subedi",solvedOrNot("google")),
    array("prof","Ashok Chapagai",solvedOrNot("prof")),
    array("alibaba","Baibhav Anand Jha",solvedOrNot("alibaba")),
    array("discord","Bibek Bhattarai",solvedOrNot("discord")),
    array("network","Bibek Dhungana",solvedOrNot("network")),
    array("kid","Bibek Shah",solvedOrNot("kid")),
    array("drug","Bibek Uprety",solvedOrNot("drug")),
    array("naryal2580","Captain Nick Lucifer",solvedOrNot("naryal2580")),
    array("xss","Dipendra Shrestha",solvedOrNot("xss")),
    array("data","Mahesh C. Regmi",solvedOrNot("data")),
    array("biggie","Nepolian Pratik",solvedOrNot("biggie")),
    array("punkholic","Niraj Ghimire",solvedOrNot("punkholic")),
    array("oneel","Oneel Nyyra",solvedOrNot("oneel")),
    array("prabesh","Prabesh Sapkota",solvedOrNot("prabesh")),
    array("bhprdp","Pradeep Bhattarai",solvedOrNot("bhprdp")),
    array("noob","Prashant Pandey",solvedOrNot("noob")),
    array("webinar","Pratik Dahal",solvedOrNot("webinar")),
    array("course","Pratik Gyawali",solvedOrNot("course")),
    array("thm","Rahul Gautam",solvedOrNot("thm")),
    array("noobie","Sabeen Pandey",solvedOrNot("noobie")),
    array("6thfloor","Sudarshan Rai",solvedOrNot("6thfloor")),
    array("smallkailashbohara","Utsab Joshi",solvedOrNot("smallkailashbohara")),
    array("new","एन्जिल निरौला",solvedOrNot("new")),
    array("uppi","उप्पी पाई",solvedOrNot("uppi")),
    array("phantam","Phantam Ray",solvedOrNot("phantam"))
);
$message = "Find a way to submit the flag!";
$tips = "How about custom HTTP request methods?";
$mainFLAG = "NepSec{h3llo_n00bs_do_you_like_MC?}";
if($_SERVER['REQUEST_METHOD']=='POST'){    
    $username = htmlspecialchars($_POST['participant']);
    foreach($members as $submissionUser){
        if($username != $submissionUser[0]){
            $message = "Invalid Submission! You aren't a valid user.";
            $tips = "Only NepSec members are allowed to participate.";
        }
    }
    $submission = htmlspecialchars($_POST['flag']);
    if($submission == htmlspecialchars($mainFLAG)){
        foreach($members as $flagAuthor){
            if($username==$flagAuthor[0]){
                if($flagAuthor[2]==1){
                    $message = "Invalid Submission! You have already solved it.";
                    $tips = "Are you looking for more challenges?";
                } elseif($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']=='NEPSEC'){
                    $soSirJustSolvedIt = fopen("solvers.md","a");
                    fwrite($soSirJustSolvedIt, "$username\n");
                    fclose($soSirJustSolvedIt);
                    $flagAuthor[2]=1;
                    $message = "Congratulations! You just solved the challenge.";
                    $tips = "Refresh the page to update the status table!";
                } else{
                    $message = "Getting the right flag isn't enough! Try more!";
                    $tips = "How about custom HTTP request methods?";
                }
            }
        }
    } else {
        $message = "Invalid Submission! Please submit a valid flag!";
        $tips = "How about custom HTTP request methods?";
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>NepSecCTF</title>
    <style>
        * {
            vertical-align:baseline;
        }
        body{
            margin:0;
            padding:0;
            text-align:center;
            font-size:20px;
            color:#ffffff;
        }
        .container{
            paddng:10px;
            background: #d53369;
            background: -webkit-linear-gradient(to right, #d53369, #cbad6d);
            background: linear-gradient(to right, #d53369, #cbad6d);
        }
        #header{
            margin-top:0;
            background:url('https://whoisbinit.me/assets/img/bg.jpg');
            color:#ffffff;
            font-size:64px;
            padding:5px;
            border-bottom:2px solid #F000A0;
        }
        form{
            padding-bottom:25px;
            border-bottom:2px inset #f0000f;
        }
        details{
            padding-top:30px;
            padding-bottom:30px;
            border-bottom:2px outset;
        }
        summary{
            font-size:28px;
        }
        table{
            margin-left:auto;margin-right:auto;border-collapse:collapse;
        }
        td, th{
            border:2px inset #F000A0;
            padding:15px;
        }
        th{
            font-size:28px;
            color:#ff000f;
        }
        td{
            color:#adffad;
            -webkit-text-stroke:0.2px #00f0f0;
        }
        #keep-trying{
            margin-top:50px;font-size:54px;float:right;writing-mode:vertical-rl;text-orientation:sideways-right;
        }
        #powered{
            margin-top:200px;font-size:36px;float:left;writing-mode:vertical-rl;text-orientation:upright;
        }
        #flag-submission{
            padding-top:15px;
            background:#fc00ff;
            background:-webkit-linear-gradient(to right, #00dbde, #fc00ff);
            background:linear-gradient(to right, #00dbde, #fc00ff);
            padding-bottom:25px;
        }
        #members-area{
            padding-top:15px;
            background:#fc00ff;
            background:-webkit-linear-gradient(to right, #00dbde, #fc00ff);
            background:linear-gradient(to right, #00dbde, #fc00ff);
            padding-bottom:25px;
        }
        #footer{
            background:url('https://whoisbinit.me/assets/img/bg.jpg');
            color:#83a4d4;
            -webkit-text-stroke:2px #00f0f0;
            margin:0;
            font-size:48px;
            padding:15px;
        }
        @media only screen and (max-width: 600px){
            #keep-trying, #powered{
                display:none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 id="header">NepSecCTF</h1>
    <h3 style="color:black">You shall need this: <strong>wordlist.txt</strong></h3>
    <h2>Flag Submission</h2>
    <form method="POST">
        Name:
        <select name="participant">
            <option>Select Identity</option>
            <option value="udemy">Akash Hamal</option>
            <option value="htb">Alex Dhital</option>
            <option value="h1">Ananda Dhakal</option>
            <option value="google">Anurag Subedi</option>
            <option value="prof">Ashok Chapagai</option>
            <option value="alibaba">Baibhav Anand Jha</option>
            <option value="discord">Bibek Bhattarai</option>
            <option value="network">Bibek Dhungana</option>
            <option value="kid">Bibek Shah</option>
            <option value="drug">Bibek Uprety</option>
            <option value="naryal2580">Captain Nick Lucifer</option>
            <option value="xss">Dipendra Shrestha</option>
            <option value="data">Regmi C. Mahesh</option>
            <option value="biggie">Nepolian Pratik</option>
            <option value="punkholic">Niraj Ghimire</option>
            <option value="oneel">Oneel Nyyra</option>
            <option value="prabesh">Prabesh Sapkota</option>
            <option value="bhprdp">Pradeep Bhattarai</option>
            <option value="noob">Prashant Pandey</option>
            <option value="webinar">Pratik Dahal</option>
            <option value="course">Pratik Gyawali</option>
            <option value="thm">Rahul Gautam</option>
            <option value="noobie">Sabeen Pandey</option>
            <option value="6thfloor">Sudarshan Rai</option>
            <option value="smallkailashbohara">Utsab Joshi</option>
            <option value="new">एन्जिल निरौला</option>
            <option value="uppi">उप्पी पाई</option>
            <option value="phantam">Phantam Ray</option>
        </select>
        &nbsp;<br><br>&nbsp;
        Flag: <input type="text" name="flag" size="30" placeholder="NepSec{NepSecCTF}"/>
    </form>
        <details>
            <summary><em><?php echo $message;?></em></summary>
            <ul>
                <li><?php echo $tips;?></li>
            </ul>
        </details>
    <div id="members-area">
    <h2>Members</h2>
    <h1 id="keep-trying">Keep trying the NepSecCTF!</h1>
    <h1 id="powered">Powered by Binit</h1>
    <table>
        <thead>
            <tr>
                <th>Members</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($members as $participant){
                    echo "<tr><td><strong>".$participant[1]."</strong></td>";
                    if($participant[2]) echo "<td>SOLVED!</td></tr>";
                    else echo "<td><em>UNSOLVED!</em></td></tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
    </div>
    <h1 id="footer">Thank You!</h1>
</body>
</html>
