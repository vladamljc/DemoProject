<table>
    <tr>
        <th colspan="2" class="header-form-style">Create sub-category</th>
    </tr>

    <tr>
        <td>
            <label for="title">Title:</label>
        </td>
        <td>
            <input type="text" name="title" id="title" required>
        </td>
    </tr>

    <tr>
        <td>
            <label for="parent">Parent category:</label>
        </td>
        <td>
            <input type="text" name="parent" id="parent" value="<?php echo $data[0] ?>" disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="code">Code:</label>
        </td>
        <td>
            <input type="text" name="code" id="code" required>
        </td>
    </tr>

    <tr>
        <td>
            <label for="Description" class="description">Description:</label>
        </td>
        <td>
            <textarea name="description" class="description" id="description" required></textarea>
        </td>
    </tr>

    <tr>
        <td>

        </td>

        <td>
            <button type="reset" class="button-width-1" onclick="resetFields()">Cancel</button>
            <button type="submit" class="button-width-1" onclick="addSubCategory()">OK</button>
        </td>
    </tr>

    <tr>
        <td>
            <p id="feedbackMessage"></p>
        </td>
    </tr>


</table>
