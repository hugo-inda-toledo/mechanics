<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>

    <li>
        <?= 
            $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' '.
                $this->Html->tag('span', 'Dashboard'),
                [
                    'controller' => 'Pages',
                    'action' => 'dashboard'
                ],
                [
                    'escape' => false
                ]
            );
        ?>
    </li>


    <?php if($this->Access->verifyAction('Requests', 'index') || $this->Access->verifyAction('AvailableServices', 'index')):?>

        <li class="treeview">
            <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-wrench']).' '.
                    $this->Html->tag('span', 'Solicitudes y servicios').' '.
                    $this->Html->tag('i', '', ['class' => 'fa fa-angle-left pull-right']),
                    '#',
                    [
                        'escape' => false
                    ]
                );
            ?>
            <ul class="treeview-menu">
                
                <?php if($this->Access->verifyAction('Requests', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-wrench']).' Listado de Solicitudes', ['controller' => 'Requests', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
                <?php if($this->Access->verifyAction('AvailableServices', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa fa-flag-checkered']).' Listado de Servicios', ['controller' => 'AvailableServices', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
            </ul>
        </li>

    <?php endif;?>



    <?php if($this->Access->verifyAction('Cars', 'index') || $this->Access->verifyAction('CarBrands', 'index') || $this->Access->verifyAction('CarModels', 'index')):?>

        <li class="treeview">
            <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-car']).' '.
                    $this->Html->tag('span', 'Administración de vehiculos').' '.
                    $this->Html->tag('i', '', ['class' => 'fa fa-angle-left pull-right']),
                    '#',
                    [
                        'escape' => false
                    ]
                );
            ?>
            <ul class="treeview-menu">
                <?php if($this->Access->verifyAction('Cars', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-car']).' Listado de Vehiculos', ['controller' => 'Cars', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
                <?php if($this->Access->verifyAction('CarBrands', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-truck']).' Fabricantes', ['controller' => 'CarBrands', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
                <?php if($this->Access->verifyAction('CarModels', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-truck']).' Modelos', ['controller' => 'CarModels', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
            </ul>
        </li>

    <?php endif;?>

    <!--<li>
        <?php 
            /*$this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa fa-car']).' '.
                $this->Html->tag('span', 'Vehiculos'),
                [
                    'controller' => 'Cars',
                    'action' => 'index'
                ],
                [
                    'escape' => false
                ]
            );*/
        ?>
    </li>-->

    <?php if($this->Access->verifyAction('Supplies', 'index') || $this->Access->verifyAction('Replacements', 'index') || $this->Access->verifyAction('Providers', 'index')):?>

        <li class="treeview">
            <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-truck']).' '.
                    $this->Html->tag('span', 'Administrador de productos').' '.
                    $this->Html->tag('i', '', ['class' => 'fa fa-angle-left pull-right']),
                    '#',
                    [
                        'escape' => false
                    ]
                );
            ?>
            <ul class="treeview-menu">
                <?php if($this->Access->verifyAction('Replacements', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-cogs']).' Listado de Repuestos', ['controller' => 'Replacements', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
                <?php if($this->Access->verifyAction('Supplies', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-truck']).' Listado de Insumos', ['controller' => 'Supplies', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
                <?php if($this->Access->verifyAction('Providers', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-building']).' Listado de Proveedores', ['controller' => 'Providers', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
            </ul>
        </li>

    <?php endif;?>

    <?php if($this->Access->verifyAction('Users', 'index') || $this->Access->verifyAction('Roles', 'index') || $this->Access->verifyAction('Permissions', 'index')):?>

        <li class="treeview">
            <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-group']).' '.
                    $this->Html->tag('span', 'Administración de usuarios').' '.
                    $this->Html->tag('i', '', ['class' => 'fa fa-angle-left pull-right']),
                    '#',
                    [
                        'escape' => false
                    ]
                );
            ?>
            <ul class="treeview-menu">
                <?php if($this->Access->verifyAction('Users', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-user']).' Usuarios', ['controller' => 'Users', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>

                <?php if($this->Access->verifyAction('Users', 'showAll')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-cog']).' Mecánicos', ['controller' => 'Users', 'action' => 'showAll', 'mechanic'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>

                <?php if($this->Access->verifyAction('Roles', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-suitcase']).' Roles', ['controller' => 'Roles', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>

                <?php if($this->Access->verifyAction('Permissions', 'index')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-key']).' Permisos', ['controller' => 'Permissions', 'action' => 'index'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
            </ul>
        </li>

    <?php endif;?>

    <?php if($this->Access->verifyAction('Requests', 'uploadBills')):?>

        <li class="treeview">
            <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-file-text']).' '.
                    $this->Html->tag('span', 'Documentos').' '.
                    $this->Html->tag('i', '', ['class' => 'fa fa-angle-left pull-right']),
                    '#',
                    [
                        'escape' => false
                    ]
                );
            ?>
            <ul class="treeview-menu">
                <?php if($this->Access->verifyAction('Requests', 'uploadBills')):?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-file-o']).' Carga de documentos tributarios', ['controller' => 'Requests', 'action' => 'uploadBills'], ['escape' => false]);
                        ?>
                    </li>
                <?php endif;?>
            </ul>
        </li>

    <?php endif;?>

    <?php if($this->Access->verifyAction('Reports', 'index')):?>

        <li>
            <?= 
                $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' '.
                    $this->Html->tag('span', 'Reportes'),
                    [
                        'controller' => 'Reports',
                        'action' => 'index'
                    ],
                    [
                        'escape' => false
                    ]
                );
            ?>
        </li>
    <?php endif;?>


    <!--<li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="label label-primary pull-right">4</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/layout/top-nav'); ?>"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/boxed'); ?>"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/fixed'); ?>"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/collapsed-sidebar'); ?>"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->Url->build('/pages/widgets'); ?>">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <small class="label pull-right bg-green">Hot</small>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/charts/chartjs'); ?>"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/morris'); ?>"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/flot'); ?>"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/inline'); ?>"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/ui/general'); ?>"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/icons'); ?>"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/buttons'); ?>"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/sliders'); ?>"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/timeline'); ?>"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/modals'); ?>"><i class="fa fa-circle-o"></i> Modals</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/forms/general'); ?>"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/forms/advanced'); ?>"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/forms/editors'); ?>"><i class="fa fa-circle-o"></i> Editors</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Data tables</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->Url->build('/pages/calendar'); ?>">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <small class="label pull-right bg-red">3</small>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <small class="label pull-right bg-yellow">12</small>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/mailbox'); ?>">Inbox <span class="label label-primary pull-right">13</span></a></li>
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/compose'); ?>">Compose</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/read-mail'); ?>">Read</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/starter'); ?>"><i class="fa fa-circle-o"></i> Starter</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/invoice'); ?>"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/profile'); ?>"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/login'); ?>"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/register'); ?>"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/lockscreen'); ?>"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/404'); ?>"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/500'); ?>"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/blank'); ?>"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/pace'); ?>"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        </ul>
    </li>
    <li><a href="<?php echo $this->Url->build('/pages/documentation'); ?>"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
    <li class="header">LABELS</li>
    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    <li><a href="<?php echo $this->Url->build('/pages/debug'); ?>"><i class="fa fa-bug"></i> Debug</a></li> -->
</ul>
