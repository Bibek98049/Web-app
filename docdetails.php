<style media="screen">
      embed{
        border: 2px solid black;
        margin-top: 30px;
      }
      .div1{
        margin-left: 170px;
      }
    </style>

<div class="div1">
      <?php
      $host="localhost";
        $user="root";
        $pass="";
        $db="researchs";

        $conn=mysqli_connect($host,$user,$pass,$db);


      $detal = $_GET['detal'];
      $sql="SELECT filename from research where researchId = $detal";
      $query=mysqli_query($conn,$sql);
      while ($info=mysqli_fetch_array($query)) {
        ?>
      <embed type="application/pdf" src="uploads/<?php echo $info['filename'] ; ?>" width="900" height="100%">
    <?php
      }

      ?>

    </div>