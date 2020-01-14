<table>
    <tr>
        <th colspan="2" class="header-form-style">Edit category</th>
    </tr>

    <tr>
        <td>
            <label for="title">Title:</label>
        </td>
        <td>
            <input type="text" name="title" id="title" value="<?php echo $data['title'] ?>" required>
        </td>
    </tr>

    <tr>
        <td>
            <label for="parent">Parent category:</label>
        </td>
        <td>
            <select name="parent" id="parent">
                <?php
                foreach ($data['parentTitles'] as $parent) {
                    if ($parent->id === $data['parentId']) {
                        echo '<option value="' . $parent->code . '" selected>' . $parent->title . ' - ' . $parent->code . '</option>';
                    } else {
                        echo '<option value="' . $parent->code . '">' . $parent->title . ' - ' . $parent->code . '</option>';
                    }
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <td>
            <label for="code">Code:</label>
        </td>
        <td>
            <input type="text" name="code" id="code" value="<?php echo $data['code'] ?>" required>
        </td>
    </tr>

    <tr>
        <td>
            <label for="Description" class="description">Description:</label>
        </td>
        <td>
            <textarea name="description" class="description" id="description"
                      required> <?php echo $data['description'] ?> </textarea>
        </td>
    </tr>

    <tr>
        <td>

        </td>

        <td>
            <button type="submit" class="button-width-1" onclick="Catalog.adminCategory.confirmDelete()">DELETE</button>
            <button type="reset" class="button-width-1" onclick="Catalog.adminCategory.cancel()">CANCEL</button>
            <button type="submit" class="button-width-1" onclick="Catalog.adminCategory.editCategory()">OK</button>
        </td>
    </tr>

    <tr>
        <td>
            <p id="feedbackMessage"></p>
        </td>
        <td>
            <input type="hidden" id="idCategory" value="<?php echo $data['id'] ?>"/>
        </td>
    </tr>


</table>

