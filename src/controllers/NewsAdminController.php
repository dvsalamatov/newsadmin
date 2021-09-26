<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;

class NewsAdminController extends Controller
{
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
                    'logout' => ['create','delete','edit'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

    }

    public function actionCreate()
    {

    }

    public function actionDelete()
    {

    }

    public function actionEdit()
    {

    }
}