<?php
// Cetak informasi tentang GD
echo "GD Support: ";
if (extension_loaded('gd') && function_exists('gd_info')) {
    $gd_info = gd_info();
    echo "Enabled (version " . $gd_info['GD Version'] . ")";
} else {
    echo "Disabled";
}
