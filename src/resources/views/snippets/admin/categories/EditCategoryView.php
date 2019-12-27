<table>
    <tr>
        <th colspan="2" class="header-form-style">Edit category</th>
    </tr>

    <tr>
        <td>
            <label for="title">Title:</label>
        </td>
        <td>
            <input type="text" name="title" id="title" value="<?php echo $data[0] ?>" required>
        </td>
    </tr>

    <tr>
        <td>
            <label for="parent">Parent category:</label>
        </td>
        <td>
            <select name="parent" id="parent">
                <?php
                foreach ($data[1] as $parent) {
                    if ($parent === $data[4]) {
                        echo '<option selected>' . $parent . '</option>';
                    } else {
                        echo '<option>' . $parent . '</option>';
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
            <input type="text" name="code" id="code" value="<?php echo $data[2] ?>" required>
        </td>
    </tr>

    <tr>
        <td>
            <label for="Description" class="description">Description:</label>
        </td>
        <td>
            <textarea name="description" class="description" id="description"
                      required> <?php echo $data[3] ?> </textarea>
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
            <input type="hidden" id="idCategory" value="<?php echo $data[5] ?>">
        </td>
    </tr>


</table>

