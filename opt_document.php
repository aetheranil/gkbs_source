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
    
    
    
    class opt_document_datasetPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Dataset');
            $this->SetMenuLabel('Dataset');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`dataset`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('dataset_name', true),
                    new IntegerField('document_id', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $this->dataset->AddLookupField('document_id', 'opt_document', new IntegerField('id'), new StringField('document_url', false, false, false, false, 'document_id_document_url', 'document_id_document_url_opt_document'), 'document_id_document_url_opt_document');
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
                new FilterColumn($this->dataset, 'dataset_name', 'dataset_name', 'Dataset Name'),
                new FilterColumn($this->dataset, 'document_id', 'document_id_document_url', 'Document Id'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['dataset_name'])
                ->addColumn($columns['document_id'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['metadata_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('document_id')
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
            
            $main_editor = new TextEdit('dataset_name');
            
            $filterBuilder->addColumn(
                $columns['dataset_name'],
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
            
            $main_editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_document_dataset_document_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('document_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_document_dataset_document_id_search');
            
            $text_editor = new TextEdit('document_id');
            
            $filterBuilder->addColumn(
                $columns['document_id'],
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
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_dataset_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_document_id_document_url_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_document_dataset_notes_handler_list');
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
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_dataset_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_document_id_document_url_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_notes_handler_view');
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
            // Edit column for dataset_name field
            //
            $editor = new TextAreaEdit('dataset_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Dataset Name', 'dataset_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for document_id field
            //
            $editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Document Id', 'document_id', 'document_id_document_url', 'edit_opt_document_dataset_document_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'document_url', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for dataset_name field
            //
            $editor = new TextAreaEdit('dataset_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Dataset Name', 'dataset_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for document_id field
            //
            $editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Document Id', 'document_id', 'document_id_document_url', 'multi_edit_opt_document_dataset_document_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'document_url', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for dataset_name field
            //
            $editor = new TextAreaEdit('dataset_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Dataset Name', 'dataset_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for document_id field
            //
            $editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Document Id', 'document_id', 'document_id_document_url', 'insert_opt_document_dataset_document_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'document_url', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_dataset_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_document_id_document_url_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_notes_handler_print');
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
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_dataset_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_document_id_document_url_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_notes_handler_export');
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
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_dataset_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_document_id_document_url_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_dataset_notes_handler_compare');
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
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_dataset_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_document_id_document_url_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_dataset_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_document_id_document_url_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_dataset_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_document_id_document_url_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_notes_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_document_dataset_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_dataset_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_dataset_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for dataset_name field
            //
            $column = new TextViewColumn('dataset_name', 'dataset_name', 'Dataset Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_dataset_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_document_id_document_url_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_dataset_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_document_dataset_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_document_dataset_document_id_search', 'id', 'document_url', null, 20);
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
    
    
    
    class opt_document_metadataPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Metadata');
            $this->SetMenuLabel('Metadata');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`metadata`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('contributor_id', true),
                    new DateField('date', true),
                    new IntegerField('acc_flag_id', true),
                    new IntegerField('location_id', true),
                    new StringField('ref1'),
                    new StringField('src1'),
                    new StringField('ref2'),
                    new StringField('src2'),
                    new StringField('ref3'),
                    new StringField('src3'),
                    new IntegerField('image_id'),
                    new IntegerField('document_id'),
                    new StringField('notes')
                )
            );
            $this->dataset->AddLookupField('location_id', 'opt_google_placeid', new IntegerField('id'), new StringField('google_place_id', false, false, false, false, 'location_id_google_place_id', 'location_id_google_place_id_opt_google_placeid'), 'location_id_google_place_id_opt_google_placeid');
            $this->dataset->AddLookupField('image_id', 'crop_image', new IntegerField('id'), new IntegerField('cropid', false, false, false, false, 'image_id_cropid', 'image_id_cropid_crop_image'), 'image_id_cropid_crop_image');
            $this->dataset->AddLookupField('document_id', 'opt_document', new IntegerField('id'), new StringField('document_url', false, false, false, false, 'document_id_document_url', 'document_id_document_url_opt_document'), 'document_id_document_url_opt_document');
            $this->dataset->AddLookupField('contributor_id', 'opt_employee', new IntegerField('id'), new StringField('name', false, false, false, false, 'contributor_id_name', 'contributor_id_name_opt_employee'), 'contributor_id_name_opt_employee');
            $this->dataset->AddLookupField('acc_flag_id', 'opt_accuracy_flag', new IntegerField('id'), new StringField('accuracy_flag', false, false, false, false, 'acc_flag_id_accuracy_flag', 'acc_flag_id_accuracy_flag_opt_accuracy_flag'), 'acc_flag_id_accuracy_flag_opt_accuracy_flag');
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
                new FilterColumn($this->dataset, 'date', 'date', 'Date'),
                new FilterColumn($this->dataset, 'location_id', 'location_id_google_place_id', 'Location Id'),
                new FilterColumn($this->dataset, 'ref1', 'ref1', 'Ref1'),
                new FilterColumn($this->dataset, 'src1', 'src1', 'Src1'),
                new FilterColumn($this->dataset, 'ref2', 'ref2', 'Ref2'),
                new FilterColumn($this->dataset, 'src2', 'src2', 'Src2'),
                new FilterColumn($this->dataset, 'ref3', 'ref3', 'Ref3'),
                new FilterColumn($this->dataset, 'src3', 'src3', 'Src3'),
                new FilterColumn($this->dataset, 'image_id', 'image_id_cropid', 'Image Id'),
                new FilterColumn($this->dataset, 'document_id', 'document_id_document_url', 'Document Id'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'contributor_id', 'contributor_id_name', 'Contributor Id'),
                new FilterColumn($this->dataset, 'acc_flag_id', 'acc_flag_id_accuracy_flag', 'Acc Flag Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['date'])
                ->addColumn($columns['location_id'])
                ->addColumn($columns['ref1'])
                ->addColumn($columns['src1'])
                ->addColumn($columns['ref2'])
                ->addColumn($columns['src2'])
                ->addColumn($columns['ref3'])
                ->addColumn($columns['src3'])
                ->addColumn($columns['image_id'])
                ->addColumn($columns['document_id'])
                ->addColumn($columns['notes'])
                ->addColumn($columns['contributor_id'])
                ->addColumn($columns['acc_flag_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('date')
                ->setOptionsFor('location_id')
                ->setOptionsFor('image_id')
                ->setOptionsFor('document_id')
                ->setOptionsFor('contributor_id')
                ->setOptionsFor('acc_flag_id');
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
            
            $main_editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['date'],
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
            
            $main_editor = new DynamicCombobox('location_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_document_metadata_location_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('location_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_document_metadata_location_id_search');
            
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
            
            $main_editor = new TextEdit('ref1');
            
            $filterBuilder->addColumn(
                $columns['ref1'],
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
            
            $main_editor = new TextEdit('src1');
            
            $filterBuilder->addColumn(
                $columns['src1'],
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
            
            $main_editor = new TextEdit('ref2');
            
            $filterBuilder->addColumn(
                $columns['ref2'],
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
            
            $main_editor = new TextEdit('src2');
            
            $filterBuilder->addColumn(
                $columns['src2'],
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
            
            $main_editor = new TextEdit('ref3');
            
            $filterBuilder->addColumn(
                $columns['ref3'],
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
            
            $main_editor = new TextEdit('src3');
            
            $filterBuilder->addColumn(
                $columns['src3'],
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
            
            $main_editor = new DynamicCombobox('image_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_document_metadata_image_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('image_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_document_metadata_image_id_search');
            
            $filterBuilder->addColumn(
                $columns['image_id'],
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
            
            $main_editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_document_metadata_document_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('document_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_document_metadata_document_id_search');
            
            $text_editor = new TextEdit('document_id');
            
            $filterBuilder->addColumn(
                $columns['document_id'],
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
            
            $main_editor = new DynamicCombobox('contributor_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_document_metadata_contributor_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('contributor_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_document_metadata_contributor_id_search');
            
            $text_editor = new TextEdit('contributor_id');
            
            $filterBuilder->addColumn(
                $columns['contributor_id'],
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
            
            $main_editor = new DynamicCombobox('acc_flag_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_opt_document_metadata_acc_flag_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('acc_flag_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_opt_document_metadata_acc_flag_id_search');
            
            $text_editor = new TextEdit('acc_flag_id');
            
            $filterBuilder->addColumn(
                $columns['acc_flag_id'],
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
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref1_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src1_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref2_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src2_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref3_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src3_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cropid field
            //
            $column = new NumberViewColumn('image_id', 'image_id_cropid', 'Image Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_document_id_document_url_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_document_metadata_notes_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_contributor_id_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for accuracy_flag field
            //
            $column = new TextViewColumn('acc_flag_id', 'acc_flag_id_accuracy_flag', 'Acc Flag Id', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref1_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src1_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref2_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src2_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref3_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src3_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cropid field
            //
            $column = new NumberViewColumn('image_id', 'image_id_cropid', 'Image Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_document_id_document_url_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_contributor_id_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for accuracy_flag field
            //
            $column = new TextViewColumn('acc_flag_id', 'acc_flag_id_accuracy_flag', 'Acc Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'edit_opt_document_metadata_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ref1 field
            //
            $editor = new TextAreaEdit('ref1_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref1', 'ref1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for src1 field
            //
            $editor = new TextAreaEdit('src1_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src1', 'src1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ref2 field
            //
            $editor = new TextAreaEdit('ref2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref2', 'ref2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for src2 field
            //
            $editor = new TextAreaEdit('src2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src2', 'src2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ref3 field
            //
            $editor = new TextAreaEdit('ref3_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref3', 'ref3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for src3 field
            //
            $editor = new TextAreaEdit('src3_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src3', 'src3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for image_id field
            //
            $editor = new DynamicCombobox('image_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Image Id', 'image_id', 'image_id_cropid', 'edit_opt_document_metadata_image_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'cropid', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for document_id field
            //
            $editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Document Id', 'document_id', 'document_id_document_url', 'edit_opt_document_metadata_document_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'document_url', '');
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
            // Edit column for contributor_id field
            //
            $editor = new DynamicCombobox('contributor_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Contributor Id', 'contributor_id', 'contributor_id_name', 'edit_opt_document_metadata_contributor_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for acc_flag_id field
            //
            $editor = new DynamicCombobox('acc_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Acc Flag Id', 'acc_flag_id', 'acc_flag_id_accuracy_flag', 'edit_opt_document_metadata_acc_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'accuracy_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'multi_edit_opt_document_metadata_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ref1 field
            //
            $editor = new TextAreaEdit('ref1_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref1', 'ref1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for src1 field
            //
            $editor = new TextAreaEdit('src1_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src1', 'src1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ref2 field
            //
            $editor = new TextAreaEdit('ref2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref2', 'ref2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for src2 field
            //
            $editor = new TextAreaEdit('src2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src2', 'src2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ref3 field
            //
            $editor = new TextAreaEdit('ref3_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref3', 'ref3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for src3 field
            //
            $editor = new TextAreaEdit('src3_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src3', 'src3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for image_id field
            //
            $editor = new DynamicCombobox('image_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Image Id', 'image_id', 'image_id_cropid', 'multi_edit_opt_document_metadata_image_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'cropid', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for document_id field
            //
            $editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Document Id', 'document_id', 'document_id_document_url', 'multi_edit_opt_document_metadata_document_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'document_url', '');
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
            // Edit column for contributor_id field
            //
            $editor = new DynamicCombobox('contributor_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Contributor Id', 'contributor_id', 'contributor_id_name', 'multi_edit_opt_document_metadata_contributor_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for acc_flag_id field
            //
            $editor = new DynamicCombobox('acc_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Acc Flag Id', 'acc_flag_id', 'acc_flag_id_accuracy_flag', 'multi_edit_opt_document_metadata_acc_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'accuracy_flag', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Location Id', 'location_id', 'location_id_google_place_id', 'insert_opt_document_metadata_location_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'google_place_id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ref1 field
            //
            $editor = new TextAreaEdit('ref1_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref1', 'ref1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for src1 field
            //
            $editor = new TextAreaEdit('src1_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src1', 'src1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ref2 field
            //
            $editor = new TextAreaEdit('ref2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref2', 'ref2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for src2 field
            //
            $editor = new TextAreaEdit('src2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src2', 'src2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ref3 field
            //
            $editor = new TextAreaEdit('ref3_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ref3', 'ref3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for src3 field
            //
            $editor = new TextAreaEdit('src3_edit', 50, 8);
            $editColumn = new CustomEditColumn('Src3', 'src3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for image_id field
            //
            $editor = new DynamicCombobox('image_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Image Id', 'image_id', 'image_id_cropid', 'insert_opt_document_metadata_image_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'cropid', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for document_id field
            //
            $editor = new DynamicCombobox('document_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Document Id', 'document_id', 'document_id_document_url', 'insert_opt_document_metadata_document_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'document_url', '');
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
            // Edit column for contributor_id field
            //
            $editor = new DynamicCombobox('contributor_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Contributor Id', 'contributor_id', 'contributor_id_name', 'insert_opt_document_metadata_contributor_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for acc_flag_id field
            //
            $editor = new DynamicCombobox('acc_flag_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Acc Flag Id', 'acc_flag_id', 'acc_flag_id_accuracy_flag', 'insert_opt_document_metadata_acc_flag_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'accuracy_flag', '');
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
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref1_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src1_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref2_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src2_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref3_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src3_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for cropid field
            //
            $column = new NumberViewColumn('image_id', 'image_id_cropid', 'Image Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_document_id_document_url_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_notes_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_contributor_id_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for accuracy_flag field
            //
            $column = new TextViewColumn('acc_flag_id', 'acc_flag_id_accuracy_flag', 'Acc Flag Id', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref1_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src1_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref2_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src2_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref3_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src3_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for cropid field
            //
            $column = new NumberViewColumn('image_id', 'image_id_cropid', 'Image Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_document_id_document_url_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_notes_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_contributor_id_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for accuracy_flag field
            //
            $column = new TextViewColumn('acc_flag_id', 'acc_flag_id_accuracy_flag', 'Acc Flag Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for google_place_id field
            //
            $column = new TextViewColumn('location_id', 'location_id_google_place_id', 'Location Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref1_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src1_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref2_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src2_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_ref3_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_src3_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for cropid field
            //
            $column = new NumberViewColumn('image_id', 'image_id_cropid', 'Image Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_document_id_document_url_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_notes_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_metadata_contributor_id_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for accuracy_flag field
            //
            $column = new TextViewColumn('acc_flag_id', 'acc_flag_id_accuracy_flag', 'Acc Flag Id', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref1_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src1_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref2_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src2_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref3_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src3_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_document_id_document_url_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_contributor_id_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref1_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src1_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref2_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src2_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref3_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src3_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_document_id_document_url_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_contributor_id_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref1_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src1_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref2_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src2_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref3_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src3_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_document_id_document_url_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_notes_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_contributor_id_name_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_document_metadata_image_id_search', 'id', 'cropid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_document_metadata_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_document_metadata_contributor_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_opt_document_metadata_acc_flag_id_search', 'id', 'accuracy_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_image_id_search', 'id', 'cropid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_contributor_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_opt_document_metadata_acc_flag_id_search', 'id', 'accuracy_flag', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref1 field
            //
            $column = new TextViewColumn('ref1', 'ref1', 'Ref1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref1_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src1 field
            //
            $column = new TextViewColumn('src1', 'src1', 'Src1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src1_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref2 field
            //
            $column = new TextViewColumn('ref2', 'ref2', 'Ref2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref2_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src2 field
            //
            $column = new TextViewColumn('src2', 'src2', 'Src2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src2_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ref3 field
            //
            $column = new TextViewColumn('ref3', 'ref3', 'Ref3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_ref3_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for src3 field
            //
            $column = new TextViewColumn('src3', 'src3', 'Src3', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_src3_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_id', 'document_id_document_url', 'Document Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_document_id_document_url_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('contributor_id', 'contributor_id_name', 'Contributor Id', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_metadata_contributor_id_name_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_document_metadata_image_id_search', 'id', 'cropid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_document_metadata_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_document_metadata_contributor_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_opt_document_metadata_acc_flag_id_search', 'id', 'accuracy_flag', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_document_metadata_location_id_search', 'id', 'google_place_id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`crop_image`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('cropid', true),
                    new StringField('image_url', true),
                    new StringField('creator', true),
                    new StringField('publisher'),
                    new StringField('rights'),
                    new StringField('original'),
                    new StringField('identifier'),
                    new StringField('notes'),
                    new IntegerField('metadata_id', true)
                )
            );
            $lookupDataset->setOrderByField('cropid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_document_metadata_image_id_search', 'id', 'cropid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
            $lookupDataset->setOrderByField('document_url', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_document_metadata_document_id_search', 'id', 'document_url', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_employee`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('email'),
                    new StringField('phone'),
                    new StringField('title'),
                    new StringField('department'),
                    new StringField('institute'),
                    new StringField('expertise'),
                    new IntegerField('cff_staff'),
                    new IntegerField('bera_flag'),
                    new IntegerField('connect_flag'),
                    new IntegerField('db_contributor_flag'),
                    new StringField('notes')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_document_metadata_contributor_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_accuracy_flag`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('accuracy_flag', true),
                    new StringField('description')
                )
            );
            $lookupDataset->setOrderByField('accuracy_flag', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_opt_document_metadata_acc_flag_id_search', 'id', 'accuracy_flag', null, 20);
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
    
    
    
    class opt_documentPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Opt Document');
            $this->SetMenuLabel('Document');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`opt_document`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('document_url', true),
                    new StringField('notes'),
                    new IntegerField('metadata_id')
                )
            );
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
                new FilterColumn($this->dataset, 'id', 'id', 'Option ID'),
                new FilterColumn($this->dataset, 'document_url', 'document_url', 'Document Url'),
                new FilterColumn($this->dataset, 'notes', 'notes', 'Notes'),
                new FilterColumn($this->dataset, 'metadata_id', 'metadata_id_id', 'Metadata Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['document_url'])
                ->addColumn($columns['notes']);
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
            
            $main_editor = new TextEdit('document_url');
            
            $filterBuilder->addColumn(
                $columns['document_url'],
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
            if (GetCurrentUserPermissionSetForDataSource('opt_document.dataset')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_document_dataset detail
            //
            $column = new DetailColumn(array('id'), 'opt_document.dataset', 'opt_document_dataset_handler', $this->dataset, 'Dataset');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('opt_document.metadata')->HasViewGrant() && $withDetails)
            {
            //
            // View column for opt_document_metadata detail
            //
            $column = new DetailColumn(array('id'), 'opt_document.metadata', 'opt_document_metadata_handler', $this->dataset, 'Metadata');
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
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_document_url_handler_list');
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
            $column->SetFullTextWindowHandlerName('opt_document_notes_handler_list');
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
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_document_url_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for document_url field
            //
            $editor = new TextAreaEdit('document_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Document Url', 'document_url', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for document_url field
            //
            $editor = new TextAreaEdit('document_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Document Url', 'document_url', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for document_url field
            //
            $editor = new TextAreaEdit('document_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Document Url', 'document_url', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_document_url_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_notes_handler_print');
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
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_document_url_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_notes_handler_export');
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
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_document_url_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('opt_document_notes_handler_compare');
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
            $detailPage = new opt_document_datasetPage('opt_document_dataset', $this, array('document_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_document.dataset'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_document.dataset'));
            $detailPage->SetHttpHandlerName('opt_document_dataset_handler');
            $handler = new PageHTTPHandler('opt_document_dataset_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new opt_document_metadataPage('opt_document_metadata', $this, array('document_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('opt_document.metadata'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('opt_document.metadata'));
            $detailPage->SetHttpHandlerName('opt_document_metadata_handler');
            $handler = new PageHTTPHandler('opt_document_metadata_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_document_url_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_document_url_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_notes_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_document_url_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_notes_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for document_url field
            //
            $column = new TextViewColumn('document_url', 'document_url', 'Document Url', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_document_url_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'opt_document_notes_handler_view', $column);
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
        $Page = new opt_documentPage("opt_document", "opt_document.php", GetCurrentUserPermissionSetForDataSource("opt_document"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("opt_document"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
