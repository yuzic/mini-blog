<?php
    use \Aqua\Base\Request;
    use \App\Base\Helper\Html;
    use \App\Base\Helper\Protection;
?>

<h3> Send Post </h3>

<?php if (!empty($notify['message'])) { ?>
    <div style="color: green"><?=$notify['message'];?> </div>
<?php } ?>
<form method="post" id="contact-form" enctype="multipart/form-data" style="margin-left: 10px">
    <input type="hidden" name="blog" value="1">
    <?php if (!isset($model['update'])) {?>
        <input type="hidden" name="id" value="<?=$model['id'];?>">
    <?php } ?>

    <div class="control-group">
        <label class="control-label" for="name">Title</label>
        <div class="controls">
            <input name="title" type="text" id="title" placeholder="Tile" required value="<?=Html::escape(Request::post('title'));?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="text">Image</label>
        <div class="controls">
            <?php if (!empty(Request::post('image_path'))):?>
                <img src="/<?=Html::escape(Request::post('image_path'));?>" width="100px">
            <?php endif; ?>

            <input type="file" name="image_path" placeholder="File" required value="<?=Html::escape(Request::post('image_path'));?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="text">Text</label>
        <div class="controls">
            <textarea name="text" required cols="40" id="text" placeholder="You Text" rows="10"><?=Html::escape(Request::post('text'));?></textarea>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-success">Submit Message</button>
        <button type="reset" class="btn">Cancel</button>
    </div>

    <?php if (!empty($notify['error'])) { ?>
        <div style="color: red"><?=$notify['error'];?> </div>
    <?php } ?>
</form>

<script>
    $(document).ready(function () {

        $('#contact-form').validate({
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    minlength: 2,
                    required: true
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid')
                    .closest('.control-group').removeClass('error').addClass('success');
            }
        });

    });
</script>