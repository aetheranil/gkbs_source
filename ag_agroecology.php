<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class ag_agroecologyPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Agroecology');
            $this->SetMenuLabel('Agroecology');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ag_agroecology`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new IntegerField('location_id'),
                    new IntegerField('zone_a'),
                    new IntegerField('zone_b'),
                    new IntegerField('zone_c'),
                    new IntegerField('zone_d'),
                    new IntegerField('zone_e'),
                    new StringField('climate_zone'),
                    new IntegerField('altitude_optimal_max'),
                    new IntegerField('altitude_optimal_mean'),
                    new IntegerField('altitude_optimal_min'),
                    new IntegerField('altitude_absolute_max'),
                    new IntegerField('altitude_absolute_mean'),
                    new IntegerField('altitude_absolute_min'),
                    new IntegerField('latitude_optimal_max'),
                    new IntegerField('latitude_optimal_mean'),
                    new IntegerField('latitude_optimal_min'),
                    new IntegerField('latitude_absolute_max'),
                    new IntegerField('latitude_absolute_mean'),
                    new IntegerField('latitude_absolute_min'),
                    new StringField('light_optimal_max'),
                    new StringField('light_optimal_mean'),
                    new StringField('light_optimal_min'),
                    new StringField('light_absolute_max'),
                    new StringField('light_absolute_mean'),
                    new StringField('light_absolute_min'),
                    new IntegerField('optimal_aspect_max'),
                    new IntegerField('optimal_aspect_mean'),
                    new IntegerField('optimal_aspect_min'),
                    new IntegerField('optimal_slope_max'),
                    new IntegerField('optimal_slope_mean'),
                    new IntegerField('optimal_slope_min'),
                    new IntegerField('photoperiod_long'),
                    new IntegerField('photoperiod_neutral'),
                    new IntegerField('photoperiod_short'),
                    new StringField('production_system'),
                    new IntegerField('rainfall_optimal_max'),
                    new IntegerField('rainfall_optimal_mean'),
                    new IntegerField('rainfall_optimal_min'),
                    new IntegerField('rainfall_absolute_max'),
                    new IntegerField('rainfall_absolute_mean'),
                    new IntegerField('rainfall_absolute_min'),
                    new IntegerField('heavymetal_toxicity_optimal_high'),
                    new IntegerField('heavymetal_toxicity_optimal_moderate'),
                    new IntegerField('heavymetal_toxicity_optimal_low'),
                    new IntegerField('heavymetal_toxicity_absolute_high'),
                    new IntegerField('heavymetal_toxicity_absolute_moderate'),
                    new IntegerField('heavymetal_toxicity_absolute_low'),
                    new IntegerField('soil_depth_optimal_deep'),
                    new IntegerField('soil_depth_optimal_medium'),
                    new IntegerField('soil_depth_optimal_low'),
                    new IntegerField('soil_depth_absolute_deep'),
                    new IntegerField('soil_depth_absolute_medium'),
                    new IntegerField('soil_depth_absolute_low'),
                    new IntegerField('soil_fertility_optimal_high'),
                    new IntegerField('soil_fertility_optimal_moderate'),
                    new IntegerField('soil_fertility_optimal_low'),
                    new IntegerField('soil_fertility_absolute_high'),
                    new IntegerField('soil_fertility_absolute_moderate'),
                    new IntegerField('soil_fertility_absolute_low'),
                    new IntegerField('soil_ph_optimal_max'),
                    new IntegerField('soil_ph_optimal_mean'),
                    new IntegerField('soil_ph_optimal_min'),
                    new IntegerField('soil_ph_absolute_max'),
                    new IntegerField('soil_ph_absolute_mean'),
                    new IntegerField('soil_ph_absolute_min'),
                    new IntegerField('soil_salinity_optimal_high'),
                    new IntegerField('soil_salinity_optimal_moderate'),
                    new IntegerField('soil_salinity_optimal_low'),
                    new IntegerField('soil_salinity_absolute_high'),
                    new IntegerField('soil_salinity_absolute_moderate'),
                    new IntegerField('soil_salinity_absolute_low'),
                    new IntegerField('soil_texture_optimal_heavy'),
                    new IntegerField('soil_texture_optimal_medium'),
                    new IntegerField('soil_texture_optimal_light'),
                    new IntegerField('soil_texture_absolute_heavy'),
                    new IntegerField('soil_texture_absolute_medium'),
                    new IntegerField('soil_texture_absolute_light'),
                    new IntegerField('temperature_optimal_max'),
                    new IntegerField('temperature_optimal_mean'),
                    new IntegerField('temperature_optimal_min'),
                    new IntegerField('temperature_absolute_max'),
                    new IntegerField('temperature_absolute_mean'),
                    new IntegerField('temperature_absolute_min'),
                    new IntegerField('texture_clay_max'),
                    new IntegerField('texture_clay_mean'),
                    new IntegerField('texture_clay_min'),
                    new IntegerField('texture_sand_max'),
                    new IntegerField('texture_sand_mean'),
                    new IntegerField('texture_sand_min'),
                    new IntegerField('texture_silt_max'),
                    new IntegerField('texture_silt_mean'),
                    new IntegerField('texture_silt_min'),
                    new IntegerField('water_requirement_max'),
                    new IntegerField('water_requirement_mean'),
                    new IntegerField('water_requirement_min'),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $this->dataset->AddLookupField('cropid', 'crop_records', new IntegerField('id'), new StringField('name', false, false, false, false, 'cropid_name', 'cropid_name_crop_records'), 'cropid_name_crop_records');
            $this->dataset->AddLookupField('location_id', 'opt_google_placeid', new IntegerField('id'), new StringField('google_place_id', false, false, false, false, 'location_id_google_place_id', 'location_id_google_place_id_opt_google_placeid'), 'location_id_google_place_id_opt_google_placeid');
            $this->dataset->AddLookupField('metadata_id', 'metadata_alt', new IntegerField('id'), new IntegerField('id', false, false, false, false, 'metadata_id_id', 'metadata_id_id_metadata_alt'), 'metadata_id_id_metadata_alt');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Agroecology ID'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Crop ID'),
                new FilterColumn($this->dataset, 'location_id', 'location_id_google_place_id', 'Location ID'),
                new FilterColumn($this->dataset, 'zone_a', 'zone_a', 'Zone A'),
                new FilterColumn($this->dataset, 'zone_b', 'zone_b', 'Zone B'),
                new FilterColumn($this->dataset, 'zone_c', 'zone_c', 'Zone C'),
                new FilterColumn($this->dataset, 'zone_d', 'zone_d', 'Zone D'),
                new FilterColumn($this->dataset, 'zone_e', 'zone_e', 'Zone E'),
                new FilterColumn($this->dataset, 'climate_zone', 'climate_zone', 'Climate Zone'),
                new FilterColumn($this->dataset, 'altitude_optimal_max', 'altitude_optimal_max', 'Altitude Optimal Max (m)'),
                new FilterColumn($this->dataset, 'altitude_optimal_mean', 'altitude_optimal_mean', 'Altitude Optimal Mean (m)'),
                new FilterColumn($this->dataset, 'altitude_optimal_min', 'altitude_optimal_min', 'Altitude Optimal Min (m)'),
                new FilterColumn($this->dataset, 'altitude_absolute_max', 'altitude_absolute_max', 'Altitude Absolute Max (m)'),
                new FilterColumn($this->dataset, 'altitude_absolute_mean', 'altitude_absolute_mean', 'Altitude Absolute Mean (m)'),
                new FilterColumn($this->dataset, 'altitude_absolute_min', 'altitude_absolute_min', 'Altitude Absolute Min (m)'),
                new FilterColumn($this->dataset, 'latitude_optimal_max', 'latitude_optimal_max', 'Latitude Optimal Max (Degree North/South)'),
                new FilterColumn($this->dataset, 'latitude_optimal_mean', 'latitude_optimal_mean', 'Latitude Optimal Mean (Degree North/South)'),
                new FilterColumn($this->dataset, 'latitude_optimal_min', 'latitude_optimal_min', 'Latitude Optimal Min (Degree North/South)'),
                new FilterColumn($this->dataset, 'latitude_absolute_max', 'latitude_absolute_max', 'Latitude Absolute Max (Degree North/South)'),
                new FilterColumn($this->dataset, 'latitude_absolute_mean', 'latitude_absolute_mean', 'Latitude Absolute Mean (Degree North/South)'),
                new FilterColumn($this->dataset, 'latitude_absolute_min', 'latitude_absolute_min', 'Latitude Absolute Min (Degree North/South)'),
                new FilterColumn($this->dataset, 'light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max'),
                new FilterColumn($this->dataset, 'light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean'),
                new FilterColumn($this->dataset, 'light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min'),
                new FilterColumn($this->dataset, 'light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max'),
                new FilterColumn($this->dataset, 'light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean'),
                new FilterColumn($this->dataset, 'light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min'),
                new FilterColumn($this->dataset, 'optimal_aspect_max', 'optimal_aspect_max', 'Optimal Aspect Max (Degree)'),
                new FilterColumn($this->dataset, 'optimal_aspect_mean', 'optimal_aspect_mean', 'Optimal Aspect Mean (Degree)'),
                new FilterColumn($this->dataset, 'optimal_aspect_min', 'optimal_aspect_min', 'Optimal Aspect Min (Degree)'),
                new FilterColumn($this->dataset, 'optimal_slope_max', 'optimal_slope_max', 'Optimal Slope Max (%)'),
                new FilterColumn($this->dataset, 'optimal_slope_mean', 'optimal_slope_mean', 'Optimal Slope Mean (%)'),
                new FilterColumn($this->dataset, 'optimal_slope_min', 'optimal_slope_min', 'Optimal Slope Min (%)'),
                new FilterColumn($this->dataset, 'photoperiod_long', 'photoperiod_long', 'Photoperiod Long (>14 hours)'),
                new FilterColumn($this->dataset, 'photoperiod_neutral', 'photoperiod_neutral', 'Photoperiod Neutral (12-14 hours)'),
                new FilterColumn($this->dataset, 'photoperiod_short', 'photoperiod_short', 'Photoperiod Short (<12 hours)'),
                new FilterColumn($this->dataset, 'production_system', 'production_system', 'Production System'),
                new FilterColumn($this->dataset, 'rainfall_optimal_max', 'rainfall_optimal_max', 'Rainfall Optimal Max (mm/Year)'),
                new FilterColumn($this->dataset, 'rainfall_optimal_mean', 'rainfall_optimal_mean', 'Rainfall Optimal Mean (mm/Year)'),
                new FilterColumn($this->dataset, 'rainfall_optimal_min', 'rainfall_optimal_min', 'Rainfall Optimal Minimum (mm/Year)'),
                new FilterColumn($this->dataset, 'rainfall_absolute_max', 'rainfall_absolute_max', 'Rainfall Absolute Maximum (mm/Year)'),
                new FilterColumn($this->dataset, 'rainfall_absolute_mean', 'rainfall_absolute_mean', 'Rainfall Absolute Mean (mm/Year)'),
                new FilterColumn($this->dataset, 'rainfall_absolute_min', 'rainfall_absolute_min', 'Rainfall Absolute Minimum (mm/Year)'),
                new FilterColumn($this->dataset, 'heavymetal_toxicity_optimal_high', 'heavymetal_toxicity_optimal_high', 'Heavymetal Toxicity Optimal High'),
                new FilterColumn($this->dataset, 'heavymetal_toxicity_optimal_moderate', 'heavymetal_toxicity_optimal_moderate', 'Heavymetal Toxicity Optimal Moderate'),
                new FilterColumn($this->dataset, 'heavymetal_toxicity_optimal_low', 'heavymetal_toxicity_optimal_low', 'Heavymetal Toxicity Optimal Low'),
                new FilterColumn($this->dataset, 'heavymetal_toxicity_absolute_high', 'heavymetal_toxicity_absolute_high', 'Heavymetal Toxicity Absolute High'),
                new FilterColumn($this->dataset, 'heavymetal_toxicity_absolute_moderate', 'heavymetal_toxicity_absolute_moderate', 'Heavymetal Toxicity Absolute Moderate'),
                new FilterColumn($this->dataset, 'heavymetal_toxicity_absolute_low', 'heavymetal_toxicity_absolute_low', 'Heavymetal Toxicity Absolute Low'),
                new FilterColumn($this->dataset, 'soil_depth_optimal_deep', 'soil_depth_optimal_deep', 'Soil Depth Optimal Deep (>150cm)'),
                new FilterColumn($this->dataset, 'soil_depth_optimal_medium', 'soil_depth_optimal_medium', 'Soil Depth Optimal Medium (50 - 150cm)'),
                new FilterColumn($this->dataset, 'soil_depth_optimal_low', 'soil_depth_optimal_low', 'Soil Depth Optimal Low (< 50cm)'),
                new FilterColumn($this->dataset, 'soil_depth_absolute_deep', 'soil_depth_absolute_deep', 'Soil Depth Absolute Deep (>150cm)'),
                new FilterColumn($this->dataset, 'soil_depth_absolute_medium', 'soil_depth_absolute_medium', 'Soil Depth Absolute Medium (50-150cm)'),
                new FilterColumn($this->dataset, 'soil_depth_absolute_low', 'soil_depth_absolute_low', 'Soil Depth Absolute Low (<50cm)'),
                new FilterColumn($this->dataset, 'soil_fertility_optimal_high', 'soil_fertility_optimal_high', 'Soil Fertility Optimal High'),
                new FilterColumn($this->dataset, 'soil_fertility_optimal_moderate', 'soil_fertility_optimal_moderate', 'Soil Fertility Optimal Moderate'),
                new FilterColumn($this->dataset, 'soil_fertility_optimal_low', 'soil_fertility_optimal_low', 'Soil Fertility Optimal Low'),
                new FilterColumn($this->dataset, 'soil_fertility_absolute_high', 'soil_fertility_absolute_high', 'Soil Fertility Absolute High'),
                new FilterColumn($this->dataset, 'soil_fertility_absolute_moderate', 'soil_fertility_absolute_moderate', 'Soil Fertility Absolute Moderate'),
                new FilterColumn($this->dataset, 'soil_fertility_absolute_low', 'soil_fertility_absolute_low', 'Soil Fertility Absolute Low'),
                new FilterColumn($this->dataset, 'soil_ph_optimal_max', 'soil_ph_optimal_max', 'Soil pH Optimal Max'),
                new FilterColumn($this->dataset, 'soil_ph_optimal_mean', 'soil_ph_optimal_mean', 'Soil pH Optimal Mean'),
                new FilterColumn($this->dataset, 'soil_ph_optimal_min', 'soil_ph_optimal_min', 'Soil pH Optimal Min'),
                new FilterColumn($this->dataset, 'soil_ph_absolute_max', 'soil_ph_absolute_max', 'Soil pH Absolute Max'),
                new FilterColumn($this->dataset, 'soil_ph_absolute_mean', 'soil_ph_absolute_mean', 'Soil pH Absolute Mean'),
                new FilterColumn($this->dataset, 'soil_ph_absolute_min', 'soil_ph_absolute_min', 'Soil pH Absolute Min'),
                new FilterColumn($this->dataset, 'soil_salinity_optimal_high', 'soil_salinity_optimal_high', 'Soil Salinity Optimal High (>10 dS/m)'),
                new FilterColumn($this->dataset, 'soil_salinity_optimal_moderate', 'soil_salinity_optimal_moderate', 'Soil Salinity Optimal Moderate (4-10dS/m)'),
                new FilterColumn($this->dataset, 'soil_salinity_optimal_low', 'soil_salinity_optimal_low', 'Soil Salinity Optimal Low (<4 dS/m)'),
                new FilterColumn($this->dataset, 'soil_salinity_absolute_high', 'soil_salinity_absolute_high', 'Soil Salinity Absolute High (10 dS/m)'),
                new FilterColumn($this->dataset, 'soil_salinity_absolute_moderate', 'soil_salinity_absolute_moderate', 'Soil Salinity Absolute Moderate (4-10dS/m)'),
                new FilterColumn($this->dataset, 'soil_salinity_absolute_low', 'soil_salinity_absolute_low', 'Soil Salinity Absolute Low (<4 dS/m)'),
                new FilterColumn($this->dataset, 'soil_texture_optimal_heavy', 'soil_texture_optimal_heavy', 'Soil Texture Optimal Heavy'),
                new FilterColumn($this->dataset, 'soil_texture_optimal_medium', 'soil_texture_optimal_medium', 'Soil Texture Optimal Medium'),
                new FilterColumn($this->dataset, 'soil_texture_optimal_light', 'soil_texture_optimal_light', 'Soil Texture Optimal Light'),
                new FilterColumn($this->dataset, 'soil_texture_absolute_heavy', 'soil_texture_absolute_heavy', 'Soil Texture Absolute Heavy'),
                new FilterColumn($this->dataset, 'soil_texture_absolute_medium', 'soil_texture_absolute_medium', 'Soil Texture Absolute Medium'),
                new FilterColumn($this->dataset, 'soil_texture_absolute_light', 'soil_texture_absolute_light', 'Soil Texture Absolute Light'),
                new FilterColumn($this->dataset, 'temperature_optimal_max', 'temperature_optimal_max', 'Temperature Optimal Max (Degree Celcius)'),
                new FilterColumn($this->dataset, 'temperature_optimal_mean', 'temperature_optimal_mean', 'Temperature Optimal Mean (Degree Celcius)'),
                new FilterColumn($this->dataset, 'temperature_optimal_min', 'temperature_optimal_min', 'Temperature Optimal Min (Degree Celcius)'),
                new FilterColumn($this->dataset, 'temperature_absolute_max', 'temperature_absolute_max', 'Temperature Absolute Max (Degree Celcius)'),
                new FilterColumn($this->dataset, 'temperature_absolute_mean', 'temperature_absolute_mean', 'Temperature Absolute Mean (Degree Celcius)'),
                new FilterColumn($this->dataset, 'temperature_absolute_min', 'temperature_absolute_min', 'Temperature Absolute Min (Degree Celcius)'),
                new FilterColumn($this->dataset, 'texture_clay_max', 'texture_clay_max', 'Texture Clay Max (%)'),
                new FilterColumn($this->dataset, 'texture_clay_mean', 'texture_clay_mean', 'Texture Clay Mean (%)'),
                new FilterColumn($this->dataset, 'texture_clay_min', 'texture_clay_min', 'Texture Clay Min (%)'),
                new FilterColumn($this->dataset, 'texture_sand_max', 'texture_sand_max', 'Texture Sand Max (%)'),
                new FilterColumn($this->dataset, 'texture_sand_mean', 'texture_sand_mean', 'Texture Sand Mean (%)'),
                new FilterColumn($this->dataset, 'texture_sand_min', 'texture_sand_min', 'Texture Sand Min (%)'),
                new FilterColumn($this->dataset, 'texture_silt_max', 'texture_silt_max', 'Texture Silt Max (%)'),
                new FilterColumn($this->dataset, 'texture_silt_mean', 'texture_silt_mean', 'Texture Silt Mean (%)'),
                new FilterColumn($this->dataset, 'texture_silt_min', 'texture_silt_min', 'Texture Silt Min (%)'),
                new FilterColumn($this->dataset, 'water_requirement_max', 'water_requirement_max', 'Water Requirement Max (liter/ha/season)'),
                new FilterColumn($this->dataset, 'water_requirement_mean', 'water_requirement_mean', 'Water Requirement Mean (liter/ha/season)'),
                new FilterColumn($this->dataset, 'water_requirement_min', 'water_requirement_min', 'Water Requirement Min (liter/ha/season)'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id_id', 'Metadata ID')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['zone_a'])
                ->addColumn($columns['zone_b'])
                ->addColumn($columns['zone_c'])
                ->addColumn($columns['zone_d'])
                ->addColumn($columns['zone_e'])
                ->addColumn($columns['climate_zone'])
                ->addColumn($columns['altitude_optimal_max'])
                ->addColumn($columns['altitude_optimal_mean'])
                ->addColumn($columns['altitude_optimal_min'])
                ->addColumn($columns['altitude_absolute_max'])
                ->addColumn($columns['altitude_absolute_mean'])
                ->addColumn($columns['altitude_absolute_min'])
                ->addColumn($columns['latitude_optimal_max'])
                ->addColumn($columns['latitude_optimal_mean'])
                ->addColumn($columns['latitude_optimal_min'])
                ->addColumn($columns['latitude_absolute_max'])
                ->addColumn($columns['latitude_absolute_mean'])
                ->addColumn($columns['latitude_absolute_min'])
                ->addColumn($columns['light_optimal_max'])
                ->addColumn($columns['light_optimal_mean'])
                ->addColumn($columns['light_optimal_min'])
                ->addColumn($columns['light_absolute_max'])
                ->addColumn($columns['light_absolute_mean'])
                ->addColumn($columns['light_absolute_min'])
                ->addColumn($columns['optimal_aspect_max'])
                ->addColumn($columns['optimal_aspect_mean'])
                ->addColumn($columns['optimal_aspect_min'])
                ->addColumn($columns['optimal_slope_max'])
                ->addColumn($columns['optimal_slope_mean'])
                ->addColumn($columns['optimal_slope_min'])
                ->addColumn($columns['photoperiod_long'])
                ->addColumn($columns['photoperiod_neutral'])
                ->addColumn($columns['photoperiod_short'])
                ->addColumn($columns['production_system'])
                ->addColumn($columns['rainfall_optimal_max'])
                ->addColumn($columns['rainfall_optimal_mean'])
                ->addColumn($columns['rainfall_optimal_min'])
                ->addColumn($columns['rainfall_absolute_max'])
                ->addColumn($columns['rainfall_absolute_mean'])
                ->addColumn($columns['rainfall_absolute_min'])
                ->addColumn($columns['heavymetal_toxicity_optimal_high'])
                ->addColumn($columns['heavymetal_toxicity_optimal_moderate'])
                ->addColumn($columns['heavymetal_toxicity_optimal_low'])
                ->addColumn($columns['heavymetal_toxicity_absolute_high'])
                ->addColumn($columns['heavymetal_toxicity_absolute_moderate'])
                ->addColumn($columns['heavymetal_toxicity_absolute_low'])
                ->addColumn($columns['soil_depth_optimal_deep'])
                ->addColumn($columns['soil_depth_optimal_medium'])
                ->addColumn($columns['soil_depth_optimal_low'])
                ->addColumn($columns['soil_depth_absolute_deep'])
                ->addColumn($columns['soil_depth_absolute_medium'])
                ->addColumn($columns['soil_depth_absolute_low'])
                ->addColumn($columns['soil_fertility_optimal_high'])
                ->addColumn($columns['soil_fertility_optimal_moderate'])
                ->addColumn($columns['soil_fertility_optimal_low'])
                ->addColumn($columns['soil_fertility_absolute_high'])
                ->addColumn($columns['soil_fertility_absolute_moderate'])
                ->addColumn($columns['soil_fertility_absolute_low'])
                ->addColumn($columns['soil_ph_optimal_max'])
                ->addColumn($columns['soil_ph_optimal_mean'])
                ->addColumn($columns['soil_ph_optimal_min'])
                ->addColumn($columns['soil_ph_absolute_max'])
                ->addColumn($columns['soil_ph_absolute_mean'])
                ->addColumn($columns['soil_ph_absolute_min'])
                ->addColumn($columns['soil_salinity_optimal_high'])
                ->addColumn($columns['soil_salinity_optimal_moderate'])
                ->addColumn($columns['soil_salinity_optimal_low'])
                ->addColumn($columns['soil_salinity_absolute_high'])
                ->addColumn($columns['soil_salinity_absolute_moderate'])
                ->addColumn($columns['soil_salinity_absolute_low'])
                ->addColumn($columns['soil_texture_optimal_heavy'])
                ->addColumn($columns['soil_texture_optimal_medium'])
                ->addColumn($columns['soil_texture_optimal_light'])
                ->addColumn($columns['soil_texture_absolute_heavy'])
                ->addColumn($columns['soil_texture_absolute_medium'])
                ->addColumn($columns['soil_texture_absolute_light'])
                ->addColumn($columns['temperature_optimal_max'])
                ->addColumn($columns['temperature_optimal_mean'])
                ->addColumn($columns['temperature_optimal_min'])
                ->addColumn($columns['temperature_absolute_max'])
                ->addColumn($columns['temperature_absolute_mean'])
                ->addColumn($columns['temperature_absolute_min'])
                ->addColumn($columns['texture_clay_max'])
                ->addColumn($columns['texture_clay_mean'])
                ->addColumn($columns['texture_clay_min'])
                ->addColumn($columns['texture_sand_max'])
                ->addColumn($columns['texture_sand_mean'])
                ->addColumn($columns['texture_sand_min'])
                ->addColumn($columns['texture_silt_max'])
                ->addColumn($columns['texture_silt_mean'])
                ->addColumn($columns['texture_silt_min'])
                ->addColumn($columns['water_requirement_max'])
                ->addColumn($columns['water_requirement_mean'])
                ->addColumn($columns['water_requirement_min'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('metadata_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('cropid_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ag_agroecology_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ag_agroecology_cropid_search');
            
            $text_editor = new TextEdit('cropid');
            
            $filterBuilder->addColumn(
                $columns['cropid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zone_a');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zone_a'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zone_b');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zone_b'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zone_c');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zone_c'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zone_d');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zone_d'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zone_e');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zone_e'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('climate_zone_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['climate_zone'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('altitude_optimal_max_edit');
            
            $filterBuilder->addColumn(
                $columns['altitude_optimal_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('altitude_optimal_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['altitude_optimal_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('altitude_optimal_min_edit');
            
            $filterBuilder->addColumn(
                $columns['altitude_optimal_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('altitude_absolute_max_edit');
            
            $filterBuilder->addColumn(
                $columns['altitude_absolute_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('altitude_absolute_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['altitude_absolute_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('altitude_absolute_min_edit');
            
            $filterBuilder->addColumn(
                $columns['altitude_absolute_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('latitude_optimal_max_edit');
            
            $filterBuilder->addColumn(
                $columns['latitude_optimal_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('latitude_optimal_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['latitude_optimal_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('latitude_optimal_min_edit');
            
            $filterBuilder->addColumn(
                $columns['latitude_optimal_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('latitude_absolute_max_edit');
            
            $filterBuilder->addColumn(
                $columns['latitude_absolute_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('latitude_absolute_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['latitude_absolute_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('latitude_absolute_min_edit');
            
            $filterBuilder->addColumn(
                $columns['latitude_absolute_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('light_optimal_max_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['light_optimal_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('light_optimal_mean_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['light_optimal_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('light_optimal_min_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['light_optimal_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('light_absolute_max_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['light_absolute_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('light_absolute_mean_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['light_absolute_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('light_absolute_min_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['light_absolute_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('optimal_aspect_max_edit');
            
            $filterBuilder->addColumn(
                $columns['optimal_aspect_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('optimal_aspect_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['optimal_aspect_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('optimal_aspect_min_edit');
            
            $filterBuilder->addColumn(
                $columns['optimal_aspect_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('optimal_slope_max_edit');
            
            $filterBuilder->addColumn(
                $columns['optimal_slope_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('optimal_slope_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['optimal_slope_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('optimal_slope_min_edit');
            
            $filterBuilder->addColumn(
                $columns['optimal_slope_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('photoperiod_long');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['photoperiod_long'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('photoperiod_neutral');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['photoperiod_neutral'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('photoperiod_short');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['photoperiod_short'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('production_system_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['production_system'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rainfall_optimal_max_edit');
            
            $filterBuilder->addColumn(
                $columns['rainfall_optimal_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rainfall_optimal_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['rainfall_optimal_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rainfall_optimal_min_edit');
            
            $filterBuilder->addColumn(
                $columns['rainfall_optimal_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rainfall_absolute_max_edit');
            
            $filterBuilder->addColumn(
                $columns['rainfall_absolute_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rainfall_absolute_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['rainfall_absolute_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rainfall_absolute_min_edit');
            
            $filterBuilder->addColumn(
                $columns['rainfall_absolute_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('heavymetal_toxicity_optimal_high');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['heavymetal_toxicity_optimal_high'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('heavymetal_toxicity_optimal_moderate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['heavymetal_toxicity_optimal_moderate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('heavymetal_toxicity_optimal_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['heavymetal_toxicity_optimal_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('heavymetal_toxicity_absolute_high');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['heavymetal_toxicity_absolute_high'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('heavymetal_toxicity_absolute_moderate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['heavymetal_toxicity_absolute_moderate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('heavymetal_toxicity_absolute_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['heavymetal_toxicity_absolute_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_depth_optimal_deep');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_depth_optimal_deep'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_depth_optimal_medium');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_depth_optimal_medium'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_depth_optimal_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_depth_optimal_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_depth_absolute_deep');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_depth_absolute_deep'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_depth_absolute_medium');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_depth_absolute_medium'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_depth_absolute_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_depth_absolute_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_fertility_optimal_high');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_fertility_optimal_high'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_fertility_optimal_moderate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_fertility_optimal_moderate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_fertility_optimal_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_fertility_optimal_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_fertility_absolute_high');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_fertility_absolute_high'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_fertility_absolute_moderate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_fertility_absolute_moderate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_fertility_absolute_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_fertility_absolute_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('soil_ph_optimal_max_edit');
            
            $filterBuilder->addColumn(
                $columns['soil_ph_optimal_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('soil_ph_optimal_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['soil_ph_optimal_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('soil_ph_optimal_min_edit');
            
            $filterBuilder->addColumn(
                $columns['soil_ph_optimal_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('soil_ph_absolute_max_edit');
            
            $filterBuilder->addColumn(
                $columns['soil_ph_absolute_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('soil_ph_absolute_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['soil_ph_absolute_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('soil_ph_absolute_min_edit');
            
            $filterBuilder->addColumn(
                $columns['soil_ph_absolute_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_salinity_optimal_high');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_salinity_optimal_high'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_salinity_optimal_moderate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_salinity_optimal_moderate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_salinity_optimal_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_salinity_optimal_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_salinity_absolute_high');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_salinity_absolute_high'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_salinity_absolute_moderate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_salinity_absolute_moderate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_salinity_absolute_low');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_salinity_absolute_low'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_texture_optimal_heavy');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_texture_optimal_heavy'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_texture_optimal_medium');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_texture_optimal_medium'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_texture_optimal_light');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_texture_optimal_light'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_texture_absolute_heavy');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_texture_absolute_heavy'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_texture_absolute_medium');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_texture_absolute_medium'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('soil_texture_absolute_light');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['soil_texture_absolute_light'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('temperature_optimal_max_edit');
            
            $filterBuilder->addColumn(
                $columns['temperature_optimal_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('temperature_optimal_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['temperature_optimal_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('temperature_optimal_min_edit');
            
            $filterBuilder->addColumn(
                $columns['temperature_optimal_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('temperature_absolute_max_edit');
            
            $filterBuilder->addColumn(
                $columns['temperature_absolute_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('temperature_absolute_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['temperature_absolute_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('temperature_absolute_min_edit');
            
            $filterBuilder->addColumn(
                $columns['temperature_absolute_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_clay_max_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_clay_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_clay_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_clay_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_clay_min_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_clay_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_sand_max_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_sand_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_sand_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_sand_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_sand_min_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_sand_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_silt_max_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_silt_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_silt_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_silt_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('texture_silt_min_edit');
            
            $filterBuilder->addColumn(
                $columns['texture_silt_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('water_requirement_max_edit');
            
            $filterBuilder->addColumn(
                $columns['water_requirement_max'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('water_requirement_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['water_requirement_mean'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('water_requirement_min_edit');
            
            $filterBuilder->addColumn(
                $columns['water_requirement_min'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('notes');
            
            $filterBuilder->addColumn(
                $columns['notes'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('metadata_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ag_agroecology_metadata_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('metadata_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ag_agroecology_metadata_id_search');
            
            $filterBuilder->addColumn(
                $columns['metadata_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Agroecology ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zone_a field
            //
            $column = new CheckboxViewColumn('zone_a', 'zone_a', 'Zone A', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zone_b field
            //
            $column = new CheckboxViewColumn('zone_b', 'zone_b', 'Zone B', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zone_c field
            //
            $column = new CheckboxViewColumn('zone_c', 'zone_c', 'Zone C', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zone_d field
            //
            $column = new CheckboxViewColumn('zone_d', 'zone_d', 'Zone D', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zone_e field
            //
            $column = new CheckboxViewColumn('zone_e', 'zone_e', 'Zone E', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_climate_zone_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for altitude_optimal_max field
            //
            $column = new NumberViewColumn('altitude_optimal_max', 'altitude_optimal_max', 'Altitude Optimal Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for altitude_optimal_mean field
            //
            $column = new NumberViewColumn('altitude_optimal_mean', 'altitude_optimal_mean', 'Altitude Optimal Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for altitude_optimal_min field
            //
            $column = new NumberViewColumn('altitude_optimal_min', 'altitude_optimal_min', 'Altitude Optimal Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for altitude_absolute_max field
            //
            $column = new NumberViewColumn('altitude_absolute_max', 'altitude_absolute_max', 'Altitude Absolute Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for altitude_absolute_mean field
            //
            $column = new NumberViewColumn('altitude_absolute_mean', 'altitude_absolute_mean', 'Altitude Absolute Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for altitude_absolute_min field
            //
            $column = new NumberViewColumn('altitude_absolute_min', 'altitude_absolute_min', 'Altitude Absolute Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude_optimal_max field
            //
            $column = new NumberViewColumn('latitude_optimal_max', 'latitude_optimal_max', 'Latitude Optimal Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude_optimal_mean field
            //
            $column = new NumberViewColumn('latitude_optimal_mean', 'latitude_optimal_mean', 'Latitude Optimal Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude_optimal_min field
            //
            $column = new NumberViewColumn('latitude_optimal_min', 'latitude_optimal_min', 'Latitude Optimal Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude_absolute_max field
            //
            $column = new NumberViewColumn('latitude_absolute_max', 'latitude_absolute_max', 'Latitude Absolute Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude_absolute_mean field
            //
            $column = new NumberViewColumn('latitude_absolute_mean', 'latitude_absolute_mean', 'Latitude Absolute Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude_absolute_min field
            //
            $column = new NumberViewColumn('latitude_absolute_min', 'latitude_absolute_min', 'Latitude Absolute Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_max_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_mean_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_min_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_max_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_mean_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_min_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for optimal_aspect_max field
            //
            $column = new NumberViewColumn('optimal_aspect_max', 'optimal_aspect_max', 'Optimal Aspect Max (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for optimal_aspect_mean field
            //
            $column = new NumberViewColumn('optimal_aspect_mean', 'optimal_aspect_mean', 'Optimal Aspect Mean (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for optimal_aspect_min field
            //
            $column = new NumberViewColumn('optimal_aspect_min', 'optimal_aspect_min', 'Optimal Aspect Min (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for optimal_slope_max field
            //
            $column = new NumberViewColumn('optimal_slope_max', 'optimal_slope_max', 'Optimal Slope Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for optimal_slope_mean field
            //
            $column = new NumberViewColumn('optimal_slope_mean', 'optimal_slope_mean', 'Optimal Slope Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for optimal_slope_min field
            //
            $column = new NumberViewColumn('optimal_slope_min', 'optimal_slope_min', 'Optimal Slope Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photoperiod_long field
            //
            $column = new CheckboxViewColumn('photoperiod_long', 'photoperiod_long', 'Photoperiod Long (>14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photoperiod_neutral field
            //
            $column = new CheckboxViewColumn('photoperiod_neutral', 'photoperiod_neutral', 'Photoperiod Neutral (12-14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photoperiod_short field
            //
            $column = new CheckboxViewColumn('photoperiod_short', 'photoperiod_short', 'Photoperiod Short (<12 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_production_system_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rainfall_optimal_max field
            //
            $column = new NumberViewColumn('rainfall_optimal_max', 'rainfall_optimal_max', 'Rainfall Optimal Max (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rainfall_optimal_mean field
            //
            $column = new NumberViewColumn('rainfall_optimal_mean', 'rainfall_optimal_mean', 'Rainfall Optimal Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rainfall_optimal_min field
            //
            $column = new NumberViewColumn('rainfall_optimal_min', 'rainfall_optimal_min', 'Rainfall Optimal Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rainfall_absolute_max field
            //
            $column = new NumberViewColumn('rainfall_absolute_max', 'rainfall_absolute_max', 'Rainfall Absolute Maximum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rainfall_absolute_mean field
            //
            $column = new NumberViewColumn('rainfall_absolute_mean', 'rainfall_absolute_mean', 'Rainfall Absolute Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rainfall_absolute_min field
            //
            $column = new NumberViewColumn('rainfall_absolute_min', 'rainfall_absolute_min', 'Rainfall Absolute Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_high', 'heavymetal_toxicity_optimal_high', 'Heavymetal Toxicity Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_moderate', 'heavymetal_toxicity_optimal_moderate', 'Heavymetal Toxicity Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_low', 'heavymetal_toxicity_optimal_low', 'Heavymetal Toxicity Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_high', 'heavymetal_toxicity_absolute_high', 'Heavymetal Toxicity Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_moderate', 'heavymetal_toxicity_absolute_moderate', 'Heavymetal Toxicity Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_low', 'heavymetal_toxicity_absolute_low', 'Heavymetal Toxicity Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_depth_optimal_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_deep', 'soil_depth_optimal_deep', 'Soil Depth Optimal Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_depth_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_medium', 'soil_depth_optimal_medium', 'Soil Depth Optimal Medium (50 - 150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_depth_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_low', 'soil_depth_optimal_low', 'Soil Depth Optimal Low (< 50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_depth_absolute_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_deep', 'soil_depth_absolute_deep', 'Soil Depth Absolute Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_depth_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_medium', 'soil_depth_absolute_medium', 'Soil Depth Absolute Medium (50-150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_depth_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_low', 'soil_depth_absolute_low', 'Soil Depth Absolute Low (<50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_fertility_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_high', 'soil_fertility_optimal_high', 'Soil Fertility Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_fertility_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_moderate', 'soil_fertility_optimal_moderate', 'Soil Fertility Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_fertility_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_low', 'soil_fertility_optimal_low', 'Soil Fertility Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_fertility_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_high', 'soil_fertility_absolute_high', 'Soil Fertility Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_fertility_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_moderate', 'soil_fertility_absolute_moderate', 'Soil Fertility Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_fertility_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_low', 'soil_fertility_absolute_low', 'Soil Fertility Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_ph_optimal_max field
            //
            $column = new NumberViewColumn('soil_ph_optimal_max', 'soil_ph_optimal_max', 'Soil pH Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_ph_optimal_mean field
            //
            $column = new NumberViewColumn('soil_ph_optimal_mean', 'soil_ph_optimal_mean', 'Soil pH Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_ph_optimal_min field
            //
            $column = new NumberViewColumn('soil_ph_optimal_min', 'soil_ph_optimal_min', 'Soil pH Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_ph_absolute_max field
            //
            $column = new NumberViewColumn('soil_ph_absolute_max', 'soil_ph_absolute_max', 'Soil pH Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_ph_absolute_mean field
            //
            $column = new NumberViewColumn('soil_ph_absolute_mean', 'soil_ph_absolute_mean', 'Soil pH Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_ph_absolute_min field
            //
            $column = new NumberViewColumn('soil_ph_absolute_min', 'soil_ph_absolute_min', 'Soil pH Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_salinity_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_high', 'soil_salinity_optimal_high', 'Soil Salinity Optimal High (>10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_salinity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_moderate', 'soil_salinity_optimal_moderate', 'Soil Salinity Optimal Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_salinity_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_low', 'soil_salinity_optimal_low', 'Soil Salinity Optimal Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_salinity_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_high', 'soil_salinity_absolute_high', 'Soil Salinity Absolute High (10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_salinity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_moderate', 'soil_salinity_absolute_moderate', 'Soil Salinity Absolute Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_salinity_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_low', 'soil_salinity_absolute_low', 'Soil Salinity Absolute Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_texture_optimal_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_heavy', 'soil_texture_optimal_heavy', 'Soil Texture Optimal Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_texture_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_medium', 'soil_texture_optimal_medium', 'Soil Texture Optimal Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_texture_optimal_light field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_light', 'soil_texture_optimal_light', 'Soil Texture Optimal Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_texture_absolute_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_heavy', 'soil_texture_absolute_heavy', 'Soil Texture Absolute Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_texture_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_medium', 'soil_texture_absolute_medium', 'Soil Texture Absolute Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for soil_texture_absolute_light field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_light', 'soil_texture_absolute_light', 'Soil Texture Absolute Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for temperature_optimal_max field
            //
            $column = new NumberViewColumn('temperature_optimal_max', 'temperature_optimal_max', 'Temperature Optimal Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for temperature_optimal_mean field
            //
            $column = new NumberViewColumn('temperature_optimal_mean', 'temperature_optimal_mean', 'Temperature Optimal Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for temperature_optimal_min field
            //
            $column = new NumberViewColumn('temperature_optimal_min', 'temperature_optimal_min', 'Temperature Optimal Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for temperature_absolute_max field
            //
            $column = new NumberViewColumn('temperature_absolute_max', 'temperature_absolute_max', 'Temperature Absolute Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for temperature_absolute_mean field
            //
            $column = new NumberViewColumn('temperature_absolute_mean', 'temperature_absolute_mean', 'Temperature Absolute Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for temperature_absolute_min field
            //
            $column = new NumberViewColumn('temperature_absolute_min', 'temperature_absolute_min', 'Temperature Absolute Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_clay_max field
            //
            $column = new NumberViewColumn('texture_clay_max', 'texture_clay_max', 'Texture Clay Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_clay_mean field
            //
            $column = new NumberViewColumn('texture_clay_mean', 'texture_clay_mean', 'Texture Clay Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_clay_min field
            //
            $column = new NumberViewColumn('texture_clay_min', 'texture_clay_min', 'Texture Clay Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_sand_max field
            //
            $column = new NumberViewColumn('texture_sand_max', 'texture_sand_max', 'Texture Sand Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_sand_mean field
            //
            $column = new NumberViewColumn('texture_sand_mean', 'texture_sand_mean', 'Texture Sand Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_sand_min field
            //
            $column = new NumberViewColumn('texture_sand_min', 'texture_sand_min', 'Texture Sand Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_silt_max field
            //
            $column = new NumberViewColumn('texture_silt_max', 'texture_silt_max', 'Texture Silt Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_silt_mean field
            //
            $column = new NumberViewColumn('texture_silt_mean', 'texture_silt_mean', 'Texture Silt Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for texture_silt_min field
            //
            $column = new NumberViewColumn('texture_silt_min', 'texture_silt_min', 'Texture Silt Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Agroecology ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zone_a field
            //
            $column = new CheckboxViewColumn('zone_a', 'zone_a', 'Zone A', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zone_b field
            //
            $column = new CheckboxViewColumn('zone_b', 'zone_b', 'Zone B', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zone_c field
            //
            $column = new CheckboxViewColumn('zone_c', 'zone_c', 'Zone C', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zone_d field
            //
            $column = new CheckboxViewColumn('zone_d', 'zone_d', 'Zone D', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zone_e field
            //
            $column = new CheckboxViewColumn('zone_e', 'zone_e', 'Zone E', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_climate_zone_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for altitude_optimal_max field
            //
            $column = new NumberViewColumn('altitude_optimal_max', 'altitude_optimal_max', 'Altitude Optimal Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for altitude_optimal_mean field
            //
            $column = new NumberViewColumn('altitude_optimal_mean', 'altitude_optimal_mean', 'Altitude Optimal Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for altitude_optimal_min field
            //
            $column = new NumberViewColumn('altitude_optimal_min', 'altitude_optimal_min', 'Altitude Optimal Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for altitude_absolute_max field
            //
            $column = new NumberViewColumn('altitude_absolute_max', 'altitude_absolute_max', 'Altitude Absolute Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for altitude_absolute_mean field
            //
            $column = new NumberViewColumn('altitude_absolute_mean', 'altitude_absolute_mean', 'Altitude Absolute Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for altitude_absolute_min field
            //
            $column = new NumberViewColumn('altitude_absolute_min', 'altitude_absolute_min', 'Altitude Absolute Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude_optimal_max field
            //
            $column = new NumberViewColumn('latitude_optimal_max', 'latitude_optimal_max', 'Latitude Optimal Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude_optimal_mean field
            //
            $column = new NumberViewColumn('latitude_optimal_mean', 'latitude_optimal_mean', 'Latitude Optimal Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude_optimal_min field
            //
            $column = new NumberViewColumn('latitude_optimal_min', 'latitude_optimal_min', 'Latitude Optimal Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude_absolute_max field
            //
            $column = new NumberViewColumn('latitude_absolute_max', 'latitude_absolute_max', 'Latitude Absolute Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude_absolute_mean field
            //
            $column = new NumberViewColumn('latitude_absolute_mean', 'latitude_absolute_mean', 'Latitude Absolute Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude_absolute_min field
            //
            $column = new NumberViewColumn('latitude_absolute_min', 'latitude_absolute_min', 'Latitude Absolute Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_max_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_mean_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_min_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_max_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_mean_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_min_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for optimal_aspect_max field
            //
            $column = new NumberViewColumn('optimal_aspect_max', 'optimal_aspect_max', 'Optimal Aspect Max (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for optimal_aspect_mean field
            //
            $column = new NumberViewColumn('optimal_aspect_mean', 'optimal_aspect_mean', 'Optimal Aspect Mean (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for optimal_aspect_min field
            //
            $column = new NumberViewColumn('optimal_aspect_min', 'optimal_aspect_min', 'Optimal Aspect Min (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for optimal_slope_max field
            //
            $column = new NumberViewColumn('optimal_slope_max', 'optimal_slope_max', 'Optimal Slope Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for optimal_slope_mean field
            //
            $column = new NumberViewColumn('optimal_slope_mean', 'optimal_slope_mean', 'Optimal Slope Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for optimal_slope_min field
            //
            $column = new NumberViewColumn('optimal_slope_min', 'optimal_slope_min', 'Optimal Slope Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photoperiod_long field
            //
            $column = new CheckboxViewColumn('photoperiod_long', 'photoperiod_long', 'Photoperiod Long (>14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photoperiod_neutral field
            //
            $column = new CheckboxViewColumn('photoperiod_neutral', 'photoperiod_neutral', 'Photoperiod Neutral (12-14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photoperiod_short field
            //
            $column = new CheckboxViewColumn('photoperiod_short', 'photoperiod_short', 'Photoperiod Short (<12 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_production_system_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rainfall_optimal_max field
            //
            $column = new NumberViewColumn('rainfall_optimal_max', 'rainfall_optimal_max', 'Rainfall Optimal Max (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rainfall_optimal_mean field
            //
            $column = new NumberViewColumn('rainfall_optimal_mean', 'rainfall_optimal_mean', 'Rainfall Optimal Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rainfall_optimal_min field
            //
            $column = new NumberViewColumn('rainfall_optimal_min', 'rainfall_optimal_min', 'Rainfall Optimal Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rainfall_absolute_max field
            //
            $column = new NumberViewColumn('rainfall_absolute_max', 'rainfall_absolute_max', 'Rainfall Absolute Maximum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rainfall_absolute_mean field
            //
            $column = new NumberViewColumn('rainfall_absolute_mean', 'rainfall_absolute_mean', 'Rainfall Absolute Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rainfall_absolute_min field
            //
            $column = new NumberViewColumn('rainfall_absolute_min', 'rainfall_absolute_min', 'Rainfall Absolute Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_high', 'heavymetal_toxicity_optimal_high', 'Heavymetal Toxicity Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_moderate', 'heavymetal_toxicity_optimal_moderate', 'Heavymetal Toxicity Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_low', 'heavymetal_toxicity_optimal_low', 'Heavymetal Toxicity Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_high', 'heavymetal_toxicity_absolute_high', 'Heavymetal Toxicity Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_moderate', 'heavymetal_toxicity_absolute_moderate', 'Heavymetal Toxicity Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_low', 'heavymetal_toxicity_absolute_low', 'Heavymetal Toxicity Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_depth_optimal_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_deep', 'soil_depth_optimal_deep', 'Soil Depth Optimal Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_depth_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_medium', 'soil_depth_optimal_medium', 'Soil Depth Optimal Medium (50 - 150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_depth_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_low', 'soil_depth_optimal_low', 'Soil Depth Optimal Low (< 50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_depth_absolute_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_deep', 'soil_depth_absolute_deep', 'Soil Depth Absolute Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_depth_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_medium', 'soil_depth_absolute_medium', 'Soil Depth Absolute Medium (50-150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_depth_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_low', 'soil_depth_absolute_low', 'Soil Depth Absolute Low (<50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_fertility_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_high', 'soil_fertility_optimal_high', 'Soil Fertility Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_fertility_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_moderate', 'soil_fertility_optimal_moderate', 'Soil Fertility Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_fertility_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_low', 'soil_fertility_optimal_low', 'Soil Fertility Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_fertility_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_high', 'soil_fertility_absolute_high', 'Soil Fertility Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_fertility_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_moderate', 'soil_fertility_absolute_moderate', 'Soil Fertility Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_fertility_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_low', 'soil_fertility_absolute_low', 'Soil Fertility Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_ph_optimal_max field
            //
            $column = new NumberViewColumn('soil_ph_optimal_max', 'soil_ph_optimal_max', 'Soil pH Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_ph_optimal_mean field
            //
            $column = new NumberViewColumn('soil_ph_optimal_mean', 'soil_ph_optimal_mean', 'Soil pH Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_ph_optimal_min field
            //
            $column = new NumberViewColumn('soil_ph_optimal_min', 'soil_ph_optimal_min', 'Soil pH Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_ph_absolute_max field
            //
            $column = new NumberViewColumn('soil_ph_absolute_max', 'soil_ph_absolute_max', 'Soil pH Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_ph_absolute_mean field
            //
            $column = new NumberViewColumn('soil_ph_absolute_mean', 'soil_ph_absolute_mean', 'Soil pH Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_ph_absolute_min field
            //
            $column = new NumberViewColumn('soil_ph_absolute_min', 'soil_ph_absolute_min', 'Soil pH Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_salinity_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_high', 'soil_salinity_optimal_high', 'Soil Salinity Optimal High (>10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_salinity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_moderate', 'soil_salinity_optimal_moderate', 'Soil Salinity Optimal Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_salinity_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_low', 'soil_salinity_optimal_low', 'Soil Salinity Optimal Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_salinity_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_high', 'soil_salinity_absolute_high', 'Soil Salinity Absolute High (10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_salinity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_moderate', 'soil_salinity_absolute_moderate', 'Soil Salinity Absolute Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_salinity_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_low', 'soil_salinity_absolute_low', 'Soil Salinity Absolute Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_texture_optimal_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_heavy', 'soil_texture_optimal_heavy', 'Soil Texture Optimal Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_texture_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_medium', 'soil_texture_optimal_medium', 'Soil Texture Optimal Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_texture_optimal_light field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_light', 'soil_texture_optimal_light', 'Soil Texture Optimal Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_texture_absolute_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_heavy', 'soil_texture_absolute_heavy', 'Soil Texture Absolute Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_texture_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_medium', 'soil_texture_absolute_medium', 'Soil Texture Absolute Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for soil_texture_absolute_light field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_light', 'soil_texture_absolute_light', 'Soil Texture Absolute Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for temperature_optimal_max field
            //
            $column = new NumberViewColumn('temperature_optimal_max', 'temperature_optimal_max', 'Temperature Optimal Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for temperature_optimal_mean field
            //
            $column = new NumberViewColumn('temperature_optimal_mean', 'temperature_optimal_mean', 'Temperature Optimal Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for temperature_optimal_min field
            //
            $column = new NumberViewColumn('temperature_optimal_min', 'temperature_optimal_min', 'Temperature Optimal Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for temperature_absolute_max field
            //
            $column = new NumberViewColumn('temperature_absolute_max', 'temperature_absolute_max', 'Temperature Absolute Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for temperature_absolute_mean field
            //
            $column = new NumberViewColumn('temperature_absolute_mean', 'temperature_absolute_mean', 'Temperature Absolute Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for temperature_absolute_min field
            //
            $column = new NumberViewColumn('temperature_absolute_min', 'temperature_absolute_min', 'Temperature Absolute Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_clay_max field
            //
            $column = new NumberViewColumn('texture_clay_max', 'texture_clay_max', 'Texture Clay Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_clay_mean field
            //
            $column = new NumberViewColumn('texture_clay_mean', 'texture_clay_mean', 'Texture Clay Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_clay_min field
            //
            $column = new NumberViewColumn('texture_clay_min', 'texture_clay_min', 'Texture Clay Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_sand_max field
            //
            $column = new NumberViewColumn('texture_sand_max', 'texture_sand_max', 'Texture Sand Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_sand_mean field
            //
            $column = new NumberViewColumn('texture_sand_mean', 'texture_sand_mean', 'Texture Sand Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_sand_min field
            //
            $column = new NumberViewColumn('texture_sand_min', 'texture_sand_min', 'Texture Sand Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_silt_max field
            //
            $column = new NumberViewColumn('texture_silt_max', 'texture_silt_max', 'Texture Silt Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_silt_mean field
            //
            $column = new NumberViewColumn('texture_silt_mean', 'texture_silt_mean', 'Texture Silt Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for texture_silt_min field
            //
            $column = new NumberViewColumn('texture_silt_min', 'texture_silt_min', 'Texture Silt Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for cropid field
            //
            $editor = new DynamicCombobox('cropid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Crop ID', 'cropid', 'cropid_name', 'edit_ag_agroecology_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zone_a field
            //
            $editor = new CheckBox('zone_a_edit');
            $editColumn = new CustomEditColumn('Zone A', 'zone_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zone_b field
            //
            $editor = new CheckBox('zone_b_edit');
            $editColumn = new CustomEditColumn('Zone B', 'zone_b', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zone_c field
            //
            $editor = new CheckBox('zone_c_edit');
            $editColumn = new CustomEditColumn('Zone C', 'zone_c', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zone_d field
            //
            $editor = new CheckBox('zone_d_edit');
            $editColumn = new CustomEditColumn('Zone D', 'zone_d', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zone_e field
            //
            $editor = new CheckBox('zone_e_edit');
            $editColumn = new CustomEditColumn('Zone E', 'zone_e', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for climate_zone field
            //
            $editor = new TextEdit('climate_zone_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Climate Zone', 'climate_zone', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_max field
            //
            $editor = new TextEdit('altitude_optimal_max_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Max (m)', 'altitude_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_mean field
            //
            $editor = new TextEdit('altitude_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Mean (m)', 'altitude_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_min field
            //
            $editor = new TextEdit('altitude_optimal_min_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Min (m)', 'altitude_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_max field
            //
            $editor = new TextEdit('altitude_absolute_max_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Max (m)', 'altitude_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_mean field
            //
            $editor = new TextEdit('altitude_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Mean (m)', 'altitude_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_min field
            //
            $editor = new TextEdit('altitude_absolute_min_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Min (m)', 'altitude_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_max field
            //
            $editor = new TextEdit('latitude_optimal_max_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Max (Degree North/South)', 'latitude_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_mean field
            //
            $editor = new TextEdit('latitude_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Mean (Degree North/South)', 'latitude_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_min field
            //
            $editor = new TextEdit('latitude_optimal_min_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Min (Degree North/South)', 'latitude_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_max field
            //
            $editor = new TextEdit('latitude_absolute_max_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Max (Degree North/South)', 'latitude_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_mean field
            //
            $editor = new TextEdit('latitude_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Mean (Degree North/South)', 'latitude_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_min field
            //
            $editor = new TextEdit('latitude_absolute_min_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Min (Degree North/South)', 'latitude_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for light_optimal_max field
            //
            $editor = new TextEdit('light_optimal_max_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Max', 'light_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for light_optimal_mean field
            //
            $editor = new TextEdit('light_optimal_mean_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Mean', 'light_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for light_optimal_min field
            //
            $editor = new TextEdit('light_optimal_min_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Min', 'light_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for light_absolute_max field
            //
            $editor = new TextEdit('light_absolute_max_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Max', 'light_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for light_absolute_mean field
            //
            $editor = new TextEdit('light_absolute_mean_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Mean', 'light_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for light_absolute_min field
            //
            $editor = new TextEdit('light_absolute_min_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Min', 'light_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_max field
            //
            $editor = new TextEdit('optimal_aspect_max_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Max (Degree)', 'optimal_aspect_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_mean field
            //
            $editor = new TextEdit('optimal_aspect_mean_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Mean (Degree)', 'optimal_aspect_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_min field
            //
            $editor = new TextEdit('optimal_aspect_min_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Min (Degree)', 'optimal_aspect_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for optimal_slope_max field
            //
            $editor = new TextEdit('optimal_slope_max_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Max (%)', 'optimal_slope_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for optimal_slope_mean field
            //
            $editor = new TextEdit('optimal_slope_mean_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Mean (%)', 'optimal_slope_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for optimal_slope_min field
            //
            $editor = new TextEdit('optimal_slope_min_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Min (%)', 'optimal_slope_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photoperiod_long field
            //
            $editor = new CheckBox('photoperiod_long_edit');
            $editColumn = new CustomEditColumn('Photoperiod Long (>14 hours)', 'photoperiod_long', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photoperiod_neutral field
            //
            $editor = new CheckBox('photoperiod_neutral_edit');
            $editColumn = new CustomEditColumn('Photoperiod Neutral (12-14 hours)', 'photoperiod_neutral', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photoperiod_short field
            //
            $editor = new CheckBox('photoperiod_short_edit');
            $editColumn = new CustomEditColumn('Photoperiod Short (<12 hours)', 'photoperiod_short', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for production_system field
            //
            $editor = new TextEdit('production_system_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Production System', 'production_system', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_max field
            //
            $editor = new TextEdit('rainfall_optimal_max_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Max (mm/Year)', 'rainfall_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_mean field
            //
            $editor = new TextEdit('rainfall_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Mean (mm/Year)', 'rainfall_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_min field
            //
            $editor = new TextEdit('rainfall_optimal_min_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Minimum (mm/Year)', 'rainfall_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_max field
            //
            $editor = new TextEdit('rainfall_absolute_max_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Maximum (mm/Year)', 'rainfall_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_mean field
            //
            $editor = new TextEdit('rainfall_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Mean (mm/Year)', 'rainfall_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_min field
            //
            $editor = new TextEdit('rainfall_absolute_min_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Minimum (mm/Year)', 'rainfall_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_high field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_high_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal High', 'heavymetal_toxicity_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_moderate field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal Moderate', 'heavymetal_toxicity_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_low field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_low_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal Low', 'heavymetal_toxicity_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_high field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_high_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute High', 'heavymetal_toxicity_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_moderate field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute Moderate', 'heavymetal_toxicity_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_low field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_low_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute Low', 'heavymetal_toxicity_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_deep field
            //
            $editor = new CheckBox('soil_depth_optimal_deep_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Deep (>150cm)', 'soil_depth_optimal_deep', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_medium field
            //
            $editor = new CheckBox('soil_depth_optimal_medium_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Medium (50 - 150cm)', 'soil_depth_optimal_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_low field
            //
            $editor = new CheckBox('soil_depth_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Low (< 50cm)', 'soil_depth_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_deep field
            //
            $editor = new CheckBox('soil_depth_absolute_deep_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Deep (>150cm)', 'soil_depth_absolute_deep', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_medium field
            //
            $editor = new CheckBox('soil_depth_absolute_medium_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Medium (50-150cm)', 'soil_depth_absolute_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_low field
            //
            $editor = new CheckBox('soil_depth_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Low (<50cm)', 'soil_depth_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_high field
            //
            $editor = new CheckBox('soil_fertility_optimal_high_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal High', 'soil_fertility_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_moderate field
            //
            $editor = new CheckBox('soil_fertility_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal Moderate', 'soil_fertility_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_low field
            //
            $editor = new CheckBox('soil_fertility_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal Low', 'soil_fertility_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_high field
            //
            $editor = new CheckBox('soil_fertility_absolute_high_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute High', 'soil_fertility_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_moderate field
            //
            $editor = new CheckBox('soil_fertility_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute Moderate', 'soil_fertility_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_low field
            //
            $editor = new CheckBox('soil_fertility_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute Low', 'soil_fertility_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_max field
            //
            $editor = new TextEdit('soil_ph_optimal_max_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Max', 'soil_ph_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_mean field
            //
            $editor = new TextEdit('soil_ph_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Mean', 'soil_ph_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_min field
            //
            $editor = new TextEdit('soil_ph_optimal_min_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Min', 'soil_ph_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_max field
            //
            $editor = new TextEdit('soil_ph_absolute_max_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Max', 'soil_ph_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_mean field
            //
            $editor = new TextEdit('soil_ph_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Mean', 'soil_ph_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_min field
            //
            $editor = new TextEdit('soil_ph_absolute_min_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Min', 'soil_ph_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_high field
            //
            $editor = new CheckBox('soil_salinity_optimal_high_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal High (>10 dS/m)', 'soil_salinity_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_moderate field
            //
            $editor = new CheckBox('soil_salinity_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal Moderate (4-10dS/m)', 'soil_salinity_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_low field
            //
            $editor = new CheckBox('soil_salinity_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal Low (<4 dS/m)', 'soil_salinity_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_high field
            //
            $editor = new CheckBox('soil_salinity_absolute_high_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute High (10 dS/m)', 'soil_salinity_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_moderate field
            //
            $editor = new CheckBox('soil_salinity_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute Moderate (4-10dS/m)', 'soil_salinity_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_low field
            //
            $editor = new CheckBox('soil_salinity_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute Low (<4 dS/m)', 'soil_salinity_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_heavy field
            //
            $editor = new CheckBox('soil_texture_optimal_heavy_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Heavy', 'soil_texture_optimal_heavy', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_medium field
            //
            $editor = new CheckBox('soil_texture_optimal_medium_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Medium', 'soil_texture_optimal_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_light field
            //
            $editor = new CheckBox('soil_texture_optimal_light_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Light', 'soil_texture_optimal_light', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_heavy field
            //
            $editor = new CheckBox('soil_texture_absolute_heavy_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Heavy', 'soil_texture_absolute_heavy', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_medium field
            //
            $editor = new CheckBox('soil_texture_absolute_medium_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Medium', 'soil_texture_absolute_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_light field
            //
            $editor = new CheckBox('soil_texture_absolute_light_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Light', 'soil_texture_absolute_light', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_max field
            //
            $editor = new TextEdit('temperature_optimal_max_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Max (Degree Celcius)', 'temperature_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_mean field
            //
            $editor = new TextEdit('temperature_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Mean (Degree Celcius)', 'temperature_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_min field
            //
            $editor = new TextEdit('temperature_optimal_min_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Min (Degree Celcius)', 'temperature_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_max field
            //
            $editor = new TextEdit('temperature_absolute_max_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Max (Degree Celcius)', 'temperature_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_mean field
            //
            $editor = new TextEdit('temperature_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Mean (Degree Celcius)', 'temperature_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_min field
            //
            $editor = new TextEdit('temperature_absolute_min_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Min (Degree Celcius)', 'temperature_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_clay_max field
            //
            $editor = new TextEdit('texture_clay_max_edit');
            $editColumn = new CustomEditColumn('Texture Clay Max (%)', 'texture_clay_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_clay_mean field
            //
            $editor = new TextEdit('texture_clay_mean_edit');
            $editColumn = new CustomEditColumn('Texture Clay Mean (%)', 'texture_clay_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_clay_min field
            //
            $editor = new TextEdit('texture_clay_min_edit');
            $editColumn = new CustomEditColumn('Texture Clay Min (%)', 'texture_clay_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_sand_max field
            //
            $editor = new TextEdit('texture_sand_max_edit');
            $editColumn = new CustomEditColumn('Texture Sand Max (%)', 'texture_sand_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_sand_mean field
            //
            $editor = new TextEdit('texture_sand_mean_edit');
            $editColumn = new CustomEditColumn('Texture Sand Mean (%)', 'texture_sand_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_sand_min field
            //
            $editor = new TextEdit('texture_sand_min_edit');
            $editColumn = new CustomEditColumn('Texture Sand Min (%)', 'texture_sand_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_silt_max field
            //
            $editor = new TextEdit('texture_silt_max_edit');
            $editColumn = new CustomEditColumn('Texture Silt Max (%)', 'texture_silt_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_silt_mean field
            //
            $editor = new TextEdit('texture_silt_mean_edit');
            $editColumn = new CustomEditColumn('Texture Silt Mean (%)', 'texture_silt_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for texture_silt_min field
            //
            $editor = new TextEdit('texture_silt_min_edit');
            $editColumn = new CustomEditColumn('Texture Silt Min (%)', 'texture_silt_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for water_requirement_max field
            //
            $editor = new TextEdit('water_requirement_max_edit');
            $editColumn = new CustomEditColumn('Water Requirement Max (liter/ha/season)', 'water_requirement_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for water_requirement_mean field
            //
            $editor = new TextEdit('water_requirement_mean_edit');
            $editColumn = new CustomEditColumn('Water Requirement Mean (liter/ha/season)', 'water_requirement_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for water_requirement_min field
            //
            $editor = new TextEdit('water_requirement_min_edit');
            $editColumn = new CustomEditColumn('Water Requirement Min (liter/ha/season)', 'water_requirement_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for metadata_id field
            //
            $editor = new DynamicCombobox('metadata_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Metadata ID', 'metadata_id', 'metadata_id_id', 'edit_ag_agroecology_metadata_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for cropid field
            //
            $editor = new DynamicCombobox('cropid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Crop ID', 'cropid', 'cropid_name', 'multi_edit_ag_agroecology_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zone_a field
            //
            $editor = new CheckBox('zone_a_edit');
            $editColumn = new CustomEditColumn('Zone A', 'zone_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zone_b field
            //
            $editor = new CheckBox('zone_b_edit');
            $editColumn = new CustomEditColumn('Zone B', 'zone_b', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zone_c field
            //
            $editor = new CheckBox('zone_c_edit');
            $editColumn = new CustomEditColumn('Zone C', 'zone_c', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zone_d field
            //
            $editor = new CheckBox('zone_d_edit');
            $editColumn = new CustomEditColumn('Zone D', 'zone_d', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zone_e field
            //
            $editor = new CheckBox('zone_e_edit');
            $editColumn = new CustomEditColumn('Zone E', 'zone_e', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for climate_zone field
            //
            $editor = new TextEdit('climate_zone_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Climate Zone', 'climate_zone', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_max field
            //
            $editor = new TextEdit('altitude_optimal_max_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Max (m)', 'altitude_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_mean field
            //
            $editor = new TextEdit('altitude_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Mean (m)', 'altitude_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_min field
            //
            $editor = new TextEdit('altitude_optimal_min_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Min (m)', 'altitude_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_max field
            //
            $editor = new TextEdit('altitude_absolute_max_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Max (m)', 'altitude_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_mean field
            //
            $editor = new TextEdit('altitude_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Mean (m)', 'altitude_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_min field
            //
            $editor = new TextEdit('altitude_absolute_min_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Min (m)', 'altitude_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_max field
            //
            $editor = new TextEdit('latitude_optimal_max_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Max (Degree North/South)', 'latitude_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_mean field
            //
            $editor = new TextEdit('latitude_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Mean (Degree North/South)', 'latitude_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_min field
            //
            $editor = new TextEdit('latitude_optimal_min_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Min (Degree North/South)', 'latitude_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_max field
            //
            $editor = new TextEdit('latitude_absolute_max_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Max (Degree North/South)', 'latitude_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_mean field
            //
            $editor = new TextEdit('latitude_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Mean (Degree North/South)', 'latitude_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_min field
            //
            $editor = new TextEdit('latitude_absolute_min_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Min (Degree North/South)', 'latitude_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for light_optimal_max field
            //
            $editor = new TextEdit('light_optimal_max_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Max', 'light_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for light_optimal_mean field
            //
            $editor = new TextEdit('light_optimal_mean_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Mean', 'light_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for light_optimal_min field
            //
            $editor = new TextEdit('light_optimal_min_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Min', 'light_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for light_absolute_max field
            //
            $editor = new TextEdit('light_absolute_max_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Max', 'light_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for light_absolute_mean field
            //
            $editor = new TextEdit('light_absolute_mean_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Mean', 'light_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for light_absolute_min field
            //
            $editor = new TextEdit('light_absolute_min_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Min', 'light_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_max field
            //
            $editor = new TextEdit('optimal_aspect_max_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Max (Degree)', 'optimal_aspect_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_mean field
            //
            $editor = new TextEdit('optimal_aspect_mean_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Mean (Degree)', 'optimal_aspect_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_min field
            //
            $editor = new TextEdit('optimal_aspect_min_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Min (Degree)', 'optimal_aspect_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for optimal_slope_max field
            //
            $editor = new TextEdit('optimal_slope_max_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Max (%)', 'optimal_slope_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for optimal_slope_mean field
            //
            $editor = new TextEdit('optimal_slope_mean_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Mean (%)', 'optimal_slope_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for optimal_slope_min field
            //
            $editor = new TextEdit('optimal_slope_min_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Min (%)', 'optimal_slope_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photoperiod_long field
            //
            $editor = new CheckBox('photoperiod_long_edit');
            $editColumn = new CustomEditColumn('Photoperiod Long (>14 hours)', 'photoperiod_long', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photoperiod_neutral field
            //
            $editor = new CheckBox('photoperiod_neutral_edit');
            $editColumn = new CustomEditColumn('Photoperiod Neutral (12-14 hours)', 'photoperiod_neutral', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photoperiod_short field
            //
            $editor = new CheckBox('photoperiod_short_edit');
            $editColumn = new CustomEditColumn('Photoperiod Short (<12 hours)', 'photoperiod_short', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for production_system field
            //
            $editor = new TextEdit('production_system_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Production System', 'production_system', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_max field
            //
            $editor = new TextEdit('rainfall_optimal_max_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Max (mm/Year)', 'rainfall_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_mean field
            //
            $editor = new TextEdit('rainfall_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Mean (mm/Year)', 'rainfall_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_min field
            //
            $editor = new TextEdit('rainfall_optimal_min_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Minimum (mm/Year)', 'rainfall_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_max field
            //
            $editor = new TextEdit('rainfall_absolute_max_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Maximum (mm/Year)', 'rainfall_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_mean field
            //
            $editor = new TextEdit('rainfall_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Mean (mm/Year)', 'rainfall_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_min field
            //
            $editor = new TextEdit('rainfall_absolute_min_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Minimum (mm/Year)', 'rainfall_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_high field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_high_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal High', 'heavymetal_toxicity_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_moderate field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal Moderate', 'heavymetal_toxicity_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_low field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_low_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal Low', 'heavymetal_toxicity_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_high field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_high_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute High', 'heavymetal_toxicity_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_moderate field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute Moderate', 'heavymetal_toxicity_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_low field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_low_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute Low', 'heavymetal_toxicity_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_deep field
            //
            $editor = new CheckBox('soil_depth_optimal_deep_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Deep (>150cm)', 'soil_depth_optimal_deep', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_medium field
            //
            $editor = new CheckBox('soil_depth_optimal_medium_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Medium (50 - 150cm)', 'soil_depth_optimal_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_low field
            //
            $editor = new CheckBox('soil_depth_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Low (< 50cm)', 'soil_depth_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_deep field
            //
            $editor = new CheckBox('soil_depth_absolute_deep_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Deep (>150cm)', 'soil_depth_absolute_deep', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_medium field
            //
            $editor = new CheckBox('soil_depth_absolute_medium_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Medium (50-150cm)', 'soil_depth_absolute_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_low field
            //
            $editor = new CheckBox('soil_depth_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Low (<50cm)', 'soil_depth_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_high field
            //
            $editor = new CheckBox('soil_fertility_optimal_high_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal High', 'soil_fertility_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_moderate field
            //
            $editor = new CheckBox('soil_fertility_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal Moderate', 'soil_fertility_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_low field
            //
            $editor = new CheckBox('soil_fertility_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal Low', 'soil_fertility_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_high field
            //
            $editor = new CheckBox('soil_fertility_absolute_high_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute High', 'soil_fertility_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_moderate field
            //
            $editor = new CheckBox('soil_fertility_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute Moderate', 'soil_fertility_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_low field
            //
            $editor = new CheckBox('soil_fertility_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute Low', 'soil_fertility_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_max field
            //
            $editor = new TextEdit('soil_ph_optimal_max_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Max', 'soil_ph_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_mean field
            //
            $editor = new TextEdit('soil_ph_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Mean', 'soil_ph_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_min field
            //
            $editor = new TextEdit('soil_ph_optimal_min_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Min', 'soil_ph_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_max field
            //
            $editor = new TextEdit('soil_ph_absolute_max_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Max', 'soil_ph_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_mean field
            //
            $editor = new TextEdit('soil_ph_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Mean', 'soil_ph_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_min field
            //
            $editor = new TextEdit('soil_ph_absolute_min_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Min', 'soil_ph_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_high field
            //
            $editor = new CheckBox('soil_salinity_optimal_high_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal High (>10 dS/m)', 'soil_salinity_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_moderate field
            //
            $editor = new CheckBox('soil_salinity_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal Moderate (4-10dS/m)', 'soil_salinity_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_low field
            //
            $editor = new CheckBox('soil_salinity_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal Low (<4 dS/m)', 'soil_salinity_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_high field
            //
            $editor = new CheckBox('soil_salinity_absolute_high_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute High (10 dS/m)', 'soil_salinity_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_moderate field
            //
            $editor = new CheckBox('soil_salinity_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute Moderate (4-10dS/m)', 'soil_salinity_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_low field
            //
            $editor = new CheckBox('soil_salinity_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute Low (<4 dS/m)', 'soil_salinity_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_heavy field
            //
            $editor = new CheckBox('soil_texture_optimal_heavy_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Heavy', 'soil_texture_optimal_heavy', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_medium field
            //
            $editor = new CheckBox('soil_texture_optimal_medium_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Medium', 'soil_texture_optimal_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_light field
            //
            $editor = new CheckBox('soil_texture_optimal_light_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Light', 'soil_texture_optimal_light', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_heavy field
            //
            $editor = new CheckBox('soil_texture_absolute_heavy_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Heavy', 'soil_texture_absolute_heavy', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_medium field
            //
            $editor = new CheckBox('soil_texture_absolute_medium_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Medium', 'soil_texture_absolute_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_light field
            //
            $editor = new CheckBox('soil_texture_absolute_light_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Light', 'soil_texture_absolute_light', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_max field
            //
            $editor = new TextEdit('temperature_optimal_max_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Max (Degree Celcius)', 'temperature_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_mean field
            //
            $editor = new TextEdit('temperature_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Mean (Degree Celcius)', 'temperature_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_min field
            //
            $editor = new TextEdit('temperature_optimal_min_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Min (Degree Celcius)', 'temperature_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_max field
            //
            $editor = new TextEdit('temperature_absolute_max_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Max (Degree Celcius)', 'temperature_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_mean field
            //
            $editor = new TextEdit('temperature_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Mean (Degree Celcius)', 'temperature_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_min field
            //
            $editor = new TextEdit('temperature_absolute_min_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Min (Degree Celcius)', 'temperature_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_clay_max field
            //
            $editor = new TextEdit('texture_clay_max_edit');
            $editColumn = new CustomEditColumn('Texture Clay Max (%)', 'texture_clay_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_clay_mean field
            //
            $editor = new TextEdit('texture_clay_mean_edit');
            $editColumn = new CustomEditColumn('Texture Clay Mean (%)', 'texture_clay_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_clay_min field
            //
            $editor = new TextEdit('texture_clay_min_edit');
            $editColumn = new CustomEditColumn('Texture Clay Min (%)', 'texture_clay_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_sand_max field
            //
            $editor = new TextEdit('texture_sand_max_edit');
            $editColumn = new CustomEditColumn('Texture Sand Max (%)', 'texture_sand_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_sand_mean field
            //
            $editor = new TextEdit('texture_sand_mean_edit');
            $editColumn = new CustomEditColumn('Texture Sand Mean (%)', 'texture_sand_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_sand_min field
            //
            $editor = new TextEdit('texture_sand_min_edit');
            $editColumn = new CustomEditColumn('Texture Sand Min (%)', 'texture_sand_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_silt_max field
            //
            $editor = new TextEdit('texture_silt_max_edit');
            $editColumn = new CustomEditColumn('Texture Silt Max (%)', 'texture_silt_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_silt_mean field
            //
            $editor = new TextEdit('texture_silt_mean_edit');
            $editColumn = new CustomEditColumn('Texture Silt Mean (%)', 'texture_silt_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for texture_silt_min field
            //
            $editor = new TextEdit('texture_silt_min_edit');
            $editColumn = new CustomEditColumn('Texture Silt Min (%)', 'texture_silt_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for water_requirement_max field
            //
            $editor = new TextEdit('water_requirement_max_edit');
            $editColumn = new CustomEditColumn('Water Requirement Max (liter/ha/season)', 'water_requirement_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for water_requirement_mean field
            //
            $editor = new TextEdit('water_requirement_mean_edit');
            $editColumn = new CustomEditColumn('Water Requirement Mean (liter/ha/season)', 'water_requirement_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for water_requirement_min field
            //
            $editor = new TextEdit('water_requirement_min_edit');
            $editColumn = new CustomEditColumn('Water Requirement Min (liter/ha/season)', 'water_requirement_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for metadata_id field
            //
            $editor = new DynamicCombobox('metadata_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Metadata ID', 'metadata_id', 'metadata_id_id', 'multi_edit_ag_agroecology_metadata_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for cropid field
            //
            $editor = new DynamicCombobox('cropid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Crop ID', 'cropid', 'cropid_name', 'insert_ag_agroecology_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zone_a field
            //
            $editor = new CheckBox('zone_a_edit');
            $editColumn = new CustomEditColumn('Zone A', 'zone_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zone_b field
            //
            $editor = new CheckBox('zone_b_edit');
            $editColumn = new CustomEditColumn('Zone B', 'zone_b', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zone_c field
            //
            $editor = new CheckBox('zone_c_edit');
            $editColumn = new CustomEditColumn('Zone C', 'zone_c', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zone_d field
            //
            $editor = new CheckBox('zone_d_edit');
            $editColumn = new CustomEditColumn('Zone D', 'zone_d', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zone_e field
            //
            $editor = new CheckBox('zone_e_edit');
            $editColumn = new CustomEditColumn('Zone E', 'zone_e', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for climate_zone field
            //
            $editor = new TextEdit('climate_zone_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Climate Zone', 'climate_zone', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_max field
            //
            $editor = new TextEdit('altitude_optimal_max_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Max (m)', 'altitude_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_mean field
            //
            $editor = new TextEdit('altitude_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Mean (m)', 'altitude_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for altitude_optimal_min field
            //
            $editor = new TextEdit('altitude_optimal_min_edit');
            $editColumn = new CustomEditColumn('Altitude Optimal Min (m)', 'altitude_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_max field
            //
            $editor = new TextEdit('altitude_absolute_max_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Max (m)', 'altitude_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_mean field
            //
            $editor = new TextEdit('altitude_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Mean (m)', 'altitude_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for altitude_absolute_min field
            //
            $editor = new TextEdit('altitude_absolute_min_edit');
            $editColumn = new CustomEditColumn('Altitude Absolute Min (m)', 'altitude_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_max field
            //
            $editor = new TextEdit('latitude_optimal_max_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Max (Degree North/South)', 'latitude_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_mean field
            //
            $editor = new TextEdit('latitude_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Mean (Degree North/South)', 'latitude_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude_optimal_min field
            //
            $editor = new TextEdit('latitude_optimal_min_edit');
            $editColumn = new CustomEditColumn('Latitude Optimal Min (Degree North/South)', 'latitude_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_max field
            //
            $editor = new TextEdit('latitude_absolute_max_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Max (Degree North/South)', 'latitude_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_mean field
            //
            $editor = new TextEdit('latitude_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Mean (Degree North/South)', 'latitude_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude_absolute_min field
            //
            $editor = new TextEdit('latitude_absolute_min_edit');
            $editColumn = new CustomEditColumn('Latitude Absolute Min (Degree North/South)', 'latitude_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for light_optimal_max field
            //
            $editor = new TextEdit('light_optimal_max_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Max', 'light_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for light_optimal_mean field
            //
            $editor = new TextEdit('light_optimal_mean_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Mean', 'light_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for light_optimal_min field
            //
            $editor = new TextEdit('light_optimal_min_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Optimal Min', 'light_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for light_absolute_max field
            //
            $editor = new TextEdit('light_absolute_max_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Max', 'light_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for light_absolute_mean field
            //
            $editor = new TextEdit('light_absolute_mean_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Mean', 'light_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for light_absolute_min field
            //
            $editor = new TextEdit('light_absolute_min_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Light Intensity Absolute Min', 'light_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_max field
            //
            $editor = new TextEdit('optimal_aspect_max_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Max (Degree)', 'optimal_aspect_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_mean field
            //
            $editor = new TextEdit('optimal_aspect_mean_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Mean (Degree)', 'optimal_aspect_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for optimal_aspect_min field
            //
            $editor = new TextEdit('optimal_aspect_min_edit');
            $editColumn = new CustomEditColumn('Optimal Aspect Min (Degree)', 'optimal_aspect_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for optimal_slope_max field
            //
            $editor = new TextEdit('optimal_slope_max_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Max (%)', 'optimal_slope_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for optimal_slope_mean field
            //
            $editor = new TextEdit('optimal_slope_mean_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Mean (%)', 'optimal_slope_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for optimal_slope_min field
            //
            $editor = new TextEdit('optimal_slope_min_edit');
            $editColumn = new CustomEditColumn('Optimal Slope Min (%)', 'optimal_slope_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photoperiod_long field
            //
            $editor = new CheckBox('photoperiod_long_edit');
            $editColumn = new CustomEditColumn('Photoperiod Long (>14 hours)', 'photoperiod_long', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photoperiod_neutral field
            //
            $editor = new CheckBox('photoperiod_neutral_edit');
            $editColumn = new CustomEditColumn('Photoperiod Neutral (12-14 hours)', 'photoperiod_neutral', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photoperiod_short field
            //
            $editor = new CheckBox('photoperiod_short_edit');
            $editColumn = new CustomEditColumn('Photoperiod Short (<12 hours)', 'photoperiod_short', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for production_system field
            //
            $editor = new TextEdit('production_system_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Production System', 'production_system', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_max field
            //
            $editor = new TextEdit('rainfall_optimal_max_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Max (mm/Year)', 'rainfall_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_mean field
            //
            $editor = new TextEdit('rainfall_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Mean (mm/Year)', 'rainfall_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rainfall_optimal_min field
            //
            $editor = new TextEdit('rainfall_optimal_min_edit');
            $editColumn = new CustomEditColumn('Rainfall Optimal Minimum (mm/Year)', 'rainfall_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_max field
            //
            $editor = new TextEdit('rainfall_absolute_max_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Maximum (mm/Year)', 'rainfall_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_mean field
            //
            $editor = new TextEdit('rainfall_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Mean (mm/Year)', 'rainfall_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rainfall_absolute_min field
            //
            $editor = new TextEdit('rainfall_absolute_min_edit');
            $editColumn = new CustomEditColumn('Rainfall Absolute Minimum (mm/Year)', 'rainfall_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_high field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_high_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal High', 'heavymetal_toxicity_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_moderate field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal Moderate', 'heavymetal_toxicity_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_optimal_low field
            //
            $editor = new CheckBox('heavymetal_toxicity_optimal_low_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Optimal Low', 'heavymetal_toxicity_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_high field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_high_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute High', 'heavymetal_toxicity_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_moderate field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute Moderate', 'heavymetal_toxicity_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for heavymetal_toxicity_absolute_low field
            //
            $editor = new CheckBox('heavymetal_toxicity_absolute_low_edit');
            $editColumn = new CustomEditColumn('Heavymetal Toxicity Absolute Low', 'heavymetal_toxicity_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_deep field
            //
            $editor = new CheckBox('soil_depth_optimal_deep_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Deep (>150cm)', 'soil_depth_optimal_deep', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_medium field
            //
            $editor = new CheckBox('soil_depth_optimal_medium_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Medium (50 - 150cm)', 'soil_depth_optimal_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_depth_optimal_low field
            //
            $editor = new CheckBox('soil_depth_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Depth Optimal Low (< 50cm)', 'soil_depth_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_deep field
            //
            $editor = new CheckBox('soil_depth_absolute_deep_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Deep (>150cm)', 'soil_depth_absolute_deep', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_medium field
            //
            $editor = new CheckBox('soil_depth_absolute_medium_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Medium (50-150cm)', 'soil_depth_absolute_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_depth_absolute_low field
            //
            $editor = new CheckBox('soil_depth_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Depth Absolute Low (<50cm)', 'soil_depth_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_high field
            //
            $editor = new CheckBox('soil_fertility_optimal_high_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal High', 'soil_fertility_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_moderate field
            //
            $editor = new CheckBox('soil_fertility_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal Moderate', 'soil_fertility_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_fertility_optimal_low field
            //
            $editor = new CheckBox('soil_fertility_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Optimal Low', 'soil_fertility_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_high field
            //
            $editor = new CheckBox('soil_fertility_absolute_high_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute High', 'soil_fertility_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_moderate field
            //
            $editor = new CheckBox('soil_fertility_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute Moderate', 'soil_fertility_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_fertility_absolute_low field
            //
            $editor = new CheckBox('soil_fertility_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Fertility Absolute Low', 'soil_fertility_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_max field
            //
            $editor = new TextEdit('soil_ph_optimal_max_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Max', 'soil_ph_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_mean field
            //
            $editor = new TextEdit('soil_ph_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Mean', 'soil_ph_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_ph_optimal_min field
            //
            $editor = new TextEdit('soil_ph_optimal_min_edit');
            $editColumn = new CustomEditColumn('Soil pH Optimal Min', 'soil_ph_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_max field
            //
            $editor = new TextEdit('soil_ph_absolute_max_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Max', 'soil_ph_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_mean field
            //
            $editor = new TextEdit('soil_ph_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Mean', 'soil_ph_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_ph_absolute_min field
            //
            $editor = new TextEdit('soil_ph_absolute_min_edit');
            $editColumn = new CustomEditColumn('Soil pH Absolute Min', 'soil_ph_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_high field
            //
            $editor = new CheckBox('soil_salinity_optimal_high_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal High (>10 dS/m)', 'soil_salinity_optimal_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_moderate field
            //
            $editor = new CheckBox('soil_salinity_optimal_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal Moderate (4-10dS/m)', 'soil_salinity_optimal_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_salinity_optimal_low field
            //
            $editor = new CheckBox('soil_salinity_optimal_low_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Optimal Low (<4 dS/m)', 'soil_salinity_optimal_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_high field
            //
            $editor = new CheckBox('soil_salinity_absolute_high_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute High (10 dS/m)', 'soil_salinity_absolute_high', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_moderate field
            //
            $editor = new CheckBox('soil_salinity_absolute_moderate_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute Moderate (4-10dS/m)', 'soil_salinity_absolute_moderate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_salinity_absolute_low field
            //
            $editor = new CheckBox('soil_salinity_absolute_low_edit');
            $editColumn = new CustomEditColumn('Soil Salinity Absolute Low (<4 dS/m)', 'soil_salinity_absolute_low', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_heavy field
            //
            $editor = new CheckBox('soil_texture_optimal_heavy_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Heavy', 'soil_texture_optimal_heavy', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_medium field
            //
            $editor = new CheckBox('soil_texture_optimal_medium_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Medium', 'soil_texture_optimal_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_texture_optimal_light field
            //
            $editor = new CheckBox('soil_texture_optimal_light_edit');
            $editColumn = new CustomEditColumn('Soil Texture Optimal Light', 'soil_texture_optimal_light', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_heavy field
            //
            $editor = new CheckBox('soil_texture_absolute_heavy_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Heavy', 'soil_texture_absolute_heavy', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_medium field
            //
            $editor = new CheckBox('soil_texture_absolute_medium_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Medium', 'soil_texture_absolute_medium', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for soil_texture_absolute_light field
            //
            $editor = new CheckBox('soil_texture_absolute_light_edit');
            $editColumn = new CustomEditColumn('Soil Texture Absolute Light', 'soil_texture_absolute_light', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_max field
            //
            $editor = new TextEdit('temperature_optimal_max_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Max (Degree Celcius)', 'temperature_optimal_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_mean field
            //
            $editor = new TextEdit('temperature_optimal_mean_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Mean (Degree Celcius)', 'temperature_optimal_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for temperature_optimal_min field
            //
            $editor = new TextEdit('temperature_optimal_min_edit');
            $editColumn = new CustomEditColumn('Temperature Optimal Min (Degree Celcius)', 'temperature_optimal_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_max field
            //
            $editor = new TextEdit('temperature_absolute_max_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Max (Degree Celcius)', 'temperature_absolute_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_mean field
            //
            $editor = new TextEdit('temperature_absolute_mean_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Mean (Degree Celcius)', 'temperature_absolute_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for temperature_absolute_min field
            //
            $editor = new TextEdit('temperature_absolute_min_edit');
            $editColumn = new CustomEditColumn('Temperature Absolute Min (Degree Celcius)', 'temperature_absolute_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_clay_max field
            //
            $editor = new TextEdit('texture_clay_max_edit');
            $editColumn = new CustomEditColumn('Texture Clay Max (%)', 'texture_clay_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_clay_mean field
            //
            $editor = new TextEdit('texture_clay_mean_edit');
            $editColumn = new CustomEditColumn('Texture Clay Mean (%)', 'texture_clay_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_clay_min field
            //
            $editor = new TextEdit('texture_clay_min_edit');
            $editColumn = new CustomEditColumn('Texture Clay Min (%)', 'texture_clay_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_sand_max field
            //
            $editor = new TextEdit('texture_sand_max_edit');
            $editColumn = new CustomEditColumn('Texture Sand Max (%)', 'texture_sand_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_sand_mean field
            //
            $editor = new TextEdit('texture_sand_mean_edit');
            $editColumn = new CustomEditColumn('Texture Sand Mean (%)', 'texture_sand_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_sand_min field
            //
            $editor = new TextEdit('texture_sand_min_edit');
            $editColumn = new CustomEditColumn('Texture Sand Min (%)', 'texture_sand_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_silt_max field
            //
            $editor = new TextEdit('texture_silt_max_edit');
            $editColumn = new CustomEditColumn('Texture Silt Max (%)', 'texture_silt_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_silt_mean field
            //
            $editor = new TextEdit('texture_silt_mean_edit');
            $editColumn = new CustomEditColumn('Texture Silt Mean (%)', 'texture_silt_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for texture_silt_min field
            //
            $editor = new TextEdit('texture_silt_min_edit');
            $editColumn = new CustomEditColumn('Texture Silt Min (%)', 'texture_silt_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for water_requirement_max field
            //
            $editor = new TextEdit('water_requirement_max_edit');
            $editColumn = new CustomEditColumn('Water Requirement Max (liter/ha/season)', 'water_requirement_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for water_requirement_mean field
            //
            $editor = new TextEdit('water_requirement_mean_edit');
            $editColumn = new CustomEditColumn('Water Requirement Mean (liter/ha/season)', 'water_requirement_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for water_requirement_min field
            //
            $editor = new TextEdit('water_requirement_min_edit');
            $editColumn = new CustomEditColumn('Water Requirement Min (liter/ha/season)', 'water_requirement_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for metadata_id field
            //
            $editor = new DynamicCombobox('metadata_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Metadata ID', 'metadata_id', 'metadata_id_id', 'insert_ag_agroecology_metadata_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Agroecology ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zone_a field
            //
            $column = new CheckboxViewColumn('zone_a', 'zone_a', 'Zone A', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zone_b field
            //
            $column = new CheckboxViewColumn('zone_b', 'zone_b', 'Zone B', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zone_c field
            //
            $column = new CheckboxViewColumn('zone_c', 'zone_c', 'Zone C', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zone_d field
            //
            $column = new CheckboxViewColumn('zone_d', 'zone_d', 'Zone D', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zone_e field
            //
            $column = new CheckboxViewColumn('zone_e', 'zone_e', 'Zone E', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_climate_zone_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for altitude_optimal_max field
            //
            $column = new NumberViewColumn('altitude_optimal_max', 'altitude_optimal_max', 'Altitude Optimal Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for altitude_optimal_mean field
            //
            $column = new NumberViewColumn('altitude_optimal_mean', 'altitude_optimal_mean', 'Altitude Optimal Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for altitude_optimal_min field
            //
            $column = new NumberViewColumn('altitude_optimal_min', 'altitude_optimal_min', 'Altitude Optimal Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for altitude_absolute_max field
            //
            $column = new NumberViewColumn('altitude_absolute_max', 'altitude_absolute_max', 'Altitude Absolute Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for altitude_absolute_mean field
            //
            $column = new NumberViewColumn('altitude_absolute_mean', 'altitude_absolute_mean', 'Altitude Absolute Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for altitude_absolute_min field
            //
            $column = new NumberViewColumn('altitude_absolute_min', 'altitude_absolute_min', 'Altitude Absolute Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude_optimal_max field
            //
            $column = new NumberViewColumn('latitude_optimal_max', 'latitude_optimal_max', 'Latitude Optimal Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude_optimal_mean field
            //
            $column = new NumberViewColumn('latitude_optimal_mean', 'latitude_optimal_mean', 'Latitude Optimal Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude_optimal_min field
            //
            $column = new NumberViewColumn('latitude_optimal_min', 'latitude_optimal_min', 'Latitude Optimal Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude_absolute_max field
            //
            $column = new NumberViewColumn('latitude_absolute_max', 'latitude_absolute_max', 'Latitude Absolute Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude_absolute_mean field
            //
            $column = new NumberViewColumn('latitude_absolute_mean', 'latitude_absolute_mean', 'Latitude Absolute Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude_absolute_min field
            //
            $column = new NumberViewColumn('latitude_absolute_min', 'latitude_absolute_min', 'Latitude Absolute Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_max_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_mean_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_min_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_max_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_mean_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_min_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for optimal_aspect_max field
            //
            $column = new NumberViewColumn('optimal_aspect_max', 'optimal_aspect_max', 'Optimal Aspect Max (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for optimal_aspect_mean field
            //
            $column = new NumberViewColumn('optimal_aspect_mean', 'optimal_aspect_mean', 'Optimal Aspect Mean (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for optimal_aspect_min field
            //
            $column = new NumberViewColumn('optimal_aspect_min', 'optimal_aspect_min', 'Optimal Aspect Min (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for optimal_slope_max field
            //
            $column = new NumberViewColumn('optimal_slope_max', 'optimal_slope_max', 'Optimal Slope Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for optimal_slope_mean field
            //
            $column = new NumberViewColumn('optimal_slope_mean', 'optimal_slope_mean', 'Optimal Slope Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for optimal_slope_min field
            //
            $column = new NumberViewColumn('optimal_slope_min', 'optimal_slope_min', 'Optimal Slope Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photoperiod_long field
            //
            $column = new CheckboxViewColumn('photoperiod_long', 'photoperiod_long', 'Photoperiod Long (>14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photoperiod_neutral field
            //
            $column = new CheckboxViewColumn('photoperiod_neutral', 'photoperiod_neutral', 'Photoperiod Neutral (12-14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photoperiod_short field
            //
            $column = new CheckboxViewColumn('photoperiod_short', 'photoperiod_short', 'Photoperiod Short (<12 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_production_system_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for rainfall_optimal_max field
            //
            $column = new NumberViewColumn('rainfall_optimal_max', 'rainfall_optimal_max', 'Rainfall Optimal Max (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for rainfall_optimal_mean field
            //
            $column = new NumberViewColumn('rainfall_optimal_mean', 'rainfall_optimal_mean', 'Rainfall Optimal Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for rainfall_optimal_min field
            //
            $column = new NumberViewColumn('rainfall_optimal_min', 'rainfall_optimal_min', 'Rainfall Optimal Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for rainfall_absolute_max field
            //
            $column = new NumberViewColumn('rainfall_absolute_max', 'rainfall_absolute_max', 'Rainfall Absolute Maximum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for rainfall_absolute_mean field
            //
            $column = new NumberViewColumn('rainfall_absolute_mean', 'rainfall_absolute_mean', 'Rainfall Absolute Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for rainfall_absolute_min field
            //
            $column = new NumberViewColumn('rainfall_absolute_min', 'rainfall_absolute_min', 'Rainfall Absolute Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_high', 'heavymetal_toxicity_optimal_high', 'Heavymetal Toxicity Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_moderate', 'heavymetal_toxicity_optimal_moderate', 'Heavymetal Toxicity Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_low', 'heavymetal_toxicity_optimal_low', 'Heavymetal Toxicity Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_high', 'heavymetal_toxicity_absolute_high', 'Heavymetal Toxicity Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_moderate', 'heavymetal_toxicity_absolute_moderate', 'Heavymetal Toxicity Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_low', 'heavymetal_toxicity_absolute_low', 'Heavymetal Toxicity Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_depth_optimal_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_deep', 'soil_depth_optimal_deep', 'Soil Depth Optimal Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_depth_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_medium', 'soil_depth_optimal_medium', 'Soil Depth Optimal Medium (50 - 150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_depth_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_low', 'soil_depth_optimal_low', 'Soil Depth Optimal Low (< 50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_depth_absolute_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_deep', 'soil_depth_absolute_deep', 'Soil Depth Absolute Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_depth_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_medium', 'soil_depth_absolute_medium', 'Soil Depth Absolute Medium (50-150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_depth_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_low', 'soil_depth_absolute_low', 'Soil Depth Absolute Low (<50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_fertility_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_high', 'soil_fertility_optimal_high', 'Soil Fertility Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_fertility_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_moderate', 'soil_fertility_optimal_moderate', 'Soil Fertility Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_fertility_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_low', 'soil_fertility_optimal_low', 'Soil Fertility Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_fertility_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_high', 'soil_fertility_absolute_high', 'Soil Fertility Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_fertility_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_moderate', 'soil_fertility_absolute_moderate', 'Soil Fertility Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_fertility_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_low', 'soil_fertility_absolute_low', 'Soil Fertility Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_ph_optimal_max field
            //
            $column = new NumberViewColumn('soil_ph_optimal_max', 'soil_ph_optimal_max', 'Soil pH Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_ph_optimal_mean field
            //
            $column = new NumberViewColumn('soil_ph_optimal_mean', 'soil_ph_optimal_mean', 'Soil pH Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_ph_optimal_min field
            //
            $column = new NumberViewColumn('soil_ph_optimal_min', 'soil_ph_optimal_min', 'Soil pH Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_ph_absolute_max field
            //
            $column = new NumberViewColumn('soil_ph_absolute_max', 'soil_ph_absolute_max', 'Soil pH Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_ph_absolute_mean field
            //
            $column = new NumberViewColumn('soil_ph_absolute_mean', 'soil_ph_absolute_mean', 'Soil pH Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_ph_absolute_min field
            //
            $column = new NumberViewColumn('soil_ph_absolute_min', 'soil_ph_absolute_min', 'Soil pH Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_salinity_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_high', 'soil_salinity_optimal_high', 'Soil Salinity Optimal High (>10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_salinity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_moderate', 'soil_salinity_optimal_moderate', 'Soil Salinity Optimal Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_salinity_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_low', 'soil_salinity_optimal_low', 'Soil Salinity Optimal Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_salinity_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_high', 'soil_salinity_absolute_high', 'Soil Salinity Absolute High (10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_salinity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_moderate', 'soil_salinity_absolute_moderate', 'Soil Salinity Absolute Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_salinity_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_low', 'soil_salinity_absolute_low', 'Soil Salinity Absolute Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_texture_optimal_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_heavy', 'soil_texture_optimal_heavy', 'Soil Texture Optimal Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_texture_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_medium', 'soil_texture_optimal_medium', 'Soil Texture Optimal Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_texture_optimal_light field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_light', 'soil_texture_optimal_light', 'Soil Texture Optimal Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_texture_absolute_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_heavy', 'soil_texture_absolute_heavy', 'Soil Texture Absolute Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_texture_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_medium', 'soil_texture_absolute_medium', 'Soil Texture Absolute Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for soil_texture_absolute_light field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_light', 'soil_texture_absolute_light', 'Soil Texture Absolute Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for temperature_optimal_max field
            //
            $column = new NumberViewColumn('temperature_optimal_max', 'temperature_optimal_max', 'Temperature Optimal Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for temperature_optimal_mean field
            //
            $column = new NumberViewColumn('temperature_optimal_mean', 'temperature_optimal_mean', 'Temperature Optimal Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for temperature_optimal_min field
            //
            $column = new NumberViewColumn('temperature_optimal_min', 'temperature_optimal_min', 'Temperature Optimal Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for temperature_absolute_max field
            //
            $column = new NumberViewColumn('temperature_absolute_max', 'temperature_absolute_max', 'Temperature Absolute Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for temperature_absolute_mean field
            //
            $column = new NumberViewColumn('temperature_absolute_mean', 'temperature_absolute_mean', 'Temperature Absolute Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for temperature_absolute_min field
            //
            $column = new NumberViewColumn('temperature_absolute_min', 'temperature_absolute_min', 'Temperature Absolute Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_clay_max field
            //
            $column = new NumberViewColumn('texture_clay_max', 'texture_clay_max', 'Texture Clay Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_clay_mean field
            //
            $column = new NumberViewColumn('texture_clay_mean', 'texture_clay_mean', 'Texture Clay Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_clay_min field
            //
            $column = new NumberViewColumn('texture_clay_min', 'texture_clay_min', 'Texture Clay Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_sand_max field
            //
            $column = new NumberViewColumn('texture_sand_max', 'texture_sand_max', 'Texture Sand Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_sand_mean field
            //
            $column = new NumberViewColumn('texture_sand_mean', 'texture_sand_mean', 'Texture Sand Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_sand_min field
            //
            $column = new NumberViewColumn('texture_sand_min', 'texture_sand_min', 'Texture Sand Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_silt_max field
            //
            $column = new NumberViewColumn('texture_silt_max', 'texture_silt_max', 'Texture Silt Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_silt_mean field
            //
            $column = new NumberViewColumn('texture_silt_mean', 'texture_silt_mean', 'Texture Silt Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for texture_silt_min field
            //
            $column = new NumberViewColumn('texture_silt_min', 'texture_silt_min', 'Texture Silt Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for water_requirement_max field
            //
            $column = new NumberViewColumn('water_requirement_max', 'water_requirement_max', 'Water Requirement Max (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for water_requirement_mean field
            //
            $column = new NumberViewColumn('water_requirement_mean', 'water_requirement_mean', 'Water Requirement Mean (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for water_requirement_min field
            //
            $column = new NumberViewColumn('water_requirement_min', 'water_requirement_min', 'Water Requirement Min (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Agroecology ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for zone_a field
            //
            $column = new CheckboxViewColumn('zone_a', 'zone_a', 'Zone A', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zone_b field
            //
            $column = new CheckboxViewColumn('zone_b', 'zone_b', 'Zone B', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zone_c field
            //
            $column = new CheckboxViewColumn('zone_c', 'zone_c', 'Zone C', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zone_d field
            //
            $column = new CheckboxViewColumn('zone_d', 'zone_d', 'Zone D', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zone_e field
            //
            $column = new CheckboxViewColumn('zone_e', 'zone_e', 'Zone E', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_climate_zone_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for altitude_optimal_max field
            //
            $column = new NumberViewColumn('altitude_optimal_max', 'altitude_optimal_max', 'Altitude Optimal Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for altitude_optimal_mean field
            //
            $column = new NumberViewColumn('altitude_optimal_mean', 'altitude_optimal_mean', 'Altitude Optimal Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for altitude_optimal_min field
            //
            $column = new NumberViewColumn('altitude_optimal_min', 'altitude_optimal_min', 'Altitude Optimal Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for altitude_absolute_max field
            //
            $column = new NumberViewColumn('altitude_absolute_max', 'altitude_absolute_max', 'Altitude Absolute Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for altitude_absolute_mean field
            //
            $column = new NumberViewColumn('altitude_absolute_mean', 'altitude_absolute_mean', 'Altitude Absolute Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for altitude_absolute_min field
            //
            $column = new NumberViewColumn('altitude_absolute_min', 'altitude_absolute_min', 'Altitude Absolute Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude_optimal_max field
            //
            $column = new NumberViewColumn('latitude_optimal_max', 'latitude_optimal_max', 'Latitude Optimal Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude_optimal_mean field
            //
            $column = new NumberViewColumn('latitude_optimal_mean', 'latitude_optimal_mean', 'Latitude Optimal Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude_optimal_min field
            //
            $column = new NumberViewColumn('latitude_optimal_min', 'latitude_optimal_min', 'Latitude Optimal Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude_absolute_max field
            //
            $column = new NumberViewColumn('latitude_absolute_max', 'latitude_absolute_max', 'Latitude Absolute Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude_absolute_mean field
            //
            $column = new NumberViewColumn('latitude_absolute_mean', 'latitude_absolute_mean', 'Latitude Absolute Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude_absolute_min field
            //
            $column = new NumberViewColumn('latitude_absolute_min', 'latitude_absolute_min', 'Latitude Absolute Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_max_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_mean_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_min_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_max_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_mean_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_min_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for optimal_aspect_max field
            //
            $column = new NumberViewColumn('optimal_aspect_max', 'optimal_aspect_max', 'Optimal Aspect Max (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for optimal_aspect_mean field
            //
            $column = new NumberViewColumn('optimal_aspect_mean', 'optimal_aspect_mean', 'Optimal Aspect Mean (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for optimal_aspect_min field
            //
            $column = new NumberViewColumn('optimal_aspect_min', 'optimal_aspect_min', 'Optimal Aspect Min (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for optimal_slope_max field
            //
            $column = new NumberViewColumn('optimal_slope_max', 'optimal_slope_max', 'Optimal Slope Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for optimal_slope_mean field
            //
            $column = new NumberViewColumn('optimal_slope_mean', 'optimal_slope_mean', 'Optimal Slope Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for optimal_slope_min field
            //
            $column = new NumberViewColumn('optimal_slope_min', 'optimal_slope_min', 'Optimal Slope Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for photoperiod_long field
            //
            $column = new CheckboxViewColumn('photoperiod_long', 'photoperiod_long', 'Photoperiod Long (>14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for photoperiod_neutral field
            //
            $column = new CheckboxViewColumn('photoperiod_neutral', 'photoperiod_neutral', 'Photoperiod Neutral (12-14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for photoperiod_short field
            //
            $column = new CheckboxViewColumn('photoperiod_short', 'photoperiod_short', 'Photoperiod Short (<12 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_production_system_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for rainfall_optimal_max field
            //
            $column = new NumberViewColumn('rainfall_optimal_max', 'rainfall_optimal_max', 'Rainfall Optimal Max (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for rainfall_optimal_mean field
            //
            $column = new NumberViewColumn('rainfall_optimal_mean', 'rainfall_optimal_mean', 'Rainfall Optimal Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for rainfall_optimal_min field
            //
            $column = new NumberViewColumn('rainfall_optimal_min', 'rainfall_optimal_min', 'Rainfall Optimal Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for rainfall_absolute_max field
            //
            $column = new NumberViewColumn('rainfall_absolute_max', 'rainfall_absolute_max', 'Rainfall Absolute Maximum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for rainfall_absolute_mean field
            //
            $column = new NumberViewColumn('rainfall_absolute_mean', 'rainfall_absolute_mean', 'Rainfall Absolute Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for rainfall_absolute_min field
            //
            $column = new NumberViewColumn('rainfall_absolute_min', 'rainfall_absolute_min', 'Rainfall Absolute Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_high', 'heavymetal_toxicity_optimal_high', 'Heavymetal Toxicity Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_moderate', 'heavymetal_toxicity_optimal_moderate', 'Heavymetal Toxicity Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_low', 'heavymetal_toxicity_optimal_low', 'Heavymetal Toxicity Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_high', 'heavymetal_toxicity_absolute_high', 'Heavymetal Toxicity Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_moderate', 'heavymetal_toxicity_absolute_moderate', 'Heavymetal Toxicity Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_low', 'heavymetal_toxicity_absolute_low', 'Heavymetal Toxicity Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_depth_optimal_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_deep', 'soil_depth_optimal_deep', 'Soil Depth Optimal Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_depth_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_medium', 'soil_depth_optimal_medium', 'Soil Depth Optimal Medium (50 - 150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_depth_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_low', 'soil_depth_optimal_low', 'Soil Depth Optimal Low (< 50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_depth_absolute_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_deep', 'soil_depth_absolute_deep', 'Soil Depth Absolute Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_depth_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_medium', 'soil_depth_absolute_medium', 'Soil Depth Absolute Medium (50-150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_depth_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_low', 'soil_depth_absolute_low', 'Soil Depth Absolute Low (<50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_fertility_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_high', 'soil_fertility_optimal_high', 'Soil Fertility Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_fertility_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_moderate', 'soil_fertility_optimal_moderate', 'Soil Fertility Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_fertility_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_low', 'soil_fertility_optimal_low', 'Soil Fertility Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_fertility_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_high', 'soil_fertility_absolute_high', 'Soil Fertility Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_fertility_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_moderate', 'soil_fertility_absolute_moderate', 'Soil Fertility Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_fertility_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_low', 'soil_fertility_absolute_low', 'Soil Fertility Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_ph_optimal_max field
            //
            $column = new NumberViewColumn('soil_ph_optimal_max', 'soil_ph_optimal_max', 'Soil pH Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_ph_optimal_mean field
            //
            $column = new NumberViewColumn('soil_ph_optimal_mean', 'soil_ph_optimal_mean', 'Soil pH Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_ph_optimal_min field
            //
            $column = new NumberViewColumn('soil_ph_optimal_min', 'soil_ph_optimal_min', 'Soil pH Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_ph_absolute_max field
            //
            $column = new NumberViewColumn('soil_ph_absolute_max', 'soil_ph_absolute_max', 'Soil pH Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_ph_absolute_mean field
            //
            $column = new NumberViewColumn('soil_ph_absolute_mean', 'soil_ph_absolute_mean', 'Soil pH Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_ph_absolute_min field
            //
            $column = new NumberViewColumn('soil_ph_absolute_min', 'soil_ph_absolute_min', 'Soil pH Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_salinity_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_high', 'soil_salinity_optimal_high', 'Soil Salinity Optimal High (>10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_salinity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_moderate', 'soil_salinity_optimal_moderate', 'Soil Salinity Optimal Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_salinity_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_low', 'soil_salinity_optimal_low', 'Soil Salinity Optimal Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_salinity_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_high', 'soil_salinity_absolute_high', 'Soil Salinity Absolute High (10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_salinity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_moderate', 'soil_salinity_absolute_moderate', 'Soil Salinity Absolute Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_salinity_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_low', 'soil_salinity_absolute_low', 'Soil Salinity Absolute Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_texture_optimal_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_heavy', 'soil_texture_optimal_heavy', 'Soil Texture Optimal Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_texture_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_medium', 'soil_texture_optimal_medium', 'Soil Texture Optimal Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_texture_optimal_light field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_light', 'soil_texture_optimal_light', 'Soil Texture Optimal Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_texture_absolute_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_heavy', 'soil_texture_absolute_heavy', 'Soil Texture Absolute Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_texture_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_medium', 'soil_texture_absolute_medium', 'Soil Texture Absolute Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for soil_texture_absolute_light field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_light', 'soil_texture_absolute_light', 'Soil Texture Absolute Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for temperature_optimal_max field
            //
            $column = new NumberViewColumn('temperature_optimal_max', 'temperature_optimal_max', 'Temperature Optimal Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for temperature_optimal_mean field
            //
            $column = new NumberViewColumn('temperature_optimal_mean', 'temperature_optimal_mean', 'Temperature Optimal Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for temperature_optimal_min field
            //
            $column = new NumberViewColumn('temperature_optimal_min', 'temperature_optimal_min', 'Temperature Optimal Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for temperature_absolute_max field
            //
            $column = new NumberViewColumn('temperature_absolute_max', 'temperature_absolute_max', 'Temperature Absolute Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for temperature_absolute_mean field
            //
            $column = new NumberViewColumn('temperature_absolute_mean', 'temperature_absolute_mean', 'Temperature Absolute Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for temperature_absolute_min field
            //
            $column = new NumberViewColumn('temperature_absolute_min', 'temperature_absolute_min', 'Temperature Absolute Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_clay_max field
            //
            $column = new NumberViewColumn('texture_clay_max', 'texture_clay_max', 'Texture Clay Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_clay_mean field
            //
            $column = new NumberViewColumn('texture_clay_mean', 'texture_clay_mean', 'Texture Clay Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_clay_min field
            //
            $column = new NumberViewColumn('texture_clay_min', 'texture_clay_min', 'Texture Clay Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_sand_max field
            //
            $column = new NumberViewColumn('texture_sand_max', 'texture_sand_max', 'Texture Sand Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_sand_mean field
            //
            $column = new NumberViewColumn('texture_sand_mean', 'texture_sand_mean', 'Texture Sand Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_sand_min field
            //
            $column = new NumberViewColumn('texture_sand_min', 'texture_sand_min', 'Texture Sand Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_silt_max field
            //
            $column = new NumberViewColumn('texture_silt_max', 'texture_silt_max', 'Texture Silt Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_silt_mean field
            //
            $column = new NumberViewColumn('texture_silt_mean', 'texture_silt_mean', 'Texture Silt Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for texture_silt_min field
            //
            $column = new NumberViewColumn('texture_silt_min', 'texture_silt_min', 'Texture Silt Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for water_requirement_max field
            //
            $column = new NumberViewColumn('water_requirement_max', 'water_requirement_max', 'Water Requirement Max (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for water_requirement_mean field
            //
            $column = new NumberViewColumn('water_requirement_mean', 'water_requirement_mean', 'Water Requirement Mean (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for water_requirement_min field
            //
            $column = new NumberViewColumn('water_requirement_min', 'water_requirement_min', 'Water Requirement Min (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zone_a field
            //
            $column = new CheckboxViewColumn('zone_a', 'zone_a', 'Zone A', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zone_b field
            //
            $column = new CheckboxViewColumn('zone_b', 'zone_b', 'Zone B', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zone_c field
            //
            $column = new CheckboxViewColumn('zone_c', 'zone_c', 'Zone C', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zone_d field
            //
            $column = new CheckboxViewColumn('zone_d', 'zone_d', 'Zone D', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zone_e field
            //
            $column = new CheckboxViewColumn('zone_e', 'zone_e', 'Zone E', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_climate_zone_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for altitude_optimal_max field
            //
            $column = new NumberViewColumn('altitude_optimal_max', 'altitude_optimal_max', 'Altitude Optimal Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for altitude_optimal_mean field
            //
            $column = new NumberViewColumn('altitude_optimal_mean', 'altitude_optimal_mean', 'Altitude Optimal Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for altitude_optimal_min field
            //
            $column = new NumberViewColumn('altitude_optimal_min', 'altitude_optimal_min', 'Altitude Optimal Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for altitude_absolute_max field
            //
            $column = new NumberViewColumn('altitude_absolute_max', 'altitude_absolute_max', 'Altitude Absolute Max (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for altitude_absolute_mean field
            //
            $column = new NumberViewColumn('altitude_absolute_mean', 'altitude_absolute_mean', 'Altitude Absolute Mean (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for altitude_absolute_min field
            //
            $column = new NumberViewColumn('altitude_absolute_min', 'altitude_absolute_min', 'Altitude Absolute Min (m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude_optimal_max field
            //
            $column = new NumberViewColumn('latitude_optimal_max', 'latitude_optimal_max', 'Latitude Optimal Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude_optimal_mean field
            //
            $column = new NumberViewColumn('latitude_optimal_mean', 'latitude_optimal_mean', 'Latitude Optimal Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude_optimal_min field
            //
            $column = new NumberViewColumn('latitude_optimal_min', 'latitude_optimal_min', 'Latitude Optimal Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude_absolute_max field
            //
            $column = new NumberViewColumn('latitude_absolute_max', 'latitude_absolute_max', 'Latitude Absolute Max (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude_absolute_mean field
            //
            $column = new NumberViewColumn('latitude_absolute_mean', 'latitude_absolute_mean', 'Latitude Absolute Mean (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude_absolute_min field
            //
            $column = new NumberViewColumn('latitude_absolute_min', 'latitude_absolute_min', 'Latitude Absolute Min (Degree North/South)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_max_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_mean_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_optimal_min_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_max_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_mean_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_light_absolute_min_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for optimal_aspect_max field
            //
            $column = new NumberViewColumn('optimal_aspect_max', 'optimal_aspect_max', 'Optimal Aspect Max (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for optimal_aspect_mean field
            //
            $column = new NumberViewColumn('optimal_aspect_mean', 'optimal_aspect_mean', 'Optimal Aspect Mean (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for optimal_aspect_min field
            //
            $column = new NumberViewColumn('optimal_aspect_min', 'optimal_aspect_min', 'Optimal Aspect Min (Degree)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for optimal_slope_max field
            //
            $column = new NumberViewColumn('optimal_slope_max', 'optimal_slope_max', 'Optimal Slope Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for optimal_slope_mean field
            //
            $column = new NumberViewColumn('optimal_slope_mean', 'optimal_slope_mean', 'Optimal Slope Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for optimal_slope_min field
            //
            $column = new NumberViewColumn('optimal_slope_min', 'optimal_slope_min', 'Optimal Slope Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photoperiod_long field
            //
            $column = new CheckboxViewColumn('photoperiod_long', 'photoperiod_long', 'Photoperiod Long (>14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photoperiod_neutral field
            //
            $column = new CheckboxViewColumn('photoperiod_neutral', 'photoperiod_neutral', 'Photoperiod Neutral (12-14 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photoperiod_short field
            //
            $column = new CheckboxViewColumn('photoperiod_short', 'photoperiod_short', 'Photoperiod Short (<12 hours)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_production_system_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for rainfall_optimal_max field
            //
            $column = new NumberViewColumn('rainfall_optimal_max', 'rainfall_optimal_max', 'Rainfall Optimal Max (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for rainfall_optimal_mean field
            //
            $column = new NumberViewColumn('rainfall_optimal_mean', 'rainfall_optimal_mean', 'Rainfall Optimal Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for rainfall_optimal_min field
            //
            $column = new NumberViewColumn('rainfall_optimal_min', 'rainfall_optimal_min', 'Rainfall Optimal Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for rainfall_absolute_max field
            //
            $column = new NumberViewColumn('rainfall_absolute_max', 'rainfall_absolute_max', 'Rainfall Absolute Maximum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for rainfall_absolute_mean field
            //
            $column = new NumberViewColumn('rainfall_absolute_mean', 'rainfall_absolute_mean', 'Rainfall Absolute Mean (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for rainfall_absolute_min field
            //
            $column = new NumberViewColumn('rainfall_absolute_min', 'rainfall_absolute_min', 'Rainfall Absolute Minimum (mm/Year)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_high', 'heavymetal_toxicity_optimal_high', 'Heavymetal Toxicity Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_moderate', 'heavymetal_toxicity_optimal_moderate', 'Heavymetal Toxicity Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for heavymetal_toxicity_optimal_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_optimal_low', 'heavymetal_toxicity_optimal_low', 'Heavymetal Toxicity Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_high field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_high', 'heavymetal_toxicity_absolute_high', 'Heavymetal Toxicity Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_moderate', 'heavymetal_toxicity_absolute_moderate', 'Heavymetal Toxicity Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for heavymetal_toxicity_absolute_low field
            //
            $column = new CheckboxViewColumn('heavymetal_toxicity_absolute_low', 'heavymetal_toxicity_absolute_low', 'Heavymetal Toxicity Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_depth_optimal_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_deep', 'soil_depth_optimal_deep', 'Soil Depth Optimal Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_depth_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_medium', 'soil_depth_optimal_medium', 'Soil Depth Optimal Medium (50 - 150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_depth_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_depth_optimal_low', 'soil_depth_optimal_low', 'Soil Depth Optimal Low (< 50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_depth_absolute_deep field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_deep', 'soil_depth_absolute_deep', 'Soil Depth Absolute Deep (>150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_depth_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_medium', 'soil_depth_absolute_medium', 'Soil Depth Absolute Medium (50-150cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_depth_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_depth_absolute_low', 'soil_depth_absolute_low', 'Soil Depth Absolute Low (<50cm)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_fertility_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_high', 'soil_fertility_optimal_high', 'Soil Fertility Optimal High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_fertility_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_moderate', 'soil_fertility_optimal_moderate', 'Soil Fertility Optimal Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_fertility_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_optimal_low', 'soil_fertility_optimal_low', 'Soil Fertility Optimal Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_fertility_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_high', 'soil_fertility_absolute_high', 'Soil Fertility Absolute High', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_fertility_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_moderate', 'soil_fertility_absolute_moderate', 'Soil Fertility Absolute Moderate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_fertility_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_fertility_absolute_low', 'soil_fertility_absolute_low', 'Soil Fertility Absolute Low', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_ph_optimal_max field
            //
            $column = new NumberViewColumn('soil_ph_optimal_max', 'soil_ph_optimal_max', 'Soil pH Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_ph_optimal_mean field
            //
            $column = new NumberViewColumn('soil_ph_optimal_mean', 'soil_ph_optimal_mean', 'Soil pH Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_ph_optimal_min field
            //
            $column = new NumberViewColumn('soil_ph_optimal_min', 'soil_ph_optimal_min', 'Soil pH Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_ph_absolute_max field
            //
            $column = new NumberViewColumn('soil_ph_absolute_max', 'soil_ph_absolute_max', 'Soil pH Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_ph_absolute_mean field
            //
            $column = new NumberViewColumn('soil_ph_absolute_mean', 'soil_ph_absolute_mean', 'Soil pH Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_ph_absolute_min field
            //
            $column = new NumberViewColumn('soil_ph_absolute_min', 'soil_ph_absolute_min', 'Soil pH Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_salinity_optimal_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_high', 'soil_salinity_optimal_high', 'Soil Salinity Optimal High (>10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_salinity_optimal_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_moderate', 'soil_salinity_optimal_moderate', 'Soil Salinity Optimal Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_salinity_optimal_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_optimal_low', 'soil_salinity_optimal_low', 'Soil Salinity Optimal Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_salinity_absolute_high field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_high', 'soil_salinity_absolute_high', 'Soil Salinity Absolute High (10 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_salinity_absolute_moderate field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_moderate', 'soil_salinity_absolute_moderate', 'Soil Salinity Absolute Moderate (4-10dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_salinity_absolute_low field
            //
            $column = new CheckboxViewColumn('soil_salinity_absolute_low', 'soil_salinity_absolute_low', 'Soil Salinity Absolute Low (<4 dS/m)', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_texture_optimal_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_heavy', 'soil_texture_optimal_heavy', 'Soil Texture Optimal Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_texture_optimal_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_medium', 'soil_texture_optimal_medium', 'Soil Texture Optimal Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_texture_optimal_light field
            //
            $column = new CheckboxViewColumn('soil_texture_optimal_light', 'soil_texture_optimal_light', 'Soil Texture Optimal Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_texture_absolute_heavy field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_heavy', 'soil_texture_absolute_heavy', 'Soil Texture Absolute Heavy', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_texture_absolute_medium field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_medium', 'soil_texture_absolute_medium', 'Soil Texture Absolute Medium', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for soil_texture_absolute_light field
            //
            $column = new CheckboxViewColumn('soil_texture_absolute_light', 'soil_texture_absolute_light', 'Soil Texture Absolute Light', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for temperature_optimal_max field
            //
            $column = new NumberViewColumn('temperature_optimal_max', 'temperature_optimal_max', 'Temperature Optimal Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for temperature_optimal_mean field
            //
            $column = new NumberViewColumn('temperature_optimal_mean', 'temperature_optimal_mean', 'Temperature Optimal Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for temperature_optimal_min field
            //
            $column = new NumberViewColumn('temperature_optimal_min', 'temperature_optimal_min', 'Temperature Optimal Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for temperature_absolute_max field
            //
            $column = new NumberViewColumn('temperature_absolute_max', 'temperature_absolute_max', 'Temperature Absolute Max (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for temperature_absolute_mean field
            //
            $column = new NumberViewColumn('temperature_absolute_mean', 'temperature_absolute_mean', 'Temperature Absolute Mean (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for temperature_absolute_min field
            //
            $column = new NumberViewColumn('temperature_absolute_min', 'temperature_absolute_min', 'Temperature Absolute Min (Degree Celcius)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_clay_max field
            //
            $column = new NumberViewColumn('texture_clay_max', 'texture_clay_max', 'Texture Clay Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_clay_mean field
            //
            $column = new NumberViewColumn('texture_clay_mean', 'texture_clay_mean', 'Texture Clay Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_clay_min field
            //
            $column = new NumberViewColumn('texture_clay_min', 'texture_clay_min', 'Texture Clay Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_sand_max field
            //
            $column = new NumberViewColumn('texture_sand_max', 'texture_sand_max', 'Texture Sand Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_sand_mean field
            //
            $column = new NumberViewColumn('texture_sand_mean', 'texture_sand_mean', 'Texture Sand Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_sand_min field
            //
            $column = new NumberViewColumn('texture_sand_min', 'texture_sand_min', 'Texture Sand Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_silt_max field
            //
            $column = new NumberViewColumn('texture_silt_max', 'texture_silt_max', 'Texture Silt Max (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_silt_mean field
            //
            $column = new NumberViewColumn('texture_silt_mean', 'texture_silt_mean', 'Texture Silt Mean (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for texture_silt_min field
            //
            $column = new NumberViewColumn('texture_silt_min', 'texture_silt_min', 'Texture Silt Min (%)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for water_requirement_max field
            //
            $column = new NumberViewColumn('water_requirement_max', 'water_requirement_max', 'Water Requirement Max (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for water_requirement_mean field
            //
            $column = new NumberViewColumn('water_requirement_mean', 'water_requirement_mean', 'Water Requirement Mean (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for water_requirement_min field
            //
            $column = new NumberViewColumn('water_requirement_min', 'water_requirement_min', 'Water Requirement Min (liter/ha/season)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ag_agroecology_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(true);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        
        public function GetEnableModalGridInsert() { return true; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::CARD);
            $result->SetCardCountInRow(array(
                'lg' => 3,
                'md' => 2,
                'sm' => 1,
                'xs' => 1
            ));
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_climate_zone_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_max_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_mean_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_min_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_max_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_mean_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_min_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_production_system_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_climate_zone_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_max_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_mean_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_min_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_max_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_mean_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_min_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_production_system_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_climate_zone_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_max_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_mean_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_min_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_max_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_mean_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_min_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_production_system_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_notes_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ag_agroecology_metadata_id_search', 'id', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ag_agroecology_metadata_id_search', 'id', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for climate_zone field
            //
            $column = new TextViewColumn('climate_zone', 'climate_zone', 'Climate Zone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_climate_zone_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_max field
            //
            $column = new TextViewColumn('light_optimal_max', 'light_optimal_max', 'Light Intensity Optimal Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_max_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_mean field
            //
            $column = new TextViewColumn('light_optimal_mean', 'light_optimal_mean', 'Light Intensity Optimal Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_mean_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_optimal_min field
            //
            $column = new TextViewColumn('light_optimal_min', 'light_optimal_min', 'Light Intensity Optimal Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_optimal_min_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_max field
            //
            $column = new TextViewColumn('light_absolute_max', 'light_absolute_max', 'Light Intensity Absolute Max', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_max_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_mean field
            //
            $column = new TextViewColumn('light_absolute_mean', 'light_absolute_mean', 'Light Intensity Absolute Mean', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_mean_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for light_absolute_min field
            //
            $column = new TextViewColumn('light_absolute_min', 'light_absolute_min', 'Light Intensity Absolute Min', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_light_absolute_min_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for production_system field
            //
            $column = new TextViewColumn('production_system', 'production_system', 'Production System', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_production_system_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ag_agroecology_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ag_agroecology_metadata_id_search', 'id', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_records`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('scientific_name', true),
                    new IntegerField('family_id', true),
                    new IntegerField('infraspecific_category_id', true),
                    new StringField('synonyms'),
                    new IntegerField('crop_type_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_ag_agroecology_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata_alt`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new StringField('ref1', true),
                    new StringField('src1', true),
                    new IntegerField('acc_flag1_id'),
                    new IntegerField('location1_id'),
                    new IntegerField('document1_id'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new IntegerField('acc_flag2_id'),
                    new IntegerField('location2_id'),
                    new IntegerField('document2_id'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('acc_flag3_id'),
                    new IntegerField('location3_id'),
                    new IntegerField('document3_id'),
                    new IntegerField('image_id'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_ag_agroecology_metadata_id_search', 'id', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new ag_agroecologyPage("ag_agroecology", "ag_agroecology.php", GetCurrentUserPermissionSetForDataSource("ag_agroecology"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("ag_agroecology"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
