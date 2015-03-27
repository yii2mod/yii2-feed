<?php
/* @var $this yii\web\View */
/* @var $tweets array */
/* @var $user array */

use yii\helpers\Html;

$screenNameLink = Twitter_Autolink::create()->setNoFollow(false)->autoLink('@' . $user['screen_name']);
?>
<h1><?php echo $user['name']; ?> <span class="name-screen-tweet"><?php echo $screenNameLink ?></span></h1>

<div class="posts-user">
    <span><strong><?php echo $user['statuses_count']; ?></strong> Tweets</span>
    <span><strong><?php echo $user['friends_count']; ?></strong> Follows</span>
    <span><strong><?php echo $user['followers_count']; ?></strong> Followers</span>
</div>
<ul class="twitter-posts-container">
    <?php foreach ($tweets as $tweet) : ?>
        <li class="twitter-post clearfix">
            <div class="img-tweet">
                <?php echo Html::img($user['profile_image_url']); ?>
            </div>
            <div class="img-name-tweet">
                <div class="two-names">
                    <span class="name-ures-tweet"><?php echo $user['name']; ?></span>
                    <span class="name-screen-tweet"><?php echo $screenNameLink; ?></span>
                </div>

                <div class="text-post hide-phone">
                    <?php echo Twitter_Autolink::create()
                        ->setNoFollow(false)
                        ->autoLink($tweet['text']); ?>
                </div>
            </div>
            <div class="text-post show-phone">
                <?php echo Twitter_Autolink::create()
                    ->setNoFollow(false)
                    ->autoLink($tweet['text']); ?>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
