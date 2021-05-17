<?php include("../server/navs.php") ?>

<!DOCTYPE html>
<html>
<head>
<style>
.panel{
background-color: grey;
color: white;
border: 2px striped dark-grey;
margin-left: 85%;
padding: 3px;

}

.a hover{
	color: purple;
}
.a visited{
	color: white;
}
</style>


</head>
<body>

<div class="panel">
<!-- links to the other screens -->
<script type="text/javascript">
    var een_lijstJS = <?php echo json_encode($navs) ?>;

    console.log(een_lijstJS);


    

</script>

<a href="the php file+location"> this screen</a>
<a href="the php file+location"> other screen</a>

<p> go to this place </p>
<p> go to the other place </p>

</div>


<?php

?>



</body>
</html>





