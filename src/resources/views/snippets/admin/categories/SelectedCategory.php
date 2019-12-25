<table>
    <tr>
        <th colspan="2" class="header-form-style">Selected category</th>
    </tr>

    <tr>
        <td>
            <label for="title">Title:</label>
        </td>
        <td>
            <input type="text" name="title" id="title" value="<?php echo $data[1] ?>" disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="parent">Parent category:</label>
        </td>
        <td>
            <input type="text" name="parent" id="parent" value="<?php echo $data[2] ?> " disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="code">Code:</label>
        </td>
        <td>
            <input type="text" name="code" id="code" value="<?php echo $data[4] ?>" disabled>
        </td>
    </tr>

    <tr>
        <td>
            <label for="Description" class="description">Description:</label>
        </td>
        <td>
            <textarea name="description" class="description" id="description" disabled><?php echo $data[3] ?></textarea>
        </td>
    </tr>

    <tr>
        <td>

        </td>

        <td>
            <button type="reset" class="button-width-1" onclick="">DELETE</button>
            <button type="submit" class="button-width-1" onclick="">EDIT</button>
        </td>
    </tr>


</table>
