<?php  use \App\Base\Helper\Html;?>

<table class="table" border="1px" width="100%">
        <tr>
            <td>
                name:<br><?=Html::escape($message['name']);?>
                <br>
                author:<br><?=Html::escape($news['author']);?>
                <br>
                tags:
                <?=Html::escape($news['tags']);?>
                <br>
                text:
                <?=Html::escape($news['text']);?>
                <a href="/news/<?=$news['id'];?>"> More </a>
                <br>
                date:
                <?=date('Y-m-d H:i:s', $news['created_at']);?>

            </td>

        </tr>
</table>


<?php if (!empty($notify['error'])) { ?>
    <div style="color: red"><?=$notify['error'];?> </div>
<?php } ?>