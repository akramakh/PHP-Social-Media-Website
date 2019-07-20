<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app_nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
      <a class="navbar-brand" href="#"><div class="row"><?php echo lang('HOME_ADMEN')?></div></a>
    </div>


    <div class="collapse navbar-collapse" id="app_nav">
      <ul class="nav navbar-nav">
       
      </ul>
        <form class="navbar-form navbar-left nav-search" role="search" action="search.php" method="get">
            <div class="form-group">
                <input type="text" class="form-control" name="q" placeholder="Search"/>
                <a ><button type="submit"><i class="fa fa-search"></i></button></a>
            </div>
         <!--   <button type="submit" class="btn btn-default">Search</button>-->
        </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login-system/#login"><i class="fa fa-sign-in"></i> Login</a></li>
        <li><a href="login-system/#signup"><i class="fa fa-user-plus"></i> Register</a></li>
      </ul>
    </div>
  </div>
</nav>