<?php

namespace frontend\controllers;

use common\models\TaskSubscriber;
use Yii;
use common\models\Task;
use frontend\search\SearchTask;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Priority;
use common\models\Project;
use console\components\SocketServer;



/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=> [
                'class'=> AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'view', 'update', 'delete', 'subscribe', 'unsubscribe'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTask();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $isSubscribed = TaskSubscriber::isSuscribed(\Yii::$app->user->id, $id);
        $project = Project::findOne($this->findModel($id)->project_id);
        return $this->render('view', [
            'model' => $model,
            'project'=> $project,
            'isSubscribed'=> $isSubscribed,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();


        if ($model->load(Yii::$app->request->post()))   {

            $model->deadline = Yii::$app->formatter->asTimestamp($model->deadline);
            $model->created_at = time();
            $model->updated_at = time();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('create', [
                'model' => $model,]);

        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();
            $model->deadline = Yii::$app->formatter->asTimestamp($model->deadline);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //        if (($model = Task::findOne(['id'=>$id, 'author_id'=>Yii::$app->user->identity->id])) !== null)
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSubscribe($id)
    {
        if(TaskSubscriber::subscribe(\Yii::$app->user->id, $id))
        {

            Yii::$app->session->setFlash('success', 'Subscribed');

        } else
        {
            Yii::$app->session->setFlash('error', 'Error');

        }
        $this->redirect(['task/view','id'=>$id]);

    }

    public function actionUnsubscribe($id)
    {
        if(TaskSubscriber::unsubscribe(\Yii::$app->user->id, $id))
        {

            Yii::$app->session->setFlash('success', 'Unsubscribed');

        } else
        {
            Yii::$app->session->setFlash('error', 'Error');

        }
        $this->redirect(['task/view','id'=>$id]);

    }
}


