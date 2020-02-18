<div class="row">
    <?php $_from = $this->_tpl_vars['Grid']['FormLayout']->getGroups(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Group']):
?>
        <?php if (count ( $this->_tpl_vars['Group']->getRows() ) > 0): ?>
            <fieldset class="col-md-<?php echo $this->_tpl_vars['Group']->getWidth(); ?>
">
                <?php if ($this->_tpl_vars['Group']->getName()): ?>
                    <legend>
                        <?php echo $this->_tpl_vars['Group']->getName(); ?>

                    </legend>
                <?php endif; ?>
                <?php $_from = $this->_tpl_vars['Group']->getRows(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Row']):
?>
                    <div class="row">
                        <?php $_from = $this->_tpl_vars['Row']->getCols(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Col']):
?>
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'forms/form_field.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</div>