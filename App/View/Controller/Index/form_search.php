Search:
<form method="post" action="/search/1" id="search-form" style="margin-left: 10px">
    <input type="hidden" name="search" value="1">

    <div class="control-group">
        <label class="control-label" for="name">Name</label>
        <div class="controls">
            <input name="search" type="text" id="search" placeholder="search name" required value="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="text">Field</label>
        <div class="controls">
            <select name="field_name">
                <option  value="name">Name</option>
                <option value="author">author</option>
                <option value="tags">tags</option>
                <option value="text">text</option>
            </select>
            <option>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Search</button>
        </div>
    </div>
</form>
