<?php
/**
 * Created by PhpStorm.
 * User: kandie
 * Date: 6/26/18
 * Time: 10:53 AM
 */

namespace app\widgets;


use yii\grid\GridView;
use yii\helpers\Html;

class MyGridView extends GridView
{
    /**
     * Renders the table header.
     * @return string the rendering result.
     */
    public function renderTableHeader()
    {
        $cells = [];
        foreach ($this->columns as $column) {
            /* @var $column Column */
            $cells[] = $column->renderHeaderCell();
        }
        $content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);
        if ($this->filterPosition === self::FILTER_POS_HEADER) {
            $content = $this->renderFilters() . $content;
        } elseif ($this->filterPosition === self::FILTER_POS_BODY) {
            $content .= $this->renderFilters();
        }

        return "<thead class='thead-dark'>\n" . $content . "\n</thead>";
    }
}