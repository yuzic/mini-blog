<?php  use \App\Base\Helper\Html;?>

<table class="table" border="1px" width="100%">
        <tr>
            <td>
                Title:<br><?=Html::escape($blog['title']);?>
                <br>
                text:
                <?=Html::escape($blog['text']);?>
                <br>
                date:
                <?=date('Y-m-d H:i:s', $blog['created_at']);?>

            </td>

        </tr>
</table>


<?php if (!empty($notify['error'])) { ?>
    <div style="color: red"><?=$notify['error'];?> </div>
<?php } ?>