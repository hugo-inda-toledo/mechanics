<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li role="presentation" class="dropdown">
              <a href="#" class="dropdown-toggle" id="drop6" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <?= isset($loggedIn['User']) ? $loggedIn['User']['name'] .' '.$loggedIn['User']['last_name'] : '' ?> <span class="caret"></span> </a>
               <ul class="dropdown-menu" id="menu3" aria-labelledby="drop6">
                 <li><a href="#">Perfil</a></li>
                 <li><a href="#">Another action</a></li>
                 <li><a href="#">Something else here</a></li>
                 <li role="separator" class="divider"></li>
                 <li><?= $this->Html->link('Salir',['controller'=>'Users','action'=>'logout']) ?></li>
               </ul>
            </li>
        </ul>
    </div>
</nav>
