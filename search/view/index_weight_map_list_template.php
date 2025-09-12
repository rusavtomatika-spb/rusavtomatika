<table class="weight_map_list_table">       
    <colgroup><col style="width: 1%;"><col style="width: 100%;"><col style="width: 1%;"><col style="width: 1%;"><col style="width: 0;"></colgroup>
    <tr>
        <th>ID</th>
        <th>URL</th>
        <th>WEIGHT</th>
        <th>POS</th>
        <th class="td_button_delete"></th>
    </tr>
<?php
foreach ($arrResult as $row) {
    echo "<tr class='edit_row' id='{$row["id"]}'>";
    echo "<td class='read_only'>{$row["id"]}</td>";
    echo "<td data-rel-field_name = 'url'>{$row["url"]}</td>";
    echo "<td data-rel-field_name = 'weight'>{$row["weight"]}</td>";
    echo "<td data-rel-field_name = 'position'>{$row["position"]}</td>";
    echo "<td class='read_only td_button_delete'><span data-rel-id='{$row["id"]}' class='button_delete'>x</span></td>";
    echo "</tr>";
}
?>
</table>

