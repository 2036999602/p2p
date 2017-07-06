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


        <div class="row">

            <div class="row">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
<?= Alert::widget() ?>
<?= $content ?>
            </div><!--/row-->

        </div>


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
            window.jQuery || document.write("<script src='js/jquery-2.1.0.min.js'>" + "<" + "/script>");
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
