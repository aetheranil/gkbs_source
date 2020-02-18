<?php

require_once 'phpgen_settings.php';
require_once 'components/application.php';
require_once 'components/security/permission_set.php';
require_once 'components/security/user_authentication/table_based_user_authentication.php';
require_once 'components/security/grant_manager/user_grant_manager.php';
require_once 'components/security/grant_manager/composite_grant_manager.php';
require_once 'components/security/grant_manager/hard_coded_user_grant_manager.php';
require_once 'components/security/grant_manager/table_based_user_grant_manager.php';
require_once 'components/security/table_based_user_manager.php';

include_once 'components/security/user_identity_storage/user_identity_session_storage.php';

require_once 'database_engine/mysql_engine.php';

$grants = array();

$appGrants = array();

$dataSourceRecordPermissions = array();

$tableCaptions = array('crop_records' => 'Records',
'crop_records.crop_image' => 'Records->Image',
'crop_records.crop_image.metadata_alt' => 'Records->Image->Metadata',
'crop_records.crop_db_taxon_id' => 'Records->DB Taxon ID',
'crop_records.crop_db_taxon_id.metadata_alt' => 'Records->DB Taxon ID->Metadata',
'crop_records.crop_relative' => 'Records->Relative',
'crop_records.crop_relative.metadata_alt' => 'Records->Relative->Metadata',
'crop_records.crop_classification' => 'Records->Classification',
'crop_records.crop_classification.metadata_alt' => 'Records->Classification->Metadata',
'crop_records.crop_alternative_name' => 'Records->Alternative Name',
'crop_records.crop_alternative_name.metadata_alt' => 'Records->Alternative Name->Metadata',
'crop_records.crop_uses' => 'Records->Uses',
'crop_records.crop_uses.crop_derived_product' => 'Records->Uses->Derived Product',
'crop_records.crop_uses.crop_derived_product.crop_product_image' => 'Records->Uses->Derived Product->Product Image',
'crop_records.crop_uses.crop_derived_product.crop_product_image.metadata_alt' => 'Records->Uses->Derived Product->Product Image->Metadata',
'crop_records.crop_uses.crop_derived_product.metadata_alt' => 'Records->Uses->Derived Product->Metadata',
'crop_records.crop_uses.metadata_alt' => 'Records->Uses->Metadata',
'crop_records.crop_utilisation_status' => 'Records->Utilisation Status',
'crop_records.crop_utilisation_status.metadata_alt' => 'Records->Utilisation Status->Metadata',
'crop_records.crop_native_origin' => 'Records->Native Origin',
'crop_records.crop_native_origin.metadata_alt' => 'Records->Native Origin->Metadata',
'crop_records.crop_gc_institute' => 'Records->GC Institute',
'crop_records.crop_gc_institute.metadata_alt' => 'Records->GC Institute->Metadata',
'crop_records.n_nutrition' => 'Records->Nutrition',
'crop_records.n_nutrition.metadata_alt' => 'Records->Nutrition->Metadata',
'crop_records.n_antinutrient_and_toxicity' => 'Records->Antinutrient & Toxicity',
'crop_records.n_antinutrient_and_toxicity.metadata_alt' => 'Records->Antinutrient & Toxicity->Metadata',
'crop_records.ag_season' => 'Records->Season',
'crop_records.ag_season.metadata_alt' => 'Records->Season->Metadata',
'crop_records.ag_agroecology' => 'Records->Agroecology',
'crop_records.ag_agroecology.metadata_alt' => 'Records->Agroecology->Metadata',
'crop_records.ag_planting' => 'Records->Planting',
'crop_records.ag_planting.metadata_alt' => 'Records->Planting->Metadata',
'crop_records.ag_nutrient_application' => 'Records->Nutrient Application',
'crop_records.ag_nutrient_application.metadata_alt' => 'Records->Nutrient Application->Metadata',
'crop_records.ag_pwd_control' => 'Records->PWD Control',
'crop_records.ag_pwd_control.metadata_alt' => 'Records->PWD Control->Metadata',
'crop_records.ag_cropping_system' => 'Records->Cropping System',
'crop_records.ag_cropping_system.metadata_alt' => 'Records->Cropping System->Metadata',
'crop_records.m_potential_yield' => 'Records->Potential Yield',
'crop_records.m_potential_yield.metadata_alt' => 'Records->Potential Yield->Metadata',
'crop_records.m_production' => 'Records->Production',
'crop_records.m_production.metadata_alt' => 'Records->Production->Metadata',
'crop_records.m_crop_prices' => 'Records->Crop Prices',
'crop_records.m_crop_prices.metadata_alt' => 'Records->Crop Prices->Metadata',
'ag_agroecology' => 'Agroecology',
'ag_nutrient_application' => 'Nutrient Application',
'ag_planting' => 'Planting',
'ag_pwd_control' => 'Pest/Weed/Disease Control',
'ag_season' => 'Season',
'ag_cropping_system' => 'Cropping System',
'ag_tolerance' => 'Tolerance',
'ai_antinutrient_toxicity' => 'Antinutrient Toxicity',
'ai_antinutrient_toxicity_hint' => 'Antinutrient Toxicity Hint',
'ai_crop_classification' => 'Crop Classification',
'ai_crop_classification_hint' => 'Crop Classification Hint',
'ai_crop_classification_hint.ai_antinutrient_toxicity' => 'Crop Classification Hint->Ai Antinutrient Toxicity',
'ai_crop_classification_hint.ai_crop_classification' => 'Crop Classification Hint->Ai Crop Classification',
'ai_crop_classification_hint.ai_underutilised_status' => 'Crop Classification Hint->Ai Underutilised Status',
'ai_underutilised_status' => 'Underutilised Status',
'ai_underutilised_status_hint' => 'Underutilised Status Hint',
'crop_alternative_name' => 'Alternative Name',
'crop_classification' => 'Classification',
'crop_db_taxon_id' => 'DB Taxon ID',
'crop_derived_product' => 'Derived Product',
'crop_derived_product.crop_product_image' => 'Derived Product->Crop Product Image',
'crop_gc_institute' => 'GC Institute',
'crop_image' => 'Image',
'crop_image.crop_product_image' => 'Image->Crop Product Image',
'crop_image.metadata' => 'Image->Metadata',
'crop_native_origin' => 'Native Origin',
'crop_product_image' => 'Product Image',
'crop_uses' => 'Uses',
'crop_uses.crop_derived_product' => 'Uses->Crop Derived Product',
'crop_relative' => 'Relative',
'crop_utilisation_status' => 'Utilisation Status',
'dataset' => 'Dataset',
'metadata' => 'Metadata',
'metadata.ag_agroecology' => 'Metadata->Ag Agroecology',
'metadata.ag_cropping_system' => 'Metadata->Ag Cropping System',
'metadata.ag_nutrient_application' => 'Metadata->Ag Nutrient Application',
'metadata.ag_planting' => 'Metadata->Ag Planting',
'metadata.ag_pwd_control' => 'Metadata->Ag Pwd Control',
'metadata.ag_season' => 'Metadata->Ag Season',
'metadata.crop_alternative_name' => 'Metadata->Crop Alternative Name',
'metadata.crop_classification' => 'Metadata->Crop Classification',
'metadata.crop_db_taxon_id' => 'Metadata->Crop Db Taxon Id',
'metadata.crop_derived_product' => 'Metadata->Crop Derived Product',
'metadata.crop_gc_institute' => 'Metadata->Crop Gc Institute',
'metadata.crop_image' => 'Metadata->Crop Image',
'metadata.crop_native_origin' => 'Metadata->Crop Native Origin',
'metadata.crop_product_image' => 'Metadata->Crop Product Image',
'metadata.crop_records' => 'Metadata->Crop Records',
'metadata.crop_relative' => 'Metadata->Crop Relative',
'metadata.crop_uses' => 'Metadata->Crop Uses',
'metadata.crop_utilisation_status' => 'Metadata->Crop Utilisation Status',
'metadata.dataset' => 'Metadata->Dataset',
'metadata.m_crop_prices' => 'Metadata->M Crop Prices',
'metadata.m_potential_yield' => 'Metadata->M Potential Yield',
'metadata.m_production' => 'Metadata->M Production',
'metadata.n_antinutrient_and_toxicity' => 'Metadata->N Antinutrient And Toxicity',
'metadata.n_nutrition' => 'Metadata->N Nutrition',
'metadata.opt_cropping_system' => 'Metadata->Opt Cropping System',
'metadata.opt_crop_classification' => 'Metadata->Opt Crop Classification',
'metadata.opt_crop_stage' => 'Metadata->Opt Crop Stage',
'metadata.opt_crop_type' => 'Metadata->Opt Crop Type',
'metadata.opt_document' => 'Metadata->Opt Document',
'metadata.opt_family' => 'Metadata->Opt Family',
'metadata.opt_fertilisers' => 'Metadata->Opt Fertilisers',
'metadata.opt_gc_institute' => 'Metadata->Opt Gc Institute',
'metadata.opt_google_placeid' => 'Metadata->Opt Google Placeid',
'metadata.opt_nutrient_variable' => 'Metadata->Opt Nutrient Variable',
'metadata.opt_plant_part' => 'Metadata->Opt Plant Part',
'metadata.opt_taxonomy_db' => 'Metadata->Opt Taxonomy Db',
'metadata.opt_utilisation_status' => 'Metadata->Opt Utilisation Status',
'm_crop_prices' => 'Crop Prices',
'm_potential_yield' => 'Potential Yield',
'm_production' => 'Production',
'n_antinutrient_and_toxicity' => 'Antinutrient And Toxicity',
'n_nutrition' => 'Nutrition',
'opt_accuracy_flag' => 'Accuracy Flag',
'opt_accuracy_flag.metadata' => 'Accuracy Flag->Metadata',
'opt_city' => 'City',
'opt_city.opt_google_placeid' => 'City->Opt Google Placeid',
'opt_country' => 'Country',
'opt_country.opt_google_placeid' => 'Country->Opt Google Placeid',
'opt_cropping_system' => 'Cropping System',
'opt_cropping_system.ag_cropping_system' => 'Cropping System->Ag Cropping System',
'opt_crop_classification' => 'Crop Classification',
'opt_crop_classification.crop_classification' => 'Crop Classification->Crop Classification',
'opt_crop_stage' => 'Crop Stage',
'opt_crop_stage.ag_nutrient_application' => 'Crop Stage->Ag Nutrient Application',
'opt_crop_type' => 'Crop Type',
'opt_crop_type.crop_records' => 'Crop Type->Crop Records',
'opt_data_flag' => 'Data Flag',
'opt_data_flag.ag_season' => 'Data Flag->Ag Season',
'opt_data_flag.ag_season01' => 'Data Flag->Ag Season',
'opt_data_flag.ag_season02' => 'Data Flag->Ag Season',
'opt_data_flag.m_potential_yield' => 'Data Flag->M Potential Yield',
'opt_data_flag.n_nutrition' => 'Data Flag->N Nutrition',
'opt_document' => 'Document',
'opt_document.dataset' => 'Document->Dataset',
'opt_document.metadata' => 'Document->Metadata',
'opt_employee' => 'Employee',
'opt_employee.metadata' => 'Employee->Metadata',
'opt_family' => 'Family',
'opt_family.crop_records' => 'Family->Crop Records',
'opt_fertilisers' => 'Fertilisers',
'opt_fertilisers.ag_nutrient_application' => 'Fertilisers->Ag Nutrient Application',
'opt_gc_institute' => 'GC Institute',
'opt_gc_institute.crop_gc_institute' => 'GC Institute->Crop Gc Institute',
'opt_google_placeid' => 'Google PlaceID',
'opt_google_placeid.ag_agroecology' => 'Google PlaceID->Ag Agroecology',
'opt_google_placeid.ag_season' => 'Google PlaceID->Ag Season',
'opt_google_placeid.crop_alternative_name' => 'Google PlaceID->Crop Alternative Name',
'opt_google_placeid.crop_native_origin' => 'Google PlaceID->Crop Native Origin',
'opt_google_placeid.crop_utilisation_status' => 'Google PlaceID->Crop Utilisation Status',
'opt_google_placeid.metadata' => 'Google PlaceID->Metadata',
'opt_google_placeid.m_crop_prices' => 'Google PlaceID->M Crop Prices',
'opt_google_placeid.m_potential_yield' => 'Google PlaceID->M Potential Yield',
'opt_google_placeid.m_production' => 'Google PlaceID->M Production',
'opt_month' => 'Month',
'opt_month.m_crop_prices' => 'Month->M Crop Prices',
'opt_nutrient_variable' => 'Nutrient Variable',
'opt_nutrient_variable.n_nutrition' => 'Nutrient Variable->N Nutrition',
'opt_pest_weed_disease' => 'Pest Weed Disease',
'opt_pest_weed_disease.ag_pwd_control' => 'Pest Weed Disease->Ag Pwd Control',
'opt_plant_part' => 'Plant Part',
'opt_plant_part.crop_uses' => 'Plant Part->Crop Uses',
'opt_plant_part.m_crop_prices' => 'Plant Part->M Crop Prices',
'opt_plant_part.m_potential_yield' => 'Plant Part->M Potential Yield',
'opt_plant_part.m_production' => 'Plant Part->M Production',
'opt_plant_part.n_antinutrient_and_toxicity' => 'Plant Part->N Antinutrient And Toxicity',
'opt_plant_part.n_nutrition' => 'Plant Part->N Nutrition',
'opt_price_unit' => 'Price Unit',
'opt_price_unit.m_crop_prices' => 'Price Unit->M Crop Prices',
'opt_sale_point' => 'Sale Point',
'opt_sale_point.m_crop_prices' => 'Sale Point->M Crop Prices',
'opt_infraspecific_category' => 'Infraspecific Category',
'opt_infraspecific_category.crop_records' => 'Infraspecific Category->Crop Records',
'opt_taxonomy_db' => 'Taxonomy DB',
'opt_uses' => 'Uses',
'opt_uses.crop_uses' => 'Uses->Crop Uses',
'opt_utilisation_status' => 'Utilisation Status',
'opt_utilisation_status.crop_utilisation_status' => 'Utilisation Status->Crop Utilisation Status',
'opt_year' => 'Year',
'opt_year.m_crop_prices' => 'Year->M Crop Prices',
'opt_year.m_potential_yield' => 'Year->M Potential Yield',
'opt_year.m_production' => 'Year->M Production',
'opt_weight_basis' => 'Weight Basis',
'metadata_alt01' => 'Metadata',
'focus_crop' => 'Focus Crop');

$usersTableInfo = array(
    'TableName' => 'phpgen_users',
    'UserId' => 'user_id',
    'UserName' => 'user_name',
    'Password' => 'user_password',
    'Email' => '',
    'UserToken' => '',
    'UserStatus' => ''
);

function EncryptPassword($password, &$result)
{

}

function VerifyPassword($enteredPassword, $encryptedPassword, &$result)
{

}

function BeforeUserRegistration($username, $email, $password, &$allowRegistration, &$errorMessage)
{

}    

function AfterUserRegistration($username, $email)
{

}    

function PasswordResetRequest($username, $email)
{

}

function PasswordResetComplete($username, $email)
{

}

function CreatePasswordHasher()
{
    $hasher = CreateHasher('');
    if ($hasher instanceof CustomStringHasher) {
        $hasher->OnEncryptPassword->AddListener('EncryptPassword');
        $hasher->OnVerifyPassword->AddListener('VerifyPassword');
    }
    return $hasher;
}

function CreateTableBasedGrantManager()
{
    global $tableCaptions;
    global $usersTableInfo;
    $userPermsTableInfo = array('TableName' => 'phpgen_user_perms', 'UserId' => 'user_id', 'PageName' => 'page_name', 'Grant' => 'perm_name');
    
    $tableBasedGrantManager = new TableBasedUserGrantManager(MySqlIConnectionFactory::getInstance(), GetGlobalConnectionOptions(),
        $usersTableInfo, $userPermsTableInfo, $tableCaptions, false);
    return $tableBasedGrantManager;
}

function CreateTableBasedUserManager() {
    global $usersTableInfo;
    return new TableBasedUserManager(MySqlIConnectionFactory::getInstance(), GetGlobalConnectionOptions(), $usersTableInfo, CreatePasswordHasher(), false);
}

function SetUpUserAuthorization()
{
    global $grants;
    global $appGrants;
    global $dataSourceRecordPermissions;

    $hasher = CreatePasswordHasher();

    $hardCodedGrantManager = new HardCodedUserGrantManager($grants, $appGrants);
    $tableBasedGrantManager = CreateTableBasedGrantManager();
    $grantManager = new CompositeGrantManager();
    $grantManager->AddGrantManager($hardCodedGrantManager);
    if (!is_null($tableBasedGrantManager)) {
        $grantManager->AddGrantManager($tableBasedGrantManager);
    }

    $userAuthentication = new TableBasedUserAuthentication(new UserIdentitySessionStorage(), false, $hasher, CreateTableBasedUserManager(), true, false, false);

    GetApplication()->SetUserAuthentication($userAuthentication);
    GetApplication()->SetUserGrantManager($grantManager);
    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}
