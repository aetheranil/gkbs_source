<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';
include_once dirname(__FILE__) . '/' . 'components/mail/mailer.php';
include_once dirname(__FILE__) . '/' . 'components/mail/phpmailer_based_mailer.php';
require_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('Asia/Brunei');

function GetGlobalConnectionOptions()
{
    return
        array(
          'server' => '',
          'port' => '3306',
          'username' => '',
          'password' => '',
          'database' => 'cropbase_5_0_3',
          'client_encoding' => 'utf8'
        );
}

function HasAdminPage()
{
    return true;
}

function HasHomePage()
{
    return true;
}

function GetHomeURL()
{
    return 'index.php';
}

function GetHomePageBanner()
{
    return '';
}

function GetPageGroups()
{
    $result = array();
    $result[] = array('caption' => 'Crop', 'description' => '');
    $result[] = array('caption' => 'Nutrition', 'description' => '');
    $result[] = array('caption' => 'Agro', 'description' => '');
    $result[] = array('caption' => 'Market', 'description' => '');
    $result[] = array('caption' => 'Opt', 'description' => '');
    $result[] = array('caption' => 'Dataset', 'description' => '');
    $result[] = array('caption' => 'AI', 'description' => '');
    $result[] = array('caption' => 'Metadata', 'description' => '');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Records', 'short_caption' => 'Crop Records', 'filename' => 'crop_records.php', 'name' => 'crop_records', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Agroecology', 'short_caption' => 'Agroecology', 'filename' => 'ag_agroecology.php', 'name' => 'ag_agroecology', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Nutrient Application', 'short_caption' => 'Nutrient Application', 'filename' => 'ag_nutrient_application.php', 'name' => 'ag_nutrient_application', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Planting', 'short_caption' => 'Planting', 'filename' => 'ag_planting.php', 'name' => 'ag_planting', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Pest/Weed/Disease Control', 'short_caption' => 'PWD Control', 'filename' => 'ag_pwd_control.php', 'name' => 'ag_pwd_control', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Season', 'short_caption' => 'Season', 'filename' => 'ag_season.php', 'name' => 'ag_season', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Cropping System', 'short_caption' => 'Cropping System', 'filename' => 'ag_cropping_system.php', 'name' => 'ag_cropping_system', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Tolerance', 'short_caption' => 'Tolerance', 'filename' => 'ag_tolerance.php', 'name' => 'ag_tolerance', 'group_name' => 'Agro', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Antinutrient Toxicity', 'short_caption' => 'Ai Antinutrient Toxicity', 'filename' => 'ai_antinutrient_toxicity.php', 'name' => 'ai_antinutrient_toxicity', 'group_name' => 'AI', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Antinutrient Toxicity Hint', 'short_caption' => 'Ai Antinutrient Toxicity Hint', 'filename' => 'ai_antinutrient_toxicity_hint.php', 'name' => 'ai_antinutrient_toxicity_hint', 'group_name' => 'AI', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Crop Classification', 'short_caption' => 'Ai Crop Classification', 'filename' => 'ai_crop_classification.php', 'name' => 'ai_crop_classification', 'group_name' => 'AI', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Crop Classification Hint', 'short_caption' => 'Ai Crop Classification Hint', 'filename' => 'ai_crop_classification_hint.php', 'name' => 'ai_crop_classification_hint', 'group_name' => 'AI', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Underutilised Status', 'short_caption' => 'Ai Underutilised Status', 'filename' => 'ai_underutilised_status.php', 'name' => 'ai_underutilised_status', 'group_name' => 'AI', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Underutilised Status Hint', 'short_caption' => 'Ai Underutilised Status Hint', 'filename' => 'ai_underutilised_status_hint.php', 'name' => 'ai_underutilised_status_hint', 'group_name' => 'AI', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Alternative Name', 'short_caption' => 'Alternative Name', 'filename' => 'crop_alternative_name.php', 'name' => 'crop_alternative_name', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Classification', 'short_caption' => 'Crop Classification', 'filename' => 'crop_classification.php', 'name' => 'crop_classification', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'DB Taxon ID', 'short_caption' => 'DB Taxon ID', 'filename' => 'crop_db_taxon_id.php', 'name' => 'crop_db_taxon_id', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Derived Product', 'short_caption' => 'Derived Product', 'filename' => 'crop_derived_product.php', 'name' => 'crop_derived_product', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'GC Institute', 'short_caption' => 'GC Institute', 'filename' => 'crop_gc_institute.php', 'name' => 'crop_gc_institute', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Image', 'short_caption' => 'Image', 'filename' => 'crop_image.php', 'name' => 'crop_image', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Native Origin', 'short_caption' => 'Native Origin', 'filename' => 'crop_native_origin.php', 'name' => 'crop_native_origin', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Product Image', 'short_caption' => 'Product Image', 'filename' => 'crop_product_image.php', 'name' => 'crop_product_image', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Uses', 'short_caption' => 'Uses', 'filename' => 'crop_uses.php', 'name' => 'crop_uses', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Relative', 'short_caption' => 'Relative', 'filename' => 'crop_relative.php', 'name' => 'crop_relative', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Utilisation Status', 'short_caption' => 'Utilisation Status', 'filename' => 'crop_utilisation_status.php', 'name' => 'crop_utilisation_status', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Dataset', 'short_caption' => 'Dataset', 'filename' => 'dataset.php', 'name' => 'dataset', 'group_name' => 'Dataset', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Crop Prices', 'short_caption' => 'Crop Prices', 'filename' => 'm_crop_prices.php', 'name' => 'm_crop_prices', 'group_name' => 'Market', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Potential Yield', 'short_caption' => 'Potential Yield', 'filename' => 'm_potential_yield.php', 'name' => 'm_potential_yield', 'group_name' => 'Market', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Production', 'short_caption' => 'Production', 'filename' => 'm_production.php', 'name' => 'm_production', 'group_name' => 'Market', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Antinutrient And Toxicity', 'short_caption' => 'Antinutrient & Toxicity', 'filename' => 'n_antinutrient_and_toxicity.php', 'name' => 'n_antinutrient_and_toxicity', 'group_name' => 'Nutrition', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Nutrition', 'short_caption' => 'Nutrition', 'filename' => 'n_nutrition.php', 'name' => 'n_nutrition', 'group_name' => 'Nutrition', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Accuracy Flag', 'short_caption' => 'Opt Accuracy Flag', 'filename' => 'opt_accuracy_flag.php', 'name' => 'opt_accuracy_flag', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'City', 'short_caption' => 'Opt City', 'filename' => 'opt_city.php', 'name' => 'opt_city', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Country', 'short_caption' => 'Opt Country', 'filename' => 'opt_country.php', 'name' => 'opt_country', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Cropping System', 'short_caption' => 'Opt Cropping System', 'filename' => 'opt_cropping_system.php', 'name' => 'opt_cropping_system', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Crop Classification', 'short_caption' => 'Opt Crop Classification', 'filename' => 'opt_crop_classification.php', 'name' => 'opt_crop_classification', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Crop Stage', 'short_caption' => 'Opt Crop Stage', 'filename' => 'opt_crop_stage.php', 'name' => 'opt_crop_stage', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Crop Type', 'short_caption' => 'Opt Crop Type', 'filename' => 'opt_crop_type.php', 'name' => 'opt_crop_type', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Data Flag', 'short_caption' => 'Opt Data Flag', 'filename' => 'opt_data_flag.php', 'name' => 'opt_data_flag', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Employee', 'short_caption' => 'Opt Employee', 'filename' => 'opt_employee.php', 'name' => 'opt_employee', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Family', 'short_caption' => 'Opt Family', 'filename' => 'opt_family.php', 'name' => 'opt_family', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Fertilisers', 'short_caption' => 'Opt Fertilisers', 'filename' => 'opt_fertilisers.php', 'name' => 'opt_fertilisers', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'GC Institute', 'short_caption' => 'Opt Gc Institute', 'filename' => 'opt_gc_institute.php', 'name' => 'opt_gc_institute', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Google PlaceID', 'short_caption' => 'Opt Google PlaceID', 'filename' => 'opt_google_placeid.php', 'name' => 'opt_google_placeid', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Month', 'short_caption' => 'Opt Month', 'filename' => 'opt_month.php', 'name' => 'opt_month', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Nutrient Variable', 'short_caption' => 'Opt Nutrient Variable', 'filename' => 'opt_nutrient_variable.php', 'name' => 'opt_nutrient_variable', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Pest Weed Disease', 'short_caption' => 'Opt Pest Weed Disease', 'filename' => 'opt_pest_weed_disease.php', 'name' => 'opt_pest_weed_disease', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Plant Part', 'short_caption' => 'Opt Plant Part', 'filename' => 'opt_plant_part.php', 'name' => 'opt_plant_part', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Price Unit', 'short_caption' => 'Opt Price Unit', 'filename' => 'opt_price_unit.php', 'name' => 'opt_price_unit', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Sale Point', 'short_caption' => 'Opt Sale Point', 'filename' => 'opt_sale_point.php', 'name' => 'opt_sale_point', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Infraspecific Category', 'short_caption' => 'Opt Infraspecific Category', 'filename' => 'opt_infraspecific_category.php', 'name' => 'opt_infraspecific_category', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Taxonomy DB', 'short_caption' => 'Opt Taxonomy DB', 'filename' => 'opt_taxonomy_db.php', 'name' => 'opt_taxonomy_db', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Uses', 'short_caption' => 'Opt Uses', 'filename' => 'opt_uses.php', 'name' => 'opt_uses', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Utilisation Status', 'short_caption' => 'Opt Utilisation Status', 'filename' => 'opt_utilisation_status.php', 'name' => 'opt_utilisation_status', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Year', 'short_caption' => 'Opt Year', 'filename' => 'opt_year.php', 'name' => 'opt_year', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Weight Basis', 'short_caption' => 'Opt Weight Basis', 'filename' => 'opt_weight_basis.php', 'name' => 'opt_weight_basis', 'group_name' => 'Opt', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Metadata', 'short_caption' => 'Metadata', 'filename' => 'metadata.php', 'name' => 'metadata_alt01', 'group_name' => 'Metadata', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Focus Crop', 'short_caption' => 'Focus Crop', 'filename' => 'focus_crop.php', 'name' => 'focus_crop', 'group_name' => 'Crop', 'add_separator' => false, 'description' => '');
    return $result;
}

function GetPagesHeader()
{
    return
        '';
}

function GetPagesFooter()
{
    return
        '';
}

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->setShowNavigation(true);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $page->OnGetCustomExportOptions->AddListener('Global_OnGetCustomExportOptions');
    $page->getDataset()->OnGetFieldValue->AddListener('Global_OnGetFieldValue');
    $page->getDataset()->OnGetFieldValue->AddListener('OnGetFieldValue', $page);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
    $grid->AfterUpdateRecord->AddListener('Global_AfterUpdateHandler');
    $grid->AfterDeleteRecord->AddListener('Global_AfterDeleteHandler');
    $grid->AfterInsertRecord->AddListener('Global_AfterInsertHandler');
}

function GetAnsiEncoding() { return 'windows-1252'; }

function Global_OnGetCustomPagePermissionsHandler(Page $page, PermissionSet &$permissions, &$handled)
{

}

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($type, $part, $mode, &$result, &$params, CommonPage $page = null)
{

}

function Global_OnGetCustomExportOptions($page, $exportType, $rowData, &$options)
{

}

function Global_OnGetFieldValue($fieldName, &$value, $tableName)
{

}

function Global_GetCustomPageList(CommonPage $page, PageList $pageList)
{

}

function Global_BeforeInsertHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeUpdateHandler($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_AfterInsertHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterUpdateHandler($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterDeleteHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetPageListType()
{
    return PageList::TYPE_MENU;
}

function GetNullLabel()
{
    return null;
}

function UseMinifiedJS()
{
    return true;
}

function GetOfflineMode()
{
    return false;
}

function GetInactivityTimeout()
{
    return 0;
}

function GetMailer()
{
    $mailerOptions = new MailerOptions(MailerType::Sendmail, '', '');
    
    return PHPMailerBasedMailer::getInstance($mailerOptions);
}

function sendMailMessage($recipients, $messageSubject, $messageBody, $attachments = '', $cc = '', $bcc = '')
{
    GetMailer()->send($recipients, $messageSubject, $messageBody, $attachments, $cc, $bcc);
}

function createConnection()
{
    $connectionOptions = GetGlobalConnectionOptions();
    $connectionOptions['client_encoding'] = 'utf8';

    $connectionFactory = MySqlIConnectionFactory::getInstance();
    return $connectionFactory->CreateConnection($connectionOptions);
}
