<?php
session_start();
?>

<?php
require 'db-tilkobling.php';
if(!empty($_SESSION['name'])){

    $right_answer=0;
    $wrong_answer=0;
    $unanswered=0;

   $keys=array_keys($_POST);
   $order=join(",",$keys);


   $response=mysql_query("select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysql_error());

   while($result=mysql_fetch_array($response)){
       if($result['answer']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
   }
   $name=$_SESSION['name'];
   mysql_query("update users set score='$right_answer' where user_name='$name'");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>E-Learning</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <header>
            <p class="text-center">
                Velkommen <?php
                if(!empty($_SESSION['name'])){
                    echo $_SESSION['name'];
                }?>

            </p>
        </header>
        <div class="container result">
            <div class="row">
              <h2 class="text-center">
                  Gratulerer du har fullført testen!
              </h2>
           </div>
           <hr>
           <div class="row">
                  <div class="col-xs-18 col-sm-9 col-lg-9">
                    <div class='result-logo1'>
                            <img src="image/cat.GIF" class="img-responsive"/>
                    </div>
                  </div>

                  <div class="col-xs-6 col-sm-3 col-lg-3">
                     <a href="<?php echo BASE_PATH;?>" class='btn btn-success'>Start ny test!</a>
                     <a href="<?php echo BASE_PATH.'logout.php';?>" class='btn btn-success'>Logg ut</a>

                       <div style="margin-top: 30%">
                        <p>Totalt riktig svar : <span class="answer"><?php echo $right_answer;?></span></p>
                        <p>Totalt feil svar : <span class="answer"><?php echo $wrong_answer;?></span></p>
                        <p>Totalt usvart : <span class="answer"><?php echo $unanswered;?></span></p>
                       </div>

                   </div>

            </div>
            <div class="row">

            </div>
        </div>
        <footer>
            <p class="text-center" id="foot">
                &copy; <a>E-Learning </a>2016
            </p>
        </footer>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script src="js/jquery.validate.min.js"></script>



    </body>
</html>
<?php }else{

 header( 'Location: index.php' ) ;

}?>
