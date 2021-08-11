
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="description" content="Creating Web Applications">
<meta name="keywords" content="HTML, CSS">
<meta name="author" content="Le Bao Duy Nguyen">
  <link href="styles/style.css" rel="stylesheet">
  <title><?php echo $title;  ?></title>
  <?php  
  if ($js != null) {
  	for ($i =0; $i < sizeof($js); $i++){
  		echo('<script src="scripts/'.$js[$i].'"></script>');
  	}
  }
  ?>
  <header><div class="container"></div></header>
