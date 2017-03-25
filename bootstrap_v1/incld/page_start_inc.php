<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<? if ($this_page == "home") { ?>
    <meta name="p:domain_verify" content="711378967addf14bde3c691a30ec3dd5"/>
 <? } ?>
    
    <title>Job Site</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="/favicon.ico">


     <link type="text/css" rel="stylesheet" href="/css2/home.css" media="all">

    <? if ($use_CDN) { ?>
		<link href="http<? if ($_SERVER['HTTPS']) echo 's'; ?>://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <? } else { ?>
	    <link href="/bootstrap_v1/css/bootstrap.css" rel="stylesheet">
    <? } ?>
    
	 <link href="/bootstrap_v1/css/custom.css" rel="stylesheet">
     
    <? if ($this_page == "home") { ?>
	 	<link href="/bootstrap_v1/css/custom-home.css" rel="stylesheet">
    <? } else if ($this_page == "products") { ?>
	 	<link href="/bootstrap_v1/css/custom-store-logo.css" rel="stylesheet">
	 	<link href="/bootstrap_v1/css/custom-products.css" rel="stylesheet">
    <? } else if ($this_page == "details") { ?>
	 	<link href="/bootstrap_v1/css/custom-store-logo.css" rel="stylesheet">
	 	<link href="/bootstrap_v1/css/custom-details.css" rel="stylesheet">
    <? } else { ?>
	 	<link href="/bootstrap_v1/css/custom-info-page.css" rel="stylesheet">
    <? } ?>

    <link href="/bootstrap_v1/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/bootstrap_v1/assets/js/html5shiv.min.js"></script>
      <script src="/bootstrap_v1/assets/js/respond.min.js"></script>
    <![endif]-->

    <link href="/bootstrap_v1/css/style.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>

    <? if ($this_page == "register") { ?>
	 <script type="text/javascript" src="/js/check_register_form.js"></script>
    <? }  ?>

	 <script type="text/javascript" src="/js/ajax_utils.js"></script>
     
       <? if ($this_page == "home") { ?>
    <link type="text/css" rel="stylesheet" media="all" href="/css2/style2.css" />
    <? }  ?>
 
	<style>
    .navlink {
        font-size:18px;
        margin-right:12px;
    }
    </style>

  </head>
  <body>
