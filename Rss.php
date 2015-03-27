<?php

namespace yii2mod\feed;


use yii\base\Widget;

/**
 * Class Viewer
 * @package app\components\rss
 */
class Rss extends Widget
{
    /**
     * @var array
     */
    public $feeds = [];
    /**
     * @var int
     */
    public $itemLimit = 3;
    /**
     * @var int
     */
    public $from = 0;
    /**
     * @var int
     */
    public $to = 20;

    /**
     * Runs RSS combine
     */
    public function run()
    {
        $feed = new \SimplePie();
        $feed->set_feed_url($this->feeds);
        $feed->set_cache_location(\Yii::getAlias('@runtime') . '/cache/feed');
        $feed->set_item_limit($this->itemLimit);
        $success = $feed->init();
        if ($success) {
            $feed->handle_content_type();
            $items = $feed->get_items($this->from, $this->to);
            return $this->render('rss', ['items' => $items]);
        }
    }
}