<?php
include '../../core/config.php';

$selected_id = $_POST[selected];
echo getEmployeePosition($selected_id);