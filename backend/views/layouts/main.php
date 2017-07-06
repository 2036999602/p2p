<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/respond.min.js"></script>
        <script src="css/ie6-8.css"></script>
                
        <![endif]-->

        <!-- start: Favicon and Touch Icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="ico/favicon.png">
        <!-- end: Favicon and Touch Icons -->	
        
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!-- start: Header -->
        <header class="navbar">
            <div class="container">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="main-menu-toggle" class="hidden-xs open"><i class="fa fa-bars"></i></a>		
                <a class="navbar-brand col-lg-2 col-sm-1 col-xs-12" href="index.html"><span>SimpliQ</span></a>
                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav navbar-nav pull-right">
                        <!--li class="dropdown hidden-xs">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <i class="fa fa-warning"></i>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="dropdown-menu-title">
                                    <span>You have 11 notifications</span>
                                </li>	
                                <li>
                                    <a href="index.html#">
                                        <span class="icon blue"><i class="fa fa-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">1 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">7 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">8 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">16 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon blue"><i class="fa fa-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">36 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon yellow"><i class="fa fa-shopping-cart"></i></span>
                                        <span class="message">2 items sold</span>
                                        <span class="time">1 hour</span> 
                                    </a>
                                </li>
                                <li class="warning">
                                    <a href="index.html#">
                                        <span class="icon red"><i class="fa fa-user"></i></span>
                                        <span class="message">User deleted account</span>
                                        <span class="time">2 hour</span> 
                                    </a>
                                </li>
                                <li class="warning">
                                    <a href="index.html#">
                                        <span class="icon red"><i class="fa fa-shopping-cart"></i></span>
                                        <span class="message">Transaction was canceled</span>
                                        <span class="time">6 hour</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon green"><i class="fa fa-comment"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="icon blue"><i class="fa fa-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                                    <a>View all notifications</a>
                                </li>	
                            </ul>
                        </li-->
                        <!-- start: Notifications Dropdown -->
                        <!--li class="dropdown hidden-xs">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <i class="fa fa-tasks"></i>
                            </a>
                            <ul class="dropdown-menu tasks">
                                <li>
                                    <span class="dropdown-menu-title">You have 17 tasks in progress</span>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">iOS Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressBlue">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">Android Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressYellow">47</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">Django Project For Google</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressRed">32</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">SEO for new sites</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressGreen">63</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="header">
                                            <span class="title">New blog posts</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressPink">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all tasks</a>
                                </li>	
                            </ul>
                        </li-->
                        <!-- end: Notifications Dropdown -->
                        <!-- start: Message Dropdown -->
                        <!--li class="dropdown hidden-xs">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <ul class="dropdown-menu messages">
                                <li>
                                    <span class="dropdown-menu-title">You have 9 messages</span>
                                </li>	
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Łukasz Holeczek
                                            </span>
                                            <span class="time">
                                                6 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="img/avatar2.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Megan Abott
                                            </span>
                                            <span class="time">
                                                56 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="img/avatar3.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Kate Ross
                                            </span>
                                            <span class="time">
                                                3 hours
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="img/avatar4.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Julie Blank
                                            </span>
                                            <span class="time">
                                                yesterday
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <span class="avatar"><img src="img/avatar5.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Jane Sanders
                                            </span>
                                            <span class="time">
                                                Jul 25, 2012
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all messages</a>
                                </li>	
                            </ul>
                        </li-->
                        <!-- end: Message Dropdown -->
                        <!--li>
                            <a class="btn" href="index.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                        </li-->
                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn account dropdown-toggle" data-toggle="dropdown" href="index.html#">
                                <div class="avatar"><img src="img/avatar.jpg" alt="Avatar"></div>
                                <div class="user">
                                    <span class="hello"></span>
                                    <span class="name"><?= common\models\User::find()->select('username')->where(['id'=>Yii::$app->user->id])->scalar() ?></span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title">

                                </li>
                                <!--li><a href="index.html#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="index.html#"><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href="index.html#"><i class="fa fa-envelope"></i> Messages</a></li-->
                                <li>
                                    <?= yii\bootstrap\Html::beginForm(yii\helpers\Url::to(['/site/logout']), 'post', ['id' => 'logout-form', 'style' => 'display:none;']) . yii\bootstrap\Html::submitButton('退出', ['id' => 'logout-button']) . yii\bootstrap\Html::endForm(); ?>
                                    <a href="javascript:void(0)" onclick="$('#logout-button').click()">
                                        <i class="fa fa-off"></i> 退出
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: User Dropdown -->
                    </ul>
                </div>
                <!-- end: Header Menu -->

            </div>	
        </header>
        <!-- end: Header -->
        <div class="container content">
            <div class="row">
                <div id="sidebar-left" class="col-lg-2 col-sm-1">
                    <div class="nav-collapse sidebar-nav collapse navbar-collapse bs-navbar-collapse">
                        <?php
                        $callback = function ($menu) {
                            $data = eval($menu['data']);
                            $menu_route=[$menu['route']];
                            if(stripos($menu['route'], '&')!==false){
                                $menus=explode("&", $menu['route']);
                                $menu_route=[$menus[0]];
                                foreach($menus as $mk=>$mv){
                                    $url_param_array=explode("=", $mv);
                                    if($mk>0){
                                        $menu_route[$url_param_array[0]]=$url_param_array[1];
                                    }
                                }
                            }
                            return [
                                'label' => $menu['name'],
                                'url' => empty($menu['route']) ? yii\helpers\Url::to()."#" : $menu_route,
                                'options' => empty($data) ? [] : $data,
                                'items' => $menu['children']
                            ];
                        };
                        $menus = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback,true);

                        echo \backend\widgets\BackendAdminMenu::widget([
                            'options' => ['class' => 'nav nav-tabs nav-stacked main-menu', 'tag' => 'ul'],
                            'linkTemplate' => '<a class="dropmenu" href="{url}"><i class="fa fa-align-justify"></i>{label}</a>',
                            'sublinkTemplate' => '<a class="submenu" href="{url}"><i class="fa fa-link"></i>{label}</a>',
                            'itemOptions' => [],
                            'labelTemplate' => '<span class="hidden-sm"> {label}</span>',
                            'submenuTemplate' => "\r\n<ul>\r\n{items}\r\n</ul>\r\n",
                            'encodeLabels' => true,
                            'activeCssClass' => 'active',
                            'activateItems' => true,
                            'activateParents' => false,
                            'hideEmptyItems' => true,
                            'firstItemCssClass' => '',
                            'lastItemCssClass' => '',
                            'route' => '',
                            'params' => '',
                            'items' => $menus, 
                        ]);
                        ?>

                        
                    </div>
                </div>
                <div id="content" class="col-lg-10 col-sm-11" style="min-height: 524px;">
                    <div class="row">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>

            </div>
        </div><!--/container-->


        <div class="clearfix"></div>

        <footer>

            <div class="row">

                <div class="col-sm-5">
                    &copy; 2015 creativeLabs. <a href="http://bootstrapmaster.com">Admin Templates</a> by BootstrapMaster
                </div><!--/.col-->

                <div class="col-sm-7 text-right">
                    Powered by: <a href="http://bootstrapmaster.com/demo/simpliq/" alt="Bootstrap Admin Templates">SimpliQ Dashboard</a> | Based on Bootstrap 3.1.1 | Built with Brix.io
                </div><!--/.col-->	

            </div><!--/.row-->	

        </footer>

        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>Here settings can be configured...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close-btn">关闭</button>
                        <!--button type="button" class="btn btn-primary" id="modal-ok-btn">确定</button-->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- start: JavaScript-->
	<!-- start: JavaScript-->
	<!--[if !IE]>-->

			<script src="js/jquery-2.1.0.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script src="js/jquery-1.11.0.min.js"></script>
	
	<![endif]-->

	<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='js/jquery-2.1.0.min.js'>"+"<"+"/script>");
		</script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='js/jquery-1.11.0.min.js'>"+"<"+"/script>");
		</script>
		
	<![endif]-->
	
	
	<?php $this->endBody() ?>        
    </body>
</html>
<?php $this->endPage() ?>
