<?php

namespace app\controllers;

use app\models\News;
use app\repository\NewsRepository;
use app\service\NewsUserService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\AccessControl;
use app\models\forms\CreateNews;

class NewsAdminController extends Controller
{
    protected NewsUserService $newsUserService;
    protected NewsRepository $newsRepository;

    public function __construct(
        $id,
        $module,
        NewsUserService $newsUserService,
        NewsRepository $newsRepository,
        $config = []
    )
    {
        $this->newsUserService = $newsUserService;
        $this->newsRepository = $newsRepository;

        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->getIdentity();

        return $this->render('index', [
            'news' => $this->newsRepository->getNewsForUser($user)
        ]);
    }

    public function actionCreate()
    {
        $model = new CreateNews();
        $user = Yii::$app->user->getIdentity();
        $model->user = $user;
        $successLabel = '';
        $title = 'Редактирование новости';

        if (Yii::$app->request->isGet && $id = Yii::$app->request->get('id')) {
            $news = News::findOne($id);
            if (!$this->newsUserService->hasUserEditNews($news, $user)) {
                throw new NotAcceptableHttpException('Вы не можете отредактировать новость другого пользователя');
            }
            $model->id = $news->id;
            $model->content = $news->content;
            $model->header = $news->header;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->id) {
                $oldNews = News::findOne($model->id);
                if (!$this->newsUserService->hasUserEditNews($oldNews, $user)) {
                    throw new NotAcceptableHttpException('Вы не можете отредактировать новость другого пользователя');
                }
            }
            $news = $model->saveNews();
            $successLabel = 'Новость успешно сохранена';
            $title = 'Создание новости';
        }

        return $this->render('create', [
            'title' => $title,
            'successLabel' => $successLabel,
            'model' => $model,
            'news' => $news ?? null
        ]);
    }

    public function actionDelete()
    {
        $user = Yii::$app->user->getIdentity();
        $id = Yii::$app->request->post('id');
        $message = '';

        $news = News::findOne($id);

        if (!$news){
            throw new NotFoundHttpException('Новость id=' . $id . ' не найдена');
        }

        if (!$this->newsUserService->hasUserEditNews($news, $user)){
            throw new NotAcceptableHttpException('Вы не можете удалить новость другого пользователя');
        }

        $message = 'Удалена новость ' . $news->header . ', id=' . $id;
        $news->delete();


        return $this->render('index', [
            'message' => $message,
            'news' => $this->newsRepository->getNewsForUser($user)
        ]);
    }
}