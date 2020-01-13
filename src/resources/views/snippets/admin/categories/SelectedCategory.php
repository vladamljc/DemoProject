<table>
    <tr>
        <th colspan="2" class="header-form-style">Selected category</th>
    </tr>

    <tr>
        <td>
            <label for="title">Title:</label>
        </td>
        <td>
            <input type="text" name="title" id="title" value="<?php echo $data['title'] ?>" disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="parent">Parent category:</label>
        </td>
        <td>
            <input type="text" name="parent" id="parent" value="<?php echo $data['parentTitle'] ?> " disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="code">Code:</label>
        </td>
        <td>
            <input type="text" name="code" id="code" value="<?php echo $data['code'] ?>" disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="Description" class="description">Description:</label>
        </td>
        <td>
            <textarea name="description" class="description" id="description"
                      disabled><?php echo $data['description'] ?></textarea>
        </td>
    </tr>

    <tr>
        <td>

        </td>

        <td>
            <button type="reset" class="button-width-1" onclick="Catalog.adminCategory.confirmDelete()">DELETE</button>
            <button type="submit" class="button-width-1" onclick="Catalog.adminCategory.showEditCategoryForm()">EDIT
            </button>
        </td>
    </tr>

    <tr>
        <td>
            <p id="feedbackMessage"></p>
        </td>

    </tr>


</table>
