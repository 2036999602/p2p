<?php

namespace frontend\controllers;

use common\tool\Vcode;
use Yii;
use yii\web\Controller;

//会员中心
/**
 * Site controller
 */
class UserController extends Controller
{
    //登陆
    public function actionLogin()
    {
        return $this->render('login');
    }

    //注册
    public function actionRegister()
    {
        if (Yii::$app->request->isPost){

        }

        return $this->render('register');
    }

    public function actionForgotPassword()
    {
        return $this->render('forgot-password');
    }


    //输出验证码
    public function actionCode()
    {
        $code = new Vcode(80, 30, 4);
        Yii::$app->session->set('verify',$code->getcode());//保存session
        $code->outimg();
    }
}
