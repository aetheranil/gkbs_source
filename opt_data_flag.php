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
    
    
    
    class opt_data_flag_ag_seasonPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Ag Season');
            $this->SetMenuLabel('Ag Season');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ag_season`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new IntegerField('location_id', true),
                    new IntegerField('season_length_min', true),
                    new IntegerField('season_length_max', true),
                    new IntegerField('data_flag1_id'),
                    new IntegerField('period_sowing_to_1st_harvest_min'),
                    new IntegerField('period_sowing_to_1st_harvest_max'),
                    new IntegerField('data_flag2_id'),
                    new IntegerField('period_propagating_to_1st_harvest_min'),
                    new IntegerField('period_propagating_to_1st_harvest_max'),
                    new IntegerField('data_flag3_id'),
                    new DateField('planting_date_early_season'),
                    new DateField('planting_date_late_season'),
                    new StringField('season_others'),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $this->dataset->AddLookupField('cropid', 'crop_records', new IntegerField('id'), new StringField('name', false, false, false, false, 'cropid_name', 'cropid_name_crop_records'), 'cropid_name_crop_records');
            $this->dataset->AddLookupField('location_id', 'opt_google_placeid', new IntegerField('id'), new StringField('google_place_id', false, false, false, false, 'location_id_google_place_id', 'location_id_google_place_id_opt_google_placeid'), 'location_id_google_place_id_opt_google_placeid');
            $this->dataset->AddLookupField('data_flag1_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag1_id_data_flag', 'data_flag1_id_data_flag_opt_data_flag'), 'data_flag1_id_data_flag_opt_data_flag');
            $this->dataset->AddLookupField('data_flag2_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag2_id_data_flag', 'data_flag2_id_data_flag_opt_data_flag'), 'data_flag2_id_data_flag_opt_data_flag');
            $this->dataset->AddLookupField('data_flag3_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag3_id_data_flag', 'data_flag3_id_data_flag_opt_data_flag'), 'data_flag3_id_data_flag_opt_data_flag');
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
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Cropid'),
                new FilterColumn($this->dataset, 'location_id', 'location_id_google_place_id', 'Location Id'),
                new FilterColumn($this->dataset, 'season_length_min', 'season_length_min', 'Season Length Min'),
                new FilterColumn($this->dataset, 'season_length_max', 'season_length_max', 'Season Length Max'),
                new FilterColumn($this->dataset, 'data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id'),
                new FilterColumn($this->dataset, 'period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min'),
                new FilterColumn($this->dataset, 'period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max'),
                new FilterColumn($this->dataset, 'data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id'),
                new FilterColumn($this->dataset, 'period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min'),
                new FilterColumn($this->dataset, 'period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max'),
                new FilterColumn($this->dataset, 'data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id'),
                new FilterColumn($this->dataset, 'planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season'),
                new FilterColumn($this->dataset, 'planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season'),
                new FilterColumn($this->dataset, 'season_others', 'season_others', 'Season Others'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['location_id'])
                ->addColumn($columns['season_length_min'])
                ->addColumn($columns['season_length_max'])
                ->addColumn($columns['data_flag1_id'])
                ->addColumn($columns['period_sowing_to_1st_harvest_min'])
                ->addColumn($columns['period_sowing_to_1st_harvest_max'])
                ->addColumn($columns['data_flag2_id'])
                ->addColumn($columns['period_propagating_to_1st_harvest_min'])
                ->addColumn($columns['period_propagating_to_1st_harvest_max'])
                ->addColumn($columns['data_flag3_id'])
                ->addColumn($columns['planting_date_early_season'])
                ->addColumn($columns['planting_date_late_season'])
                ->addColumn($columns['season_others'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('location_id')
                ->setOptionsFor('data_flag1_id')
                ->setOptionsFor('data_flag2_id')
                ->setOptionsFor('data_flag3_id')
                ->setOptionsFor('planting_date_early_season')
                ->setOptionsFor('planting_date_late_season')
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
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_cropid_search');
            
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
            
            $main_editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_location_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('location_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_location_id_search');
            
            $text_editor = new TextEdit('location_id');
            
            $filterBuilder->addColumn(
                $columns['location_id'],
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
            
            $main_editor = new TextEdit('season_length_min_edit');
            
            $filterBuilder->addColumn(
                $columns['season_length_min'],
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
            
            $main_editor = new TextEdit('season_length_max_edit');
            
            $filterBuilder->addColumn(
                $columns['season_length_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_data_flag1_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag1_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_data_flag1_id_search');
            
            $text_editor = new TextEdit('data_flag1_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag1_id'],
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
            
            $main_editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            
            $filterBuilder->addColumn(
                $columns['period_sowing_to_1st_harvest_min'],
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
            
            $main_editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            
            $filterBuilder->addColumn(
                $columns['period_sowing_to_1st_harvest_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_data_flag2_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag2_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_data_flag2_id_search');
            
            $text_editor = new TextEdit('data_flag2_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag2_id'],
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
            
            $main_editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            
            $filterBuilder->addColumn(
                $columns['period_propagating_to_1st_harvest_min'],
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
            
            $main_editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            
            $filterBuilder->addColumn(
                $columns['period_propagating_to_1st_harvest_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_data_flag3_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag3_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season_data_flag3_id_search');
            
            $text_editor = new TextEdit('data_flag3_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag3_id'],
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
            
            $main_editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['planting_date_early_season'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['planting_date_late_season'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('season_others');
            
            $filterBuilder->addColumn(
                $columns['season_others'],
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
            
            $main_editor = new TextEdit('metadata_id_edit');
            
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag1_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag2_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag3_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_season_others_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag1_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag2_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag3_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_season_others_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'edit_opt_data_flag_ag_season_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'edit_opt_data_flag_ag_season_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'edit_opt_data_flag_ag_season_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'edit_opt_data_flag_ag_season_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'edit_opt_data_flag_ag_season_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'multi_edit_opt_data_flag_ag_season_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'multi_edit_opt_data_flag_ag_season_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'multi_edit_opt_data_flag_ag_season_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'multi_edit_opt_data_flag_ag_season_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'multi_edit_opt_data_flag_ag_season_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'insert_opt_data_flag_ag_season_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'insert_opt_data_flag_ag_season_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'insert_opt_data_flag_ag_season_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'insert_opt_data_flag_ag_season_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'insert_opt_data_flag_ag_season_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag1_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag2_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag3_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_season_others_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag1_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag2_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag3_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_season_others_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag1_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag2_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_data_flag3_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_season_others_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag1_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag2_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag3_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_season_others_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag1_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag2_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag3_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_season_others_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag1_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag2_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag3_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_season_others_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_notes_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season_data_flag3_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag1_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag2_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_data_flag3_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_season_others_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season_notes_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class opt_data_flag_ag_season01Page extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Ag Season');
            $this->SetMenuLabel('Ag Season');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ag_season`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new IntegerField('location_id', true),
                    new IntegerField('season_length_min', true),
                    new IntegerField('season_length_max', true),
                    new IntegerField('data_flag1_id'),
                    new IntegerField('period_sowing_to_1st_harvest_min'),
                    new IntegerField('period_sowing_to_1st_harvest_max'),
                    new IntegerField('data_flag2_id'),
                    new IntegerField('period_propagating_to_1st_harvest_min'),
                    new IntegerField('period_propagating_to_1st_harvest_max'),
                    new IntegerField('data_flag3_id'),
                    new DateField('planting_date_early_season'),
                    new DateField('planting_date_late_season'),
                    new StringField('season_others'),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $this->dataset->AddLookupField('cropid', 'crop_records', new IntegerField('id'), new StringField('name', false, false, false, false, 'cropid_name', 'cropid_name_crop_records'), 'cropid_name_crop_records');
            $this->dataset->AddLookupField('location_id', 'opt_google_placeid', new IntegerField('id'), new StringField('google_place_id', false, false, false, false, 'location_id_google_place_id', 'location_id_google_place_id_opt_google_placeid'), 'location_id_google_place_id_opt_google_placeid');
            $this->dataset->AddLookupField('data_flag1_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag1_id_data_flag', 'data_flag1_id_data_flag_opt_data_flag'), 'data_flag1_id_data_flag_opt_data_flag');
            $this->dataset->AddLookupField('data_flag2_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag2_id_data_flag', 'data_flag2_id_data_flag_opt_data_flag'), 'data_flag2_id_data_flag_opt_data_flag');
            $this->dataset->AddLookupField('data_flag3_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag3_id_data_flag', 'data_flag3_id_data_flag_opt_data_flag'), 'data_flag3_id_data_flag_opt_data_flag');
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
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Cropid'),
                new FilterColumn($this->dataset, 'location_id', 'location_id_google_place_id', 'Location Id'),
                new FilterColumn($this->dataset, 'season_length_min', 'season_length_min', 'Season Length Min'),
                new FilterColumn($this->dataset, 'season_length_max', 'season_length_max', 'Season Length Max'),
                new FilterColumn($this->dataset, 'data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id'),
                new FilterColumn($this->dataset, 'period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min'),
                new FilterColumn($this->dataset, 'period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max'),
                new FilterColumn($this->dataset, 'data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id'),
                new FilterColumn($this->dataset, 'period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min'),
                new FilterColumn($this->dataset, 'period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max'),
                new FilterColumn($this->dataset, 'data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id'),
                new FilterColumn($this->dataset, 'planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season'),
                new FilterColumn($this->dataset, 'planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season'),
                new FilterColumn($this->dataset, 'season_others', 'season_others', 'Season Others'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['location_id'])
                ->addColumn($columns['season_length_min'])
                ->addColumn($columns['season_length_max'])
                ->addColumn($columns['data_flag1_id'])
                ->addColumn($columns['period_sowing_to_1st_harvest_min'])
                ->addColumn($columns['period_sowing_to_1st_harvest_max'])
                ->addColumn($columns['data_flag2_id'])
                ->addColumn($columns['period_propagating_to_1st_harvest_min'])
                ->addColumn($columns['period_propagating_to_1st_harvest_max'])
                ->addColumn($columns['data_flag3_id'])
                ->addColumn($columns['planting_date_early_season'])
                ->addColumn($columns['planting_date_late_season'])
                ->addColumn($columns['season_others'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('location_id')
                ->setOptionsFor('data_flag1_id')
                ->setOptionsFor('data_flag2_id')
                ->setOptionsFor('data_flag3_id')
                ->setOptionsFor('planting_date_early_season')
                ->setOptionsFor('planting_date_late_season')
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
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_cropid_search');
            
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
            
            $main_editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_location_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('location_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_location_id_search');
            
            $text_editor = new TextEdit('location_id');
            
            $filterBuilder->addColumn(
                $columns['location_id'],
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
            
            $main_editor = new TextEdit('season_length_min_edit');
            
            $filterBuilder->addColumn(
                $columns['season_length_min'],
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
            
            $main_editor = new TextEdit('season_length_max_edit');
            
            $filterBuilder->addColumn(
                $columns['season_length_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_data_flag1_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag1_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_data_flag1_id_search');
            
            $text_editor = new TextEdit('data_flag1_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag1_id'],
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
            
            $main_editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            
            $filterBuilder->addColumn(
                $columns['period_sowing_to_1st_harvest_min'],
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
            
            $main_editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            
            $filterBuilder->addColumn(
                $columns['period_sowing_to_1st_harvest_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_data_flag2_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag2_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_data_flag2_id_search');
            
            $text_editor = new TextEdit('data_flag2_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag2_id'],
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
            
            $main_editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            
            $filterBuilder->addColumn(
                $columns['period_propagating_to_1st_harvest_min'],
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
            
            $main_editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            
            $filterBuilder->addColumn(
                $columns['period_propagating_to_1st_harvest_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_data_flag3_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag3_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season01_data_flag3_id_search');
            
            $text_editor = new TextEdit('data_flag3_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag3_id'],
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
            
            $main_editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['planting_date_early_season'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['planting_date_late_season'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('season_others');
            
            $filterBuilder->addColumn(
                $columns['season_others'],
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
            
            $main_editor = new TextEdit('metadata_id_edit');
            
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_season_others_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_season_others_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'edit_opt_data_flag_ag_season01_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'edit_opt_data_flag_ag_season01_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'edit_opt_data_flag_ag_season01_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'edit_opt_data_flag_ag_season01_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'edit_opt_data_flag_ag_season01_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'multi_edit_opt_data_flag_ag_season01_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'multi_edit_opt_data_flag_ag_season01_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'multi_edit_opt_data_flag_ag_season01_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'multi_edit_opt_data_flag_ag_season01_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'multi_edit_opt_data_flag_ag_season01_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'insert_opt_data_flag_ag_season01_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'insert_opt_data_flag_ag_season01_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'insert_opt_data_flag_ag_season01_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'insert_opt_data_flag_ag_season01_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'insert_opt_data_flag_ag_season01_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_season_others_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_season_others_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_season_others_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season01_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_season_others_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_season_others_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_season_others_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_notes_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season01_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season01_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season01_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season01_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season01_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season01_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season01_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season01_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season01_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season01_data_flag3_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag1_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag2_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_data_flag3_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_season_others_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season01_notes_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season01_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season01_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season01_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season01_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season01_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season01_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season01_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season01_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season01_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season01_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class opt_data_flag_ag_season02Page extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Ag Season');
            $this->SetMenuLabel('Ag Season');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ag_season`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new IntegerField('location_id', true),
                    new IntegerField('season_length_min', true),
                    new IntegerField('season_length_max', true),
                    new IntegerField('data_flag1_id'),
                    new IntegerField('period_sowing_to_1st_harvest_min'),
                    new IntegerField('period_sowing_to_1st_harvest_max'),
                    new IntegerField('data_flag2_id'),
                    new IntegerField('period_propagating_to_1st_harvest_min'),
                    new IntegerField('period_propagating_to_1st_harvest_max'),
                    new IntegerField('data_flag3_id'),
                    new DateField('planting_date_early_season'),
                    new DateField('planting_date_late_season'),
                    new StringField('season_others'),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $this->dataset->AddLookupField('cropid', 'crop_records', new IntegerField('id'), new StringField('name', false, false, false, false, 'cropid_name', 'cropid_name_crop_records'), 'cropid_name_crop_records');
            $this->dataset->AddLookupField('location_id', 'opt_google_placeid', new IntegerField('id'), new StringField('google_place_id', false, false, false, false, 'location_id_google_place_id', 'location_id_google_place_id_opt_google_placeid'), 'location_id_google_place_id_opt_google_placeid');
            $this->dataset->AddLookupField('data_flag1_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag1_id_data_flag', 'data_flag1_id_data_flag_opt_data_flag'), 'data_flag1_id_data_flag_opt_data_flag');
            $this->dataset->AddLookupField('data_flag2_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag2_id_data_flag', 'data_flag2_id_data_flag_opt_data_flag'), 'data_flag2_id_data_flag_opt_data_flag');
            $this->dataset->AddLookupField('data_flag3_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag3_id_data_flag', 'data_flag3_id_data_flag_opt_data_flag'), 'data_flag3_id_data_flag_opt_data_flag');
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
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Cropid'),
                new FilterColumn($this->dataset, 'location_id', 'location_id_google_place_id', 'Location Id'),
                new FilterColumn($this->dataset, 'season_length_min', 'season_length_min', 'Season Length Min'),
                new FilterColumn($this->dataset, 'season_length_max', 'season_length_max', 'Season Length Max'),
                new FilterColumn($this->dataset, 'data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id'),
                new FilterColumn($this->dataset, 'period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min'),
                new FilterColumn($this->dataset, 'period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max'),
                new FilterColumn($this->dataset, 'data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id'),
                new FilterColumn($this->dataset, 'period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min'),
                new FilterColumn($this->dataset, 'period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max'),
                new FilterColumn($this->dataset, 'data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id'),
                new FilterColumn($this->dataset, 'planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season'),
                new FilterColumn($this->dataset, 'planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season'),
                new FilterColumn($this->dataset, 'season_others', 'season_others', 'Season Others'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['location_id'])
                ->addColumn($columns['season_length_min'])
                ->addColumn($columns['season_length_max'])
                ->addColumn($columns['data_flag1_id'])
                ->addColumn($columns['period_sowing_to_1st_harvest_min'])
                ->addColumn($columns['period_sowing_to_1st_harvest_max'])
                ->addColumn($columns['data_flag2_id'])
                ->addColumn($columns['period_propagating_to_1st_harvest_min'])
                ->addColumn($columns['period_propagating_to_1st_harvest_max'])
                ->addColumn($columns['data_flag3_id'])
                ->addColumn($columns['planting_date_early_season'])
                ->addColumn($columns['planting_date_late_season'])
                ->addColumn($columns['season_others'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('location_id')
                ->setOptionsFor('data_flag1_id')
                ->setOptionsFor('data_flag2_id')
                ->setOptionsFor('data_flag3_id')
                ->setOptionsFor('planting_date_early_season')
                ->setOptionsFor('planting_date_late_season')
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
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_cropid_search');
            
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
            
            $main_editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_location_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('location_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_location_id_search');
            
            $text_editor = new TextEdit('location_id');
            
            $filterBuilder->addColumn(
                $columns['location_id'],
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
            
            $main_editor = new TextEdit('season_length_min_edit');
            
            $filterBuilder->addColumn(
                $columns['season_length_min'],
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
            
            $main_editor = new TextEdit('season_length_max_edit');
            
            $filterBuilder->addColumn(
                $columns['season_length_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_data_flag1_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag1_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_data_flag1_id_search');
            
            $text_editor = new TextEdit('data_flag1_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag1_id'],
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
            
            $main_editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            
            $filterBuilder->addColumn(
                $columns['period_sowing_to_1st_harvest_min'],
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
            
            $main_editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            
            $filterBuilder->addColumn(
                $columns['period_sowing_to_1st_harvest_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_data_flag2_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag2_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_data_flag2_id_search');
            
            $text_editor = new TextEdit('data_flag2_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag2_id'],
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
            
            $main_editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            
            $filterBuilder->addColumn(
                $columns['period_propagating_to_1st_harvest_min'],
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
            
            $main_editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            
            $filterBuilder->addColumn(
                $columns['period_propagating_to_1st_harvest_max'],
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
            
            $main_editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_data_flag3_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag3_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_ag_season02_data_flag3_id_search');
            
            $text_editor = new TextEdit('data_flag3_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag3_id'],
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
            
            $main_editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['planting_date_early_season'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['planting_date_late_season'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('season_others');
            
            $filterBuilder->addColumn(
                $columns['season_others'],
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
            
            $main_editor = new TextEdit('metadata_id_edit');
            
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_season_others_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_season_others_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'edit_opt_data_flag_ag_season02_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'edit_opt_data_flag_ag_season02_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'edit_opt_data_flag_ag_season02_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'edit_opt_data_flag_ag_season02_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'edit_opt_data_flag_ag_season02_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'multi_edit_opt_data_flag_ag_season02_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'multi_edit_opt_data_flag_ag_season02_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'multi_edit_opt_data_flag_ag_season02_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'multi_edit_opt_data_flag_ag_season02_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'multi_edit_opt_data_flag_ag_season02_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'insert_opt_data_flag_ag_season02_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'insert_opt_data_flag_ag_season02_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_length_min field
            //
            $editor = new TextEdit('season_length_min_edit');
            $editColumn = new CustomEditColumn('Season Length Min', 'season_length_min', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_length_max field
            //
            $editor = new TextEdit('season_length_max_edit');
            $editColumn = new CustomEditColumn('Season Length Max', 'season_length_max', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag1_id field
            //
            $editor = new DynamicCombobox('data_flag1_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag1 Id', 'data_flag1_id', 'data_flag1_id_data_flag', 'insert_opt_data_flag_ag_season02_data_flag1_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Min', 'period_sowing_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_sowing_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_sowing_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Sowing To 1st Harvest Max', 'period_sowing_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag2_id field
            //
            $editor = new DynamicCombobox('data_flag2_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag2 Id', 'data_flag2_id', 'data_flag2_id_data_flag', 'insert_opt_data_flag_ag_season02_data_flag2_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_min field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_min_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Min', 'period_propagating_to_1st_harvest_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for period_propagating_to_1st_harvest_max field
            //
            $editor = new TextEdit('period_propagating_to_1st_harvest_max_edit');
            $editColumn = new CustomEditColumn('Period Propagating To 1st Harvest Max', 'period_propagating_to_1st_harvest_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag3_id field
            //
            $editor = new DynamicCombobox('data_flag3_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag3 Id', 'data_flag3_id', 'data_flag3_id_data_flag', 'insert_opt_data_flag_ag_season02_data_flag3_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for planting_date_early_season field
            //
            $editor = new DateTimeEdit('planting_date_early_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Early Season', 'planting_date_early_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for planting_date_late_season field
            //
            $editor = new DateTimeEdit('planting_date_late_season_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Planting Date Late Season', 'planting_date_late_season', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for season_others field
            //
            $editor = new TextAreaEdit('season_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Season Others', 'season_others', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_season_others_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_season_others_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_length_min field
            //
            $column = new NumberViewColumn('season_length_min', 'season_length_min', 'Season Length Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_length_max field
            //
            $column = new NumberViewColumn('season_length_max', 'season_length_max', 'Season Length Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_min', 'period_sowing_to_1st_harvest_min', 'Period Sowing To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_sowing_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_sowing_to_1st_harvest_max', 'period_sowing_to_1st_harvest_max', 'Period Sowing To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_min field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_min', 'period_propagating_to_1st_harvest_min', 'Period Propagating To 1st Harvest Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for period_propagating_to_1st_harvest_max field
            //
            $column = new NumberViewColumn('period_propagating_to_1st_harvest_max', 'period_propagating_to_1st_harvest_max', 'Period Propagating To 1st Harvest Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for planting_date_early_season field
            //
            $column = new DateTimeViewColumn('planting_date_early_season', 'planting_date_early_season', 'Planting Date Early Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for planting_date_late_season field
            //
            $column = new DateTimeViewColumn('planting_date_late_season', 'planting_date_late_season', 'Planting Date Late Season', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_season_others_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_ag_season02_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_season_others_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_season_others_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_season_others_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_notes_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season02_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season02_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season02_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season02_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_ag_season02_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season02_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season02_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season02_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season02_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_ag_season02_data_flag3_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag1_id', 'data_flag1_id_data_flag', 'Data Flag1 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag1_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag2_id', 'data_flag2_id_data_flag', 'Data Flag2 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag2_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag3_id', 'data_flag3_id_data_flag', 'Data Flag3 Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_data_flag3_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for season_others field
            //
            $column = new TextViewColumn('season_others', 'season_others', 'Season Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_season_others_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_ag_season02_notes_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season02_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season02_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season02_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season02_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_ag_season02_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season02_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season02_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season02_data_flag1_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season02_data_flag2_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_ag_season02_data_flag3_id_search', 'id', 'data_flag', null, 20);
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
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class opt_data_flag_m_potential_yieldPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('M Potential Yield');
            $this->SetMenuLabel('M Potential Yield');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`m_potential_yield`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new IntegerField('location_id', true),
                    new IntegerField('part_id', true),
                    new IntegerField('year_id'),
                    new IntegerField('potential_yield_mean'),
                    new IntegerField('potential_yield_max'),
                    new IntegerField('potential_yield_min'),
                    new StringField('potential_yield_others'),
                    new IntegerField('data_flag_id'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $this->dataset->AddLookupField('cropid', 'crop_records', new IntegerField('id'), new StringField('name', false, false, false, false, 'cropid_name', 'cropid_name_crop_records'), 'cropid_name_crop_records');
            $this->dataset->AddLookupField('location_id', 'opt_google_placeid', new IntegerField('id'), new StringField('google_place_id', false, false, false, false, 'location_id_google_place_id', 'location_id_google_place_id_opt_google_placeid'), 'location_id_google_place_id_opt_google_placeid');
            $this->dataset->AddLookupField('part_id', 'opt_plant_part', new IntegerField('id'), new StringField('part_name', false, false, false, false, 'part_id_part_name', 'part_id_part_name_opt_plant_part'), 'part_id_part_name_opt_plant_part');
            $this->dataset->AddLookupField('year_id', 'opt_year', new IntegerField('id'), new IntegerField('year', false, false, false, false, 'year_id_year', 'year_id_year_opt_year'), 'year_id_year_opt_year');
            $this->dataset->AddLookupField('data_flag_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag_id_data_flag', 'data_flag_id_data_flag_opt_data_flag'), 'data_flag_id_data_flag_opt_data_flag');
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
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Cropid'),
                new FilterColumn($this->dataset, 'location_id', 'location_id_google_place_id', 'Location Id'),
                new FilterColumn($this->dataset, 'part_id', 'part_id_part_name', 'Part Id'),
                new FilterColumn($this->dataset, 'year_id', 'year_id_year', 'Year Id'),
                new FilterColumn($this->dataset, 'potential_yield_mean', 'potential_yield_mean', 'Potential Yield Mean'),
                new FilterColumn($this->dataset, 'potential_yield_max', 'potential_yield_max', 'Potential Yield Max'),
                new FilterColumn($this->dataset, 'potential_yield_min', 'potential_yield_min', 'Potential Yield Min'),
                new FilterColumn($this->dataset, 'potential_yield_others', 'potential_yield_others', 'Potential Yield Others'),
                new FilterColumn($this->dataset, 'data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['location_id'])
                ->addColumn($columns['part_id'])
                ->addColumn($columns['year_id'])
                ->addColumn($columns['potential_yield_mean'])
                ->addColumn($columns['potential_yield_max'])
                ->addColumn($columns['potential_yield_min'])
                ->addColumn($columns['potential_yield_others'])
                ->addColumn($columns['data_flag_id'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('location_id')
                ->setOptionsFor('part_id')
                ->setOptionsFor('year_id')
                ->setOptionsFor('data_flag_id')
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
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_cropid_search');
            
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
            
            $main_editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_location_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('location_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_location_id_search');
            
            $text_editor = new TextEdit('location_id');
            
            $filterBuilder->addColumn(
                $columns['location_id'],
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
            
            $main_editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_part_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('part_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_part_id_search');
            
            $text_editor = new TextEdit('part_id');
            
            $filterBuilder->addColumn(
                $columns['part_id'],
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
            
            $main_editor = new DynamicCombobox('year_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_year_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('year_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_year_id_search');
            
            $filterBuilder->addColumn(
                $columns['year_id'],
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
            
            $main_editor = new TextEdit('potential_yield_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['potential_yield_mean'],
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
            
            $main_editor = new TextEdit('potential_yield_max_edit');
            
            $filterBuilder->addColumn(
                $columns['potential_yield_max'],
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
            
            $main_editor = new TextEdit('potential_yield_min_edit');
            
            $filterBuilder->addColumn(
                $columns['potential_yield_min'],
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
            
            $main_editor = new TextEdit('potential_yield_others');
            
            $filterBuilder->addColumn(
                $columns['potential_yield_others'],
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
            
            $main_editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_data_flag_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_m_potential_yield_data_flag_id_search');
            
            $text_editor = new TextEdit('data_flag_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag_id'],
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
            
            $main_editor = new TextEdit('metadata_id_edit');
            
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_part_id_part_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new NumberViewColumn('year_id', 'year_id_year', 'Year Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for potential_yield_mean field
            //
            $column = new NumberViewColumn('potential_yield_mean', 'potential_yield_mean', 'Potential Yield Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for potential_yield_max field
            //
            $column = new NumberViewColumn('potential_yield_max', 'potential_yield_max', 'Potential Yield Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for potential_yield_min field
            //
            $column = new NumberViewColumn('potential_yield_min', 'potential_yield_min', 'Potential Yield Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_potential_yield_others_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_part_id_part_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new NumberViewColumn('year_id', 'year_id_year', 'Year Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for potential_yield_mean field
            //
            $column = new NumberViewColumn('potential_yield_mean', 'potential_yield_mean', 'Potential Yield Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for potential_yield_max field
            //
            $column = new NumberViewColumn('potential_yield_max', 'potential_yield_max', 'Potential Yield Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for potential_yield_min field
            //
            $column = new NumberViewColumn('potential_yield_min', 'potential_yield_min', 'Potential Yield Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_potential_yield_others_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'edit_opt_data_flag_m_potential_yield_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'edit_opt_data_flag_m_potential_yield_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for part_id field
            //
            $editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Part Id', 'part_id', 'part_id_part_name', 'edit_opt_data_flag_m_potential_yield_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for year_id field
            //
            $editor = new DynamicCombobox('year_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Year Id', 'year_id', 'year_id_year', 'edit_opt_data_flag_m_potential_yield_year_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'year', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_mean field
            //
            $editor = new TextEdit('potential_yield_mean_edit');
            $editColumn = new CustomEditColumn('Potential Yield Mean', 'potential_yield_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_max field
            //
            $editor = new TextEdit('potential_yield_max_edit');
            $editColumn = new CustomEditColumn('Potential Yield Max', 'potential_yield_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_min field
            //
            $editor = new TextEdit('potential_yield_min_edit');
            $editColumn = new CustomEditColumn('Potential Yield Min', 'potential_yield_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_others field
            //
            $editor = new TextAreaEdit('potential_yield_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Potential Yield Others', 'potential_yield_others', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag_id field
            //
            $editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag Id', 'data_flag_id', 'data_flag_id_data_flag', 'edit_opt_data_flag_m_potential_yield_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'multi_edit_opt_data_flag_m_potential_yield_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'multi_edit_opt_data_flag_m_potential_yield_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for part_id field
            //
            $editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Part Id', 'part_id', 'part_id_part_name', 'multi_edit_opt_data_flag_m_potential_yield_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for year_id field
            //
            $editor = new DynamicCombobox('year_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Year Id', 'year_id', 'year_id_year', 'multi_edit_opt_data_flag_m_potential_yield_year_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'year', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_mean field
            //
            $editor = new TextEdit('potential_yield_mean_edit');
            $editColumn = new CustomEditColumn('Potential Yield Mean', 'potential_yield_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_max field
            //
            $editor = new TextEdit('potential_yield_max_edit');
            $editColumn = new CustomEditColumn('Potential Yield Max', 'potential_yield_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_min field
            //
            $editor = new TextEdit('potential_yield_min_edit');
            $editColumn = new CustomEditColumn('Potential Yield Min', 'potential_yield_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for potential_yield_others field
            //
            $editor = new TextAreaEdit('potential_yield_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Potential Yield Others', 'potential_yield_others', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag_id field
            //
            $editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag Id', 'data_flag_id', 'data_flag_id_data_flag', 'multi_edit_opt_data_flag_m_potential_yield_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'insert_opt_data_flag_m_potential_yield_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for location_id field
            //
            $editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'insert_opt_data_flag_m_potential_yield_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for part_id field
            //
            $editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Part Id', 'part_id', 'part_id_part_name', 'insert_opt_data_flag_m_potential_yield_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for year_id field
            //
            $editor = new DynamicCombobox('year_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Year Id', 'year_id', 'year_id_year', 'insert_opt_data_flag_m_potential_yield_year_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'year', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for potential_yield_mean field
            //
            $editor = new TextEdit('potential_yield_mean_edit');
            $editColumn = new CustomEditColumn('Potential Yield Mean', 'potential_yield_mean', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for potential_yield_max field
            //
            $editor = new TextEdit('potential_yield_max_edit');
            $editColumn = new CustomEditColumn('Potential Yield Max', 'potential_yield_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for potential_yield_min field
            //
            $editor = new TextEdit('potential_yield_min_edit');
            $editColumn = new CustomEditColumn('Potential Yield Min', 'potential_yield_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for potential_yield_others field
            //
            $editor = new TextAreaEdit('potential_yield_others_edit', 50, 8);
            $editColumn = new CustomEditColumn('Potential Yield Others', 'potential_yield_others', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag_id field
            //
            $editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag Id', 'data_flag_id', 'data_flag_id_data_flag', 'insert_opt_data_flag_m_potential_yield_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_part_id_part_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new NumberViewColumn('year_id', 'year_id_year', 'Year Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for potential_yield_mean field
            //
            $column = new NumberViewColumn('potential_yield_mean', 'potential_yield_mean', 'Potential Yield Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for potential_yield_max field
            //
            $column = new NumberViewColumn('potential_yield_max', 'potential_yield_max', 'Potential Yield Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for potential_yield_min field
            //
            $column = new NumberViewColumn('potential_yield_min', 'potential_yield_min', 'Potential Yield Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_potential_yield_others_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_part_id_part_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for year field
            //
            $column = new NumberViewColumn('year_id', 'year_id_year', 'Year Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for potential_yield_mean field
            //
            $column = new NumberViewColumn('potential_yield_mean', 'potential_yield_mean', 'Potential Yield Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for potential_yield_max field
            //
            $column = new NumberViewColumn('potential_yield_max', 'potential_yield_max', 'Potential Yield Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for potential_yield_min field
            //
            $column = new NumberViewColumn('potential_yield_min', 'potential_yield_min', 'Potential Yield Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_potential_yield_others_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_part_id_part_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for year field
            //
            $column = new NumberViewColumn('year_id', 'year_id_year', 'Year Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for potential_yield_mean field
            //
            $column = new NumberViewColumn('potential_yield_mean', 'potential_yield_mean', 'Potential Yield Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for potential_yield_max field
            //
            $column = new NumberViewColumn('potential_yield_max', 'potential_yield_max', 'Potential Yield Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for potential_yield_min field
            //
            $column = new NumberViewColumn('potential_yield_min', 'potential_yield_min', 'Potential Yield Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_potential_yield_others_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_m_potential_yield_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_part_id_part_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_potential_yield_others_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_part_id_part_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_potential_yield_others_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_part_id_part_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_potential_yield_others_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_notes_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_m_potential_yield_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_m_potential_yield_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_m_potential_yield_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_m_potential_yield_year_id_search', 'id', 'year', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_m_potential_yield_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_m_potential_yield_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_m_potential_yield_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_m_potential_yield_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_m_potential_yield_year_id_search', 'id', 'year', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_m_potential_yield_data_flag_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_m_potential_yield_data_flag_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_part_id_part_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for potential_yield_others field
            //
            $column = new TextViewColumn('potential_yield_others', 'potential_yield_others', 'Potential Yield Others', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_potential_yield_others_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_data_flag_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_m_potential_yield_notes_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_m_potential_yield_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_m_potential_yield_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_m_potential_yield_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_m_potential_yield_year_id_search', 'id', 'year', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_m_potential_yield_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_m_potential_yield_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_google_placeid`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('google_place_id', true),
                    new StringField('google_address', true),
                    new StringField('locality'),
                    new StringField('region'),
                    new IntegerField('city'),
                    new IntegerField('country'),
                    new IntegerField('lat'),
                    new IntegerField('long'),
                    new StringField('notes'),
                    new StringField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('google_place_id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_m_potential_yield_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_m_potential_yield_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_year`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('year', true),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('year', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_m_potential_yield_year_id_search', 'id', 'year', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_m_potential_yield_data_flag_id_search', 'id', 'data_flag', null, 20);
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
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class opt_data_flag_n_nutritionPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('N Nutrition');
            $this->SetMenuLabel('N Nutrition');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`n_nutrition`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new IntegerField('part_id', true),
                    new IntegerField('variable_id', true),
                    new IntegerField('weight_basis_id'),
                    new IntegerField('value_mean', true),
                    new IntegerField('value_max'),
                    new IntegerField('value_min'),
                    new IntegerField('data_flag_id', true),
                    new StringField('analysis_method'),
                    new StringField('pretreatment'),
                    new IntegerField('sample_number'),
                    new StringField('material_source'),
                    new IntegerField('recommended_data'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $this->dataset->AddLookupField('cropid', 'crop_records', new IntegerField('id'), new StringField('name', false, false, false, false, 'cropid_name', 'cropid_name_crop_records'), 'cropid_name_crop_records');
            $this->dataset->AddLookupField('part_id', 'opt_plant_part', new IntegerField('id'), new StringField('part_name', false, false, false, false, 'part_id_part_name', 'part_id_part_name_opt_plant_part'), 'part_id_part_name_opt_plant_part');
            $this->dataset->AddLookupField('variable_id', 'opt_nutrient_variable', new IntegerField('id'), new StringField('variable', false, false, false, false, 'variable_id_variable', 'variable_id_variable_opt_nutrient_variable'), 'variable_id_variable_opt_nutrient_variable');
            $this->dataset->AddLookupField('data_flag_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag_id_data_flag', 'data_flag_id_data_flag_opt_data_flag'), 'data_flag_id_data_flag_opt_data_flag');
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
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Cropid'),
                new FilterColumn($this->dataset, 'part_id', 'part_id_part_name', 'Part Id'),
                new FilterColumn($this->dataset, 'variable_id', 'variable_id_variable', 'Variable Id'),
                new FilterColumn($this->dataset, 'value_mean', 'value_mean', 'Value Mean'),
                new FilterColumn($this->dataset, 'value_max', 'value_max', 'Value Max'),
                new FilterColumn($this->dataset, 'value_min', 'value_min', 'Value Min'),
                new FilterColumn($this->dataset, 'data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id'),
                new FilterColumn($this->dataset, 'recommended_data', 'recommended_data', 'Recommended Data'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id', 'Metadata Id'),
                new FilterColumn($this->dataset, 'weight_basis_id', 'weight_basis_id', 'Weight Basis Id'),
                new FilterColumn($this->dataset, 'analysis_method', 'analysis_method', 'Analysis Method'),
                new FilterColumn($this->dataset, 'pretreatment', 'pretreatment', 'Pretreatment'),
                new FilterColumn($this->dataset, 'sample_number', 'sample_number', 'Sample Number'),
                new FilterColumn($this->dataset, 'material_source', 'material_source', 'Material Source')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['part_id'])
                ->addColumn($columns['variable_id'])
                ->addColumn($columns['value_mean'])
                ->addColumn($columns['value_max'])
                ->addColumn($columns['value_min'])
                ->addColumn($columns['data_flag_id'])
                ->addColumn($columns['recommended_data'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id'])
                ->addColumn($columns['weight_basis_id'])
                ->addColumn($columns['analysis_method'])
                ->addColumn($columns['pretreatment'])
                ->addColumn($columns['sample_number'])
                ->addColumn($columns['material_source']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('part_id')
                ->setOptionsFor('variable_id')
                ->setOptionsFor('data_flag_id')
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
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_cropid_search');
            
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
            
            $main_editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_part_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('part_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_part_id_search');
            
            $text_editor = new TextEdit('part_id');
            
            $filterBuilder->addColumn(
                $columns['part_id'],
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
            
            $main_editor = new DynamicCombobox('variable_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_variable_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('variable_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_variable_id_search');
            
            $text_editor = new TextEdit('variable_id');
            
            $filterBuilder->addColumn(
                $columns['variable_id'],
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
            
            $main_editor = new TextEdit('value_mean_edit');
            
            $filterBuilder->addColumn(
                $columns['value_mean'],
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
            
            $main_editor = new TextEdit('value_max_edit');
            
            $filterBuilder->addColumn(
                $columns['value_max'],
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
            
            $main_editor = new TextEdit('value_min_edit');
            
            $filterBuilder->addColumn(
                $columns['value_min'],
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
            
            $main_editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_data_flag_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_data_flag_n_nutrition_data_flag_id_search');
            
            $text_editor = new TextEdit('data_flag_id');
            
            $filterBuilder->addColumn(
                $columns['data_flag_id'],
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
            
            $main_editor = new TextEdit('recommended_data_edit');
            
            $filterBuilder->addColumn(
                $columns['recommended_data'],
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
            
            $main_editor = new TextEdit('metadata_id_edit');
            
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
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('weight_basis_id_edit');
            
            $filterBuilder->addColumn(
                $columns['weight_basis_id'],
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
            
            $main_editor = new TextEdit('analysis_method');
            
            $filterBuilder->addColumn(
                $columns['analysis_method'],
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
            
            $main_editor = new TextEdit('pretreatment');
            
            $filterBuilder->addColumn(
                $columns['pretreatment'],
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
            
            $main_editor = new TextEdit('sample_number_edit');
            
            $filterBuilder->addColumn(
                $columns['sample_number'],
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
            
            $main_editor = new TextEdit('material_source');
            
            $filterBuilder->addColumn(
                $columns['material_source'],
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_part_id_part_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_variable_id_variable_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for value_mean field
            //
            $column = new NumberViewColumn('value_mean', 'value_mean', 'Value Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for value_max field
            //
            $column = new NumberViewColumn('value_max', 'value_max', 'Value Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for value_min field
            //
            $column = new NumberViewColumn('value_min', 'value_min', 'Value Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new NumberViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for weight_basis_id field
            //
            $column = new NumberViewColumn('weight_basis_id', 'weight_basis_id', 'Weight Basis Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_analysis_method_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_pretreatment_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sample_number field
            //
            $column = new NumberViewColumn('sample_number', 'sample_number', 'Sample Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_material_source_handler_list');
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_part_id_part_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_variable_id_variable_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for value_mean field
            //
            $column = new NumberViewColumn('value_mean', 'value_mean', 'Value Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for value_max field
            //
            $column = new NumberViewColumn('value_max', 'value_max', 'Value Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for value_min field
            //
            $column = new NumberViewColumn('value_min', 'value_min', 'Value Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new NumberViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for weight_basis_id field
            //
            $column = new NumberViewColumn('weight_basis_id', 'weight_basis_id', 'Weight Basis Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_analysis_method_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_pretreatment_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sample_number field
            //
            $column = new NumberViewColumn('sample_number', 'sample_number', 'Sample Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_material_source_handler_view');
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'edit_opt_data_flag_n_nutrition_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for part_id field
            //
            $editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Part Id', 'part_id', 'part_id_part_name', 'edit_opt_data_flag_n_nutrition_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for variable_id field
            //
            $editor = new DynamicCombobox('variable_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Variable Id', 'variable_id', 'variable_id_variable', 'edit_opt_data_flag_n_nutrition_variable_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'variable', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for value_mean field
            //
            $editor = new TextEdit('value_mean_edit');
            $editColumn = new CustomEditColumn('Value Mean', 'value_mean', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for value_max field
            //
            $editor = new TextEdit('value_max_edit');
            $editColumn = new CustomEditColumn('Value Max', 'value_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for value_min field
            //
            $editor = new TextEdit('value_min_edit');
            $editColumn = new CustomEditColumn('Value Min', 'value_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for data_flag_id field
            //
            $editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag Id', 'data_flag_id', 'data_flag_id_data_flag', 'edit_opt_data_flag_n_nutrition_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for recommended_data field
            //
            $editor = new TextEdit('recommended_data_edit');
            $editColumn = new CustomEditColumn('Recommended Data', 'recommended_data', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for weight_basis_id field
            //
            $editor = new TextEdit('weight_basis_id_edit');
            $editColumn = new CustomEditColumn('Weight Basis Id', 'weight_basis_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for analysis_method field
            //
            $editor = new TextAreaEdit('analysis_method_edit', 50, 8);
            $editColumn = new CustomEditColumn('Analysis Method', 'analysis_method', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for pretreatment field
            //
            $editor = new TextAreaEdit('pretreatment_edit', 50, 8);
            $editColumn = new CustomEditColumn('Pretreatment', 'pretreatment', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sample_number field
            //
            $editor = new TextEdit('sample_number_edit');
            $editColumn = new CustomEditColumn('Sample Number', 'sample_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for material_source field
            //
            $editor = new TextAreaEdit('material_source_edit', 50, 8);
            $editColumn = new CustomEditColumn('Material Source', 'material_source', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'multi_edit_opt_data_flag_n_nutrition_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for part_id field
            //
            $editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Part Id', 'part_id', 'part_id_part_name', 'multi_edit_opt_data_flag_n_nutrition_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for variable_id field
            //
            $editor = new DynamicCombobox('variable_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Variable Id', 'variable_id', 'variable_id_variable', 'multi_edit_opt_data_flag_n_nutrition_variable_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'variable', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for value_mean field
            //
            $editor = new TextEdit('value_mean_edit');
            $editColumn = new CustomEditColumn('Value Mean', 'value_mean', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for value_max field
            //
            $editor = new TextEdit('value_max_edit');
            $editColumn = new CustomEditColumn('Value Max', 'value_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for value_min field
            //
            $editor = new TextEdit('value_min_edit');
            $editColumn = new CustomEditColumn('Value Min', 'value_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for data_flag_id field
            //
            $editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag Id', 'data_flag_id', 'data_flag_id_data_flag', 'multi_edit_opt_data_flag_n_nutrition_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for recommended_data field
            //
            $editor = new TextEdit('recommended_data_edit');
            $editColumn = new CustomEditColumn('Recommended Data', 'recommended_data', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for weight_basis_id field
            //
            $editor = new TextEdit('weight_basis_id_edit');
            $editColumn = new CustomEditColumn('Weight Basis Id', 'weight_basis_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for analysis_method field
            //
            $editor = new TextAreaEdit('analysis_method_edit', 50, 8);
            $editColumn = new CustomEditColumn('Analysis Method', 'analysis_method', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for pretreatment field
            //
            $editor = new TextAreaEdit('pretreatment_edit', 50, 8);
            $editColumn = new CustomEditColumn('Pretreatment', 'pretreatment', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sample_number field
            //
            $editor = new TextEdit('sample_number_edit');
            $editColumn = new CustomEditColumn('Sample Number', 'sample_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for material_source field
            //
            $editor = new TextAreaEdit('material_source_edit', 50, 8);
            $editColumn = new CustomEditColumn('Material Source', 'material_source', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Cropid', 'cropid', 'cropid_name', 'insert_opt_data_flag_n_nutrition_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for part_id field
            //
            $editor = new DynamicCombobox('part_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Part Id', 'part_id', 'part_id_part_name', 'insert_opt_data_flag_n_nutrition_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for variable_id field
            //
            $editor = new DynamicCombobox('variable_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Variable Id', 'variable_id', 'variable_id_variable', 'insert_opt_data_flag_n_nutrition_variable_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'variable', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for value_mean field
            //
            $editor = new TextEdit('value_mean_edit');
            $editColumn = new CustomEditColumn('Value Mean', 'value_mean', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for value_max field
            //
            $editor = new TextEdit('value_max_edit');
            $editColumn = new CustomEditColumn('Value Max', 'value_max', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for value_min field
            //
            $editor = new TextEdit('value_min_edit');
            $editColumn = new CustomEditColumn('Value Min', 'value_min', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for data_flag_id field
            //
            $editor = new DynamicCombobox('data_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Data Flag Id', 'data_flag_id', 'data_flag_id_data_flag', 'insert_opt_data_flag_n_nutrition_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for recommended_data field
            //
            $editor = new TextEdit('recommended_data_edit');
            $editColumn = new CustomEditColumn('Recommended Data', 'recommended_data', $editor, $this->dataset);
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
            $editor = new TextEdit('metadata_id_edit');
            $editColumn = new CustomEditColumn('Metadata Id', 'metadata_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for weight_basis_id field
            //
            $editor = new TextEdit('weight_basis_id_edit');
            $editColumn = new CustomEditColumn('Weight Basis Id', 'weight_basis_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for analysis_method field
            //
            $editor = new TextAreaEdit('analysis_method_edit', 50, 8);
            $editColumn = new CustomEditColumn('Analysis Method', 'analysis_method', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pretreatment field
            //
            $editor = new TextAreaEdit('pretreatment_edit', 50, 8);
            $editColumn = new CustomEditColumn('Pretreatment', 'pretreatment', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sample_number field
            //
            $editor = new TextEdit('sample_number_edit');
            $editColumn = new CustomEditColumn('Sample Number', 'sample_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for material_source field
            //
            $editor = new TextAreaEdit('material_source_edit', 50, 8);
            $editColumn = new CustomEditColumn('Material Source', 'material_source', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_part_id_part_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_variable_id_variable_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for value_mean field
            //
            $column = new NumberViewColumn('value_mean', 'value_mean', 'Value Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for value_max field
            //
            $column = new NumberViewColumn('value_max', 'value_max', 'Value Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for value_min field
            //
            $column = new NumberViewColumn('value_min', 'value_min', 'Value Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new NumberViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for weight_basis_id field
            //
            $column = new NumberViewColumn('weight_basis_id', 'weight_basis_id', 'Weight Basis Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_analysis_method_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_pretreatment_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for sample_number field
            //
            $column = new NumberViewColumn('sample_number', 'sample_number', 'Sample Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_material_source_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_part_id_part_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_variable_id_variable_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for value_mean field
            //
            $column = new NumberViewColumn('value_mean', 'value_mean', 'Value Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for value_max field
            //
            $column = new NumberViewColumn('value_max', 'value_max', 'Value Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for value_min field
            //
            $column = new NumberViewColumn('value_min', 'value_min', 'Value Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new NumberViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for weight_basis_id field
            //
            $column = new NumberViewColumn('weight_basis_id', 'weight_basis_id', 'Weight Basis Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_analysis_method_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_pretreatment_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for sample_number field
            //
            $column = new NumberViewColumn('sample_number', 'sample_number', 'Sample Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_material_source_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_part_id_part_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_variable_id_variable_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for value_mean field
            //
            $column = new NumberViewColumn('value_mean', 'value_mean', 'Value Mean', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for value_max field
            //
            $column = new NumberViewColumn('value_max', 'value_max', 'Value Max', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for value_min field
            //
            $column = new NumberViewColumn('value_min', 'value_min', 'Value Min', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new NumberViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for metadata_id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id', 'Metadata Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for weight_basis_id field
            //
            $column = new NumberViewColumn('weight_basis_id', 'weight_basis_id', 'Weight Basis Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_analysis_method_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_pretreatment_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for sample_number field
            //
            $column = new NumberViewColumn('sample_number', 'sample_number', 'Sample Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_n_nutrition_material_source_handler_compare');
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
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_part_id_part_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_variable_id_variable_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_analysis_method_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_pretreatment_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_material_source_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_part_id_part_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_variable_id_variable_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_analysis_method_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_pretreatment_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_material_source_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_part_id_part_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_variable_id_variable_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_notes_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_analysis_method_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_pretreatment_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_material_source_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_n_nutrition_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_data_flag_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_n_nutrition_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_data_flag_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Cropid', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_part_id_part_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_variable_id_variable_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_data_flag_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_analysis_method_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pretreatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_pretreatment_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_n_nutrition_material_source_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_n_nutrition_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_data_flag_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_n_nutrition_cropid_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_plant_part`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('part_name', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('part_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_nutrient_variable`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('variable', true),
                    new StringField('code', true),
                    new StringField('variable_group', true),
                    new StringField('unit', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('variable', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('data_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_data_flag_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
    
    // OnBeforePageExecute event handler
    
    
    
    class opt_data_flagPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Opt Data Flag');
            $this->SetMenuLabel('Data Flag');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_data_flag`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('data_flag', true),
                    new StringField('description')
                )
            );
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
                new FilterColumn($this->dataset, 'id', 'id', 'Option ID'),
                new FilterColumn($this->dataset, 'data_flag', 'data_flag', 'Data Flag'),
                new FilterColumn($this->dataset, 'description', 'description', 'Description')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['data_flag'])
                ->addColumn($columns['description']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
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
            
            $main_editor = new TextEdit('data_flag_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['data_flag'],
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
            
            $main_editor = new TextEdit('description');
            
            $filterBuilder->addColumn(
                $columns['description'],
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
            if (GetCurrentUserPermissionSetForDataSource('opt_data_flag.ag_season')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_data_flag_ag_season detail
            //
            $column = new DetailColumn(array('id'), 'opt_data_flag.ag_season', 'opt_data_flag_ag_season_handler', $this->dataset, 'Ag Season');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('opt_data_flag.ag_season01')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_data_flag_ag_season01 detail
            //
            $column = new DetailColumn(array('id'), 'opt_data_flag.ag_season01', 'opt_data_flag_ag_season01_handler', $this->dataset, 'Ag Season');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('opt_data_flag.ag_season02')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_data_flag_ag_season02 detail
            //
            $column = new DetailColumn(array('id'), 'opt_data_flag.ag_season02', 'opt_data_flag_ag_season02_handler', $this->dataset, 'Ag Season');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('opt_data_flag.m_potential_yield')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_data_flag_m_potential_yield detail
            //
            $column = new DetailColumn(array('id'), 'opt_data_flag.m_potential_yield', 'opt_data_flag_m_potential_yield_handler', $this->dataset, 'M Potential Yield');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('opt_data_flag.n_nutrition')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_data_flag_n_nutrition detail
            //
            $column = new DetailColumn(array('id'), 'opt_data_flag.n_nutrition', 'opt_data_flag_n_nutrition_handler', $this->dataset, 'N Nutrition');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Option ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_data_flag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_description_handler_list');
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
            $column = new NumberViewColumn('id', 'id', 'Option ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_description_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for data_flag field
            //
            $editor = new TextEdit('data_flag_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Data Flag', 'data_flag', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for data_flag field
            //
            $editor = new TextEdit('data_flag_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Data Flag', 'data_flag', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for data_flag field
            //
            $editor = new TextEdit('data_flag_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Data Flag', 'data_flag', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Option ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_description_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Option ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_description_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Option ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_data_flag_description_handler_compare');
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
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::CARD);
            $result->SetCardCountInRow(1);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
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
            $detailPage = new opt_data_flag_ag_seasonPage('opt_data_flag_ag_season', $this, array('data_flag1_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_data_flag.ag_season'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_data_flag.ag_season'));
            $detailPage->SetHttpHandlerName('opt_data_flag_ag_season_handler');
            $handler = new PageHTTPHandler('opt_data_flag_ag_season_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new opt_data_flag_ag_season01Page('opt_data_flag_ag_season01', $this, array('data_flag2_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_data_flag.ag_season01'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_data_flag.ag_season01'));
            $detailPage->SetHttpHandlerName('opt_data_flag_ag_season01_handler');
            $handler = new PageHTTPHandler('opt_data_flag_ag_season01_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new opt_data_flag_ag_season02Page('opt_data_flag_ag_season02', $this, array('data_flag3_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_data_flag.ag_season02'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_data_flag.ag_season02'));
            $detailPage->SetHttpHandlerName('opt_data_flag_ag_season02_handler');
            $handler = new PageHTTPHandler('opt_data_flag_ag_season02_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new opt_data_flag_m_potential_yieldPage('opt_data_flag_m_potential_yield', $this, array('data_flag_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_data_flag.m_potential_yield'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_data_flag.m_potential_yield'));
            $detailPage->SetHttpHandlerName('opt_data_flag_m_potential_yield_handler');
            $handler = new PageHTTPHandler('opt_data_flag_m_potential_yield_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new opt_data_flag_n_nutritionPage('opt_data_flag_n_nutrition', $this, array('data_flag_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_data_flag.n_nutrition'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_data_flag.n_nutrition'));
            $detailPage->SetHttpHandlerName('opt_data_flag_n_nutrition_handler');
            $handler = new PageHTTPHandler('opt_data_flag_n_nutrition_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_description_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_description_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_description_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag', 'data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_data_flag_description_handler_view', $column);
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
        $Page = new opt_data_flagPage("opt_data_flag", "opt_data_flag.php", GetCurrentUserPermissionSetForDataSource("opt_data_flag"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("opt_data_flag"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
