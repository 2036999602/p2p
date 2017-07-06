<?php

namespace backend\modules\archives\controllers;

use Yii;
use common\models\ArchivesModel;
use common\models\ArchivesSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArchivesController implements the CRUD actions for ArchivesModel model.
 */
class ManagerController extends Controller
{
    public $post;
    public $get;
    private $ids;
    
    public function init() {
        parent::init();
        $this->post = \Yii::$app->getRequest()->post();
        $this->get = \Yii::$app->getRequest()->get();
        $this->ids = isset($this->post['id']) ? (strrpos($this->post['id'], ",") ? explode(",", $this->post['id']) : [$this->post['id']]) : [];
        if (empty($this->ids) && isset($this->post['selection']) && !empty($this->post['selection'])) {
            $this->ids = $this->post['selection'];
        }
        if(empty($this->ids) && isset($this->get['id']) && !empty($this->get['id'])){
            $this->ids = strrpos($this->get['id'], ",") ? explode(",", $this->get['id']) : [$this->get['id']];
        }
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ArchivesModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArchivesSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/archives/index', [
            'searchModel' => $searchModel,
            'list' => $dataProvider,
            'title'=>'文档列表'
        ]);
    }

    /**
     * Displays a single ArchivesModel model.
     * @param string $id
     * @return mixed
     */
    public function actionView()
    {
        return $this->render('/archives/view', [
            'model' => \backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesModel')->getOne(['id'=>$this->ids[0]]),
            'title'=>'查看文档'
        ]);
    }

    /**
     * Creates a new ArchivesModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new ArchivesModel();
        $module_name=Yii::$app->controller->module->id?Yii::$app->controller->module->id:Yii::$app->controller->id;
        $types=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel')->getList(true,['module_name'=>$module_name],['id'=>SORT_DESC],10);
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id=Yii::$app->user->id;
            $model->status=1;
            
            if($model->save()){
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('/archives/add', [
                'model' => $model,
                'article_model'=>new \common\models\ArticleModel(),
                'title'=>'发布文档',
                'types'=>$types
            ]);
        }
    }   

    /**
     * Updates an existing ArchivesModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel($this->ids[0]);
        $module_name=Yii::$app->controller->module->id?Yii::$app->controller->module->id:Yii::$app->controller->id;
        $types=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel')->getList(true,['module_name'=>$module_name],['id'=>SORT_DESC],10);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $article_model=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArticleModel')->getOne(['archive_id'=>$this->ids[0]]);
            return $this->render('/archives/update', [
                'model' => $model,
                'article_model'=>$article_model,
                'title'=>'编辑文档',
                'types'=>$types
            ]);
        }
    }

    /**
     * Deletes an existing ArchivesModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(!empty($this->ids)){
            $result=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesModel')->delete(['id'=>$this->ids]);
            if(Yii::$app->request->isAjax){
                $msg="操作失败";
                $status=0;                
                if($result){
                    $msg='操作成功';
                    $status=1;
                }
                return json_encode(['status'=>$status,'msg'=>$msg,'data'=>['title'=>'删除文档','content'=>$msg]]);
            }
            return $this->redirect(['index']);
        }else{
            if(Yii::$app->request->isAjax){
                return json_encode(['status'=>0,'msg'=>'参数错误']);
            }else{
                Yii::$app->session->setFlash('error', '参数错误');
                return $this->goBack(['index']);
            }
        }
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
    }
    
    public function actionAudit() {
        if($this->post){
            $query_result = \backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesModel')->update($this->ids, ['ArchivesModel' => ['status' => 1]]);

            if ($query_result) {
                if (\Yii::$app->request->isAjax) {
                    $result = ['status' => 1, 'msg' => '审核成功', 'data' => ['title' => '审核', 'content' => empty($query_result) ? '操作成功' : $query_result]];
                    return json_encode($result);
                }
                \Yii::$app->session->setFlash('success', empty($query_result) ? '操作成功' : $query_result);
            } else {
                if (\Yii::$app->request->isAjax) {
                    $result = ['status' => 0, 'msg' => '操作成功', 'data' => []];
                    return json_encode($result);
                }
                \Yii::$app->session->setFlash('error', '操作成功，无数据变动');
            }
            return $this->redirect(['index']);
        }
        return false;
    }

    public function actionDisable() {
        if($this->post){
            $query_result = \backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesModel')->update($this->ids, ['ArchivesModel' => ['is_disable' => 1]]);

            if ($query_result) {
                if (\Yii::$app->request->isAjax) {
                    $result = ['status' => 1, 'msg' => '屏蔽成功', 'data' => ['title' => '屏蔽', 'content' => empty($query_result) ? '操作成功' : $query_result]];
                    return json_encode($result);
                }
                \Yii::$app->session->setFlash('success', empty($query_result) ? '操作成功' : $query_result);
            } else {
                if (\Yii::$app->request->isAjax) {
                    $result = ['status' => 0, 'msg' => '操作成功', 'data' => []];
                    return json_encode($result);
                }
                \Yii::$app->session->setFlash('error', '操作成功，无数据变动');
            }
            return $this->redirect(['index']);
        }
        return false;
    }
    
    
    
    public function actionTypeIndex()
    {
        $logic=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel');
        //$model=$logic->getModel();
        $list=$logic->getList();
        return $this->render('/archives/index_type', ['title'=>'栏目列表','list'=>$list]);
    }
    
    public function actionTypeAdd(){
        $logic=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel');
        $model=$logic->getModel();
        if($this->post){
            if($logic->scenario('type-add')->save($this->post)){
                return $this->redirect(['type-index']);
            }
        }
        return $this->render('/archives/add_type',['title'=>'添加栏目','model'=>$model]);
    }
    
    public function actionTypeUpdate(){
        $logic=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel');
        $model=$logic->getOne(['id'=>$this->ids]);
        if($this->post){
            if($logic->scenario('type-update')->update($this->ids,$this->post)){
                return $this->redirect(['type-index']);
            }
        }
        return $this->render('/archives/update_type',['title'=>'修改栏目','model'=>$model]);
    }
    
    public function actionTypeDelete(){
        if(!empty($this->ids)){
            $result=\backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel')->delete(['id'=>$this->ids]);
            if(Yii::$app->request->isAjax){
                $msg="操作失败";
                $status=0;                
                if($result){
                    $msg='操作成功';
                    $status=1;
                }
                return json_encode(['status'=>$status,'msg'=>$msg,'data'=>['title'=>'删除栏目','content'=>$msg]]);
            }
            return $this->redirect(['type-index']);
        }else{
            if(Yii::$app->request->isAjax){
                return json_encode(['status'=>0,'msg'=>'参数错误']);
            }else{
                Yii::$app->session->setFlash('error', '参数错误');
                return $this->goBack(['type-index']);
            }
        }
    }

    /**
     * Finds the ArchivesModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ArchivesModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArchivesModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
