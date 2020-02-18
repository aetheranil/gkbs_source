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
    
    
    
    class n_nutritionPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Nutrition');
            $this->SetMenuLabel('Nutrition');
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
            $this->dataset->AddLookupField('weight_basis_id', 'opt_weight_basis', new IntegerField('id'), new StringField('weight_basis', false, false, false, false, 'weight_basis_id_weight_basis', 'weight_basis_id_weight_basis_opt_weight_basis'), 'weight_basis_id_weight_basis_opt_weight_basis');
            $this->dataset->AddLookupField('data_flag_id', 'opt_data_flag', new IntegerField('id'), new StringField('data_flag', false, false, false, false, 'data_flag_id_data_flag', 'data_flag_id_data_flag_opt_data_flag'), 'data_flag_id_data_flag_opt_data_flag');
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
                new FilterColumn($this->dataset, 'id', 'id', 'Nutrition ID'),
                new FilterColumn($this->dataset, 'cropid', 'cropid_name', 'Crop ID'),
                new FilterColumn($this->dataset, 'part_id', 'part_id_part_name', 'Part'),
                new FilterColumn($this->dataset, 'variable_id', 'variable_id_variable', 'Variable'),
                new FilterColumn($this->dataset, 'weight_basis_id', 'weight_basis_id_weight_basis', 'Weight Basis'),
                new FilterColumn($this->dataset, 'value_mean', 'value_mean', 'Value Mean'),
                new FilterColumn($this->dataset, 'value_max', 'value_max', 'Value Max'),
                new FilterColumn($this->dataset, 'value_min', 'value_min', 'Value Min'),
                new FilterColumn($this->dataset, 'data_flag_id', 'data_flag_id_data_flag', 'Data Flag'),
                new FilterColumn($this->dataset, 'analysis_method', 'analysis_method', 'Analysis Method'),
                new FilterColumn($this->dataset, 'pretreatment', 'pretreatment', 'Pre-treatment'),
                new FilterColumn($this->dataset, 'sample_number', 'sample_number', 'Sample Number'),
                new FilterColumn($this->dataset, 'material_source', 'material_source', 'Material Source'),
                new FilterColumn($this->dataset, 'recommended_data', 'recommended_data', 'Recommended Data'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['cropid'])
                ->addColumn($columns['part_id'])
                ->addColumn($columns['variable_id'])
                ->addColumn($columns['weight_basis_id'])
                ->addColumn($columns['value_mean'])
                ->addColumn($columns['value_max'])
                ->addColumn($columns['value_min'])
                ->addColumn($columns['data_flag_id'])
                ->addColumn($columns['analysis_method'])
                ->addColumn($columns['pretreatment'])
                ->addColumn($columns['sample_number'])
                ->addColumn($columns['material_source'])
                ->addColumn($columns['recommended_data'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('cropid')
                ->setOptionsFor('part_id')
                ->setOptionsFor('variable_id')
                ->setOptionsFor('weight_basis_id')
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
            $main_editor->SetHandlerName('filter_builder_n_nutrition_cropid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('cropid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_n_nutrition_cropid_search');
            
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
            $main_editor->SetHandlerName('filter_builder_n_nutrition_part_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('part_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_n_nutrition_part_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_n_nutrition_variable_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('variable_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_n_nutrition_variable_id_search');
            
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
            
            $main_editor = new DynamicCombobox('weight_basis_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_n_nutrition_weight_basis_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('weight_basis_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_n_nutrition_weight_basis_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_n_nutrition_data_flag_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('data_flag_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_n_nutrition_data_flag_id_search');
            
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
            
            $main_editor = new ComboBox('recommended_data');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['recommended_data'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
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
            $main_editor->SetHandlerName('filter_builder_n_nutrition_metadata_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('metadata_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_n_nutrition_metadata_id_search');
            
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
            $column = new NumberViewColumn('id', 'id', 'Nutrition ID', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('n_nutrition_cropid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_part_id_part_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_variable_id_variable_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for weight_basis field
            //
            $column = new TextViewColumn('weight_basis_id', 'weight_basis_id_weight_basis', 'Weight Basis', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_data_flag_id_data_flag_handler_list');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_analysis_method_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_pretreatment_handler_list');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_material_source_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new CheckboxViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Nutrition ID', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('n_nutrition_cropid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_part_id_part_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_variable_id_variable_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for weight_basis field
            //
            $column = new TextViewColumn('weight_basis_id', 'weight_basis_id_weight_basis', 'Weight Basis', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_data_flag_id_data_flag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_analysis_method_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_pretreatment_handler_view');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_material_source_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new CheckboxViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata Id', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Crop ID', 'cropid', 'cropid_name', 'edit_n_nutrition_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
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
            $editColumn = new DynamicLookupEditColumn('Part', 'part_id', 'part_id_part_name', 'edit_n_nutrition_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
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
            $editColumn = new DynamicLookupEditColumn('Variable', 'variable_id', 'variable_id_variable', 'edit_n_nutrition_variable_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'variable', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for weight_basis_id field
            //
            $editor = new DynamicCombobox('weight_basis_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Weight Basis', 'weight_basis_id', 'weight_basis_id_weight_basis', 'edit_n_nutrition_weight_basis_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'weight_basis', '');
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Data Flag', 'data_flag_id', 'data_flag_id_data_flag', 'edit_n_nutrition_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new CustomEditColumn('Pre-treatment', 'pretreatment', $editor, $this->dataset);
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
            
            //
            // Edit column for recommended_data field
            //
            $editor = new CheckBox('recommended_data_edit');
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
            $editColumn = new DynamicLookupEditColumn('Metadata Id', 'metadata_id', 'metadata_id_id', 'edit_n_nutrition_metadata_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Crop ID', 'cropid', 'cropid_name', 'multi_edit_n_nutrition_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
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
            $editColumn = new DynamicLookupEditColumn('Part', 'part_id', 'part_id_part_name', 'multi_edit_n_nutrition_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
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
            $editColumn = new DynamicLookupEditColumn('Variable', 'variable_id', 'variable_id_variable', 'multi_edit_n_nutrition_variable_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'variable', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for weight_basis_id field
            //
            $editor = new DynamicCombobox('weight_basis_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Weight Basis', 'weight_basis_id', 'weight_basis_id_weight_basis', 'multi_edit_n_nutrition_weight_basis_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'weight_basis', '');
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Data Flag', 'data_flag_id', 'data_flag_id_data_flag', 'multi_edit_n_nutrition_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new CustomEditColumn('Pre-treatment', 'pretreatment', $editor, $this->dataset);
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
            
            //
            // Edit column for recommended_data field
            //
            $editor = new CheckBox('recommended_data_edit');
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
            $editColumn = new DynamicLookupEditColumn('Metadata Id', 'metadata_id', 'metadata_id_id', 'multi_edit_n_nutrition_metadata_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Crop ID', 'cropid', 'cropid_name', 'insert_n_nutrition_cropid_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
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
            $editColumn = new DynamicLookupEditColumn('Part', 'part_id', 'part_id_part_name', 'insert_n_nutrition_part_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'part_name', '');
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
            $editColumn = new DynamicLookupEditColumn('Variable', 'variable_id', 'variable_id_variable', 'insert_n_nutrition_variable_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'variable', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for weight_basis_id field
            //
            $editor = new DynamicCombobox('weight_basis_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Weight Basis', 'weight_basis_id', 'weight_basis_id_weight_basis', 'insert_n_nutrition_weight_basis_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'weight_basis', '');
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Data Flag', 'data_flag_id', 'data_flag_id_data_flag', 'insert_n_nutrition_data_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'data_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new CustomEditColumn('Pre-treatment', 'pretreatment', $editor, $this->dataset);
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
            
            //
            // Edit column for recommended_data field
            //
            $editor = new CheckBox('recommended_data_edit');
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
            $editColumn = new DynamicLookupEditColumn('Metadata Id', 'metadata_id', 'metadata_id_id', 'insert_n_nutrition_metadata_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $column = new NumberViewColumn('id', 'id', 'Nutrition ID', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('n_nutrition_cropid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_part_id_part_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_variable_id_variable_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for weight_basis field
            //
            $column = new TextViewColumn('weight_basis_id', 'weight_basis_id_weight_basis', 'Weight Basis', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_data_flag_id_data_flag_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_analysis_method_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_pretreatment_handler_print');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_material_source_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new CheckboxViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata Id', $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'Nutrition ID', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('n_nutrition_cropid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_part_id_part_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_variable_id_variable_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for weight_basis field
            //
            $column = new TextViewColumn('weight_basis_id', 'weight_basis_id_weight_basis', 'Weight Basis', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_data_flag_id_data_flag_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_analysis_method_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_pretreatment_handler_export');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_material_source_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new CheckboxViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Nutrition ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_cropid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_part_id_part_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_variable_id_variable_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for weight_basis field
            //
            $column = new TextViewColumn('weight_basis_id', 'weight_basis_id_weight_basis', 'Weight Basis', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_data_flag_id_data_flag_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_analysis_method_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_pretreatment_handler_compare');
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
            $column->SetFullTextWindowHandlerName('n_nutrition_material_source_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for recommended_data field
            //
            $column = new CheckboxViewColumn('recommended_data', 'recommended_data', 'Recommended Data', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('n_nutrition_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('metadata_id', 'metadata_id_id', 'Metadata Id', $this->dataset);
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
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_cropid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_part_id_part_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_variable_id_variable_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_data_flag_id_data_flag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_analysis_method_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_pretreatment_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_material_source_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_cropid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_part_id_part_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_variable_id_variable_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_data_flag_id_data_flag_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_analysis_method_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_pretreatment_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_material_source_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_cropid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_part_id_part_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_variable_id_variable_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_data_flag_id_data_flag_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_analysis_method_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_pretreatment_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_material_source_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_notes_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_n_nutrition_cropid_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_n_nutrition_weight_basis_id_search', 'id', 'weight_basis', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_n_nutrition_metadata_id_search', 'id', 'id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_cropid_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_weight_basis_id_search', 'id', 'weight_basis', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_n_nutrition_metadata_id_search', 'id', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('cropid', 'cropid_name', 'Crop ID', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_cropid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for part_name field
            //
            $column = new TextViewColumn('part_id', 'part_id_part_name', 'Part', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_part_id_part_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for variable field
            //
            $column = new TextViewColumn('variable_id', 'variable_id_variable', 'Variable', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_variable_id_variable_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for data_flag field
            //
            $column = new TextViewColumn('data_flag_id', 'data_flag_id_data_flag', 'Data Flag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_data_flag_id_data_flag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for analysis_method field
            //
            $column = new TextViewColumn('analysis_method', 'analysis_method', 'Analysis Method', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_analysis_method_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for pretreatment field
            //
            $column = new TextViewColumn('pretreatment', 'pretreatment', 'Pre-treatment', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_pretreatment_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for material_source field
            //
            $column = new TextViewColumn('material_source', 'material_source', 'Material Source', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_material_source_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'n_nutrition_notes_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_n_nutrition_cropid_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_n_nutrition_weight_basis_id_search', 'id', 'weight_basis', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_n_nutrition_metadata_id_search', 'id', 'id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_n_nutrition_cropid_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_n_nutrition_part_id_search', 'id', 'part_name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_n_nutrition_variable_id_search', 'id', 'variable', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_weight_basis`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('weight_basis', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('weight_basis', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_n_nutrition_weight_basis_id_search', 'id', 'weight_basis', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_n_nutrition_data_flag_id_search', 'id', 'data_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_n_nutrition_metadata_id_search', 'id', 'id', null, 20);
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
        $Page = new n_nutritionPage("n_nutrition", "n_nutrition.php", GetCurrentUserPermissionSetForDataSource("n_nutrition"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("n_nutrition"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
