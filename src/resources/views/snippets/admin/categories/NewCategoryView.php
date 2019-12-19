<table>
    <tr>
        <th colspan="2" class="header-form-style">Create category</th>
    </tr>

    <tr>
        <td>
            <label for="title">Title:</label>
        </td>
        <td>
            <input type="text" name="title" id="title">
        </td>
    </tr>

    <tr>
        <td>
            <label for="parent">Parent category:</label>
        </td>
        <td>
            <select name="parent" disabled>
                <option>Root</option>
            </select>
        </td>
    </tr>

    <tr>
        <td>
            <label for="code">Code:</label>
        </td>
        <td>
            <input type="text" name="code" id="code">
        </td>
    </tr>

    <tr>
        <td>
            <label for="Description" class="description">Description:</label>
        </td>
        <td>
            <textarea name="description" class="description" id="description"></textarea>
        </td>
    </tr>

    <tr>
        <td>

        </td>

        <td>
            <button type="reset" class="button-width-1" onclick="resetFields()">Cancel</button>
            <button type="submit" class="button-width-1" onclick="addCategory()">OK</button>
        </td>
    </tr>


</table>
