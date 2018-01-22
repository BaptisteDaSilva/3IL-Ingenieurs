<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="icon" href="<?= IMAGES . 'ico.png' ?>">

<link rel="stylesheet" type="text/css"
	href="<?= CSS . 'bootstrap.min.css' ?>">
<link rel="stylesheet" type="text/css"
	href="<?= CSS . 'font-awesome.min.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS . 'zoombox.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS . 'style.css' ?>">


<link rel="stylesheet" type="text/css" href="<?= CSS . 'responsiveslides.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS . 'themes.css' ?>">

<script type="text/javascript" src="<?= JS . 'jquery-1.11.3.min.js' ?>"></script>
<script type="text/javascript" src="<?= JS . 'bootstrap.min.js' ?>"></script>
<script type="text/javascript" src="<?= JS . 'zoombox.js' ?>"></script>
<script type="text/javascript" src="<?= JS . 'carte.js' ?>"></script>
<script type="text/javascript" src="<?= JS . 'ajax.js' ?>"></script>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script type="text/javascript" src="<?= JS . 'responsiveslides.min.js' ?>"></script>
  <script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxheigt: 500,
        namespace: "centered-btns"
      });

    });
  </script>

<title><?= $this->getTitre() ?></title>
</head>