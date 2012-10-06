<?php

add_theme_support( 'custom-background' );

require_once locate_template('/lib/customizer/customizer-sections.php');        // Create Customizer Sections
require_once locate_template('/lib/customizer/customizer-settings.php');        // Create Customizer Settings
require_once locate_template('/lib/customizer/customizer-controls.php');        // Create Customizer Controls

require_once locate_template('/lib/customizer/extra-customizer-functions.php'); // Extra Functions for the customizer
require_once locate_template('/lib/customizer/customizer-output.php');          // Extra Functions for the customizer
require_once locate_template('/lib/customizer/customizer-logo.php');            // Customizer Logo functions
