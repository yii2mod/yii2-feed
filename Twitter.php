<?php
/**
 * Created by PhpStorm.
 * User: semenov
 * Date: 04.02.15
 * Time: 19:25
 */

namespace yii2mod\feed;

use yii\authclient\clients\Twitter as TwitterClient;
use yii\authclient\OAuthToken;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * Class Twitter
 * @package yii2mod\feed
 */
class Twitter extends Widget
{
    /**
     * @var
     */
    public $screenName;
    /**
     * @var
     */
    public $postsCount = 20;
    /**
     * @var bool
     */
    public $excludeReplies = false;

    /**
     * @var
     */
    public $token;
    /**
     * @var
     */
    public $tokenSecret;
    /**
     * @var
     */
    public $consumerKey;
    /**
     * @var
     */
    public $consumerSecret;

    /**
     * @var
     */
    private $twitter;

    /**
     * Viewing feed
     */
    public function run()
    {
        if (empty($this->screenName)) {
            throw new InvalidConfigException("Screen Name is empty");
        }
        $this->screenName = preg_replace('/^@/', '', $this->screenName);
        
        $this->initOptions();
        $cache = \Yii::$app->getCache();
        $cacheKey = serialize([$this->screenName, $this->postsCount]);

        $tweets = $cache->get($cacheKey);

        if ($tweets === false) {
            try {
                $tweets = $this->getLatestTweets();
            } catch (\Exception $e) {
                return false;
            }
            $cache->set($cacheKey, $tweets, 3600);
        }
        if (isset($tweets[0]) && isset($tweets[0]['user'])) {
            $user = $tweets[0]['user'];
        } else {
            return $this->render('twitterEmpty', [
                'screenName' => $this->screenName
            ]);
        }

        return $this->render('twitter', [
            'user' => $user,
            'tweets' => $tweets
        ]);
    }

    /**
     * @return mixed
     */
    private function getLatestTweets()
    {
        return $this->twitter->api('statuses/user_timeline.json', 'GET', [
            'screen_name' => $this->screenName,
            'count' => $this->postsCount,
            'exclude_replies' => $this->excludeReplies
        ]);
    }

    /**
     *
     */
    private function initOptions()
    {
        $token = new OAuthToken([
            'token' => $this->token,
            'tokenSecret' => $this->tokenSecret
        ]);

        $this->twitter = new TwitterClient([
            'accessToken' => $token,
            'consumerKey' => $this->consumerKey,
            'consumerSecret' => $this->consumerSecret,
        ]);
    }
}
