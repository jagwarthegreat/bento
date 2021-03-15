<?php
include '../../core/config.php';

$selected_id = $_POST['selected'];
echo getProdCategory($selected_id);
