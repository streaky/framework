<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MineAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script type="text/javascript">var config = { siteurl: '<?php self::s("site-url"); ?>', templateurl: '<?php self::s("template-url"); ?>' };</script>
    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link href="<?php self::s("template-url"); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php self::s("template-url"); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php self::s("template-url"); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php self::s("template-url"); ?>css/bootswatch.css" rel="stylesheet">
	<link href="<?php self::s("template-url"); ?>css/mineadmin.css" rel="stylesheet">
  </head>

  <body class="preview" id="top" data-spy="scroll" data-target=".subnav" data-offset="80">


  <!-- Navbar
    ================================================== -->
 <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="<?php self::s("site-url"); ?>">MineAdmin</a>
       <div class="nav-collapse collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
          <li><a href="<?php self::s("site-url"); ?>players/">Players</a></li>
          <li><a href="<?php self::s("site-url"); ?>players/">Worlds</a></li>
          <li><a href="<?php self::s("site-url"); ?>players/">Plugins</a></li>
          <li><a href="<?php self::s("site-url"); ?>players/">Backup</a></li>
          <!--<li><a id="swatch-link" href="../#gallery">Gallery</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Preview <b class="caret"></b></a>
            <ul class="dropdown-menu" id="swatch-menu">
              <li><a href="../default">Default</a></li>
              <li class="divider"></li>
              <li><a href="../amelia">Amelia</a></li>
              <li><a href="../cerulean">Cerulean</a></li>
              <li><a href="../cosmo">Cosmo</a></li>
              <li><a href="../cyborg">Cyborg</a></li>
              <li><a href="../journal">Journal</a></li>
              <li><a href="../readable">Readable</a></li>
              <li><a href="../simplex">Simplex</a></li>
              <li><a href="../slate">Slate</a></li>
              <li><a href="../spacelab">Spacelab</a></li>
              <li><a href="../spruce">Spruce</a></li>
              <li><a href="../superhero">Superhero</a></li>
              <li><a href="../united">United</a></li>
            </ul>
          </li>
          <li class="dropdown" id="preview-menu">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Download <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a target="_blank" href="bootstrap.min.css">bootstrap.min.css</a></li>
              <li><a target="_blank" href="bootstrap.css">bootstrap.css</a></li>
              <li class="divider"></li>
              <li><a target="_blank" href="variables.less">variables.less</a></li>
              <li><a target="_blank" href="bootswatch.less">bootswatch.less</a></li>
            </ul>
          </li>-->
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <li><a href="<?php self::s("site-url"); ?>players/streaky81">streaky81 &nbsp;<img class="navatar" src="<?php self::s("site-url"); ?>avatar/streaky81/20"/></a></li>
        </ul>
       </div>
     </div>
   </div>
 </div>

    <div class="container">


<?php self::e("main-content"); ?>

<br><br><br><br>

     <!-- Footer
      ================================================== -->
      <hr>

      <footer id="footer">
        <p class="pull-right"><a href="#top">Back to top</a></p>
        <div class="links">
          <a href="http://mineadmin.com/">MineAdmin</a>
        </div>
      </footer>

    </div><!-- /container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="<?php self::s("template-url"); ?>js/bootstrap.min.js"></script>
    <script src="<?php self::s("template-url"); ?>js/bootswatch.js"></script>


  </body>
</html>
