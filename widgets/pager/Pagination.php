<?php

namespace app\widgets\pager;

class Pagination extends \yii\base\Widget
{
    /** @var \Yii\data\Pagination */
    public $pagination;

    public function run()
    {
        if ($this->pagination->pageCount <= 1) {
            return '';
        }
        $page = \Yii::$app->request->get('page', 1);
        return $this->render('pagination', [
            'page'      => $page,
            'total'     => $this->pagination->totalCount,
            'pageCount' => $this->pagination->pageCount,
            'pageSize'  => $this->pagination->pageSize,
        ]);
    }
}