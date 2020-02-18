{capture assign='FormControlLabel'}
    {include file='forms/field_label.tpl'}
{/capture}

{if $Grid.FormLayout->isHorizontal()}
    <div class="form-group form-group-label col-sm-{$Col->getLabelWidth()}"{$FormControlStyles}>
        {$FormControlLabel}
    </div>
    <div class="form-group col-sm-{$Col->getInputWidth()}"{$FormControlStyles}>
        {$FormControl}
    </div>
{else}
    <div class="form-group col-sm-{$Col->getWidth()}"{$FormControlStyles}>
        {$FormControlLabel}
        {$FormControl}
    </div>
{/if}