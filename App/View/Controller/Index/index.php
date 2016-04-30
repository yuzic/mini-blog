<?php  use \App\Base\Helper\Html;?>
<br>
<?php  require "paginator.php"; ?>
<br>
<?php  require "sort.php"; ?>

<?php
if (is_array($newsList)) {?>
<table class="table" border="1px" width="100%">
    <?php foreach ($newsList as $message) { ?>
        <tr>
            <td>
                <b>Action:</b> <a href="/edit/<?=$message['id']?>">Edit</a>
                <a href="/delete/<?=$message['id']?>">Delete</a>
                <br>
                <b>name:</b><?=Html::escape($message['title']);?>
                <br>
                <b><img src="/<?=Html::escape($message['image_path']);?>" width="100px">
                <br>
                <b>text:</b>
                <?=Html::escape(mb_substr($message['text'], 0, 200));?>
                <a href="/news/<?=$message['id'];?>"> More </a>
                <br>
                <b>date:</b>
                <?=date('Y-m-d H:i:s', $message['created_at']);?>

            </td>

        </tr>
    <?php } ?>

</table>
<?php } else { ?>
    Empty news list
<?php } ?>

<?php require "form.php";?>